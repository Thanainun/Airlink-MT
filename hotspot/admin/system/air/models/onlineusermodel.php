<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Onlineusermodel extends CI_Model {
	function __construct()
	{
		parent::__construct();
	
		$this->_table_voucher = 'voucher_list'; 
		$this->_table_accesspoint = 'accesspoint';
		
		
		
		// Ajax
		$this->nColumns = array('username', 'billingplan', 'valid_until', 'time_used', 'time_remain', 'packet_used', 'packet_remain', 'valid');
		$this->sTable = "radacct ra left join  accesspoint ap on ap.calledstationid=ra.calledstationid";
		$this->aColumns = array('ra.radacctid','ra.username', 'ap.location', 'ap.name', 'ra.acctstarttime', 'ra.acctsessiontime', 'ra.acctoutputoctets','ra.framedipaddress' );

	}
	
	function data_table()
	{
		
		$select = "
			ra.username, 
			ra.radacctid as radacctid,
			ra.callingstationid as mac,
			ra.framedipaddress as client_ip,
			MAX(ra.acctstarttime) as start, 
			(ra.calledstationid) as nasip, 
			(ap.location) as location, 
			(ap.name) as accesspoint, 
			(ra.acctstoptime) as stop, 
			sum(ra.acctsessiontime) as time,
			sum(ra.acctoutputoctets)+sum(ra.acctinputoctets) as packet 
		";
		
		
		$where = "(ra.acctstoptime IS NULL) and ( ap.calledstationid=ra.calledstationid )  group by ra.callingstationid";

		$jdata = $this->jsonmodel->data_table($this->sTable, $this->aColumns, $select, $where);
		
		$output = $jdata['output'];

		$num = 1;
		foreach ($jdata['rResult']->result() as $row)
		{	
			
			$jdata = array();
			
			$username = (substr($row->username,0,3)=='BP-') ? $row->username : anchor('admin/user/info/'.$row->username, $row->username, 'id="info" class="dialog"');
			$firstname = "";

			$jdata[] .= (($_GET['iDisplayStart']==0) ? '' : $_GET['iDisplayStart']/10).($num++);
			$jdata[] .= $username;
			//$jdata[] .= ($firstname != NULL ? $firstname : '---');
			$jdata[] .= $row->client_ip;
			$jdata[] .= $row->mac;
			$jdata[] .= $row->start;
			$jdata[] .= time_data($row->time,'hm');
			$jdata[] .= byte_format($row->packet);
			$jdata[] .= anchor('admin/onlineuser/disconnect/'.$row->client_ip,'<img width="16" height="16" src='.other_asset_url('delete.gif','','images').'>','class="disconnect"');

			$output['aaData'][] = $jdata;
			
		}
		
		return json_encode( $output );
		
	}
	
	function getLocation($fields = null, $limit = null, $where = null)
	{
		
		($fields != null) ? $this->db->select($fields) :'';
		
		($where != null) ? $this->db->where($where) :'';
		
		($limit !=null ) ? $this->db->limit($limit['start'],$limit['end']) :'';
		
		//return the query string
		return $this->db->get($this->_table_accesspoint);
	}
	
	function getNasip($username)
	{
		$this->db->select('ap.ipaddr as ip')
				->from('accesspoint ap')
				->join('radacct ra','ap.calledstationid=ra.calledstationid','left')
				->where(array('ra.username'=>$username,'ra.acctstoptime'=>NULL));
				
		return $this->db->get()->row();
	}

	function get_accessdays($fortime, $totime)
	{
		
		return $this->db->query("select MIN(radacct.acctstarttime) as time, (COUNT((radacct.acctstarttime >= '".$fortime."') and (radacct.acctstarttime <= '".$totime."'))) as accesscount from radacct left join voucher_list on voucher_list.username=radacct.username where (radacct.acctstarttime >= '".$fortime."') and (radacct.acctstarttime <= '".$totime."')");
	}

	function get_accessmonth($date)
	{
		
		return $this->db->query('
		select sum(price) as price  from 
		(	SELECT  sum( t.price ) as  price
			FROM topup_queue t, voucher_list v
			WHERE v.username = t.username  and t.date >= "'.$date.'-01 00:00:00" and t.date <= "'.$date.'-31 23:59:59"
			union 
			SELECT sum( price) as  price
			FROM  voucher_list 
			WHERE username not in (select username from topup_queue )  and  start_time is not null and start_time >= "'.$date.'-01 00:00:00" and start_time <= "'.$date.'-31 23:59:59" 
		)  as prices
		');
		
	}

}

?>

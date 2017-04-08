<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

Class StatisticModel extends CI_Model {
	function __construct()
	{
		parent::__construct();
		
		// Ajax
		$this->sTable = "billingplan";
		$this->sIndexColumn = "id";
		$this->aColumns = array('id','name', 'type', 'profile', 'amount', 'valid_for', 'price', 'bw_download', 'bw_upload', 'created_by' );

	}
	
	function getVoucherTopup($fields)
	{
		
		return $this->db->query($fields);
	}
	function get($start,$end)
	{   
		return $this->db->query(' SELECT  sum( t.price ) AS p
		FROM topup_queue t, voucher_list v
		WHERE v.username = t.username  and t.date >= "'.$start.' 00:00:00" and t.date <= "'.$end.' 23:59:59"
		union all
		SELECT sum( price) as p
		FROM  voucher_list 
		WHERE username not in (select username from topup_queue )  and  start_time is not null and start_time >= "'.$start.' 00:00:00" and start_time <= "'.$end.' 23:59:59" 
		');
	}
	function getm()
	{   
		return $this->db->query(' SELECT  sum( t.price ) AS p
		FROM topup_queue t, voucher_list v
		WHERE v.username = t.username  and t.date >= "'.date('Y-m').'-01 00:00:00" and t.date <= "'.date('Y-m-d H:i:s').'"
		union all
		SELECT sum(price) as p
		FROM  voucher_list 
		WHERE username not in (select username from topup_queue )  and  start_time is not null and start_time >= "'.date('Y-m').'-01 00:00:00" and start_time <= "'.date('Y-m-d H:i:s').'" '
		);
	}
	function getd()
	{    return $this->db->query(' SELECT  sum( t.price ) AS p
		FROM topup_queue t, voucher_list v
		WHERE v.username = t.username and t.date >= "'.date('Y-m-d').' 00:00:00" and t.date <= "'.date('Y-m-d H:i:s').'"
		union all
		SELECT sum(price) as p
		FROM  voucher_list 
		WHERE username not in (select username from topup_queue )  and  start_time is not null and start_time >= "'.date('Y-m-d').' 00:00:00" and start_time <= "'.date('Y-m-d H:i:s').'" '
		);
	}
	function getAll()
	{
		return $this->db->query(	' SELECT  sum( t.price ) AS p
		FROM topup_queue t, voucher_list v
		WHERE v.username = t.username  and t.date <= "'.date('Y-m-d H:i:s').'"
	
		union all
		SELECT sum( price) as p
		FROM  voucher_list 
		WHERE username not in (select username from topup_queue )  and  start_time is not null and start_time <= "'.date('Y-m-d H:i:s').'"');
	}

	function gety()
	{	
		return $this->db->query(' SELECT  sum( t.price ) AS p
		FROM topup_queue t, voucher_list v
		WHERE v.username = t.username and t.date >= "'.date('Y').'-01-01 00:00:00" and t.date <= "'.date('Y-m-d H:i:s').'"
	
		union all 
		SELECT sum( price) as p
		FROM  voucher_list 
		WHERE username not in (select username from topup_queue )  and  start_time is not null and start_time >= "'.date('Y').'-01-01 00:00:00" and start_time <= "'.date('Y-m-d H:i:s').'"');
	}
	
	
}

?>

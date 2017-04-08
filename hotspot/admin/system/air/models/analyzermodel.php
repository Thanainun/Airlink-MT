<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

Class AnalyzerModel extends CI_Model {
	function __construct()
	{
		parent::__construct();
		
		// Ajax
		$this->sTable = "billingplan";
		$this->sIndexColumn = "id";
		$this->aColumns = array('id','name', 'type', 'profile', 'amount', 'valid_for', 'price', 'bw_download', 'bw_upload', 'created_by' );

	}
	
	function getP()
	{
		return $this->db->query('select (sum(price)) AS p from voucher_list where start_time >= "'.date('Y-m').'-01 00:00:00" and start_time <= "'.date('Y-m-d H:i:s').'" and  start_time IS NOT NULL');
	}
			// สำหรับผู้ที่เริ่มใช้งานจนถึงวันนี้
	function getAll()
	{
		return $this->db->query('select (sum(price)) AS p from voucher_list where start_time <= "'.date('Y-m-d H:i:s').'" and  start_time IS NOT NULL');
	}

	function getPYear($ontime)
	{
		return $this->db->query('select (sum(price)) AS p from voucher_list where start_time >= "'.$ontime.'-01 00:00:00" and start_time <= "'.$ontime.'-31 23:59:59" and  start_time IS NOT NULL');
	}
	
	function getTotalOnlineUser()
	{
		//return $this->db

	}
	
	function getProxyhistory($start,$stop,$ip,$username)
	{
		$d_regex = '/[0-9]+\-[0-9]+\-[0-9]+/';
		$t_regex = '/[0-9]+\:[0-9]+\:[0-9]+/';
		
		preg_match($d_regex, $start, $d_start);
		preg_match($d_regex, $stop, $d_stop);
		
		preg_match($t_regex, $start, $t_start);
		preg_match($t_regex, $stop, $t_stop);

		$wd = array(
				'al.date' => $d_start[0],
				'al.time > '=> $t_start[0],
				'al.time < '=> ($t_stop!=NULL) ? $t_stop[0] : date('H:i:s'),
				'al.authuser'=>$username,
				'ra.username'=>$username
				);

		return $this->db->select('ra.radacctid AS id,
								ra.username AS username,
								al.url AS request_url,
								ra.framedipaddress AS client_ip_addr,
								al.date AS date_day,
								al.time AS date_time,
								sum(al.bytes) AS packet_size,
								al.ip AS server_ip_addr
								')
				->from('radacct ra')
				->join('traffic al','al.authuser = ra.username','left')
				->where($wd)
				->order_by('al.id', 'DESC ')
				->group_by('al.url')
				->get();
	}
	
	
	function getCachehit()
	{			
		return $this->db->select('id AS prec_all')
					->from('trafficSummaries')
					->where(array('outCache'=>'outCache'))
					->get()
					->row();
	}
	
	
	function getHitperday()
	{	
		return $this->db->select('id AS perc_day')
					->from('trafficSummaries')
					->where(array('date'=>date('Y-m-d')))
					->get()
					->row();
	}
}

?>

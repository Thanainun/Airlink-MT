<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

Class Analyse extends CI_Model {
	function __construct()
	{
		parent::__construct();
		
		

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
				//'al.date < ' => $d_stop[0],
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
		return $this->db->select('summaryTime AS prec_all')
					->from('trafficSummaries')
					->where(array('hits'=>'hits'))
					->get()
					->row();
	}
	
	function getHitperday()
	{
		return $this->db->select('hits_per_day_perc AS perc_day')
					->from('trafficSummaries')
					->where(array('date_day'=>date('Y-m-d')))
					->get()
					->row();
	}
}
	
	

?>

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Server
 *
 * Server Controller
 *
 * @package		server
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */
Class Server extends CI_Controller

{
	function __construct()
	{
		parent::__construct();

		$this->load->library('cpuload');
		$this->cpuload->get_load();
		
	}

	function index()
	{
		$this->load->helper('server');
		$tr = getBandwidth();
		print_r ($tr[3]);
	}
	
	
	
	function status()
	{
		$this->load->helper('number');
		$this->load->helper('serverinfo');
		$this->load->helper('server'); 
		
		//Hdd info
		$perc =  round((disk_free_space("/")*100) / disk_total_space("/"),2);
		$hddperc = 100 - $perc;

		$mem_array = get_memory();

		$memperc = round(($mem_array['Inactive']*100) / $mem_array['MemTotal'],2);

		$load = sprintf("%.1f",$this->cpuload->load["cpu"]);

		$data = array(	'cpu_load'=>sprintf("ซีพียู : %.1f%%",100-$this->cpuload->load["idle"]),
						'cpu_perc'=>sprintf("%.1f",$this->cpuload->load["cpu"]),
						'memory_usage'=>byte_format($mem_array['Inactive']*1024),
						'momory_total'=>byte_format($mem_array['MemTotal']*1024),
						'memory_perc'=>$memperc,
						'hdd_total_space'=>byte_format(disk_total_space("/")),
						'hdd_free_space'=>byte_format(disk_total_space("/")-disk_free_space("/")),
						'hdd_perc'=>$hddperc
					);

		print json_encode($data);
	}
	
	function mt_status()
	{
		$this->load->helper('number');
		$this->load->helper('mikrotik');
		$this->load->model('siteconfigmodel');
		$global = $this->siteconfigmodel->getConfig('mikrotik_config');
		$data = $this->session->_unserialize($global->value);
		$API = new routeros_api();

		$API->debug = false;

		if ($API->connect($data['ipaddress'], $data['username'], $data['password'])) {

		$API = $API->comm("/system/resource/print");		}
		$first = $API['0'];
		$memperc = round(($first['free-memory']) / $first['total-memory']);
		$hdd_free = round(($first['total-hdd-space']) - $first['free-hdd-space']);
		$perc =  round(($first['free-hdd-space']) / $first['total-hdd-space']*100,2);
		$hddperc = 100 - $perc;
		
		$mtdata = array(
						'mtcpu_load'=>sprintf("ซีพียู : %.1f%%",$first['cpu-load']),
						'mtcpu_perc'=>sprintf("%.1f",$first['cpu-load']),	
						'mtmemory_usage'=>byte_format($first['total-memory']) - byte_format($first['free-memory']),
						'mtmomory_total'=>byte_format($first['total-memory']),
						'mtmemory_perc'=>$memperc,
						'mthdd_total_space'=>byte_format($first['total-hdd-space']),
						'mthdd_free_space'=>byte_format($hdd_free),
						'mthdd_perc'=>$hddperc
					);

		print json_encode($mtdata);

	
		
	}
}

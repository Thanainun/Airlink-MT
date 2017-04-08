<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Dashboard
 *
 * Dashboard Controller
 *
 * @package		dashboard
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Dashboard extends MY_Admin
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('usermodel','billingplanmodel','siteconfigmodel','statisticmodel'));
		$this->load->helper(array('js','number','server'));
    }

    /**
     * Displays home page of Admin Console
     *
     */
    function index()
    {
		
		
		$this->load->library('graph');
		
		//get billingplan 
		$bp_qty = array();
		$bp_label = array();
		$data['billingplans'] = $this->billingplanmodel->getBillingPlanStat();
		foreach ($data['billingplans']->result() as $billingplan) {
			$bp_qty[] = $billingplan->qty;
			$bp_label[] = $billingplan->billingplan;
		}
		
		//PIE chart, 60% alpha
		//
		$this->graph->set_width(380);
		$this->graph->set_height(225);
		$this->graph->pie(80,'#0279c5','{font-size: 12px; color: #404040;');
		//
		// pass in two arrays, one of data, the other data labels
		//
		$this->graph->pie_values( $bp_qty, $bp_label );
		//
		// Colours for each slice, in this case some of the colours
		// will be re-used (3 colurs for 5 slices means the last two
		// slices will have colours colour[0] and colour[1]):
		//
		$this->graph->pie_slice_colours( array('#d9db35','#0599f7','#d00000','#4ae331') );

		$this->graph->set_tool_tip( $this->lang->line('dashboard_flashtool_tip') );
		$this->graph->bg_colour = '#FFFFFF';
		$this->graph->title( '', '{font-size:14px; color: #7F7772}' );
		$this->graph->set_output_type('js');
		
		$data['chilli'] = (trim(shell_exec("ps -A | grep chilli | awk {'print \$4'}"))) ? '<span style="float:right;padding-right:10px;"><img width="32" height="32" src='.other_asset_url('online_server.png','','images').'></span>' : '<span style="float:right;padding-right:10px;"><img width="32" height="32" src='.other_asset_url('offline_server.png','','images').'></span>';
		
		$data['radius'] = (trim(shell_exec("ps -A | grep freeradius | awk {'print \$4'}"))) ? '<span style="float:right;padding-right:10px;"><span style="float:right;padding-right:10px;"><img width="32" height="32" src='.other_asset_url('online_server.png','','images').'></span>' : '<span style="float:right;padding-right:10px;"><img width="32" height="32" src='.other_asset_url('offline_server.png','','images').'></span>';
		
		$data['proxy'] = (trim(shell_exec("ps -A | grep squid | awk {'print \$4'}"))) ? '<span style="float:right;padding-right:10px;"><img width="32" height="32" src='.other_asset_url('online_server.png','','images').'></span>' : '<span style="float:right;padding-right:10px;"><img width="32" height="32" src='.other_asset_url('offline_server.png','','images').'></span>';
		
		$data['http'] = (trim(shell_exec("ps -A | grep apache2 | awk {'print \$4'}"))) ? '<span style="float:right;padding-right:10px;"><img width="32" height="32" src='.other_asset_url('online_server.png','','images').'></span>' : '<span style="float:right;padding-right:10px;"><img width="32" height="32" src='.other_asset_url('offline_server.png','','images').'></span>';
		
		$data['user'] = $this->usermodel->getAdmin('',null,array('username'=>$this->session->userdata('user')))->row(); 
		//get the vouchers data
		$data['voucher'] = $this->usermodel->getVoucherStatistics();
		$data['pp'] = $this->statisticmodel->getAll();
	    $this->template->add_js('dashboard.js?'._DATETIME)
						->write_view('left-content', 'admin/dashboard', $data)
						->render();
        
    }
	
	function Shutdown()
{
		sleep(1);
		$ck = shell_exec('sudo /sbin/shutdown -h now');
		echo $ck;
		redirect('admin/dashboard', 'location');
}

	function Restart()
{
		sleep(1);
		$ck = shell_exec('sudo /sbin/shutdown -r now');
		redirect('admin/dashboard', 'location');
		echo $ck;
		
}

	function Clear()
{
		
		$ck = shell_exec('/usr/bin/sudo -u root /sbin/sysctl vm.drop_caches=3');
		echo $ck;
		sleep(1);
		redirect('admin/dashboard', 'location');
}
	function Network()
{
		
		$ck = shell_exec('/usr/bin/sudo -u root /etc/init.d/networking force-reload');
		echo $ck;
		sleep(5);
		redirect('admin/dashboard', 'location');
}

	function Firewall()
{
		
		$ck = shell_exec('/usr/bin/sudo -u root /etc/chilli/fw_reload.sh 2>&1');
		echo $ck;
		sleep(1);
		redirect('admin/dashboard', 'location');
}	
	function Webserver()
{
		
		$ck = shell_exec('/usr/bin/sudo -u root service apache2 reload');
		echo $ck;
		sleep(5);
		redirect('admin/dashboard', 'location');
}
	function Squid()
{
		
		$ck = shell_exec('/usr/bin/sudo -u root /usr/sbin/squid3 -k reconfigure');
		echo $ck;
		sleep(5);
		redirect('admin/dashboard', 'location');
}
	function Coova()
{
		
		$ck = shell_exec('/usr/bin/sudo -u root /etc/init.d/chilli reload');
		echo $ck;
		sleep(5);
		redirect('admin/dashboard', 'location');
}
	function Radius()
{
		
		$ck = shell_exec('/usr/bin/sudo -u root /etc/init.d/freeradius restart');
		echo $ck;
		sleep(5);
		redirect('admin/dashboard', 'location');
}

	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน ส่วนแสดงการทำงานระบบ</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}
	
}
	
/* End of file dashboard.php */
/* Location: ./system/nostradius/controllers/admin/dashboard.php */
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * -* Gu!tar *-
 *
 * Class Siteconfigmodel
 *
 * @package     Siteconfigmodel
 * @subpackage  Models
 * @category    Siteconfig
 * @author      Soontorn Jonmee
 * @license		http://www.gnu.org/licenses/gpl.html
 * @link 		http://nost.project-hotspot.net
 * @version 	1.0
 */
Class Siteconfigmodel extends CI_Model {
	function __construct()
	{
		parent::__construct();

		
		$this->_table='config';
	}
	
	function getConfig($where = NULL, $fields = 'value')
	{
		$this->db->select($fields);
		
		($where != NULL) ? $this->db->where(array('name'=>$where)) :'';
		
		return $this->db->get($this->_table)->row();
	}
	
	function updateConfig($where,$value)
	{
		$this->db->where('name',$where);
		$this->db->update($this->_table,$value);
	}

	function addConfig($dataconf)
	{
		$this->db->insert($this->_table,$dataconf);
	}
	
	function delConfig()
	{
		$this->db->where('name',$_POST['name']);
		$this->db->delete($this->_table);
	}

	function DataExist($gdata)
	{
		$query=$this->siteconfigmodel->getConfig($gdata);
		
		if(isset($query->value))
			return TRUE;
		else 
			return FALSE;
	}
	function write_config_qos($new,$old)
	{
		$check = TRUE;
		$qos_conf_config = read_file($this->config->item('QOS_COFIG_FILE'));
		foreach($old as $key=>$value)
		{
			$qos_conf_config = str_replace($value, $new[$key], $qos_conf_config);
		}
		if ( ! write_file($this->config->item('QOS_COFIG_FILE'), $qos_conf_config)) $check = FALSE;
		return $check;

	}
	function write_config($new,$old)
	{
	
		$check = TRUE;
	
		$chilli_config = read_file($this->config->item('CHILLISPOT_COFIG_FILE'));
		$freeradius_config = read_file($this->config->item('RADIUS_COFIG_FILE'));
		$squid_config = read_file($this->config->item('SQUID_LOCALNET'));

		foreach($old as $key=>$value)
		{
			$chilli_config = str_replace($value, $new[$key], $chilli_config);
			$freeradius_config = str_replace($value, $new[$key], $freeradius_config);
			$squid_config = str_replace($value, $new[$key], $squid_config);

		}

		if ( ! write_file($this->config->item('CHILLISPOT_COFIG_FILE'), $chilli_config)) $check = FALSE;
		if ( ! write_file($this->config->item('RADIUS_COFIG_FILE'), $freeradius_config)) $check = FALSE;
		if ( ! write_file($this->config->item('SQUID_LOCALNET'), $squid_config)) $check = FALSE;

		return $check;

	}
	
	function serviceRestart($service='allservice')
	{
		$flag['rep'] = TRUE;

		switch($service)
		{
			
			case 'apache2' :
				$output = shell_exec('/usr/bin/sudo -u root /etc/init.d/apache2 reload');
				sleep(1);
			break;
			
			case 'qos' :
				$output = shell_exec('/etc/chilli/fw_reload.sh 2>&1');
				sleep(1);
			break;
			
			case 'squid' :
				$output = shell_exec('/usr/bin/sudo -u root /usr/sbin/squid3 -k reconfigure');
				sleep(1);
			break;
			case 'clear' :
				$output = shell_exec('sudo /bin/echo 3 > /proc/sys/vm/drop_caches');
				sleep(1);
			break;
			
			case 'freeradius' :
				$output = shell_exec('/usr/bin/sudo -u root /etc/init.d/freeradius restart');
				system("pgrep ".escapeshellarg('freeradius')." >/dev/null 2>&1", $radius);
				 if($radius!=0) $flag['rep'] = FALSE;
			break;
			
			case 'chilli' :
				$output = shell_exec('/usr/bin/sudo -u root /etc/init.d/chilli restart');
				system("pgrep ".escapeshellarg('chilli')." >/dev/null 2>&1", $chilli);
				 if($chilli!=0) $flag['rep'] = FALSE;
			break;
			
			default: $flag['rep'] = FALSE;
		}
		
		return $flag;
	}
	
	function serviceStop($service='')
	{
		$flag['rep'] = TRUE;
		$flag['msg'] = 'Stop '.$service.' service';
		
		if($service!='')
		{
			$output = shell_exec('/usr/bin/sudo -u root /etc/init.d/'.$service.' stop');
			sleep(5);
			system("pgrep ".escapeshellarg($service)." >/dev/null 2>&1", $d);
			if($d==0) { $flag['rep'] = FALSE; $flag['msg'] = $this->lang->line('network_config_service_notstop'); }
		}
		else
		{
			$flag['rep'] = FALSE;
			$flag['msg'] = 'No service stop';
		}
		
		return $flag;
		
	}
	
	function getProxyconfig()
	{
		$file['webhost'] = read_file($this->config->item('BLOCK_WEB'));
		$file['delaypool'] = read_file($this->config->item('LIMIT_DOWNLOAD'));
		$file['blockfiles'] = read_file($this->config->item('BLOCK_FILES'));
		$file['blockip'] = read_file($this->config->item('BLOCK_IP'));
		//$file['blockbits'] = read_file($this->config->item('BLOCK_BITS'));//*********************************************

		return $file;
	}
	
	function writeProxyconfig($file)
	{
		$check = TRUE;
		if ( ! write_file($this->config->item('BLOCK_WEB'), $file['webhost'])) $check = FALSE;
		if ( ! write_file($this->config->item('LIMIT_DOWNLOAD'), $file['delaypool'])) $check = FALSE;
		if ( ! write_file($this->config->item('BLOCK_FILES'), $file['blockfiles'])) $check = FALSE;
		if ( ! write_file($this->config->item('BLOCK_IP'), $file['blockip'])) $check = FALSE;
		//if ( ! write_file($this->config->item('BLOCK_BITS'), $file['blockbits'])) $check = FALSE;//*********************************************

		return $check;
	}
	
	function advProxy()
	{
			
			$file['store_url_rewrite'] = read_file($this->config->item('STORE_URL_REWRITE'));
			$file['potocal_rewrite'] = read_file($this->config->item('SQUID_LOCALNET'));
			return $file;
		}
		
	
	function saveadvProxy($file)
	{
			$check = TRUE;
			if ( ! write_file($this->config->item('STORE_URL_REWRITE'), $file['store_url_rewrite'])) $check = FALSE;
			if ( ! write_file($this->config->item('SQUID_LOCALNET'), $file['potocal_rewrite'])) $check = FALSE;
			return $check;
		
	}
	
	function clearAlllist($_mac)
	{
		$mac_list = $this->siteconfigmodel->getConfig('mac_block');
		$block_list = $this->session->_unserialize($mac_list->value);
		$mac_name = array();
		foreach($block_list AS $mac)
		{
			if($mac!=$_mac) $mac_name[] = $mac;
		}
		$block_list = $this->session->_serialize($mac_name);
		$this->siteconfigmodel->updateConfig('mac_block',array('value'=>$block_list));
					
		$mac_list = $this->siteconfigmodel->getConfig('mac_allow');
		$allow_list = $this->session->_unserialize($mac_list->value);
		$mac_name = array();
		foreach($allow_list AS $mac)
		{
			if($mac!=$_mac) $mac_name[] = $mac;
		}
		$allow_list = $this->session->_serialize($mac_name);
		$this->siteconfigmodel->updateConfig('mac_allow',array('value'=>$allow_list));
	}
	
	function updateBlocklist($_mac)
	{
		$mac_list = $this->siteconfigmodel->getConfig('mac_block');
		$block_list = $this->session->_unserialize($mac_list->value);
		(!is_array($block_list)) ? $block_list = array() : '';

		array_push($block_list, $_mac);
		$block_list = $this->session->_serialize($block_list);

		$this->siteconfigmodel->updateConfig('mac_block',array('value'=>$block_list));
	}
	
	function updateAllowlist($_mac)
	{
		$mac_list = $this->siteconfigmodel->getConfig('mac_allow');
		$allow_list = $this->session->_unserialize($mac_list->value);
		(!is_array($allow_list)) ? $allow_list = array() : '';
					
		array_push($allow_list, $_mac);
		$allow_list = $this->session->_serialize($allow_list);

		$this->siteconfigmodel->updateConfig('mac_allow',array('value'=>$allow_list));
	}
	
}


/* End of file siteconfigmodel.php */
/* Location: ./system/nostradius/controllers/admin/siteconfigmodel.php */
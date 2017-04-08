<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

Class Gologinmodel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('onlineusermodel'));
		$this->load->helper(array('freeradius'));
		
		$this->_aptable = 'accesspoint';
		$this->_nastable = 'nas';
		$this->_voucher_table = 'voucher';
		$this->_voucher_list = 'voucher_list';
		$this->_billingplantable = 'billingplan';
		$this->_radaccttable = 'radacct';
		$this->_user_id = $this->session->userdata('user_id');
		
	}
	
	function getLocation($name)
	{
		return $this->db->select('*')
					->from($this->_aptable.' ap')
					->join($this->_nastable.' n','n.shortname=ap.name','left')
					->where(array('name'=>$name))
					->get()
					->row();
	}
	
	function getPopupcontent($uid)
	{
		return $this->db->select('ap.popup_page')
					->from($this->_aptable.' ap')
					->join($this->_radaccttable.' ra','ra.calledstationid=ap.calledstationid','left')
					->where(array('ra.username'=>$uid,'ra.acctstoptime'=>NULL))
					->get()
					->row();
	}
	
	function getUserdata($username)
	{	
		$this->session->set_userdata(array(	'user'	=> $username));
		return $this->db->select('v.username as username')
					->select('v.billingplan as plan')
					->select('b.profile as type')
					->select('b.amount as amount')
					->select('v.valid_for as valid_for')
					->select('b.bw_upload as upload')
					->select('b.bw_download as download')
					->select('v.start_time as start_time')
					->select('v.userprofile as userprofile')
					->select('v.packet_used as packet_used')
					->select('b.redirect_url as redirect_url')
					->from($this->_voucher_list.' v')
					->join($this->_billingplantable.' b','b.name = v.billingplan','left')
					->where(array('v.username'=>$username))
					->get()
					->row();
	}
	
	function getConfig($name)
	{
		return $this->db->select('value')
					->from('config')
					->where(array('name'=>$name))
					->get()
					->row();
	}
	
	function getAccount($username)
	{
		$output = $this->db->select('ra.framedipaddress AS ip,ra.acctinputoctets AS download,ra.acctoutputoctets AS upload')
								->from($this->_voucher_table.' vc')
								->join($this->_radaccttable.' ra','ra.username=vc.username','left')
								->where(array('vc.username'=>$username,'ra.acctstoptime'=>NULL))
								->get()
								->row();
		return $output;
	}
	
	function checkUserdie($username)
	{
		$user = $this->db->select('v.IdleTimeout as idletimeout,r.acctstarttime as start,r.acctsessiontime as timeused,r.acctstoptime as timestop')
						->from($this->_radaccttable.' r')
						->join($this->_voucher_table.' v','v.username=r.username','left')
						->where(array('r.username'=>$username,'r.acctstoptime'=>NULL))
						->order_by('r.radacctid','DESC')
						->limit('1')
						->get()
						->row();

		$online = $this->db->select('(`bp`.`simultaneous` - (count(`r`.`acctstarttime`) - count(`r`.`acctstoptime`))) as num')
						->from($this->_radaccttable.' r')
						->join('radusergroup rg','rg.username=r.username','left')
						->join('billingplan bp','bp.groupname=rg.groupname','left')
						->where(array('r.username'=>$username))
						->get()
						->row();

		if($online->num > 0) return FALSE;
		if(!$user) return FALSE;
		
		$current_time = human_to_unix(date('Y-m-d H:i:s',strtotime('-'. ($user->timeused - 30) - ($user->idletimeout*60) .' seconds')));
		$start_time = human_to_unix($user->start);

		$gip = $this->onlineusermodel->getNasip($username);

		if(($current_time - $start_time) > 0)
		{
			if($user->start) freeradius_disconnectuser($username , $this->config->item('radiuscommand'),$gip->ip.':'.$this->config->item('coaport'), $this->config->item('radiussecret'));
			if($online->num <= 0) $this->db->delete($this->_radaccttable,array('username'=>$username,'acctstoptime'=>NULL));
			return FALSE;
		}
		else
		{
			return TRUE;
		}

	}
	
		function checkOnlinedie($username) // เช็คถ้าออนไลน ไห้แตะออกจากระบบทันที
	{
		$user = $this->db->select('v.IdleTimeout as idletimeout,r.acctstarttime as start,r.acctsessiontime as timeused,r.acctstoptime as timestop')
						->from($this->_radaccttable.' r')
						->join($this->_voucher_table.' v','v.username=r.username','left')
						->where(array('r.username'=>$username,'r.acctstoptime'=>NULL))
						->order_by('r.radacctid','DESC')
						->limit('1')
						->get()
						->row();

		$online = $this->db->select('(`bp`.`simultaneous` - (count(`r`.`acctstarttime`) - count(`r`.`acctstoptime`))) as num')
						->from($this->_radaccttable.' r')
						->join('radusergroup rg','rg.username=r.username','left')
						->join('billingplan bp','bp.groupname=rg.groupname','left')
						->where(array('r.username'=>$username))
						->get()
						->row();

		$gip = $this->onlineusermodel->getNasip($username);

		if($user)
		{
			freeradius_disconnectuser($username , $this->config->item('radiuscommand'),$gip->ip.':'.$this->config->item('coaport'), $this->config->item('radiussecret'));
			
		}
		return ;
	}
	function getMacdeny($mac)
	{
		if($this->config->item('mac_verify')==0)
		{
			$strFileName = set_realpath('').'opt/macdeny';
			$objFopen = fopen($strFileName, 'r');
			if ($objFopen)
			{
				while (!feof($objFopen))
				{
					if(fgets($objFopen, 4096)==$mac)
					{
						fclose($objFopen);
						return FALSE;
					}				}
				fclose($objFopen);
			}
			
			return TRUE;
		}
		else
		{
			$config = $this->siteconfigmodel->getConfig('mac_block');
			$conf_data = $this->session->_unserialize($config->value);
			
			foreach($conf_data AS $mac_list)
			{

				if($mac_list==$mac)
				{
					return FALSE;
				}

			}
			
			return TRUE;
		}
	}
	
	function getEncryption($username)
	{
		return $this->db->select('encryption')
						->where(array('username'=>$username))
						->get($this->_voucher_table)
						->row();
	}
	
}
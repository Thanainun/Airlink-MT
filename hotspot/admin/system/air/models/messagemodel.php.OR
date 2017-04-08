<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Messagemodel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		
		$this->_table = "message";

	}
	
	function check_new()
	{
		$where['read'] = 0;
		return $this->db->select('*')
					->where($where)
					->count_all_results($this->_table);
	}
	
	function getMessage($id="*",$where=array('read <'=>2 ,'reply'=>0),$orderby="desc")
	{
		return $this->db->select($id)
					->where($where)
					->order_by("id", $orderby)
					->get($this->_table);
	}
	
	function setRead($id)
	{
		$where['id'] = $id;
		$this->db->where('id',$id)
				->update($this->_table,array('read'=>1));
	}
	
	function msgDelete($id)
	{
		$where['id'] = $id;
		$this->db->where($where);
		$this->db->delete($this->_table);
		$wherereply['reply'] = $id;
		$this->db->where($wherereply);
		$this->db->delete($this->_table);
	}
	
}
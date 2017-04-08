<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

Class LogModel extends CI_Model {
	function __construct()
	{
		parent::__construct();
		
		// Ajax
		$this->_table = "logs";

	}
	
	function getUserlogs($fields = null, $limit = null, $where = null ,$order = null)
	{
		
		($fields != null) ? $this->db->select($fields) :'';
		
		($limit != null ) ? $this->db->limit($limit['start'],$limit['end']) :'';
		
		($where != null) ? $this->db->where($where) : '';
			
		//return the query string
		return $this->db->get($this->_table);

	}

}

?>

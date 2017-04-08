<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

Class Jsonmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();

	}
	
	function data_table($sTable, $aColumns, $field = '*', $where = null, $join = null)
	{
		/* กรองข้อมูลที่ จากคำค้นหา กรณีที่ค้นหา ทุกคอลัมส์  */
		$sWhere = null;
		if ( $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$this->db->escape_str( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
			
		/* กรองคำค้นหา แต่ละคอลัมส์ */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
					{
						$sWhere = "WHERE ";
					}
					else
					{
						$sWhere .= " AND ";
					}
				$sWhere .= $aColumns[$i]." LIKE '%".$this->db->escape_str($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		if($where != null && $sWhere == null)
			{
				$sWhere .= ' where '.$where ;
			}
			else if($where != null && $sWhere != null)
			{
				$sWhere .= ' and '.$where ;
			}
		
		/* สร้าง Order ที่ส่งมาจาก ตาราง */
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
						".$this->db->escape_str( $_GET['sSortDir_'.$i] ) .", ";
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
			
		}
		
		/* สำหรับตัวแบ่งหน้า */
		$sLimit = null;
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".$this->db->escape_str( $_GET['iDisplayStart'] ).", ".
				$this->db->escape_str( $_GET['iDisplayLength'] );
		}

		/*
		 * SQL queries
		 * ข้อมูลที่จะนำไปสร้าง รูปแบบ json ส่งให้ javascript
		 */
		$sQuery = "SELECT ".$field." FROM   ".$sTable." $sWhere ".$sOrder." $sLimit ";
		$data['rResult'] = $this->db->query($sQuery);
		
		/*  หาจำนวนผู้ใช้ที่ได้จาก การกรองคำค้นหา  */
		$sQuery = "SELECT * FROM   ".$sTable." $sWhere ".$sOrder." ";
		$rResultFilterTotal = $this->db->query($sQuery);
		$iFilteredTotal = $rResultFilterTotal->num_rows();
		
		/*  หาจำนวนทั้งหมด */
		($where!=NULL) ? $this->db->like($where) : '';
		$iTotal = $this->db->count_all_results($sTable);
		
		/* Output header ส่วนหัว สำหรับสร้างรูปแบบ JSON */
		$data['output'] = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);

		return $data;

	}
	
}
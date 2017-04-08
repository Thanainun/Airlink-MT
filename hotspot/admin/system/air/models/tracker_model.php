<?php
class Tracker_model extends CI_Model 
{
	var $visit_table = 'visit';
	var $visitor_table = 'visitor';
	var $auto_add_visit = FALSE;
	function __construct()
	{
		parent::__construct();
		if($this->auto_add_visit)
		{
			$this->add_visit();
		}
	}

	function add_visit()
	{
		if ($this->agent->is_browser())
		{
			$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
			$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
			$agent = $this->agent->mobile();
		}
		else
		{
			$agent = 'Unidentified User Agent';
		}
		$platform = $this->agent->platform();
		$user_agent = $this->agent->agent_string();
		$referrer = $this->agent->referrer();
		$ip_address = $this->input->ip_address();
		$is_external_referral = $this->is_external_referral($referrer);
		$is_direct_access = $this->is_direct_access($referrer);
		$is_search_referral = $this->is_search_referral($referrer);
		$is_mobile = $this->agent->is_mobile();
		$is_browser = $this->agent->is_browser();
		$is_robot = $this->agent->is_robot();

		$this->db->from($this->visitor_table);
		$this->db->where('visitor_agent', $agent);
		$this->db->where('visitor_platform', $platform);
		$this->db->where('visitor_user_agent_string', $user_agent);
		$this->db->where('visitor_ip_address', $ip_address);
		$this->db->where('visitor_is_mobile', $is_mobile);
		$this->db->where('visitor_is_browser', $is_browser);
		$this->db->where('visitor_is_robot', $is_robot);
		$this->db->order_by('visitor_id', 'desc');
		$this->db->limit(1);
		$result = $this->db->get();

		$new_visitor = FALSE;

		if($result->num_rows() == 1)
		{
			$visitor = $result->row_array();
			$visitor_id = $visitor['visitor_id'];
		}
		else
		{
			$this->db->set('visitor_agent', $agent);
			$this->db->set('visitor_platform', $platform);
			$this->db->set('visitor_user_agent_string', $user_agent);
			$this->db->set('visitor_ip_address', $ip_address);
			$this->db->set('visitor_is_mobile', $is_mobile);
			$this->db->set('visitor_is_browser', $is_browser);
			$this->db->set('visitor_is_robot', $is_robot);
			$this->db->insert($this->visitor_table);
			$visitor_id = $this->db->insert_id();

			$new_visitor = TRUE;
		}

		if($is_external_referral OR $new_visitor OR $is_direct_access)
		{
			$this->db->set('visit_entry_visit_id', '');
		}
		else
		{
			$this->db->from($this->visit_table);
			$this->db->where('visit_visitor_id', $visitor_id);
			$this->db->where('visit_is_external_referral', 1);
			$this->db->order_by('visit_visit_date', 'desc');
			$this->db->limit(1);
			$result = $this->db->get();
			if($result->num_rows() == 1)
			{
				$visit = $result->row_array();
				$this->db->set('visit_entry_visit_id', $visit['visit_id']);
			}
			else
			{
				$this->db->set('visit_entry_visit_id', '');
			}
		}

		$this->db->set('visit_visitor_id', $visitor_id);
		$this->db->set('visit_visit_date', 'NOW()', FALSE);
		$this->db->set('visit_is_external_referral', $is_external_referral);
		$this->db->set('visit_is_search_referral', $is_search_referral);
		$this->db->set('visit_uri', uri_string());
		$this->db->set('visit_referrer', $referrer);
		$this->db->set('visit_is_direct_access', $is_direct_access);
		$this->db->insert($this->visit_table);

		return TRUE;
	}

	function is_external_referral($referrer)
	{
		if($referrer == '')
		{
			return FALSE;
		}
		else
		{
			$base_url_without_protocoll = str_replace('http://', '', str_replace('https://', '', base_url()));
			$referrer_without_protocoll = str_replace('http://', '', str_replace('https://', '', $referrer));

			if(substr($referrer_without_protocoll, 0, strlen($base_url_without_protocoll)) != $base_url_without_protocoll)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}

	function is_search_referral($referrer)
	{
		if($this->is_external_referral($referrer))
		{
			$search_url_list = array(
			'/http:\/\/www.google.[a-z]{2,3}\/search/',
			'/http:\/\/www.google.[a-z]{2,3}\/url/',
			);

			$match = FALSE;
			foreach($search_url_list as $pattern)
			{
				if(preg_match($pattern, $referrer))
				{
					$match = TRUE;
				}
			}

			return $match;
		}
		else
		{
			return FALSE;
		}
	}

	function is_direct_access($referrer)
	{
		if($referrer == '')
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_hits($from_date = FALSE, $to_date = FALSE, $unique = FALSE)
	{
		if($to_date === FALSE)
		{
			$to_date = date('Y-m-d', time() - 86400);
		}
		if($from_date === FALSE)
		{
			$from_date = date('Y-m-d', time() - 2592000);
		}
		$from = explode('-', $from_date);
		$to = explode('-', $to_date);
		if(count($from) == 3 AND count($to) == 3)
		{
			if(checkdate($from[1], $from[2], $from[0]) AND checkdate($to[1], $to[2], $to[0]))
			{
				if($unique)
				{
					$distinct = 'DISTINCT ';
				}
				else
				{
					$distinct = '';
				}
				$this->db->select("COUNT($distinct visitor_id) AS visit_count", FALSE);
				$this->db->select("DATE_FORMAT(visit_visit_date, '%Y') AS visit_year", FALSE);
				$this->db->select("DATE_FORMAT(visit_visit_date, '%d') AS visit_day", FALSE);
				$this->db->select("DATE_FORMAT(visit_visit_date, '%m') AS visit_month", FALSE);
				$this->db->from($this->visitor_table);
				$this->db->join($this->visit_table, 'visit_visitor_id = visitor_id');
				$this->db->where('visit_visit_date >= ', $from_date.' 00:00:00');
				$this->db->where('visit_visit_date <= ', $to_date.' 23:59:59');
				$this->db->group_by('visit_year, visit_day, visit_month');
				$result = $this->db->get();
				if($result->num_rows() > 0)
				{
					print_r($result->result_array());
				}
				else
				{
					echo "bla";
				}
			}
		}
	}

	function prepend_zero($value)
	{
		if(strlen($value) == 1)
		{
			return '0'.$value;
		}
		else
		{
			return $value;
		}
	}
}
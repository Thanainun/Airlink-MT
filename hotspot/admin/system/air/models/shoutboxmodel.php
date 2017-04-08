<?php
class Shoutboxmodel extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_shoutbox_list()
    {
        $this->db->limit(25, 0);
        $this->db->order_by("shout_date_create", "desc");
        $this->db->from('shout');
        $result = $this->db->get();
        if($result->num_rows() > 0)
        {
            $rows = $result->result_array();
            return $rows;
        }
        else
        {
            return array();
        }
    }

    function add_shout()
    {
        $this->db->set('shout_author_user_name', $this->input->post('shout_author_user_name'));
        $this->db->set('shout_message', $this->input->post('shout_message'));
        $this->db->set('shout_date_create', "NOW()", FALSE);
        $this->db->insert('shout');
        return TRUE;
    }
}
?> 
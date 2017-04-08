<?php
class Shoutbox extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('shoutboxmodel');
    }

    function index()
    {
        $this->show();
    }

    function show()
    {
        $data['shout_list'] = $this->shoutboxmodel->get_shoutbox_list();
        $this->load->view('shoutbox', $data);
    }

    function ajax_add_shout()
    {
        if($this->input->is_ajax_request())
        {
            $this->load->library('validation');
            $rules['shout_message'] = "trim|xss_clean|htmlspecialchars|required";
            $rules['shout_author_user_name'] = "trim|xss_clean|htmlspecialchars|required";
            $fields['shout_message'] = "Message";
            $fields['shout_author_user_name'] = "Name";

            $this->validation->set_rules($rules);
            $this->validation->set_fields($fields);

            if ($this->validation->run() == TRUE)
            {
                $this->shoutboxmodel->add_shout();
            }

            $this->ajax_update_shoutbox();
        }
        else
        {
            $this->index();
        }
    }

    function ajax_update_shoutbox()
    {
        if($this->input->is_ajax_request())
        {
            $data = array();
            $data['shout_list'] = $this->shoutboxmodel->get_shoutbox_list();
            $this->load->view('shout_list', $data);
        }
        else
        {
            $this->index();
        }
    }

}

/* End of file shoutbox.php */
/* Location: ./system/application/controllers/shoutbox.php */ 
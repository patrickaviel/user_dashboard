<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wall extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('message');
        $this->load->model('comment');
    }
	public function index($id) {

        //$this->load->view('users/wall',$data);

    }

    public function add_message() {
        $result = $this->message->validate_message();
        
        if($result != 'success') {
            $this->session->set_flashdata('input_errors', $result);
        } 
        else {
            $profile_id = $this->message->add_message($this->input->post());
            
        }
        redirect("users/goToWall/$profile_id");
       
        
    }

    public function add_comment() {
        $result = $this->comment->validate_comment();

        if($result != 'success') {
            $this->session->set_flashdata('input_errors', validation_errors());
        }
        else {
            $profile_id = $this->comment->add_comment($this->input->post());
        }
        redirect("users/goToWall/$profile_id");
    }

   
}

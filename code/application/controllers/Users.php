<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }
	public function index(){
		$this->load->view('users/home_page');
	}

    public function showSignInForm(){

            $this->load->view('users/sign_in');
     
    }

    public function validate_login(){

    }

    public function showRegistrationForm(){
        $this->load->view('users/register');
    }

    public function register(){
        $email = $this->input->post('email');
        $result = $this->user->validate_registration($email);
        
        if($result!=null)
        {
            $this->session->set_flashdata('input_errors', $result);
            redirect("sign-up");
        }
        else
        {
            $form_data = $this->input->post();
            $this->user->create_user($form_data);

            $new_user = $this->user->get_user_by_email($form_data['email']);
            $this->session->set_userdata(array('user_id' => $new_user["id"], 'first_name'=>$new_user['first_name']));
            
            redirect("wall");
        }
    }

    public function showDashboard(){
        $this->load->view('users/dashboard');
    }
    public function addNewUser(){
        $this->load->view('users/add_user');
    }
    public function editProfile(){
        $this->load->view('users/user_edit_profile');
    }
    public function goToWall(){
        redirect('wall');
    }
    public function adminEditUser(){
        $this->load->view('users/admin_edit_profile');
    }
}

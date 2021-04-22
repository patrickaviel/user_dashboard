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

    public function process_signin() 
    {
        $result = $this->user->validate_signin_form();
        if($result != 'success') {
            $this->session->set_flashdata('input_errors', $result);
            redirect("sign-in");
        } 
        else 
        {
            $email = $this->input->post('email');
            $user = $this->user->get_user_by_email($email);
            
            $result = $this->user->validate_signin_match($user, $this->input->post('password'));
            
            if($result == "success") 
            {
                $user_data = array(
                    'user_id'=>$user['id'], 
                    'first_name'=>$user['first_name'],
                    'last_name'=>$user['last_name'],
                    'full_name'=>$user['first_name']. ' ' . $user['last_name'],
                    'email'=>$user['email'],
                    'created_at'=>$user['created_at'],
                    'updated_at'=>$user['updated_at'],
                    'description'=>$user['description']
                );
                $this->session->set_userdata($user_data);            
                redirect("users/showDashboard");
            }
            else 
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect("sign-in");
            }
        }
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
            
            redirect("users/showDashboard");
        }
    }

    public function showDashboard(){
        $data['users'] = $this->user->get_all_user();
        $this->load->view('users/user_dashboard',$data);
    }
    public function addNewUser(){
        $this->load->view('users/add_user');
    }
    
    public function goToWall($id){
        $user = $this->user->get_user_by_email($email);
        redirect('wall');
    }
    public function adminEditUser(){
        $this->load->view('users/admin_edit_profile');
    }

    public function editProfile(){
        $this->load->view('users/user_edit_profile');
    }

    public function editPassword(){
        $email = $this->session->userdata('email');
        $form_data = $this->input->post();
        $result = $this->user->validate_password($form_data);
        if($result == "success") {
            $this->user->update_password($form_data,$email);
            redirect('users/editProfile');
        }else{
            echo "Passwords do not match!";
        }
    }

    public function editDescription(){
        $email = $this->session->userdata('email');
        $form_data = $this->input->post();
        $result = $this->user->validate_description($form_data);
        if($result == "success") {
            $this->user->update_description($form_data,$email);
            $user = $this->user->get_user_by_email($email);
            $user_data = array(
                'user_id'=>$user['id'], 
                'first_name'=>$user['first_name'],
                'last_name'=>$user['last_name'],
                'full_name'=>$user['first_name']. ' ' . $user['last_name'],
                'email'=>$user['email'],
                'created_at'=>$user['created_at'],
                'updated_at'=>$user['updated_at'],
                'description'=>$user['description']
            );
            $this->session->set_userdata($user_data);
            redirect('users/editProfile');
        }else{
            echo "Description should not be empty!";
        }
    }

    public function logoff() {
        $this->session->sess_destroy();
        redirect("/");   
    }
}

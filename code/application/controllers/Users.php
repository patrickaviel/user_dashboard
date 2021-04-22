<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('message');
        $this->load->model('comment');
    }

	public function index(){
		$this->load->view('users/home_page');
	}

    public function showSignInForm(){
        $this->load->view('users/sign_in');
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
            $user = $this->user->get_user_by_email_usertype($email);
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
                    'user_level'=>$user['user_type'],
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
            $user_type = $this->user->check_usertype();
            if( $user_type === NULL ){
                $user_level = 'admin';
            }else{
                $user_level = 'normal';
            }
            $form_data = $this->input->post();
            $this->user->create_user($form_data);
            $new_user = $this->user->get_user_by_email($form_data['email']);
            $user_id = $new_user["id"];
            $this->user->place_user_level($user_id,$user_level);
            $result_type = $this->user->get_user_by_email($form_data['email']);
            $user_types = $result_type["user_type"];
            $user_data = array(
                'user_id'=>$user['user_id'], 
                'first_name'=>$user['first_name'],
                'last_name'=>$user['last_name'],
                'full_name'=>$user['first_name']. ' ' . $user['last_name'],
                'email'=>$user['email'],
                'created_at'=>$user['created_at'],
                'updated_at'=>$user['updated_at'],
                'user_level'=>$user_types,
                'description'=>$user['description']
            );
            $this->session->set_userdata($user_data); 
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
        $user_messages = $this->message->get_messages($id);
        $inbox = array();
        foreach($user_messages as $user_message) 
        {
            $comments = $this->comment->get_comments_from_message_id($user_message['message_id']);
            $user_message["comments"] = $comments;
            $inbox[] = $user_message;
        }
        $user = $this->user->get_user_by_id($id);
        $user_info = array(
            'user_id'=>$user['user_id'], 
            'first_name'=>$user['first_name'],
            'last_name'=>$user['last_name'],
            'full_name'=>$user['first_name']. ' ' . $user['last_name'],
            'email'=>$user['email'],
            'created_at'=>$user['created_at'],
            'updated_at'=>$user['updated_at'],
            'description'=>$user['description'],
            'user_level'=>$user['user_type'],
            'inbox'=>$inbox
        );
        $this->load->view('users/wall',$user_info);  
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

    public function editInformation(){
        $email = $this->session->userdata('email');
        $form_data = $this->input->post();
        $result = $this->user->validate_information($form_data);
        if($result == "success") {
            $this->user->update_information($form_data,$email);
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

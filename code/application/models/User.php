<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    function get_all_user() { 
        $query = "SELECT id AS user_id, first_name, last_name, email, created_at, updated_at FROM users";
        return $this->db->query($query)->result_array();
    }

    function get_user_by_email($email) { 
        $query = "SELECT * FROM users WHERE email=?";
        return $this->db->query($query, $this->security->xss_clean($email))->result_array()[0];
    }

    function get_user_by_id($id) { 
        $query = "SELECT * FROM users WHERE id=?";
        return $this->db->query($query, $this->security->xss_clean($id))->result_array()[0];
    }

    function validate_registration($email) {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');        
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if($this->get_user_by_email($email)) {
            return "Email already taken.";
        }
    }

    function create_user($user) {
        $query = "INSERT INTO users (first_name, last_name, email,user_level, password,created_at,updated_at) VALUES (?,?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($user['first_name']), 
            $this->security->xss_clean($user['last_name']), 
            $this->security->xss_clean($user['email']), 
            "admin", 
            md5($this->security->xss_clean($user["password"])),
            date("Y-m-d h:i:s"),
            date("Y-m-d h:i:s")); 
        
        return $this->db->query($query, $values);
    }

    function validate_signin_form() {
        
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
        else {
            return "success";
        }
    }
    
    
    function validate_signin_match($user, $password) {
        $hash_password = md5($this->security->xss_clean($password));

        if($user && $user['password'] == $hash_password) {
            return "success";
        }
        else {
            return "Incorrect email/password.";
        }
    }
    
    function validate_password($user){
        $password = $this->security->xss_clean($user['password']);
        $confirm_password = $this->security->xss_clean($user['confirm_password']);

        if($password == $confirm_password) {
            return "success";
        }
        else {
            return "Passwords do not match.";
        }
    }

    function update_password($password,$email){
        $query = "UPDATE users SET password = ? , updated_at = ? WHERE email = ?";
        $values = array(
            md5($this->security->xss_clean($password["password"])),
            date("Y-m-d h:i:s"),
            $this->security->xss_clean($email)); 
        
        return $this->db->query($query, $values);
    }

    function validate_description($user){
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('description', 'Description', 'required');
    
        if(!$this->form_validation->run()) {
            return "error";
        } 
        else {
            return "success";
        }
    }

    function update_description($description,$email){
        $query = "UPDATE users SET description = ? , updated_at = ? WHERE email = ?";
        $values = array(
            $this->security->xss_clean($description["description"]),
            date("Y-m-d h:i:s"),
            $this->security->xss_clean($email)); 
        
        return $this->db->query($query, $values);
    }

}

?>
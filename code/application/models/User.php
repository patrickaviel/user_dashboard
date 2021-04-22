<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    function get_all_user() { 
        // $query = "SELECT users.id AS user_id, description,first_name, last_name, email, created_at, updated_at, user_level.user_type  
        // FROM users
        // INNER JOIN user_level ON users.id = user_level.user_id";
        $query="SELECT users.id AS user_id, users.description, users.first_name, users.last_name, users.email, users.created_at, users.updated_at, user_level.user_type,users.password 
        FROM user_level
        INNER JOIN users ON user_level.user_id = users.id";
        return $this->db->query($query)->result_array();
    }

    function check_usertype() { 
        $query = "SELECT * FROM user_level WHERE user_type= 'admin'";
        return $this->db->query($query)->row();
    }

    function get_user_by_email($email) { 
        $query = "SELECT * FROM users WHERE email=?";
        return $this->db->query($query, $this->security->xss_clean($email))->result_array()[0];
    }

    function get_user_by_id($use_id) { 
        $query = "SELECT users.id AS user_id, users.description, users.first_name, users.last_name, users.email, users.created_at, users.updated_at, user_level.user_type,users.password 
        FROM user_level
        INNER JOIN users ON user_level.user_id = users.id
		WHERE users.id=?";
        return $this->db->query($query, $this->security->xss_clean($use_id))->result_array()[0];
    }

    function get_user_by_email_usertype($email) { 
        $query = "SELECT users.id AS user_id, users.description, users.first_name, users.last_name, users.email, users.created_at, users.updated_at, user_level.user_type,users.password 
        FROM user_level
        INNER JOIN users ON user_level.user_id = users.id
		WHERE users.email=?";
        return $this->db->query($query, $this->security->xss_clean($email))->result_array()[0];
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
        $query = "INSERT INTO users (first_name, last_name, email, password,created_at,updated_at) VALUES (?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($user['first_name']), 
            $this->security->xss_clean($user['last_name']), 
            $this->security->xss_clean($user['email']), 
            md5($this->security->xss_clean($user["password"])),
            date("Y-m-d h:i:s"),
            date("Y-m-d h:i:s")
        );  
        return $this->db->query($query, $values);
    }
    function place_user_level($user_id,$user_level){
        $query = "INSERT INTO user_level (user_id,user_type) VALUES (?,?)";
        $values = array(
            $this->security->xss_clean($user_id), 
            $this->security->xss_clean($user_level)
        );  
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

    function validate_information($user){
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if(!$this->form_validation->run()) {
            return "error";
        } 
        else {
            return "success";
        }
    }
    function update_information($info,$email){
        $query = "UPDATE users SET first_name = ? , last_name = ? , email = ? , updated_at = ? WHERE email = ?";
        $values = array(
            $this->security->xss_clean($info["first_name"]),
            $this->security->xss_clean($info["last_name"]),
            $this->security->xss_clean($info["email"]),
            date("Y-m-d h:i:s"),
            $this->security->xss_clean($email)); 
        return $this->db->query($query, $values);
    }

    function create_user_by_admin($user) {
        $query = "INSERT INTO users (first_name, last_name, email, password,created_at,updated_at) VALUES (?,?,?,?,?,?)";
        $values = array(
            $this->security->xss_clean($user['first_name']), 
            $this->security->xss_clean($user['last_name']), 
            $this->security->xss_clean($user['email']), 
            md5($this->security->xss_clean($user["password"])),
            date("Y-m-d h:i:s"),
            date("Y-m-d h:i:s")
        ); 
        $this->db->query($query,$values);
        return $this->db->insert_id(); 
    }

}

?>
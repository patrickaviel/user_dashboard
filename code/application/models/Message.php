<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Model {
    
    public function get_messages($id) {
        $query = "SELECT messages.id AS message_id, message AS message_content, 
                    DATE_FORMAT(messages.created_at, '%M %e %Y') AS message_date, CONCAT(first_name,' ',last_name) AS message_sender_name 
                    FROM messages 
                    LEFT JOIN users on messages.user_id=users.id 
                    WHERE recepient = '$id'
                    ORDER BY messages.created_at DESC";

        return $this->db->query($query)->result_array();
    }

   

    public function validate_message() {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('message_input', 'Message', 'required');

        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else {
            return 'success';
        }
    }

    public function add_message() {
        $query = 'INSERT INTO messages(user_id, message, created_at, updated_at, recepient) VALUES (?,?,?,?,?)';
        $values = array(
            $this->security->xss_clean($this->session->userdata('user_id')), 
            $this->security->xss_clean($this->input->post('message_input')),
            date("Y-m-d h:i:s"),
            date("Y-m-d h:i:s"), 
            $this->security->xss_clean($this->input->post('recepient_id')),
        ); 
        
        $this->db->query($query, $values);
        return $this->input->post('recepient_id');
    }
}
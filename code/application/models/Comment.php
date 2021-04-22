<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Model {

    public function get_comments_from_message_id($message_id) 
    {
        $safe_message_id = $this->security->xss_clean($message_id);

        $query = "SELECT comments.message_id, 
            CONCAT(first_name,' ',last_name) AS comment_sender_name, 
            comment AS comment_content, DATE_FORMAT(comments.created_at, '%M %e %Y') AS comment_date 
            FROM comments LEFT JOIN users on comments.user_id=users.id 
            WHERE comments.message_id=? ORDER BY comment_date ASC";
        
        return $this->db->query($query, $safe_message_id)->result_array();
    }

    public function validate_comment() 
    {
        $this->form_validation->set_error_delimiters('<div>','</div>');
        $this->form_validation->set_rules('comment', 'Comment', 'required');

        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
        else {
            return "success";
        }
    }


    public function add_comment() 
    {
        $query = 'INSERT INTO comments (user_id, message_id, comment, created_at, updated_at) VALUES (?, ?, ?, ?, ?)';
        $values = array(
                    $this->security->xss_clean($this->session->userdata('user_id')),
                    $this->security->xss_clean($this->input->post('message_id')), 
                    $this->security->xss_clean($this->input->post('comment')), 
                    date("Y-m-d h:i:s"),
                    date("Y-m-d h:i:s")
                ); 
        
        $this->db->query($query, $values);
        return $this->input->post('recepient_id');
    }
    
}
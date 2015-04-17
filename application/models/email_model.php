<?php
class Email_model extends CI_Model{
    
    public function draft($to,$subject,$message){
	    $new_email_insert = array(
		    'from'           => 'test@uwebmail.com',
		    'to'             => $to,
		    'subject'        => $subject,
		    'message'        => $message,
		    'sent'        	 => '0'
	    );
	    
	    $insert = $this->db->insert('drafts', $new_email_insert);
        return $insert;
        
    }
    
    public function get_all(){
	    	$this->db->where('sent', '0');
			$q = $this->db->get('drafts');
			return $q->result();
      }
      
    public function delete($id){
	    	$this->db->where('id', $id);
	    	$q = $this->db->delete('drafts');
			return $q->result();
    }  
    
    
}
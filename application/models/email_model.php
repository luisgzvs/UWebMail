<?php	
	
class Email_model extends CI_Model{
    
    public function draft($to,$subject,$message){
	    
	    $username = $this->session->userdata('username');
	    
	    $new_email_insert = array(
		    'from'           => $username .'@uwebmail.com',
		    'to'             => $to,
		    'subject'        => $subject,
		    'message'        => $message,
		    'sent'        	 => '0'
	    );
	    
	    $insert = $this->db->insert('drafts', $new_email_insert);
        return $insert;
        
    }
    
    public function get_all(){
	    
	    $username = $this->session->userdata('username');
	    $user = $username .'@uwebmail.com';
	    
	    	$this->db->where('from', $user);	
	    	$this->db->where('sent', '0');
			$q = $this->db->get('drafts');
			return $q->result();
      }
    
    public function get_sent(){
	    
	    $username = $this->session->userdata('username');
	    $user = $username .'@uwebmail.com';
	    
	    	$this->db->where('from', $user);	
	    	$this->db->where('sent', '1');
			$q = $this->db->get('drafts');
			return $q->result();
      }
      
     
    public function get_by_id($id){
	    
	    $username = $this->session->userdata('username');
	    $user = $username .'@uwebmail.com';
	    
	    	$this->db->where('from', $user);	
	    	$this->db->where('id', $id);
	    	$q = $this->db->get('drafts');
			return $q->result();
    }  
    
    public function update($id,$to,$subject,$message){
	    
	    $username = $this->session->userdata('username');
	    	    	
	    	$new_email_update = array(
		    'from'           => $username .'@uwebmail.com',
		    'to'             => $to,
		    'subject'        => $subject,
		    'message'        => $message,
		    'sent'        	 => '0'
	    );
	    
	    $this->db->where('id', $id);
	    $q = $this->db->update('drafts', $new_email_update);	
		return $q;
    }  

      
    public function delete($id){
	    	$this->db->where('id', $id);
	    	$q = $this->db->delete('drafts');
			return $q;
    }  
    
   public function send($id){
	    	    	
	    	$new_email_update = array(
		    'sent'        	 => '1'
	    );
	    
	    $this->db->where('id', $id);
	    $q = $this->db->update('drafts', $new_email_update);	
		return $q;
    }
    
}
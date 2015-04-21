<?php
	
class Mail_Cronjob extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index(){
	
	$this->load->model('email_model','emails');
	$drafts = $this->emails->get_all();
	
	foreach ($drafts as $draft){
		$id = $draft->id;
		$from = $draft->from;
		$to = $draft->to;
		$subject = $draft->subject;
		$message = $draft->message;
		$sent = '1';
		
		$this->sendMail($from,$to,$subject,$message);
		$this->emails->send($id);
		
	}
	
	}
	

	public function sendMail($from,$to,$subject,$message){
		
		$sender_email='testinguwebmail@gmail.com';
		$user_password='uwebmail1515';
		$username='non-reply';
		        
        // Configure email library
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = $sender_email;
		$config['smtp_pass'] = $user_password;

		// Load email library and passing configured values to email library
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		// Sender email address
		$this->email->from($sender_email, $username);
		// Receiver email address
		$this->email->to($to);
		// Subject of email
		$this->email->subject($subject);
		// Message in email
		$this->email->message($message);

		if ($this->email->send()) {
		$data['message_display'] = 'Email Successfully Send !';
		} else {
		$data['message_display'] =  '<p class="error_msg">Invalid Gmail Account or Password !</p>';
		}
        
        $this->load->view('layouts/initial');
        
    }
    
    
    
                
}
                
?>        
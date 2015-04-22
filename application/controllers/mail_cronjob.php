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
		
		/Enviar correo
           $this->load->library('email');

          $config['protocol']   = 'smtp';
          $config['charset']    = 'utf-8';
          $config['smtp_host']  = 'ssl://smtp.googlemail.com';
          $config['smtp_port']  = '465';
          $config['mailtype']   = 'html';
          $config['smtp_user']  = 'testinguwebmail@gmail.com';
          $config['smtp_pass']  = 'uwebmail1515';
          $config['newline']    = "\r\n";
          $config['starttls']   = TRUE;

                    
          $this->email->initialize($config);
          $this->email->clear();


        $this->email->from('testinguwebmail@uwmail.com','UWebMail');
		$this->email->to($to);
      	// Subject of email
		$this->email->subject($subject);
		// Message in email
		$this->email->message($message);
   
        $this->email->send();

		if ($this->email->send()) {
		$data['message_display'] = 'Email Successfully Send !';
		} else {
		$data['message_display'] =  '<p class="error_msg">Invalid Gmail Account or Password !</p>';
		}
        
        $this->load->view('layouts/initial');
        
    }
    
    
    
                
}
                
?>        
<?php
	
	class Emails extends CI_Controller{
		
		public function index(){
			$this->load->view('layouts/compose');
		}
		
		public function insert(){
			
			$to = $_GET['to'];
			$subject = $_GET['subject'];
			$message = $_GET['message'];
			
			$this->load->model('email_model','emails');
			$this->emails->draft($to,$subject,$message);
			$this->load->view('layouts/initial');	
		}
		
		public function get_all(){
			$this->load->model('email_model','emails');
			$drafts = $this->emails->get_all();
			$data['drafts'] = $drafts;
			$this->load->view('layouts/drafts', $data);
		}
		
		public function get_sent(){
			$this->load->model('email_model','emails');
			$drafts = $this->emails->get_sent();
			$data['drafts'] = $drafts;
			$this->load->view('layouts/sentMail', $data);
		}
		
		public function get_message(){
			$id = $this->uri->segment(3);
			$this->load->model('email_model','emails');
			$message = $this->emails->get_by_id($id);
			$data['messages'] = $message;
			$this->load->view('layouts/update', $data);
			
		}
		
		public function get_message_sent(){
			$id = $this->uri->segment(3);
			$this->load->model('email_model','emails');
			$message = $this->emails->get_by_id($id);
			$data['messages'] = $message;
			$this->load->view('layouts/sentView', $data);
			
		}

		
		public function update(){
			$id = $_GET['id'];
			$to = $_GET['to'];
			$subject = $_GET['subject'];
			$message = $_GET['message'];
			$sent = '0';
			
			$this->load->model('email_model','emails');
			$this->emails->update($id,$to,$subject,$message);
			$this->load->view('layouts/initial');	
		}
			
		
		public function delete(){
	    	$id = $this->uri->segment(3);
			$this->load->model('email_model','emails');
			$this->emails->delete($id);
			$this->get_all();
		}
		
		
	}
	
	
?>
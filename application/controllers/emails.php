<?php
	
	class Emails extends CI_Controller{
		
		public function index(){
			$this->load->view('layouts/compose');
		}
		
		public function load_sent_view(){
			$this->load->view('layouts/sentMail');
		}
				
		public function insertar(){
			
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
		
		public function delete(){
			$id = $_GET['id'];
			$this->load->model('email_model','emails');
			$this->emails->delete($id);
			$this->get_all();
		}
		
	}
	
	
?>
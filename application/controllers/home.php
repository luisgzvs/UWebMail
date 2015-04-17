<?php
class Home extends CI_Controller {

	public function index(){

		if($this->session->userdata('logged_in')){
		$data['main_content'] = 'home';
		$this->load->view('layouts/initial',$data);
	}
	else{
		$data['main_content'] = 'home';
		$this->load->view('layouts/main',$data);
	}
	}

}
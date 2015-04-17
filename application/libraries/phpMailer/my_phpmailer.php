<?php if (! defined('BASEPATH')) exit ('No direct script access allowed');
require_once('PHPMailer/class.phpmailer.php');

class My_PHPMailer extends PHPMailer{
	public function _construct(){
		parent::_construct();
	}
}
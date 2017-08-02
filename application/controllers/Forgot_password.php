<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller {
	public function index(){
		$this->load->view('common/header_auth.php');
		$this->load->view('forgot_password');
		$this->load->view('common/footer_auth.php');
	}
}

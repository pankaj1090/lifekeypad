<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index(){
		$this->load->view('common/header_auth.php');
		$this->load->view('login');
		$this->load->view('common/footer_auth.php');
	}
}

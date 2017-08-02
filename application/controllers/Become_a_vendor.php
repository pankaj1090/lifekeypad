<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Become_a_vendor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(isset($_POST) && !empty($_POST)) {
	        if(!isset($_SERVER['HTTP_REFERER'])) {
                die('Direct Access Not Allowed!!');
	        }
	    }
		$this->load->library('ts_functions');
        $this->theme = $this->ts_functions->current_theme();
	}

	public function index(){
		$data['basepath'] = base_url();
		$data['language_details'] = $this->DatabaseModel->access_database('ts_lancate','select','',array('lancate_status'=>1));
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/become_vendor',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}
}

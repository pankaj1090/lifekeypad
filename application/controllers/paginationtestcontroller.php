<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->model('my_model');
		$this->load->library('ci_pagination');
		$data_per_page = 5;
		$current_key = 0;
		if(isset($_POST['ci_pagination_key'])){
			$current_key = $_POST['ci_pagination_key'];
		}
		
		if(isset($_COOKIE['row_per_page'])){
			$data['data_per_page'] = $data_per_page = $_COOKIE['row_per_page'];
		}
		$data['count_total'] = $count_total = $this->my_model->aggregate_data('pagination_country' , 'country_id' , 'COUNT');
		$data['pagination_data'] = $this->ci_pagination->pagination_data($count_total, $current_key , $data_per_page);
		$data['country_data'] = $this->my_model->select_data('*' , 'pagination_country' , '' , array($data_per_page,$current_key));
		$data['current_key'] = $current_key;
		
		$this->load->view('pagination',$data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ts_functions');
		$this->theme = $this->ts_functions->current_theme();
	}

    public function _remap($method='',$parameter='')
    {
        $this->index($method,$parameter);
    }

	public function index($method='',$parameter=''){
		$data['basepath'] = base_url();
        $col_id=$parameter[0];
        $colDetail=$this->my_model->select_data('*','ts_collections',array('col_id'=>$col_id));
        if(empty($colDetail)){ redirect(base_url());}
        $this->my_model->update_data('ts_collections',array('col_view'=>$colDetail[0]['col_view']+1),array('col_id'=>$col_id));

	    $join_array = array('ts_products','ts_products.prod_id = ts_collection_data.col_data_prod');
	    $data['colDetail']=$colDetail;
	    $data['productdetails']=$this->my_model->select_data('*','ts_collection_data',array('col_data_col'=>$col_id),'','','',$join_array);
	    $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
	   
	    $this->load->view('themes/'.$this->theme.'/user/single_collection',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
   }
	
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends CI_Controller {

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
	if($method!='' && $parameter!=''){
		$order_by=array('post_date','Desc');
		$uid = $parameter[0];
      	$data['basepath'] = base_url();
      	$cond=array('post_uid'=>$uid);
      	$data['timeline_posts']=$this->my_model->select_data('*','ts_posts',$cond,$limit='',$order_by);

       $data['userDetail']=$this->my_model->select_data('user_id,user_uname,user_pic,user_text_status,user_social','ts_user',array('user_id'=>$uid));
       $data['timeline_active']=1;
	    $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
	     $this->load->view('themes/'.$this->theme.'/user/profile_section',$data);
	    $this->load->view('themes/'.$this->theme.'/user/user_timeline',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
   
   }else{
   	
   }

  } 

    
 
	
}
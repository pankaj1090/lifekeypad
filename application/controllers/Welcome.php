<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->library('ts_functions');
		$this->theme = $this->ts_functions->current_theme();
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
  
    function follower($uid='',$vendor=''){
       if($uid==''){ redirect (base_url());}
        $data['basepath'] = base_url();
      	$data['userDetail']=$this->my_model->select_data('user_id,user_uname,user_pic,user_text_status,user_social','ts_user',array('user_id'=>$uid));

      	$join_array = array('ts_user','ts_user.user_id = ts_follower.fol_follower');
      	$data['fol_users']=$this->my_model->select_data('user_uname,user_pic,user_id','ts_follower',array('fol_follwing'=>$uid),'','','',$join_array );
      	$data['follower_active']=1;
	    $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
	    $this->load->view('themes/'.$this->theme.'/user/profile_section',$data);
	    $this->load->view('themes/'.$this->theme.'/user/follower',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
   }
    function following($uid='',$vendor=''){
       if($uid==''){ redirect (base_url());}
        $data['basepath'] = base_url();
      	$data['userDetail']=$this->my_model->select_data('user_id,user_uname,user_pic,user_text_status,user_social','ts_user',array('user_id'=>$uid));

      	$join_array = array('ts_user','ts_user.user_id = ts_follower.fol_follwing');
		$data['fol_users']=$this->my_model->select_data('user_uname,user_pic,user_id','ts_follower',array('fol_follower'=>$uid),'','','',$join_array );
		
      	$data['following_active']=1;
	    $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
	    $this->load->view('themes/'.$this->theme.'/user/profile_section',$data);
	    $this->load->view('themes/'.$this->theme.'/user/follower',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
   }
   function collections($username='',$uid=''){
      	$data['basepath'] = base_url();
      	$data['collection']=$this->my_model->select_data('*','ts_collections',array('col_user'=>$uid));
      	$data['userDetail']=$this->my_model->select_data('user_id,user_uname,user_pic,user_text_status,user_social','ts_user',array('user_id'=>$uid));
	    $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
	    $this->load->view('themes/'.$this->theme.'/user/profile_section',$data);
	    $this->load->view('themes/'.$this->theme.'/user/collections',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
   }
}
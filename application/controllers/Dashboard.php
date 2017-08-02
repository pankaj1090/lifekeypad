<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if( !isset($this->session->userdata['ts_uid']) ) {
			redirect(base_url());
		}
		/*if( isset($this->session->userdata['ts_uid']) ) {
    		if($this->session->userdata['ts_level'] == 1) {
			    redirect(base_url().'backend');
			}
		}*/
		if(isset($_POST) && !empty($_POST)) {
	        if(!isset($_SERVER['HTTP_REFERER'])) {
                die('Direct Access Not Allowed!!');
	        }
	    }
	    $this->load->library('ts_functions');
	    $this->theme = $this->ts_functions->current_theme();
	}

	public function index(){
		//if( isset($this->session->userdata['refer']) ) {
			redirect(base_url().'dashboard/my_collections');
		//}
	   // redirect(base_url().'dashboard/profile');
	}

/******* Profile page STARTS ***************/
	public function profile(){
		require('Default_controllers.php');
	    $data['basepath'] = base_url();
        $data['pageHeading'] = $this->ts_functions->getlanguage('profiletext','menus','solo');
        $data['profile_active'] = 'active';
        $uid = $this->session->userdata['ts_uid'];
        $updateArr = array();
	    if(isset($_POST['basic_btn']) || isset($_POST['billing_btn'])) {
	        foreach($_POST as $k=>$v) {
	            if( $k != 'basic_btn' && $k != 'billing_btn' ) {
                    $updateArr['user_'.$k] = $v;
                }
            }
            $data['updatemsg'] = $this->ts_functions->getlanguage('profilesucc','userdashboard','solo');
	    }
        
        if(isset($_POST['social_btn'])) {
	        $user_social=array();
	         foreach($_POST as $k=>$v) {
	            if( $k != 'social_btn'  ) {
                    array_push($user_social,array($k=>$v));
                }
            }
            
            $updateArr['user_social']= json_encode($user_social);
            $data['updatemsg'] = $this->ts_functions->getlanguage('profilesucc','userdashboard','solo');
	    }
	    if(isset($_POST['chngpwd_btn'])) {
	        if($_POST['pwd'] == $_POST['repwd']) {
	            if(strlen($_POST['pwd']) > 7) {
                    $updateArr['user_pwd'] = md5($_POST['repwd']);
                    $data['updatemsg'] = $this->ts_functions->getlanguage('profilepwdsucc','userdashboard','solo');
	            }
	            else {
	                $data['errormsg'] = $this->ts_functions->getlanguage('profilepwderr','userdashboard','solo');
	            }
	        }
	        else {
	            $data['errormsg'] = $this->ts_functions->getlanguage('profilepwdmatcherr','userdashboard','solo');
	        }
	    }
	    
	    if(isset($_FILES['userfile'])) {
	    	$path=dirname(__FILE__);
			$abs_path=explode('/application/',$path);
			$pathToProfilePic = $abs_path[0].'/webimage/';
			
			$config['upload_path'] = $pathToProfilePic;
			$config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload())
			{
				/***** Remove Previous Image STARTS **********/
					
					$userdetails = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));
					if( $userdetails[0]['user_pic'] != '' ) {
						unlink( $pathToProfilePic.$userdetails[0]['user_pic'] );
					}				
				/***** Remove Previous Image ENDS **********/
			
				$randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
				$imgNewname = $randomstr;
				$uploaddata=$this->upload->data();
				$img_name = $uploaddata['raw_name'];
				$img_ext = $uploaddata['file_ext'];
				$imgNewname = $imgNewname.$img_ext;
				rename($pathToProfilePic.$img_name.$img_ext, $pathToProfilePic.$imgNewname);
				$this->DatabaseModel->access_database('ts_user','update',array('user_pic'=>$imgNewname),array('user_id'=>$uid));		
			}
	    }

	    if(!empty($updateArr)) {
	        $this->DatabaseModel->access_database('ts_user','update',$updateArr,array('user_id'=>$uid));
	    }

        $data['userDetail'] = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));
        $data['countryDetails'] = $this->DatabaseModel->access_database('ts_country','select','','');
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		//$this->load->view('themes/'.$this->theme.'/user/include/dashboard_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/profile',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}
/******* Profile page ENDS ***************/

/******* Add / Renew Subscription STARTS ***************/
	public function subscription(){
	    require('Default_controllers.php');
        $data['basepath'] = base_url();
        $data['pageHeading'] = $this->ts_functions->getlanguage('substext','menus','solo');
        $data['plans_active'] = 'active';
        $data['plandetails'] = $this->DatabaseModel->access_database('ts_plans','select','',array('plan_status'=>1));
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/include/dashboard_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/plans_pricing',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}
/******* Add / Renew Subscription ENDS ***************/

/******* Purchased products OR Products unders your plan STARTS ***************/
	public function purchased(){

        $data['basepath'] = base_url();
        $data['purchase_active'] = 'active';

        $join_array = array('ts_products','ts_products.prod_id = ts_purchaserecord.purrec_prodid');
		$purchasedDetails = $this->DatabaseModel->access_database('ts_purchaserecord','','',array('purrec_uid'=>$this->session->userdata['ts_uid'],'prod_status'=>1),$join_array);

        if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) {
            $uid = $this->session->userdata['ts_uid'];
            $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));

            $userPlan = $userDetail[0]['user_plans'];
            $planProducts = $this->DatabaseModel->access_database('ts_products','select','',array('prod_status'=>1,'prod_free'=>0,'prod_plan'=>$userPlan));
            $data['dateofplan'] = $userDetail[0]['user_plansdate'];

            if( $userPlan == '0' ) {
                $data['planMsg'] = $this->ts_functions->getlanguage('upgrademessage','userdashboard','solo');
            }
        }
        else {
            $planProducts = array();
        }
		$data['purchasedDetails'] = array_merge($purchasedDetails,$planProducts);

        $data['pageHeading'] = $this->ts_functions->getlanguage('paiddowntext','menus','solo');
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/include/dashboard_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/purchased',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}

/******* Purchased products OR Products unders your plan ENDS ***************/

/******* FREE products STARTS ***************/
	public function free_downloads(){
        $data['basepath'] = base_url();
        $data['download_active'] = 'active';

		$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
		$data['freeProducts'] = $this->DatabaseModel->access_database('ts_products','','',array('prod_free'=>1,'prod_status'=>1),$join_array);

        $data['pageHeading'] = $this->ts_functions->getlanguage('freedowntext','menus','solo');
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/include/dashboard_header',$data);
		$this->load->view('themes/'.$this->theme.'/user/free_downloads',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
		/*sleep(3);
		if( isset($this->session->userdata['refer']) ) {
			redirect(base_url().'dashboard/free_download_product/'.$this->session->userdata['refer']);
			$this->session->unset_userdata('refer');
		}*/
	}
/******* FREE products ENDS ***************/


/******* Purchased Download Product Code STARTS ***************/
	public function download_product($prodUniqid='') {
	    if($prodUniqid != '') {
	        $prodDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$prodUniqid));
	        if(!empty($prodDetails)) {

	            $purchaseDetails = $this->DatabaseModel->access_database('ts_purchaserecord','select','',array('purrec_uid'=>$this->session->userdata('ts_uid'),'purrec_prodid'=>$prodDetails[0]['prod_id']));

	            if(!empty($purchaseDetails)) {
	                /*$downloadCount = $purchaseDetails[0]['purrec_downloadcount'];
	                $downloadCount = $downloadCount + 1 ;
	                $this->DatabaseModel->access_database('ts_purchaserecord','update',array('purrec_downloadcount'=>$downloadCount),array('purrec_id'=>$purchaseDetails[0]['purrec_id']));*/

                    $this->downloadfiles($prodUniqid);

                }
                else {
                    redirect(base_url());
                }
	        }
	        else {
	            redirect(base_url());
	        }
	    }
	    else {
	        redirect(base_url());
	    }
	}
/******* Purchased Download Product Code ENDS ***************/


/******* FREE Download Product Code STARTS ***************/
	public function free_download_product($prodUniqid='') {
	    if($prodUniqid != '') {
	        $prodDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$prodUniqid));
	        if(!empty($prodDetails) && isset($this->session->userdata['ts_uid']) ) {

                $uid = $this->session->userdata('ts_uid');
                $checkAvail = $this->ts_functions->checkproductavailablility($prodUniqid,$uid);
                if( $checkAvail == '0' ) {
                    redirect(base_url());
                }
                elseif( $checkAvail == '2' ) {
                    $this->session->set_flashdata('planMsg', $this->ts_functions->getlanguage('upgrademessage','userdashboard','solo'));
                    redirect(base_url().'dashboard/purchased');
                }

                $downloadCount = $prodDetails[0]['prod_download_count'];
                $downloadCount = $downloadCount + 1 ;
                $this->DatabaseModel->access_database('ts_products','update',array('prod_download_count'=>$downloadCount),array('prod_uniqid'=>$prodUniqid));
                if( $prodDetails[0]['prod_filename'] == '' ) {
                	$this->session->set_flashdata('planMsg', $this->ts_functions->getlanguage('missingzipmessage','userdashboard','solo'));
                    redirect(base_url().'dashboard/purchased');
                }
                else {
                	$this->downloadfiles($prodUniqid);
                }
	        }
	        else {
	            redirect(base_url());
	        }
	    }
	    else {
	        redirect(base_url());
	    }
	}
/******* FREE Download Product Code ENDS ***************/

/******* Download file code STARTS ***************/
	private function downloadfiles($uniqid='') {
	    require('Default_controllers.php');
	    if($uniqid != '') {
	        $prodDetails = $this->DatabaseModel->access_database('ts_products','select','',array('prod_uniqid'=>$uniqid));
	        if(!empty($prodDetails)) {
                 $this->addtodownloadcollection($prodDetails[0]['prod_id']);
	            if( strpos($prodDetails[0]['prod_filename'],'/') === false ) {

                    $filename = $prodDetails[0]['prod_filename'];
                    
                    $productname = $this->ts_functions->getProductName($prodDetails[0]['prod_id']);
                    $productname = rtrim($productname,'/');

                    $path=dirname(__FILE__);
                    $abs_path=explode('/application/',$path);
                    $source_path = $abs_path[0].'/repo/mainzipfiles/';
                    $destination_path = $abs_path[0].'/repo/temp/';

					$file_size  = filesize($source_path.$filename);
					
                    copy ( $source_path.$filename , $destination_path.$filename );
                    rename ( $destination_path.$filename , $destination_path.$productname.'.zip' );
                    
                    //header("Pragma: public");
					//header("Expires: -1");
					header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
					header("Content-Disposition: attachment; filename=\"$filename\"");
		
					header('Content-Disposition: inline;');
					header('Content-Type: application/zip');
					header("Content-Length: ".$file_size);
 
					//header('Accept-Ranges: bytes');
		
                    header('Content-Disposition: attachment; filename="'.$productname.'.zip');
                    readfile($destination_path.$productname.'.zip');		// push it out
                    
                   /* $productname = $productname.'.zip';
                    
                    set_time_limit(0);
					fseek($productname, $seek_start);
 
					while(!feof($productname)) 
					{
						print(@fread($productname, 1024*8));
						ob_flush();
						flush();
						if (connection_status()!=0) 
						{
							@fclose($productname);
							exit;
						}			
					}
 
					// file save was a success
					@fclose($productname);
					*/

                    unlink($destination_path.$productname.'.zip');
                    exit();
                }
                else {
                    // Direct URL Download
                    redirect($prodDetails[0]['prod_filename']);
                }
	        }
	        else {
	            redirect(base_url());
	        }
	    }
	    else {
	        redirect(base_url());
	    }
	}
/******* Download file code ENDS ***************/

    /************** Make User as Vendor STARTS ******************/

    function complete_vendor() {
        if(isset($_POST['comm'])) {
            $uid = $this->session->userdata['ts_uid'];
            $this->DatabaseModel->access_database('ts_user','update',array('user_accesslevel'=>3),array('user_id'=>$uid));
            $this->session->userdata['ts_level'] = 3;
            echo '1';
        }
        else {

        }
    }

    /************** Make User as Vendor ENDS ******************/


 function addtodownloadcollection($prod_id=''){
     $uid = $this->session->userdata['ts_uid'];
     if($prod_id!=''){
     $colDetail=$this->my_model->select_data('*','ts_collections',array('col_type'=>1,'col_user'=>$uid));
     if(!empty($colDetail)){
     	$col_id=$colDetail[0]['col_id'];
        $col_prod=$this->my_model->select_data('*','ts_collection_data',array('col_data_col'=>$col_id,'col_data_prod'=>$prod_id));
        if(empty($col_prod)){  
         $this->my_model->insert_data('ts_collection_data',array('col_data_col'=>$col_id,'col_data_prod'=>$prod_id));
          //success
        }else{
         //already added
        }
     }else{
     $col_id=  $this->my_model->insert_data('ts_collections',array('col_name'=>'My Download','col_user'=>$uid,'col_type'=>1,'col_status'=>1));
      $this->my_model->insert_data('ts_collection_data',array('col_data_col'=>$col_id,'col_data_prod'=>$prod_id));
     }
    }

   }

   function my_collections(){
     	$uid = $this->session->userdata['ts_uid'];
      	$data['basepath'] = base_url();
      	$data['collection']=$this->my_model->select_data('*','ts_collections',array('col_user'=>$uid));
      	$data['userDetail']=$this->my_model->select_data('user_id,user_uname,user_pic,user_text_status,user_social','ts_user',array('user_id'=>$uid));
	    $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
	    $this->load->view('themes/'.$this->theme.'/user/profile_section',$data);
	    $this->load->view('themes/'.$this->theme.'/user/collections',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
   }

   function create_collection(){
   	if($_POST){

   	  $collection_id=$_POST['collection_id'];	
   	  $collections=$_POST['new_collection_name'];	
   	  $uid = $this->session->userdata['ts_uid'];
   	  if($collection_id==''){
   	  $chk=$this->my_model->select_data('col_id','ts_collections',array('col_user'=>$uid,'col_name'=>$collections));
   	  if(empty($chk)){
   	  	$this->my_model->insert_data('ts_collections',array('col_name'=>$collections,'col_user'=>$uid,'col_type'=>0,'col_status'=>1));
   	  }
   	}else{
	   	$chk=$this->my_model->select_data('col_id','ts_collections',array('col_user'=>$uid,'col_name'=>$collections,'col_id!='=>$collection_id));
	   	  if(empty($chk)){
	   	  	$this->my_model->update_data('ts_collections',array('col_name'=>$collections),array('col_id'=>$collection_id,'col_user'=>$uid));
	   	  }
   	}
    
    }
   	  redirect(base_url('dashboard/my_collections'));
   	
   }

   
   function update_post(){
   	$uid = $this->session->userdata['ts_uid'];
   	$uname=$this->ts_functions->select_single_data("ts_user","where user_id=$uid","user_uname");
   	if($_POST){
   		$post_id=$_POST['post_id'];
   		    $postDataArr = array();
	        if($_FILES['post_image']['name'] != ''){
	            $path=dirname(__FILE__);
                $abs_path=explode('/application/',$path);
                $pathToImages = $abs_path[0].'/repo/postimage/';

                $config['upload_path'] = $pathToImages;
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('post_image'))
                {
                    $randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
                    $imgNewname = $randomstr;
                    $uploaddata=$this->upload->data();
                    $img_name = $uploaddata['raw_name'];
                    $img_ext = $uploaddata['file_ext'];
                    $imgNewname = $imgNewname.$img_ext;
                    rename($pathToImages.$img_name.$img_ext, $pathToImages.$imgNewname);
                    $postDataArr['post_image']=$imgNewname;


                    $config3['source_image'] = $pathToImages.$img_name.$img_ext;
					$config3['create_thumb'] = false;
					$config3['maintain_ratio'] = false;
					$config3['width'] = '346';
					$config3['height'] = '400';
					$this->load->library('image_lib'); 
					$this->image_lib->initialize($config3);
					$this->image_lib->resize();
					$this->image_lib->clear(); //The clear method resets all of the values

                }
                
	        }
            $postDataArr['post_content'] = $_POST['post_content'];
            $postDataArr['post_uid'] = $uid;
            $postDataArr['post_type'] = 'post';
             if($post_id==0){
             	$this->DatabaseModel->access_database('ts_posts','insert',$postDataArr,'');
             }
             redirect(base_url().'timeline/'.$uname.'/'.$uid);

   	}
   }


   function news_feeds(){
     	$order_by=array('post_date','Desc');
		$uid = $this->session->userdata['ts_uid'];
		$post_uid=$uid;
		$followers=$this->my_model->select_data('fol_follower','ts_follower',array('fol_follwing'=>$uid));
		if(!empty($followers)){
			foreach ($followers as $follower ) {
				$post_uid.=','.$follower['fol_follower'];
			}
		}
      	$data['basepath'] = base_url();
      	$cond="post_uid in($post_uid)";
        
      	$data['timeline_posts']=$this->my_model->select_data('*','ts_posts',$cond,$limit='',$order_by);
        $data['userDetail']=$this->my_model->select_data('user_id,user_uname,user_pic,user_text_status,user_social','ts_user',array('user_id'=>$uid));
        $cond1="user_id not in($post_uid)";
        $cond1.="AND user_pic!=''";
        $data['may_follow']=$this->my_model->select_data('user_id,user_uname,user_pic','ts_user',$cond1,4,array('user_id','RANDOM'));
      
	    $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
	    $this->load->view('themes/'.$this->theme.'/user/profile_section',$data);
	    $this->load->view('themes/'.$this->theme.'/user/user_timeline',$data);
	    $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
   }
    

}
?>

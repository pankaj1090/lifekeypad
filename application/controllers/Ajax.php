<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

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

    function opencollectionbox(){
    	if( isset($this->session->userdata['ts_uid']) ) {
    	}
    	else{
    		echo "login";
    	}
    }



function addtocollection(){
    if(isset($this->session->userdata['ts_uid']) ) {
       $uid= $this->session->userdata['ts_uid'];
       $prod_id=$_POST['prod_id'];
       $col_id=$_POST['col_id'];
       $colDetail=$this->my_model->select_data('*','ts_collections',array('col_id'=>$col_id,'col_type!='=>1,'col_user'=>$uid));
     if(!empty($colDetail)){
        $col_prod=$this->my_model->select_data('*','ts_collection_data',array('col_data_col'=>$col_id,'col_data_prod'=>$prod_id));
        if(empty($col_prod)){  
         $this->my_model->insert_data('ts_collection_data',array('col_data_col'=>$col_id,'col_data_prod'=>$prod_id));
         echo 1;die; //success
        }else{
          echo 2;die; //already added

        }
     }else{
        echo 0;die; //collection invalid
     }

    }else{
        echo 3;die;//invalid login
    }
}

function delete_collection(){
    if(isset($this->session->userdata['ts_uid']) ) {
       $uid= $this->session->userdata['ts_uid'];
       $col_id=$_POST['col_id'];
       $colDetail=$this->my_model->select_data('*','ts_collections',array('col_id'=>$col_id,'col_type!='=>1,'col_user'=>$uid));
     if(!empty($colDetail)){
        $this->my_model->delete_data('ts_collection_data',array('col_data_col'=>$col_id));
         $this->my_model->delete_data('ts_collections',array('col_id'=>$col_id,'col_user'=>$uid));
         echo 1;die; // success
        
     }else{
        echo 0;die; //collection invalid
     }

    }else{
        echo 3;die;//invalid login
    }
}

function site_share(){
    if(isset($this->session->userdata['ts_uid']) ) {
       $uid= $this->session->userdata['ts_uid'];
       $id=$_POST['id'];
       $type=$_POST['type'];
      if($type=='post'){
        $colDetail=$this->my_model->select_data('post_id','ts_posts',array('post_id'=>$id));
      }
      if($type=='collection'){
        $colDetail=$this->my_model->select_data('col_id','ts_collections',array('col_id'=>$id));
      }
      if($type=='book'){
        $colDetail=$this->my_model->select_data('prod_id','ts_products',array('prod_id'=>$id));
      }
     if(!empty($colDetail)){
        $data_arr=array(
        "post_uid"=>$uid,
        "post_type"=>"share",
        "post_share_type"=>$type,
        "post_share_id"=>$id
            );
      $this->my_model->insert_data('ts_posts',$data_arr);
        echo 1;die;  // shared
     }else{
        echo 0;die; //collection invalid
     }

    }else{
        echo 3;die;//invalid login
    }
  }

  

  function likes(){
   
    if(isset($this->session->userdata['ts_uid']) ) {
       $uid= $this->session->userdata['ts_uid'];
       $post_id=$_POST['post_id'];
       $postDetail=$this->my_model->select_data('post_id,post_like','ts_posts',array('post_id'=>$post_id));
     if(!empty($postDetail)){
         $lk_Detail=$this->my_model->select_data('lk_id','ts_likes',array('lk_post_id'=>$post_id,'lk_uid'=>$uid));
          if(empty($lk_Detail)){  
           $this->my_model->insert_data('ts_likes',array('lk_post_id'=>$post_id,'lk_uid'=>$uid));
           $this->my_model->update_data('ts_posts',array('post_like'=>$postDetail[0]['post_like']+1),array('post_id'=>$post_id));
           echo 1;die; //success
          }else{
           $this->my_model->delete_data('ts_likes',array('lk_post_id'=>$post_id,'lk_uid'=>$uid));
           $this->my_model->update_data('ts_posts',array('post_like'=>$postDetail[0]['post_like']-1),array('post_id'=>$post_id));
            echo 2;die; //already added

          }
         }else{
            echo 0;die; //post invalid
         }

        }else{
            echo 3;die;//invalid login
        }

  }


  function delete_collection_data(){
    if(isset($this->session->userdata['ts_uid']) ) {
       $uid= $this->session->userdata['ts_uid'];
       $delete_ids=ltrim($_POST['delete_ids'],',');
       $col_id=$_POST['col_id'];
         if(!empty($delete_ids)){
          $delete_ids=explode(',',$delete_ids);
          foreach ($delete_ids as $deleteid) {
           $this->my_model->delete_data('ts_collection_data',array('col_data_col'=>$col_id,'col_data_prod'=>$deleteid));
          }
          echo 1;//deleted

         }else{
          echo  2; //no delete
         }

        }else{
            echo 3;die;//invalid login
        }   
  }




function autosearch(){
   $res='<div class="lk_autocomp_inner_box">';
  $keywords="the";
  $keywords=$_POST['keywords'];
   $where_book="prod_urlname LIKE '%$keywords%' OR prod_name LIKE '%$keywords%' OR prod_tags LIKE '%$keywords%'";
   $books=$this->my_model->select_data('prod_name,prod_urlname,prod_uniqid','ts_products', $where_book,3);
   
   if(!empty($books)){
     $res.='<div class="autocomp_section"><ul>';
     foreach ($books as $book) {
          $books_url=base_url().'item/'.$book['prod_urlname'].'/'.$book['prod_uniqid'];
          $res.='<li><a href="'.$books_url.'">'.$book['prod_name'].'</a></li>';
     }
                      
     $res.= '</ul></div>';
    }
     
   $where_profile="user_uname LIKE '%$keywords%' OR user_fname LIKE '%$keywords%' OR user_lname LIKE '%$keywords%'";
   $profiles=$this->my_model->select_data('user_id,user_uname,user_pic','ts_user', $where_profile,3);

    if(!empty($profiles)){
      $res.='<div class="autocomp_section"><h3 class="autocomp_title">Profile</h3><ul>';
          foreach ($profiles as $profile) {
            $profile_pic=base_url().'webimage/dummy_testi.jpg';
            if(!empty($profile['user_pic'])){
            $profile_pic=base_url().'webimage/'.$profile['user_pic'];
             }
             $profile_url=base_url().'timeline/'.$profile['user_uname'].'/'.$profile['user_id'];
            $res.= '<li>
                <a href="'.$profile_url.'" class="autocomp_profile">
                  <div class="icon">
                    <img src="'.$profile_pic.'" alt="'.$profile['user_uname'].'" />
                  </div> 
                  <div class="detail">
                    <p>'.$profile['user_uname'].'</p>
                  </div>
                </a>
              </li>';
            }           
    $res.='</ul></div>';
    }
 
  $where_collection="col_name LIKE '%$keywords%'";
   $collections=$this->my_model->select_data('col_id,col_name','ts_collections', $where_collection,3);  

    if(!empty($collections)){
      $res.='<div class="autocomp_section"><h3 class="autocomp_title">Collection</h3><ul>';
       foreach ($collections as $collection) {
          $collection_url=base_url().'collection/'.$collection['col_name'].'/'.$collection['col_id'];
             $res.= '<li>
                        <a href="'.$collection_url.'" class="autocomp_collection">
                          <div class="detail">
                            <p>'.$collection['col_name'].'</p>
                          </div>
                        </a>
                      </li>';
       }               
      $res.='</ul></div>';
    }

  $res.='<div>';
  echo $res;

}


function follow(){
    if(isset($this->session->userdata['ts_uid']) ) {
       $uid= $this->session->userdata['ts_uid'];
       $following_uid=$_POST['following_uid'];
       $userDetail=$this->my_model->select_data('user_id','ts_user',array('user_id'=>$following_uid));
     if(!empty($userDetail)){
         $chk_Detail=$this->my_model->select_data('fol_id','ts_follower',array('fol_follwing '=>$following_uid,'fol_follower'=>$uid));
          if(empty($chk_Detail)){  
           $this->my_model->insert_data('ts_follower',array('fol_follwing '=>$following_uid,'fol_follower'=>$uid));
           echo 1;die; //success
          }else{
          
            echo 2;die; //already added
          }
         }else{
            echo 0;die; //post invalid
         }

        }else{
            echo 3;die;//invalid login
        }

  }


  function add_comment(){
  if(isset($this->session->userdata['ts_uid']) ) {
    $uid= $this->session->userdata['ts_uid'];
    $com_post=$_POST['com_post'];
    $com_content=$_POST['com_content'];
    $data_arr=array(
     "com_content"=>$_POST['com_content'],
     "com_post"=>$_POST['com_post'],
     "com_uid"=>$uid
      );  
      $this->my_model->insert_data('ts_comments',$data_arr);  
     $userimg = $this->ts_functions->getVendorImage($uid);
     $usename  =  $this->ts_functions->getVendorName($uid);
    $div='<div class="lk_comment_innerdiv">'.$userimg.'
              <div class="lk_commentdata">
                <h3>'.$usename.'</h3> 
                <p>'.$com_content.'</p>
                <span>2 second ago</span>
              </div>
            </div>';
   echo '1@@ss@@hh##'.$div;die;
  }else{
     echo '3@@ss@@hh##';die;
  }
}
/*function increment_postcount(){
 $post_id=$_POST['post_id']; 
 $post_view= $this->my_model->select_data('post_view','ts_posts',array('post_id'=>$post_id))[0]['post_view'];

   $data_arr=array(
     'post_view'=>$post_view+1);
$this->my_model->update_data('ts_posts',$data_arr,array('post_id'=>$post_id));
}*/

}
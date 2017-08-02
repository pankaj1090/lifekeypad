<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	function q(){
		echo phpinfo();
	}

	public function index()
	{
		$data['basepath'] = base_url();
		$data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));


		/**** Featured ****/
		$this->db->select('*');
        $this->db->from('ts_products');
        $this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
        $this->db->where('prod_status',1);
        $this->db->where('prod_featured',1);
        $this->db->where('prod_cateid',2);
        $this->db->order_by('prod_update', 'desc');
        $this->db->limit(6,0);
        $rs=$this->db->get();
        $productdetails = $rs->result_array();
		$data['featured_productdetails'] = $productdetails;
		/**** Featured ****/
		
		
		/**** Free ****/
		$this->db->select('*');
        $this->db->from('ts_products');
        $this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
        $this->db->where('prod_status',1);
        $this->db->where('prod_free',1);
        $this->db->where('prod_cateid',2);
        $this->db->order_by('prod_update', 'desc');
        $this->db->limit(6,0);
        $rs=$this->db->get();
        $productdetails = $rs->result_array();
		$data['free_productdetails'] = $productdetails;
		/**** Free ****/
		
		
		/**** Recent ****/
		$this->db->select('*');
        $this->db->from('ts_products');
        $this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
        $this->db->where('prod_status',1);
        $this->db->where('prod_free',0);
        $this->db->where('prod_cateid',2);
        $this->db->order_by('prod_update', 'desc');
        $this->db->limit(12,0);
        $rs=$this->db->get();
        $productdetails = $rs->result_array();
		$data['recent_productdetails'] = $productdetails;
		/**** Recent ****/
		

		
		/**** Best Seller ****/
		$this->db->select('purrec_prodid, COUNT(purrec_prodid) as occurence');
		$this->db->from('ts_purchaserecord');
		$this->db->group_by('purrec_prodid');
		$this->db->order_by('occurence', 'desc'); 
		//$this->db->limit(6,0);
		$rs=$this->db->get();
		$purRecord = $rs->result_array();
		$productdetails = array();
		if(!empty($purRecord)) {
			$count_rec = 0;
			foreach($purRecord as $solo_purRec) {
				
				$this->db->from('ts_products');
				$this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
				$this->db->where('prod_id',$solo_purRec['purrec_prodid']);
				$this->db->where('prod_status',1);
				$rs=$this->db->get();
				$rs=$rs->result_array();
				if(!empty($rs)) {
					if($count_rec < 6){
						$count_rec++;
						array_push($productdetails,$rs[0]);
					}
				}
			}
		}
		else {
			$productdetails = array();
		}
		$data['bestseller_productdetails'] = $productdetails;
		/**** Best Seller ****/
		
		
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/homepage',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}


	public function ebooks(){
		$data['basepath'] = base_url();
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/ebooks',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
	}

	/** newsletter ajax STARTS**/

	function subscribe_email() {
	    if(isset($_POST['emails'])) {
	        if($_POST['emails'] != '') {

	            $checkEmail = $this->DatabaseModel->access_database('ts_emaillist','select','',array('e_email'=>$_POST['emails']));
	            if(empty($checkEmail)) {
	                $s = $this->ts_functions->subscribeemails( $_POST['emails'] , $_POST['type']);

	                if($s == '7') {
                        // save to internal DB
                        $insertArr = array(
                            'e_date'    =>  date('Y-m-d'),
                            'e_email'   =>  $_POST['emails'],
                            'e_list'   =>  0,
                            'e_type'   =>  'newsletter'
                        );
                        $this->DatabaseModel->access_database('ts_emaillist','insert',$insertArr,'');
                    }
	            }
	            else {
	                echo '404';
	            }
	        }
	    }
	    else {
	        echo '0';
	    }
	    die();
	}
	/** newsletter ajax ENDS**/

	/** get ajax products STARTS **/

	public function get_ajx_products(){
	    if(isset($_POST['cid'])) {
	        $join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');

	        if($_POST['cid'] != '0') {
    		    $this->db->select('*');
                $this->db->from('ts_products');
                $this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
                $this->db->where('prod_cateid',$_POST['cid']);
                $this->db->where('prod_status',1);
                $this->db->order_by('prod_update', 'desc');
                $this->db->limit(9, 0);
                $rs=$this->db->get();
                $productdetails = $rs->result_array();

    		}
    		else {
    		    $join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid',0,9);
    		    $data_array = array('prod_update','desc');
    		    $productdetails = $this->DatabaseModel->access_database('ts_products','join_order_limit',$data_array,'',$join_array);
    		}

    		$htmlContent = '';
            if( !empty($productdetails) ) {
                foreach($productdetails as $soloProd) {
                    $prodName = $this->ts_functions->getProductName($soloProd['prod_id']);

                    if( $soloProd['prod_free'] == '0') {
                        if( $this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) {
                            $buyText = '<a href="'.base_url().'shop/checkmembership" class="ts_btn">'. $this->ts_functions->getlanguage('buynowtab','homepage','solo').'</a>';
                        }
                        else {
                            $buyText = '<a href="'.base_url().'shop/add_to_cart/products/'. $soloProd['prod_uniqid'].'" class="ts_price">'. $this->ts_functions->getsettings('portalcurreny','symbol').' '. $soloProd['prod_price'].'</a>';
                        }
                    }
                    else {
                        // Free
                        $buyText = '<a href="'.base_url().'shop/add_to_cart/products/'. $soloProd['prod_uniqid'].'" class="ts_btn">'. $this->ts_functions->getlanguage('freetext','commontext','solo').'</a>';
                    }

                    $catename = strtolower($soloProd['cate_name']);
                    $catename = str_replace(' ','-',$catename);
                    $catename = preg_replace('!-+!', '-', $catename);

                    $htmlContent .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"> <div class="ts_theme_boxes"> <div class="ts_theme_boxes_img"> <a href="'.base_url().'item/'.$prodName.$soloProd['prod_uniqid'].'"><img src="'.base_url().'repo/images/'.$soloProd['prod_image'].'" title="'.$soloProd['prod_name'].'"/></a> </div> <div class="ts_theme_boxes_info"> <div class="ts_theme_details"> <h4>'.$soloProd['prod_name'].'</h4> <p> <a href="'.base_url().'home/products/'.$catename.'"> <i class="fa fa-tag" aria-hidden="true"></i> '.$soloProd['cate_name'].'</a></p></div><div class="ts_theme_price">'.$buyText.'</div></div></div></div>';
                }
                echo json_encode($htmlContent);
            }
            else {
                echo '0';
            }
	    }
		else {
		    echo '0';
		}
		die();

	}

	/** get ajax products ENDS **/


	/** Pricing Table STARTS **/

    function plans_pricing() {
        $data['basepath'] = base_url();
        $data['plandetails'] = $this->DatabaseModel->access_database('ts_plans','select','',array( 'plan_status'=>1));
        if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) {
            redirect(base_url());
        }
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/pricing_table',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }

    /** Pricing Table ENDS **/

    /** Vendor Pricing Table STARTS **/

    function vendor_plans() {
        $data['basepath'] = base_url();
        $data['vendorplandetails'] = $this->DatabaseModel->access_database('ts_vendorplans','select','',array( 'vplan_status'=>1));

        if( $this->ts_functions->getsettings('marketplace','typevendor') != 'multi') {
            redirect(base_url());
        }
		$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/pricing_table',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }

    /** Vendor Pricing Table ENDS **/

    /** Product View STARTS **/

    function products1($category='',$cateid='') {
		$this->load->library('site_pagination');
		$limitFrom = (isset($_POST['paginationCount']))? $_POST['paginationCount'] : 0;
		$limit = array('18',$limitFrom);
		$cond = array();
        if( $category == '' ) {
            // All category

            $join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
           // $productdetails = $this->DatabaseModel->access_database('ts_products','','', array('prod_status'=>1),$join_array);

		   $productdetails = $this->DatabaseModel->select_data('*' , 'ts_products' , array('prod_status'=>1) , $limit , $join_array);

            if(empty($productdetails)) { redirect(base_url());}
            $data['productdetails'] = $productdetails;
			$cond = array('prod_status'=>1);
            $data['headlineText'] = $this->ts_functions->getlanguage('alltext','homepage','solo');
        }
        elseif( $category == 'freebies' ) {
            // All free products

            $join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
            //$productdetails = $this->DatabaseModel->access_database('ts_products','','', array('prod_status'=>1,'prod_free'=>1),$join_array);
            $productdetails = $this->DatabaseModel->select_data('*' , 'ts_products' , array('prod_status'=>1,'prod_free'=>1) , $limit , $join_array);

            if(empty($productdetails)) { redirect(base_url());}
            $data['productdetails'] = $productdetails;
			$cond = array('prod_status'=>1,'prod_free'=>1);
            $data['headlineText'] = "Free";

        }
        elseif( $category == 'recent' ) {
            // All Recent products

            $this->db->select('*');
			$this->db->from('ts_products');
			$this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
			$this->db->where('prod_status',1);
			$this->db->where('prod_free',0);
			$this->db->order_by('prod_update', 'desc');
			$this->db->limit(15,$limitFrom);
			$rs=$this->db->get();
			$productdetails = $rs->result_array();
			
            if(empty($productdetails)) { redirect(base_url());}
            $data['productdetails'] = $productdetails;
			$cond = array('prod_status'=>1,'prod_free'=>1);
            $data['headlineText'] = "Recent";
        }
        elseif( $category == 'featured' ) {
            // All Featured products
            
            $this->db->select('*');
			$this->db->from('ts_products');
			$this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
			$this->db->where('prod_status',1);
			$this->db->where('prod_featured',1);
			$this->db->order_by('prod_update', 'desc');
			$this->db->limit(15,$limitFrom);
			$rs=$this->db->get();
			$productdetails = $rs->result_array();

            if(empty($productdetails)) { redirect(base_url());}
            $data['productdetails'] = $productdetails;
			$cond = array('prod_status'=>1,'prod_free'=>1);
            $data['headlineText'] = "Featured";
        }
        else {
			if($cateid == '') {
				// Search text
				$category = urldecode($category);
                $this->db->select('*');
                $this->db->from('ts_products');
                $this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
                $this->db->like('ts_products.prod_urlname',$category);
                $this->db->or_like('ts_products.prod_name',$category);
                $this->db->or_like('ts_products.prod_tags',$category);
	            $this->db->having('prod_status',1);
				$this->db->limit($limit[0],$limit[1]);
                $rs=$this->db->get();
                $productdetails = $rs->result_array();

                $data['productdetails'] = $productdetails;
				$cond = array('prod_status'=>1);
                $data['headlineText'] = $this->ts_functions->getlanguage('searchrestext','commontext','solo').' '.$category;
			}
			else {
				$data['cateid'] = $cateid;
				if( $category == 'category' ) {
					$data['cate_type'] = 'category';
					$categoryCheck = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_id'=>$cateid));
					if(empty($categoryCheck)){
						redirect(base_url());
					}
					$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
				
					$productdetails = $this->DatabaseModel->select_data('*' , 'ts_products' , array('prod_status'=>1 , 'prod_cateid'=>$cateid) , $limit , $join_array);

					$data['productdetails'] = $productdetails;
					$cond = array('prod_status'=>1 , 'prod_cateid'=>$cateid);
					$data['headlineText'] = $categoryCheck[0]['cate_name'];
                }
                else {
                	$data['cate_type'] = 'sub_cate';
                	$sub_categoryCheck = $this->DatabaseModel->access_database('ts_subcategories','select','',array('sub_id'=>$cateid));
					if(empty($sub_categoryCheck)){
						redirect(base_url());
					}
					$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
				
					$productdetails = $this->DatabaseModel->select_data('*' , 'ts_products' , array('prod_status'=>1 , 'prod_subcateid'=>$cateid) , $limit , $join_array);

					$data['productdetails'] = $productdetails;
					$cond = array('prod_status'=>1 , 'prod_subcateid'=>$cateid);
					$data['headlineText'] = $sub_categoryCheck[0]['sub_name'];
                }
			}

        }

		$productCount = $this->DatabaseModel->select_data('COUNT(prod_id) as count_prod' , 'ts_products' , $cond);

		$count_all_prod = (!empty($productCount))?$productCount['0']['count_prod']:0;

		$data['pagination_buttons'] = $this->site_pagination->pagination($count_all_prod, $limitFrom , 18);


        $data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));

        $data['basepath'] = base_url();
        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/products_view',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }

    /** Product View ENDS **/
    
    function search_products($t=''){

    	if(isset($_POST['keyword'])) {

    		$this->load->library('site_pagination');
			$limitFrom = (isset($_POST['paginationCount']))? $_POST['paginationCount'] : 0;
			$limit = array('18',$limitFrom);
			
			
    		$category = urldecode($_POST['keyword']);
    		
    		$cond = "(prod_urlname LIKE '%$category%' OR prod_name LIKE '%$category%' OR prod_tags LIKE '%$category%')";
    		
			$this->db->select('*');
			$this->db->from('ts_products');
			$this->db->join('ts_c


				ategories', 'ts_categories.cate_id = ts_products.prod_cateid');
			$this->db->like('ts_products.prod_urlname',$category);
			$this->db->or_like('ts_products.prod_name',$category);
			$this->db->or_like('ts_products.prod_tags',$category);
			if( $_POST['category'] != '0' ) {
				$this->db->having('prod_cateid',$_POST['category']);
				$cat = $_POST['category'];
				$cond .= "AND prod_cateid = '$cat'";
			}
			if( $_POST['sub_category'] != '0' ) {
				$this->db->having('prod_subcateid',$_POST['sub_category']);
				$sub_cat = $_POST['sub_category'];
				$cond .= "AND prod_subcateid = '$sub_cat'"; 
			}

			$this->db->having('prod_status',1);
			$this->db->limit($limit[0],$limit[1]);
			$rs=$this->db->get();
			$productdetails = $rs->result_array();

			$data['productdetails'] = $productdetails;

    		$productCount = $this->DatabaseModel->select_data('COUNT(prod_id) as count_prod' , 'ts_products' , $cond);
			$data['productCount'] = $productCount;
			$count_all_prod = (!empty($productCount))?$productCount['0']['count_prod']:0;

			$data['pagination_buttons'] = $this->site_pagination->pagination($count_all_prod, $limitFrom , 18);
			$cond = array('prod_status'=>1);
			
    		$data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));
    		$data['sub_categoryList'] = $this->DatabaseModel->access_database('ts_subcategories','select','','');

			$data['basepath'] = base_url();
			$data['headlineText'] = $_POST['keyword'];
			$this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
			$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
			$this->load->view('themes/'.$this->theme.'/home/products_view',$data);
			$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    	}
    	else {
    		redirect(base_url());
    	}
    }

    /*** Support / Contact Page STARTS ***/

    function contact() {
        if(isset($_POST['msg'])) {
        // Ajax
            if( isset($_POST['email']) ) {
                if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
                    $email = $_POST['email'];
                    $name = $_POST['name'];
                    $reg = 'NO';
                }
                else {
                    echo 'emailerr';
                    die();
                }
            }
            else {
                $uid = $this->session->userdata['ts_uid'];
                $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));
                $email = $userDetail[0]['user_email'];
                $name = $userDetail[0]['user_uname'];
                $reg = 'YES';
            }
            $msg = $_POST['msg'];

            $bodyhead="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <title>".$this->ts_functions->getsettings('sitetitle','text')."</title>
            </head><body>";
            if( $this->ts_functions->getsettings('email','logoshow') == '1' ) {
                $body = "<img src='".$this->ts_functions->getsettings('logo','url')."' alt='".$this->ts_functions->getsettings('sitetitle','text')."'  title='".$this->ts_functions->getsettings('sitetitle','text')."'/>";
            }
            else {
                $body = '';
            }
            $subject = 'Query from contact page';
            $body .="<p> Hi Admin, <br/>We have got a message from Contact page. Below are the details.</p><p> Is the user is registered with us : ".$reg."</p> <p> Name : ".$name."</p> <p> Email : ".$email."</p> <p> Message : ".$msg."</p> <br/><br/> Thanks.";

            $from = $this->ts_functions->getsettings('email','fromname');
            $from_add = $this->ts_functions->getsettings('email','fromemail');
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n";
            $headers .= 'Reply-To: '.$email . "\r\n";

            $headers .= 'X-Mailer: PHP/' . phpversion();

            $to = $this->ts_functions->getsettings('email','contactemail');
            mail($to,$subject,$bodyhead.$body.'</body></html>',$headers, '-f'.$from_add);

            /* Subscribe to list */
                $s = $this->ts_functions->subscribeemails( $_POST['email'] , 'contactemails');
                if($s == '7') {
                    // save to internal DB
                    $insertArr = array(
                        'e_date'    =>  date('Y-m-d'),
                        'e_email'   =>  $_POST['email'],
                        'e_list'   =>  0,
                        'e_type'   =>  'contactemails'
                    );
                    $this->DatabaseModel->access_database('ts_emaillist','insert',$insertArr,'');
                }
            /* Subscribe to list */

            echo '1';
            die();

        }
        else {
            $data['basepath'] = base_url();
            $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
            $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
            $this->load->view('themes/'.$this->theme.'/home/contact',$data);
            $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
        }
    }

    /*** Support / Contact Page ENDS ***/

	/* Common Logout */
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
	}

    public function faq(){
        $data['basepath'] = base_url();
        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/faq',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }

    public function terms(){
        $data['basepath'] = base_url();
        $data['pageContent'] = $this->DatabaseModel->access_database('ts_pages','select', '' , array('page_type'=>'termsconditions'));
        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/terms',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }

    public function privacy(){
        $data['basepath'] = base_url();
        $data['pageContent'] = $this->DatabaseModel->access_database('ts_pages','select', '' , array('page_type'=>'privacypolicy'));
        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/privacy',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }

    public function aboutus(){
        $data['basepath'] = base_url();
        $data['pageContent'] = $this->DatabaseModel->access_database('ts_pages','select', '' , array('page_type'=>'aboutus'));
        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
        $this->load->view('themes/'.$this->theme.'/home/aboutus',$data);
        $this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }



    /************** Image Gallery STARTS **********************/
    function getgalleryimages(){
        if(isset($_POST['prodId'])) {
            $imgRes = $this->DatabaseModel->access_database('ts_prodgallery','select', '' , array('prodgallery_pid'=>$_POST['prodId']) );
            if(!empty($imgRes)) {
                $imgStr = '';
                $counter = 1;
                foreach($imgRes as $soloRes) {
                    $imgStr .= '<li id="img_'.$counter.'" style="display:none;"><img src="'.base_url().'repo/gallery/p_'.$_POST['prodId'].'/'.$soloRes['prodgallery_img'].'"></li>';
                    $counter++;
                }
                echo $imgStr;
            }
            else {
                echo '0';
            }
        }
        else {
            echo '0';
        }
    }
    /************** Image Gallery ENDS **********************/
    
    /************** Download Preview for Text STARTS **********************/
    function download_preview_text($pid=''){
        if($pid != '') {
        	$prod_details = $this->DatabaseModel->access_database('ts_products','select','',array('prod_id'=>$pid));
			if( empty($prod_details) ) {
				redirect(base_url());
			}
            $imgRes = $this->DatabaseModel->access_database('ts_prodgallery','select', '' , array('prodgallery_pid'=>$pid) );
            if(!empty($imgRes)) {
            	$filename = $imgRes[0]['prodgallery_img'];
                $productname = $this->ts_functions->getProductName($prod_details[0]['prod_id']);
                $productname = rtrim($productname,'/');
                $productname = $productname.'_preview';

                $path=dirname(__FILE__);
                $abs_path=explode('/application/',$path);
                $source_path = $abs_path[0].'/repo/gallery/p_'.$prod_details[0]['prod_id'].'/';
                $destination_path = $abs_path[0].'/repo/temp/';

                copy ( $source_path.$filename , $destination_path.$filename );
                rename ( $destination_path.$filename , $destination_path.$productname.'.zip' );

                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="'.$productname.'.zip');
                readfile($destination_path.$productname.'.zip');		// push it out

                unlink($destination_path.$productname.'.zip');
                exit();
            }
            else {
                redirect(base_url());
            }
        }
        else {
            redirect(base_url());
        }
    }
    /************** Download Preview for Text ENDS **********************/

    /*** Vendor Contact Page STARTS ***/

    function vendor_contact() {
        if(isset($_POST['msg'])) {
        // Ajax
            if( !isset($this->session->userdata['ts_uid']) ) {
                echo '0';
                die();
            }
            else {
                $uid = $this->session->userdata['ts_uid'];
                $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid));
                $email = $userDetail[0]['user_email'];
                $name = $userDetail[0]['user_uname'];

                $vendorDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$_POST['vid']));
                if(empty($vendorDetail)) {
                    echo '0';
                    die();
                }
            }
            $msg = $_POST['msg'];

            $bodyhead="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <title>".$this->ts_functions->getsettings('sitetitle','text')."</title>
            </head><body>";
            if( $this->ts_functions->getsettings('email','logoshow') == '1' ) {
                $body = "<img src='".$this->ts_functions->getsettings('logo','url')."' alt='".$this->ts_functions->getsettings('sitetitle','text')."'  title='".$this->ts_functions->getsettings('sitetitle','text')."'/>";
            }
            else {
                $body = '';
            }
            $subject = 'Query from Vendor Profile contact form';
            $body .="<p> Hi ".$vendorDetail[0]['user_uname'].", <br/>We have got a message from your profile page. Below are the user details.</p> <p> Name : ".$name."</p> <p> Email : ".$email."</p> <p> Message : ".$msg."</p> <br/><br/> Thanks.";

            $from = $this->ts_functions->getsettings('email','fromname');
            $from_add = $this->ts_functions->getsettings('email','fromemail');
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n";
            $headers .= 'Reply-To: '.$email . "\r\n";

            $headers .= 'X-Mailer: PHP/' . phpversion();

            $to = $vendorDetail[0]['user_email'];
            mail($to,$subject,$bodyhead.$body.'</body></html>',$headers, '-f'.$from_add);

            echo '1';
            die();

        }
        else {
            echo '0';
            die();
        }
    }

    /*** Support / Contact Page ENDS ***/
    
    /*********** Add to Favorite STARTS **********************/
    
    function add_to_favorites(){
    	if(isset($_POST['p_uniqid'])) {
    		if(isset($this->session->userdata['ts_uid'])) {
    			$uid = $this->session->userdata['ts_uid'];
    			
    			$data_arr = array('fav_uid'=>$uid,'fav_prodid'=>$_POST['p_uniqid']);
    			$prev_fav = $this->DatabaseModel->access_database('ts_favorites','select', '' , $data_arr );
    			if( !empty($prev_fav) ) {
    				$this->DatabaseModel->access_database('ts_favorites','delete', '' , $data_arr );
    				echo '2'; // hate
    			}
    			else {
    				$this->DatabaseModel->access_database('ts_favorites','insert', $data_arr, '' );
    				echo '1'; // love    				
    			}
    		}
    		else {
    			echo '0';
    		}
    	}
    	else {
    		echo '404';
    	}
    	die();
    	
    }
    /*********** Add to Favorite STARTS **********************/
    
    /*********** Star Rating STARTS **********************/
    
    function star_rating_product(){
    	if(isset($_POST['product_id'])) {
    		if(isset($this->session->userdata['ts_uid'])) {
    			$uid = $this->session->userdata['ts_uid'];
    			
    			$data_arr = array('rating_uid'=>$uid,'rating_prodid'=>$_POST['product_id']);
    			$prev_rating = $this->DatabaseModel->access_database('ts_ratings','select', '' , $data_arr );
    			if( !empty($prev_rating) ) {
    				$this->DatabaseModel->access_database('ts_ratings','update', array('rating_stars'=>$_POST['star']) , $data_arr );
    				echo '2'; // update
    			}
    			else {
    				$data_arr['rating_stars'] = $_POST['star'];
    				$this->DatabaseModel->access_database('ts_ratings','insert', $data_arr, '' );
    				echo '1'; // insert    				
    			}
    		}
    		else {
    			echo '0';
    		}
    	}
    	else {
    		echo '404';
    	}
    	die();
    	
    }
    /*********** Star Rating STARTS **********************/
    
    function getSubCategories(){
        if(isset($_POST['cateId'])) {
            $subCate  = $this->DatabaseModel->access_database('ts_subcategories','select','',array('sub_parent'=>$_POST['cateId']));
            $str = '<option value="0">Choose one</option>';
            if(!empty($subCate)) {
                foreach($subCate as $solo_subCate) {
                    $str .= '<option value="'.$solo_subCate['sub_id'].'">'.$solo_subCate['sub_name'].'</option>';
                }
            }
            else {
                $str .= '<option value="0">Nothing found</option>';
            }
            echo $str;
        }
        else {
	        echo '0';
	    }
	    die();
    }


    function products($category='',$cateid='') {
        $this->load->model('my_model');
		$this->load->library('ci_pagination');
        $data_per_page = 5;
		$current_key = 0;
        if(isset($_POST['ci_pagination_key'])){
			$current_key = $_POST['ci_pagination_key'];
		}


		$this->load->library('site_pagination');
		$limitFrom = (isset($_POST['paginationCount']))? $_POST['paginationCount'] : 0;
		$limit = array('18',$limitFrom);
		$cond = array();
        if( $category == '' ) {
            // All category

            $join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
           // $productdetails = $this->DatabaseModel->access_database('ts_products','','', array('prod_status'=>1),$join_array);

		   $productdetails = $this->DatabaseModel->select_data('*' , 'ts_products' , array('prod_status'=>1) , $limit , $join_array);

            if(empty($productdetails)) { redirect(base_url());}
            $data['productdetails'] = $productdetails;
			$cond = array('prod_status'=>1);
            $data['headlineText'] = $this->ts_functions->getlanguage('alltext','homepage','solo');
        }
        elseif( $category == 'freebies' ) {
            // All free products
          
            $join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
            //$productdetails = $this->DatabaseModel->access_database('ts_products','','', array('prod_status'=>1,'prod_free'=>1),$join_array);
           // $prod_condition="prod_status = '1' AND prod_free = '1' AND prod_cateid in(2,3)";
            $productdetails = $this->DatabaseModel->select_data('*' , 'ts_products' ,array('prod_status'=>1,'prod_free'=>1) , $limit , $join_array);
            
            if(empty($productdetails)) { redirect(base_url());}
            $data['productdetails'] = $productdetails;
			$cond = array('prod_status'=>1,'prod_free'=>1);
            $data['headlineText'] = "Free";
        }
        elseif( $category == 'recent' ) {
            // All Recent products

            $this->db->select('*');
			$this->db->from('ts_products');
			$this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
			$this->db->where('prod_status',1);
			$this->db->where('prod_free',0);
			$this->db->order_by('prod_update', 'desc');
			$this->db->limit(15,$limitFrom);
			$rs=$this->db->get();
			$productdetails = $rs->result_array();
			
            if(empty($productdetails)) { redirect(base_url());}
            $data['productdetails'] = $productdetails;
			$cond = array('prod_status'=>1,'prod_free'=>1);
            $data['headlineText'] = "Recent";
        }
        elseif( $category == 'featured' ) {
            // All Featured products
            
            $this->db->select('*');
			$this->db->from('ts_products');
			$this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
			$this->db->where('prod_status',1);
			$this->db->where('prod_featured',1);
			$this->db->order_by('prod_update', 'desc');
			$this->db->limit(15,$limitFrom);
			$rs=$this->db->get();
			$productdetails = $rs->result_array();

            if(empty($productdetails)) { redirect(base_url());}
            $data['productdetails'] = $productdetails;
			$cond = array('prod_status'=>1,'prod_free'=>1);
            $data['headlineText'] = "Featured";
        }
        else {
			if($cateid == '') {
				// Search text
				$category = urldecode($category);
                $this->db->select('*');
                $this->db->from('ts_products');
                $this->db->join('ts_categories', 'ts_categories.cate_id = ts_products.prod_cateid');
                $this->db->like('ts_products.prod_urlname',$category);
                $this->db->or_like('ts_products.prod_name',$category);
                $this->db->or_like('ts_products.prod_tags',$category);
	            $this->db->having('prod_status',1);
				$this->db->limit($limit[0],$limit[1]);
                $rs=$this->db->get();
                $productdetails = $rs->result_array();

                $data['productdetails'] = $productdetails;
				$cond = array('prod_status'=>1);
                $data['headlineText'] = $this->ts_functions->getlanguage('searchrestext','commontext','solo').' '.$category;
			}
			else {
				$data['cateid'] = $cateid;
				if( $category == 'category' ) {
					$data['cate_type'] = 'category';
					$categoryCheck = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_id'=>$cateid));
					if(empty($categoryCheck)){
						redirect(base_url());
					}
					$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
				
					$productdetails = $this->DatabaseModel->select_data('*' , 'ts_products' , array('prod_status'=>1 , 'prod_cateid'=>$cateid) , $limit , $join_array);

					$data['productdetails'] = $productdetails;
					$cond = array('prod_status'=>1 , 'prod_cateid'=>$cateid);
					$data['headlineText'] = $categoryCheck[0]['cate_name'];
                }
                else {
                	$data['cate_type'] = 'sub_cate';
                	$sub_categoryCheck = $this->DatabaseModel->access_database('ts_subcategories','select','',array('sub_id'=>$cateid));
					if(empty($sub_categoryCheck)){
						redirect(base_url());
					}
					$join_array = array('ts_categories','ts_categories.cate_id = ts_products.prod_cateid');
				
					$productdetails = $this->DatabaseModel->select_data('*' , 'ts_products' , array('prod_status'=>1 , 'prod_subcateid'=>$cateid) , $limit , $join_array);

					$data['productdetails'] = $productdetails;
					$cond = array('prod_status'=>1 , 'prod_subcateid'=>$cateid);
					$data['headlineText'] = $sub_categoryCheck[0]['sub_name'];
                }
			}

        }

		$productCount = $this->DatabaseModel->select_data('COUNT(prod_id) as count_prod' , 'ts_products' , $cond);

		$count_all_prod = (!empty($productCount))?$productCount['0']['count_prod']:0;

		$data['pagination_buttons'] = $this->site_pagination->pagination($count_all_prod, $limitFrom , 18);


        $data['categoryList'] = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));

        $data['basepath'] = base_url();
        $this->load->view('themes/'.$this->theme.'/home/include/home_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/menu_header',$data);
		$this->load->view('themes/'.$this->theme.'/home/products_view',$data);
		$this->load->view('themes/'.$this->theme.'/home/include/home_footer',$data);
    }


    
}

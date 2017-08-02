<!DOCTYPE html>
<html>
<head>
	
<meta charset="utf-8" />
<title><?php echo $this->ts_functions->getsettings('sitetitle','text');?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>" property="og:title">
<meta content="website" property="og:type">
<meta content="<?php echo $basepath;?>" property="og:url">
<meta content="<?php echo $this->ts_functions->getsettings('logo','url');?>" property="og:image">
<meta content="<?php echo $this->ts_functions->getsettings('seodescr','text');?>" property="og:description">
<meta content="<?php echo $this->ts_functions->getsettings('sitename','text');?>" property="og:site_name">
<meta name="description"  content="<?php echo $this->ts_functions->getsettings('seodescr','text');?>"/>
<meta name="keywords" content="<?php echo $this->ts_functions->getsettings('metatags','text');?>">
<meta name="author" content="<?php echo $this->ts_functions->getsettings('siteauthor','text');?>"/>
<meta name="MobileOptimized" content="320">
<!-- favicon links -->
<link rel="shortcut icon" type="image/png" href="<?php echo $this->ts_functions->getsettings('favicon','url');?>" />
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800" rel="stylesheet">
<link href="<?php echo $basepath;?>themes/default/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $basepath;?>themes/default/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $basepath;?>themes/default/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo $basepath;?>themes/default/js/masonry/component.css" rel="stylesheet">
<link href="<?php echo $basepath;?>themes/default/css/style.css" rel="stylesheet">

	
</head>
<?php
    if(isset($this->session->userdata['ts_uid'])) {
    if($this->ts_functions->getsettings('marketplace','typevendor') == 'multi') {
        if($this->ts_functions->getsettings('vendor','revenuemodel') != 'commission') {
            if( $this->session->userdata['ts_level'] != 3) {
                $uid = $this->session->userdata['ts_uid'];
                $userDetail = $this->DatabaseModel->access_database('ts_user','select','',array('user_id'=>$uid,'user_accesslevel'=>3));
                if(!empty($userDetail)) {
                    $this->session->userdata['ts_level'] = 3;
                }
            }
        }
    }
    }?>
<body>

<!--
<div class="lk_preloader_wrapper">
	<div id="preloader">
		<span></span>
		<span></span>
		<span></span>
		<span></span>
	</div>
</div>-->
<?php if(isset($_SESSION['ts_error_img']) && $_SESSION['ts_error_img'] != '') { ?>
    <div class="ts_message_popup ts_popup_error">
      <p class="ts_message_popup_text"> <?php echo $_SESSION['ts_error_img'];?> </p>
    </div>
<?php $_SESSION['ts_error_img'] = ''; } ?>
<?php if(isset($_SESSION['ts_error_file']) && $_SESSION['ts_error_file'] != '') { ?>
    <div class="ts_message_popup ts_popup_error">
      <p class="ts_message_popup_text"> <?php echo $_SESSION['ts_error_file'];?> </p>
    </div>
<?php $_SESSION['ts_error_file'] = ''; } ?>
<?php if(isset($_SESSION['ts_success']) && $_SESSION['ts_success'] != '') { ?>
    <div class="ts_message_popup ts_popup_success">
      <p class="ts_message_popup_text"> <?php echo $_SESSION['ts_success'];?> </p>
    </div>
<?php $_SESSION['ts_success'] = ''; } ?>
<!--Message Popup Start-->
<div class="ts_message_popup">
  <p class="ts_message_popup_text">
  
  </p>
</div>
<!--Message Popup End-->

<div class="sidebar_closer"></div>




<!--main wrapper start-->
<div class="lk_main_wrapper">
	<!--header start-->
	<div class="lk_header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="lk_logo">
						<a href="<?php echo $basepath; ?>"><img src="<?php echo $basepath;?>themes/default/images/logo.png" alt="" /></a>
					</div>
					<div class="lk_header_right">
						<div class="lk_nav_toggle">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<div class="lk_header_nav">
							<ul>
								<li><a href="<?php echo $basepath;?>become_a_vendor">Start Selling</a></li>
								<li class="lk_dropdown"><a href="javascript:">Categories</a>
								<?php $cate_list = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));?>
								<?php if(!empty($cate_list)) { ?>
									<ul class="sub_menu">
                                      <?php foreach($cate_list as $solo_cate) { 
											$catename = strtolower($solo_cate['cate_urlname']);
											$catename = str_replace(' ','-',$catename);
											$catename = preg_replace('!-+!', '-', $catename);	
											$catename = 'category';
											
											$sub_category = $this->DatabaseModel->access_database('ts_subcategories','select','',array('sub_parent'=>$solo_cate['cate_id']));
										?>
										<li><a href="javascript:"><?php echo $solo_cate['cate_name'];?> </a>
											<?php if(!empty($sub_category)) { ?>
											<ul class="sub_menu">
											<?php foreach($sub_category as $solo_subcate) { 
													$subcatename = strtolower($solo_subcate['sub_urlname']);
													$subcatename = str_replace(' ','-',$subcatename);
													$subcatename = preg_replace('!-+!', '-', $subcatename);	
												?>
												<li><a href="<?php echo $basepath;?>home/products/<?php echo $subcatename;?>/<?php echo $solo_subcate['sub_id'];?>"><?php echo $solo_subcate['sub_name'];?>  </a></li>
												<?php } ?>
											</ul>
											<?php } ?>
										</li>
							     <?php } ?>			
									</ul>
									<?php } ?>
								</li>
							</ul>
							<ul>
							<?php if( !isset($this->session->userdata['ts_uid']) ) { ?>
								<li><a href="<?php echo $basepath;?>authenticate/register">Sign up</a></li>
								<li><a href="<?php echo $basepath;?>authenticate/login">Login</a></li>
						   <?php }else{ ?>
                          <li><a onclick="open_create_post()">Update Post</a></li>						   
						   <li><a href="<?php echo $basepath;?>news-feeds">News Feeds</a></li>	
								<li class="lk_dropdown"><a href="javascript:">Hi, <?php echo $this->session->userdata['ts_uname']; ?></a>
									<ul class="sub_menu">
									<li><a href="<?php echo base_url().'dashboard/my_collections' ?>">MY Account</a></li>
									<li><a href="<?php echo base_url().'home/logout' ?>">Logout</a></li>
									</ul>
								</li>
							<?php } ?>	
							</ul>
						</div>
						<div class="lk_search">
							<div class="icon"><svg version="1.1" x="0px" y="0px" width="12.984px" height="12.985px" viewBox="0 0 12.984 12.985" enable-background="new 0 0 12.984 12.985" xml:space="preserve"><path fill="#FFFFFF" d="M12.666,11.131l-2.821-2.82C9.83,8.295,9.813,8.286,9.797,8.272c0.555-0.842,0.879-1.85,0.879-2.934C10.676,2.39,8.286,0,5.338,0S0,2.39,0,5.338s2.39,5.338,5.338,5.338c1.084,0,2.092-0.324,2.934-0.879c0.014,0.016,0.024,0.033,0.039,0.048l2.82,2.821c0.424,0.424,1.111,0.424,1.535,0S13.09,11.555,12.666,11.131z M5.338,8.825c-1.926,0-3.488-1.561-3.488-3.487s1.563-3.487,3.488-3.487s3.487,1.561,3.487,3.487S7.264,8.825,5.338,8.825z"/></svg></div>
							<div class="lk_search_box">
								<input id="lk_input_search" type="text" placeholder="Type here to search" />
							</div>
							<!--search autocomplete start-->
							<div class="lk_autocomp_box">
								
							</div>
							<!--search autocomplete end-->
						</div>
						<div class="lk_notification">
							<div class="icon"><svg version="1.1" x="0px" y="0px" width="13.001px" height="17px" viewBox="0 0 13.001 17" enable-background="new 0 0 13.001 17" xml:space="preserve"><g><g><path fill="#FFFFFF" d="M11.472,11.199V6.8c0-2.48-1.606-4.48-3.824-5.04V1.2c0-0.64-0.535-1.2-1.146-1.2C5.889,0,5.354,0.56,5.354,1.2v0.56C3.136,2.319,1.53,4.319,1.53,6.8v4.399L0,12.8L0.001,14h13v-1.2L11.472,11.199z M8.89,15.016H5.02C5.02,16.325,5.702,17,6.954,17h0.455c0.797-0.119,1.366-0.715,1.594-1.43C9.116,15.332,8.842,15.568,8.89,15.016z"/></g></g></svg> <span class="count">2</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--header end-->

<?php $vendorpage = 1;?>
<input type="hidden" id="vendorpage" value="1">


<div class="add_post_popup">
<div class="lk_custompopup_wrapper">
	<div class="lk_popupdiv">
		<a href="" class="lk_closebtn">X</a>
		<h2>Create  Post</h2>
		<div class="lk_newcollection_div">
			<form class="lk_collectionform" id="post_form" method="post" action="<?php echo base_url().'dashboard/update_post' ?>" enctype="multipart/form-data">
				<div class="form-group">
					<textarea class="form-control" id="post_content" name="post_content" row="7" placeholder="Whats in your mind"></textarea>
				</div>
				<div class="form-group">
					<div class="lk_upload_file">
						<span id="upload_text">upload</span>
						<input type="file" name="post_image" id="post_image" class="custom_imagage">
						<input type="hidden" name="post_id" value="0">
					</div>
				</div>
				<div class="lk_btndiv">
					<button class="lk_btn" type="submit" onclick="return check_post_validate()">Create</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>



<!-- Header / Menu Start -->
<div class="ts_header">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
				<div class="ts_logo">
					<a href="<?php echo $basepath;?>"><img src="<?php echo $this->ts_functions->getsettings('logo','url');?>"  class="img-responsive" alt="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>" title="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>"> </a>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-8 col-lg-push-7 col-md-push-7 col-sm-push-7 col-xs-push-0">
				<div class="row">
					<div class="ts_right_menu">
						<ul>
						<?php
							$cartArr = isset($_COOKIE['cartCookies']) ? json_decode($_COOKIE['cartCookies'],true) : array() ;
						?>
							
							<?php if(isset($this->session->userdata['ts_uname'])) { ?>
								<li><a href="<?php echo $basepath;?>authenticate/login">
								<?php if($this->session->userdata['ts_level'] == 3) { ?>
								<i class="fa fa-users" aria-hidden="true" id="vendor_icon"></i>
								<?php } else { ?>
								<i class="fa fa-user-secret" aria-hidden="true"></i>
								<?php } ?> Hi, <?php echo $this->session->userdata['ts_uname']; ?> </a></li>
								<li><a href="<?php echo $basepath;?>home/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $this->ts_functions->getlanguage('logouttext','commontext','solo'); ?> </a></li>
							<?php } else { ?>
								<li><a href="<?php echo $basepath;?>authenticate/register"><i class="fa fa-user-plus" aria-hidden="true"></i>  <?php echo $this->ts_functions->getlanguage('signuptext','commontext','solo'); ?> </a></li>
								<li><a href="<?php echo $basepath;?>authenticate/login"><i class="fa fa-user" aria-hidden="true"></i>  <?php echo $this->ts_functions->getlanguage('logintext','commontext','solo'); ?> </a></li>
							<?php } ?>
						</ul>
						<button class="ts_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 col-lg-pull-2 col-md-pull-2 col-sm-pull-2 col-xs-pull-0">
				<div class="ts_main_menu_wrapper">
				<div class="ts_main_menu">
					<ul class="mail_asd">
                <?php
                    $urlpath = $_SERVER['REQUEST_URI'];
				    $urlpath_arr = explode('aboutus',$urlpath);
				    $urlpath_arr1 = explode('dashboard',$urlpath);
				    $urlpath_arr2 = explode('products',$urlpath);
				    $urlpath_arr3 = explode('plans_pricing',$urlpath);
				    $urlpath_arr4 = explode('contact',$urlpath);
                ?>

					
						<li <?php if(count($urlpath_arr) != 2 && count($urlpath_arr1) != 2 && count($urlpath_arr2) != 2 && count($urlpath_arr3) != 2 && count($urlpath_arr4) != 2) { ?>class="active" <?php } ?>><a href="<?php echo $basepath;?>"> How it Works </a></li>
						<li <?php if(count($urlpath_arr) == 2) { ?>class="active" <?php } ?> ><a href="<?php echo $basepath;?>home/aboutus"> Start Selling </a></li>
						<li <?php if(count($urlpath_arr1) == 2 || count($urlpath_arr2) == 2) { ?>class="active" <?php } ?> ><a class="first_sb"> Categories <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				<?php 
				$cate_list = $this->DatabaseModel->access_database('ts_categories','select','',array('cate_status'=>1));
				if(!empty($cate_list)) { ?>
						<ul class="sub_menu">
				<?php foreach($cate_list as $solo_cate) { 
					$catename = strtolower($solo_cate['cate_urlname']);
					$catename = str_replace(' ','-',$catename);
					$catename = preg_replace('!-+!', '-', $catename);	
				?>
							
							 <li><a href="<?php echo $basepath;?>home/products/<?php echo $catename;?>" class="second_sb"> <?php echo $solo_cate['cate_name'];?> </a>
							</li>
							
						<?php } ?>
							</ul>
				<?php } ?>
                        </li>
                    
					</ul>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
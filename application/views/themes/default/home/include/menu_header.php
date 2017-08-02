<!--main wrapper start-->
<div class="lk_main_wrapper">
	<!--header start-->
	<div class="lk_header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="lk_logo">
						<a href="<?php echo $basepath; ?>"><img src="<?php echo $this->ts_functions->getsettings('logo','url');?>" alt="" /></a>
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






	<!-- Modal Start -->
<div class="modal fade ts_tnc_popup" id="tnc_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title"><?php echo $this->ts_functions->getlanguage('becvendortext','menus','solo'); ?> </h4>
			</div>
			<div class="modal-body">
				<div class="ts_tnc_section">
				<?php $tnc = $this->ts_functions->getsettings('vendor','tnctext');
				    $tncArr = explode(PHP_EOL, $tnc);
				    for($i=0;$i<count($tncArr);$i++) {
                         echo '<p>'.$tncArr[$i].'</p>';
                    }
				?>
				</div>
				<div class="ts_checkbox">
					<input type="checkbox" id="tnc">
					<label for="tnc"><?php echo $this->ts_functions->getlanguage('vendorpopupcheck','userdashboard','solo'); ?></label>
				</div>
			</div>
			<div class="modal-footer">
			    <?php
			        $vendor_type = $this->ts_functions->getsettings('vendor','revenuemodel') == 'commission' ? 'commission' : 'plans' ;
			    ?>
				<button type="button" class="ts_btn" onclick='become_a_vendor("<?php echo $vendor_type;?>")'><?php echo $this->ts_functions->getlanguage('submittext','authentication','solo'); ?></button>
				<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('vendorpopupcheckerror','userdashboard','solo'); ?>" id="checkpop_error">
			</div>
		</div>
  </div>
</div>
<!-- Modal End -->


<!-- Collection Modal Start -->
<?php if( isset($this->session->userdata['ts_uid']) ) { ?>
<div class="modal fade lk_popupmodel" id="tnc_collection_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
			<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add to collection </h4>
			</div>
			<div class="modal-body">
				<form class="lk_formdiv">
					<div class="form-group">
						<label for="collection_id">Select Collection:</label>
					  <select class="form-control" id="collection_id">
					  <?php  
                       $collection=$this->my_model->select_data('col_id,col_name','ts_collections',array('col_type!='=>1));
                       if(!empty($collection)){
                       	foreach ($collection as $single_collection) {
                       echo	'<option value="'.$single_collection['col_id'].'">'.$single_collection['col_name'] .'</option>';	
                       	}
                       }else{
                       	echo '<option value="0">No Collection</option>';
                       }
					  ?>
					  </select>
					  <input type="hidden" id="add_collection_prod_id" value="">
					</div>
						<button type ="button" class="lk_btn" onclick="addtocollection();">Add</button>	
					</form>
				</div>			
		</div>
  </div>
</div>
<?php } ?>
<!-- Collection Modal End -->


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
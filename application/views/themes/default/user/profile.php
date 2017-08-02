<div class="lk_collection_single_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_user_profile_img">
				<?php
                    $imgsrc=base_url().'webimage/dummy_testi.jpg';
                    if( $userDetail[0]['user_pic'] != '') {
					 $imgsrc=base_url().'webimage/'.$userDetail[0]['user_pic'];
				}  ?>
					<img src="<?php echo $imgsrc;?>" class="img-responsive" alt="">
					<h3><?php echo $userDetail[0]['user_uname'];?></h3>
					<?php
				if(isset($updatemsg)) { ?>
				    <p style="text-align: center;color: #66BB6A;font-weight: bold;"><?php echo $updatemsg; ?></p>
				<?php }
				    if(isset($errormsg)) {
				?>
				    <p style="text-align: center;color: #F44336;font-weight: bold;"><?php echo $errormsg; ?></p>
				<?php } ?>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_tabcontainer">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-4 colx-s-12 lk_tabmenu">
							<div class="lk_list_group">
								 <ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#basic_information" aria-controls="basic_information" role="tab" data-toggle="tab">Basic Information</a></li>
									<li role="presentation"><a href="#private_information" aria-controls="private_information" role="tab" data-toggle="tab">Private Information</a></li>
									<li role="presentation"><a href="#social_networks" aria-controls="social_networks" role="tab" data-toggle="tab">Social Networks</a></li>
									<li role="presentation"><a href="#change_password" aria-controls="change_password" role="tab" data-toggle="tab">Change Password</a></li>
								  </ul>
							</div>
						</div>
						<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 lk_tab">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="basic_information">
									<div class="lk_basic_information_form">
										<form method="post" action="" class="ts_inner_info_box" enctype="multipart/form-data">
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label><?php echo $this->ts_functions->getlanguage('usernametext','userdashboard','solo');?></label>
														<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('usernametext','userdashboard','solo');?>" readonly="readonly" value="<?php echo $userDetail[0]['user_uname'];?>">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label><?php echo $this->ts_functions->getlanguage('emailtext','userdashboard','solo');?></label>
														<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('emailtext','userdashboard','solo');?>" readonly="readonly" value="<?php echo $userDetail[0]['user_email'];?>">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label><?php echo $this->ts_functions->getlanguage('fnametext','userdashboard','solo');?></label>
														<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('fnametext','userdashboard','solo');?>" name="fname" value="<?php echo $userDetail[0]['user_fname'];?>">
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<div class="form-group">
														<label><?php echo $this->ts_functions->getlanguage('lnametext','userdashboard','solo');?></label>
														<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('lnametext','userdashboard','solo');?>" name="lname" value="<?php echo $userDetail[0]['user_lname'];?>">
													</div>
												</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<label>Status</label>
														<textarea class="form-control"  name="text_status" rows="5"><?php echo $userDetail[0]['user_text_status'];?></textarea>
													</div>
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="form-group">
														<input type="file" name="userfile" class="form-control">
														<label style="color: #9c9c9c;text-transform:none;font-weight: 400;">Profile Pic (70 x 70 image will be good )</label>
													</div>
												</div>
							
							<?php if( $userDetail[0]['user_pic'] != '' ) { ?>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<img src="<?php echo $basepath;?>webimage/<?php echo $userDetail[0]['user_pic'];?>" style="width: 70px;height: 70px;border-radius: 100%;"/>
								</div>
							</div>
							<?php } ?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="lk_formbtn">
									
									<button type="submit" name="basic_btn" class="lk_btn"><?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?></button>
								</div>
							</div>
							</div>
						</form>
					</div>
				</div> <!-- Basic information end -->

					<div role="tabpanel" class="tab-pane" id="private_information">
					<div class="lk_basic_information_form">
					 <form method="post" action="" class="ts_inner_info_box">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
								<label><?php echo $this->ts_functions->getlanguage('mobiletext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('mobiletext','userdashboard','solo');?>" name="mobile" value="<?php echo $userDetail[0]['user_mobile'];?>">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
								<label><?php echo $this->ts_functions->getlanguage('addtext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('addtext','userdashboard','solo');?>" name="address" value="<?php echo $userDetail[0]['user_address'];?>">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
								<label><?php echo $this->ts_functions->getlanguage('countrytext','userdashboard','solo');?></label>
									<?php if(!empty($countryDetails)) {
									    $selected = ( $userDetail[0]['user_country'] == '0' ) ? 'selected' : '' ;
									echo '<select name="country" class="form-control">';
									echo '<option value="0" '.$selected.'>'.$this->ts_functions->getlanguage('countrytext','userdashboard','solo').'</option>';
									    foreach($countryDetails as $soloCountry) {

									    $selected = ( $soloCountry['countryId'] == $userDetail[0]['user_country'] ) ? 'selected' : '' ;

									    echo '<option value="'.$soloCountry['countryId'].'" '.$selected.'>'.$soloCountry['countryName'].'</option>';

									} echo "</select>"; } ?>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
								<label><?php echo $this->ts_functions->getlanguage('statetext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('statetext','userdashboard','solo');?>" name="state" value="<?php echo $userDetail[0]['user_state'];?>">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
								<label><?php echo $this->ts_functions->getlanguage('citytext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('citytext','userdashboard','solo');?>" name="city" value="<?php echo $userDetail[0]['user_city'];?>">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
								<label><?php echo $this->ts_functions->getlanguage('zipcodetext','userdashboard','solo');?></label>
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('zipcodetext','userdashboard','solo');?>" name="zip" value="<?php echo $userDetail[0]['user_zip'];?>">
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="lk_formbtn">
								<input type="submit" name="billing_btn" class="lk_btn" value="<?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?>" />
							</div>	
							</div>
						</div>
		             </form>
				   </div>
				</div> <!-- Billing Information End-->

				<div role="tabpanel" class="tab-pane" id="social_networks">
				  <div class="lk_basic_information_form">
					<form method="post">
						<div class="row">
						<?php
						$social_detail=json_decode($userDetail[0]['user_social'],true);
						 ?>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Facebook</label>
									<input type="text" name="facebook" class="form-control" placeholder="Facebook" value="<?php if(isset($social_detail[0]['facebook'])) echo $social_detail[0]['facebook']; ?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Twitter</label>
									<input type="text" name="twitter" class="form-control" placeholder="Twitter" value="<?php if(isset($social_detail[1]['twitter'])) echo $social_detail[1]['twitter']; ?>">
								</div>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="lk_formbtn">
									<input type="submit" name="social_btn" class="lk_btn" value="<?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?>" />
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>


				<div role="tabpanel" class="tab-pane" id="change_password">
                 <div class="lk_basic_information_form">
					 <form method="post" action="" class="ts_inner_info_box">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
								<label><?php echo $this->ts_functions->getlanguage('passwordtext','userdashboard','solo');?></label>
									<input type="password" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('passwordtext','userdashboard','solo');?>" name="pwd">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
								<label><?php echo $this->ts_functions->getlanguage('resetpwdtext','userdashboard','solo');?></label>
									<input type="password" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('resetpwdtext','userdashboard','solo');?>" name="repwd">
								</div>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="lk_formbtn">
								<input type="submit" name="chngpwd_btn" class="lk_btn" value="<?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?>" />
							</div>	
							</div>
						</div>
		             </form>
				   </div>

				</div>
			  </div>
		  </div>
	   </div>
     </div>
   </div>
 </div>
</div>
</div>
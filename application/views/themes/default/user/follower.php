


<div class="lk_collection_single_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
                <div class="lk_main_tab lk_anim anim_top" style="visibility: visible; animation-name: anim_top;">
                    <ul>
                        <li><a class="<?php if(isset($follower_active)) echo 'active'; ?>" href="<?php echo base_url().'follower/'.$userDetail[0]['user_id'].'/'.$userDetail[0]['user_uname']; ?>">Followers</a></li>
                        <li><a class="<?php if(isset($following_active)) echo 'active'; ?>" href="<?php echo base_url().'following/'.$userDetail[0]['user_id'].'/'.$userDetail[0]['user_uname']; ?>">Followings</a></li>
                    </ul>
                </div>
            </div>
        
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_follower_div">
					<?php if(!empty($fol_users)){ ?>
					<div class="row">
					<?php foreach ($fol_users as $single_user) {
					$imgsrc=base_url().'webimage/dummy_testi.jpg';
                    if( $single_user['user_pic'] != '') {
					 $imgsrc=base_url().'webimage/'.$single_user['user_pic'];
					}
					 $author_url=base_url().'timeline/'.$single_user['user_uname'].'/'.$single_user['user_id'];
					 ?>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="lk_followdiv">
								<span>
									<a href="<?php echo $author_url; ?>"><img src="<?php echo $imgsrc; ?>" class="img-responsive" alt=""></a>
								</span>
		
								<a href="<?php echo $author_url; ?>"><h3><?php echo $single_user['user_uname']; ?></h3></a>
								<a href="javascript:" class="lk_btn"><?php if(isset($follower_active)) echo 'Follow'; ?> <?php if(isset($following_active)) echo 'Following'; ?></a>
							</div>
						</div>
					<?php } ?>	
						
					</div>
                 <?php } ?>
				</div>
			</div>
		 
        </div>  
   </div>
  </div>


<div class="lk_collection_single_wrapper">
    <div class="container">
        <div class="row hide">
            <div class="col-md-12">
                <div class="lk_main_tab lk_anim anim_top">
                    <ul>
                        <li><a href="<?php echo $basepath.'collections/'.$userDetail[0]['user_uname'].'/'.$userDetail[0]['user_id']; ?>">Collection</a></li>
                        <li><a  class="<?php if(isset($timeline_active)) echo 'active' ?>" href="<?php echo $basepath.'timeline/'.$userDetail[0]['user_uname'].'/'.$userDetail[0]['user_id']; ?>">Timeline</a></li>
                    </ul>
                </div>
            </div>
        </div>


<?php if(!empty($timeline_posts)): ?>

        <!--  Time line row start  -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<ul class="grid effect-3" id="grid">
				<?php foreach($timeline_posts as $single_post): ?>
				<li>
					<div class="lk_timelinediv">
						<div class="lk_postedby">
							
							<?php echo $this->ts_functions->getVendorImage($single_post['post_uid']);?>
							<div class="lk_post_detail">
								<h5><span><?php echo $this->ts_functions->getVendorName($single_post['post_uid']);?></span>
                                 <?php if($single_post['post_type']=='post'){
                                 	echo "Update a Post";
                                 }if($single_post['post_type']=='share'){
                                 	echo "share a ".$single_post['post_share_type'];
                                 }
                                
                                  ?> </h5>
								<p><?php echo $this->ts_functions->time_elapsed_string($single_post['post_date'], false);?></p>
							</div>
						</div>

						<?php if ($single_post['post_type']=='post'){ ?>
						<?php
                            /*  $post_id=$single_post['post_id'];
							  $url=base_url('singlepostplateform/permalink/'.$post_id);*/
						?>
						<?php if($single_post['post_content']!=''){ ?>
	                         <div class="lk_postdata_div "> <p><?php echo $single_post['post_content']; ?>.</p>
								<div class="lk_post_img_overlay">
								<?php if($single_post['post_image']==''){ ?>
									<span ><a  onclick="likes(this)" data-post="<?php echo $single_post['post_id'];?>" class="<?php echo $this->ts_functions->checked_like($single_post['post_id']); ?>" ><i class="fa fa-heart-o"></i> <span id="like_count"><?php echo $single_post['post_like']; ?></span> Like</a></span>
									<span><a href="<?php echo base_url().'singlepostplateform/permalink/'.$single_post['post_id'];?>" ><i class="fa fa-comment-o"></i><?php echo $single_post['post_comment']; ?>  comments</a></span>
									<span><a href="<?php echo base_url().'singlepostplateform/permalink/'.$single_post['post_id'];?>"><i class="fa fa-eye"></i> <?php echo $single_post['post_view']; ?> views</a></span>
							     <?php } ?>		
								</div>
							</div>
							<?php } ?>
							<?php if($single_post['post_image']!=''){ ?>
							<div class="lk_post_img">
									<img src="<?php echo base_url().'repo/postimage/'.$single_post['post_image'];?>" class="img-responsive" alt="">
									<div class="lk_post_img_overlay">
										<span ><a  onclick="likes(this)" data-post="<?php echo $single_post['post_id'];?>" class="<?php echo $this->ts_functions->checked_like($single_post['post_id']); ?>" ><i class="fa fa-heart-o"></i> <span id="like_count"><?php echo $single_post['post_like']; ?></span> Like</a></span>
										<span><a href="<?php echo base_url().'singlepostplateform/permalink/'.$single_post['post_id'];?>"  ><i class="fa fa-comment-o"></i><?php echo $single_post['post_comment']; ?>  comments</a></span>
										<span><a href="<?php echo base_url().'singlepostplateform/permalink/'.$single_post['post_id'];?>"><i class="fa fa-eye"></i> <?php echo $single_post['post_view']; ?> views</a></span>
									</div>
							</div>
							<?php } ?>
							

						<?php } else if ($single_post['post_type']=='share') {

                                if($single_post['post_share_type']=='book'){
                               $productdetails= $this->my_model->select_data('*' , 'ts_products' ,array('prod_id'=>$single_post['post_share_id']) ,1,'','','');
                                if(!empty($productdetails)){
                                  $dis_img=$this->ts_functions->getProductPic($productdetails[0]['prod_id']);
                               ?>
                                <div class="lk_post_img">
								<img src="<?php echo $dis_img;?>" class="img-responsive" alt="">
								<div class="lk_post_img_overlay">
									<span ><a  onclick="likes(this)" data-post="<?php echo $single_post['post_id'];?>" class="<?php echo $this->ts_functions->checked_like($single_post['post_id']); ?>" ><i class="fa fa-heart-o"></i> <span id="like_count"><?php echo $single_post['post_like']; ?></span> Like</a></span>
								<span><a href="<?php echo base_url().'singlepostplateform/permalink/'.$single_post['post_id'];?>"><i class="fa fa-comment-o"></i><?php echo $single_post['post_comment']; ?>  comments</a></span>
								<span><a href="<?php echo base_url().'singlepostplateform/permalink/'.$single_post['post_id'];?>"><i class="fa fa-eye"></i> <?php echo $single_post['post_view']; ?> views</a></span>
								</div>
								<div class="play_action">
									<a href="<?php echo base_url().'singlepostplateform/permalink/'.$single_post['post_id'];?>">
										<div class="lk_audio_control play">
												<span class="left"></span>
												<span class="right"></span>
										</div>
									</a>
								</div>
							</div>
                            <?php } ?> 

                           <?php  }else if($single_post['post_share_type']=='collection') {?>
                               
                            <?php 
                             $join_arr = array('ts_products','ts_products.prod_id = ts_collection_data.col_data_prod');
                 
                            $collection_data=$this->my_model->select_data('col_data_prod,prod_image,prod_name','ts_collection_data',array('col_data_col'=>$single_post['post_share_id']),4,'','',$join_arr);
		                      	if(!empty($collection_data)){
		                      $count_collection_data=count($collection_data);
                               $total_col_prod=$this->my_model->aggregate_data('ts_collection_data','col_data_id','count', array('col_data_col'=>$single_post['post_share_id']));
                               $remaining=$total_col_prod-$count_collection_data;
		                       ?>
	                            <div class="lk_post_img lk_collection_img">
	                            <?php
                                  $incr=0;
	                             foreach($collection_data as $single_collection){
                                  $incr++;
                                  $image_a = explode('.',$single_collection['prod_image']);
				                  $dis_img = 'small/'.$image_a[0].'_thumb.'.$image_a[1];
                                  
                                  ?>
								<div class="lk_post_smallimg">
									<img src="<?php echo $basepath;?>repo/images/<?php echo $dis_img;?>" class="img-responsive" alt="">
									<?php if($incr>3 && $remaining>0){ 
                                          
                                        echo '<div class="lk_morecollection_overlay">
												<a href="">'.$remaining.'<br> more</a>
											</div>';
                                        }   ?>
								</div>
                                
                               
							    <?php } ?>
								
								<div class="lk_post_img_overlay">
									<span ><a  onclick="likes(this)" data-post="<?php echo $single_post['post_id'];?>" class="<?php echo $this->ts_functions->checked_like($single_post['post_id']); ?>" ><i class="fa fa-heart-o"></i> <span id="like_count"><?php echo $single_post['post_like']; ?></span> Like</a></span>
									<span><a href="<?php echo base_url().'singlepostplateform/permalink/'.$single_post['post_id'];?>"><i class="fa fa-comment-o"></i><?php echo $single_post['post_comment']; ?>  comments</a></span>
									<span><a href="<?php echo base_url().'singlepostplateform/permalink/'.$single_post['post_id'];?>"><i class="fa fa-eye"></i> <?php echo $single_post['post_view']; ?> views</a></span>
								</div>
							</div>
	                <?php  } }

						} ?>
                         

                      <?php if($single_post['post_comment']>0){
                      	$comments_data=$this->my_model->select_data('com_content,com_uid','ts_comments',array('com_post'=>$single_post['post_id']),2);
                      	if(!empty($comments_data)){
                       ?>
						<div class="lk_comment">
					       <?php foreach ($comments_data as $single_comment) { ?>
							<div class="lk_comment_innerdiv">
								<?php echo $this->ts_functions->getVendorImage($single_comment['com_uid']);?>
								<div class="lk_commentdata">
									<h3><?php echo $this->ts_functions->getVendorName($single_post['post_uid']);?></h3> 
									<p><?php echo $single_comment['com_content']?></p>
								</div>
							</div>
							<?php } ?>
							
						</div>
					<?php } }?>
					</div>
				</li>
			<?php endforeach; ?>
			<?php if(isset($may_follow)){ ?>
			<?php if(!empty($may_follow)){?>
			<li>
			
					<div class="lk_people_know">
						<h3>People You May know</h3>
                 <?php foreach($may_follow as $single_follow){?>
						<div class="lk_people_img">
							 <?php
		                 $author_name=  $this->ts_functions->getVendorName($single_follow['user_id']);  
		             	$author_url=base_url().'timeline/'.$author_name.'/'.$single_follow['user_id'];
		                echo '<a href="'.$author_url.'">'. $this->ts_functions->getVendorImage($single_follow['user_id']).'</a>'; 
                            	?>
							<div class="lk_overlay">
								<a href="<?php echo $author_url; ?>">follow</a>
							</div>
						</div>
				<?php } ?>

					</div>
				</li>
				<?php }} ?>
				
				</ul>

			</div>
		</div>
<?php endif; ?>

            <!-- Timeline row end --> 

	</div>
</div>
<div class="lk_post_single_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
               <?php if($single_post['post_type']=='post'){?>
				<div class="lk_singlepost_img">
				<?php if($single_post['post_content']!=''){ ?>
					<p><?php echo $single_post['post_content']; ?>.</p>
				<?php } ?>
				<?php if($single_post['post_image']!=''){ ?>	
					<img src="<?php echo base_url().'repo/postimage/'.$single_post['post_image'];?>" class="img-responsive" alt="">
					<?php } ?>
					<div class="lk_post_img_overlay">
						<span ><a  onclick="likes(this)" data-post="<?php echo $single_post['post_id'];?>" class="<?php echo $this->ts_functions->checked_like($single_post['post_id']); ?>" ><i class="fa fa-heart-o"></i> <span id="like_count"><?php echo $single_post['post_like']; ?></span> Like</a></span>
						<span><a href=""><i class="fa fa-comment-o"></i><?php echo $single_post['post_comment']; ?>  comments</a></span>
						<span><a href=""><i class="fa fa-eye"></i> <?php echo $single_post['post_view']; ?> views</a></span>
					</div>
				</div>
				<?php } else if ($single_post['post_type']=='share') {?>
                   <?php if($single_post['post_share_type']=='book'){
                   $book_detail=$this->my_model->select_data('prod_uniqid,prod_name','ts_products',array('prod_id'=>$single_post['post_share_id']));
                    if(!empty($book_detail)){
                    	$prodName = $this->ts_functions->getProductName($single_post['post_share_id']);
                   	?>

                     <div class="lk_singlepost_img">
                     <?php   $dis_img=$this->ts_functions->getProductPic($single_post['post_share_id'],'big'); ?>
						<a  href="<?php echo base_url().'item/'.$prodName.$book_detail[0]['prod_uniqid']; ?>"><img src="<?php echo $dis_img;?>" class="img-responsive" alt=""></a>
						<div class="lk_post_img_overlay">
							<span ><a  onclick="likes(this)" data-post="<?php echo $single_post['post_id'];?>" class="<?php echo $this->ts_functions->checked_like($single_post['post_id']); ?>" ><i class="fa fa-heart-o"></i> <span id="like_count"><?php echo $single_post['post_like']; ?></span> Like</a></span>
						<span><a href=""><i class="fa fa-comment-o"></i><?php echo $single_post['post_comment']; ?>  comments</a></span>
						<span><a href=""><i class="fa fa-eye"></i> <?php echo $single_post['post_view']; ?> views</a></span>
						</div>
					</div>
					<?php } ?>
                     <?php  }else if($single_post['post_share_type']=='collection') {?>
                       <?php 
                           $collection_detail=$this->my_model->select_data('col_name,col_id','ts_collections',array('col_id'=>$single_post['post_share_id']));

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
				                 
				                $dis_img=  $this->ts_functions->getProductPic($single_collection['col_data_prod']);
                                  
                                  ?>
								<div class="lk_post_smallimg">
									<img src="<?php echo $dis_img;?>" class="img-responsive" alt="">
									<?php if($incr>3 && $remaining>0){  
                                        echo '<div class="lk_morecollection_overlay">
												<a href="">'.$remaining.'<br> more</a>
											</div>';
                                        }   ?>
								</div>
                                
                               
							    <?php } ?>
								
								<div class="lk_post_img_overlay">
									<span ><a  onclick="likes(this)" data-post="<?php echo $single_post['post_id'];?>" class="<?php echo $this->ts_functions->checked_like($single_post['post_id']); ?>" ><i class="fa fa-heart-o"></i> <span id="like_count"><?php echo $single_post['post_like']; ?></span> Like</a></span>
									<span><a href=""><i class="fa fa-comment-o"></i><?php echo $single_post['post_comment']; ?>  comments</a></span>
									<span><a href=""><i class="fa fa-eye"></i> <?php echo $single_post['post_view']; ?> views</a></span>
								</div>
							</div>
	                <?php  } }?>    
			   <?php } ?>		
                
			</div>
			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"> 
				<div class="lk_singlepost_data">
				<?php
                        $post_url='javascript:';
                        if(isset($book_detail)){
                        $post_url=base_url().'item/'.$prodName.$book_detail[0]['prod_uniqid'];
                        }else if(isset($collection_detail)){	
                        $post_url=base_url().'collection/'.$this->ts_functions->getUrlName($collection_detail[0]['col_name']).$collection_detail[0]['col_id'];

                        }
						 ?>
				
					<div class="lk_postedby">
		               <?php
		               $author_name=  $this->ts_functions->getVendorName($single_post['post_uid']);  
		               	$author_url=base_url().'timeline/'.$author_name.'/'.$single_post['post_uid'];
		                echo '<a href="'.$author_url.'">'. $this->ts_functions->getVendorImage($single_post['post_uid']).'</a>'; 
                            	?>
						<div class="lk_post_detail">
							<a href="<?php echo $author_url; ?>"><h5><span><?php echo $author_name;?></span></a>

							<a href="<?php echo  $post_url; ?>"> <?php if ($single_post['post_type']=='post') echo 'Update a Post';  ?> <?php if ($single_post['post_type']=='share') echo 'share a '.$single_post['post_share_type'];  ?> </h5></a>
							<p><?php echo $this->ts_functions->time_elapsed_string($single_post['post_date'], false);?></p>
						</div>
						
					</div>
					
					<div class="lk_comment">
					<?php if(!empty($comments_data)){ ?>
					 <?php foreach ($comments_data as $single_comment) { ?>
					    <div class="lk_comment_innerdiv">
							<?php echo $this->ts_functions->getVendorImage($single_comment['com_uid']);?>
                        	<div class="lk_commentdata">
								<h3><?php echo $this->ts_functions->getVendorName($single_comment['com_uid']);?></h3> 
								<p><?php echo $single_comment['com_content']?></p>
								<span><?php echo $this->ts_functions->time_elapsed_string($single_comment['com_date'], false);?></span>
							</div>
						</div>
					<?php } ?>	
					<?php } ?>
					</div>
					<?php if(!empty($comments_data)){ ?>
					<div class="lk_loadmore ">No more comment</div>
					<?php } ?>

					<?php if( isset($this->session->userdata['ts_uid']) ) { ?>
					<div class="lk_newsletterform">
						<form class="form-inline">
							<div class="form-group">
								<textarea class="form-control" placeholder="Write A Comment" id="com_content" rows="2"></textarea>
								<input type="hidden" id="com_post" value="<?php  echo $single_post['post_id'];   ?>">
							</div>
							<button class="lk_newsletterbtn"  id="add_comment" ><i class="fa fa-paper-plane"></i></button>
						</form>
					</div>
					<?php } ?>

				</div>
			</div>
		</div> 
	</div>
</div>
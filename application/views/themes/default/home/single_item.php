<div class="lk_product_single_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
				<div class="lk_product_single_img lk_anim anim_top">
					<div class="lk_imgdiv">
					
						<img src="<?php echo $basepath;?>repo/images/<?php echo $productdetails[0]['prod_image'];?>" class="img-responsive" alt="<?php echo $productdetails[0]['prod_name'];?>">
						<div class="lk_img_content">
							<a class="add_action" data-value="<?php echo $productdetails[0]['prod_id']; ?>">
                                <svg version="1.1" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 12.01 11.996" enable-background="new 0 0 12.01 11.996" xml:space="preserve"><path fill="#ffffff" d="M11.358,5.161H6.843v-4.51C6.843,0.446,6.564,0,6.005,0S5.167,0.446,5.167,0.651v4.51H0.652C0.446,5.161,0,5.44,0,5.998c0,0.559,0.446,0.838,0.652,0.838h4.516v4.51c0,0.205,0.279,0.65,0.838,0.65s0.838-0.445,0.838-0.65v-4.51h4.515c0.206,0,0.652-0.279,0.652-0.838C12.01,5.44,11.564,5.161,11.358,5.161z"></path></svg>
                                <span></span>
                            </a>
                          <?php
                          if( $productdetails[0]['prod_type'] == 'Audio' ) {
				        	$prod_gallery = $this->DatabaseModel->access_database('ts_prodgallery','select', '' , array('prodgallery_pid'=>$productdetails[0]['prod_id']) );
						        }
						        else {
						        	$prod_gallery = '';
						        }
			        
                           ?>
                           <?php  if( $productdetails[0]['prod_type'] == 'Audio' ) { 
	                           $prod_gallery = $this->DatabaseModel->access_database('ts_prodgallery','select', '' , array('prodgallery_pid'=>$productdetails[0]['prod_id']) );
							    if(!empty($prod_gallery)) { 
											$audio_str = '';
											foreach($prod_gallery as $solo_prod_gallery) { 
												$audio_str .= $solo_prod_gallery['prodgallery_img'].',';
											}
											$audio_str = rtrim($audio_str,',');    
							    ?>
	                            <a class="play_action" onclick="play_music('<?php echo base_url().'repo/gallery/p_'.$productdetails[0]['prod_id'].'/'; ?>',this,'single')" data-audio="<?php echo $audio_str;?>" >
	                                <div class="lk_audio_control play">
	                                    <span class="left"></span><span class="right"></span>
	                                </div>
	                            </a>
	                            <?php } ?>


                            <?php } else { ?>   /<!-- product type ebook  -->
                            <a href="" class="download_action">
                                <svg version="1.1" x="0px" y="0px" width="49.999px" height="40px" viewBox="0 0 49.999 40" enable-background="new 0 0 49.999 40" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M39.076,30.341h-7.748v-4.433h7.749c3.649,0,6.618-3.058,6.618-6.816c0-3.759-2.969-6.816-6.618-6.816c-0.218,0-0.44,0.011-0.665,0.034c-0.898,0.095-1.758-0.404-2.15-1.241c-1.118-2.382-3.4-3.861-5.955-3.861c-0.455,0-0.912,0.048-1.358,0.144c-0.701,0.15-1.429-0.068-1.941-0.583c-1.5-1.507-3.475-2.337-5.562-2.337c-3.653,0-6.826,2.552-7.716,6.204c-0.255,1.051-1.208,1.753-2.259,1.67c-0.181-0.016-0.362-0.03-0.546-0.03c-3.65,0-6.619,3.057-6.619,6.816c0,3.759,2.969,6.816,6.619,6.816h7.75v4.432h-7.75C4.9,30.34,0,25.295,0,19.092C0,13.417,4.103,8.71,9.413,7.95c0.413-0.059,0.77-0.329,0.947-0.717C12.354,2.877,16.628,0,21.445,0c2.69,0,5.258,0.894,7.377,2.542c0.234,0.183,0.523,0.273,0.818,0.255c0.222-0.014,0.443-0.021,0.666-0.021c3.48,0,6.754,1.753,8.791,4.595c0.211,0.294,0.536,0.481,0.891,0.511c5.598,0.479,10.011,5.324,10.011,11.21C49.999,25.295,45.099,30.341,39.076,30.341z M20.552,32.855c0.148,0,1.09,0,2.305,0V20.714c0-1.183,0.959-2.143,2.143-2.143c1.183,0,2.143,0.959,2.143,2.143v12.141c1.238,0,2.189,0,2.293,0c0.414,0,0.721,0.348,0.479,0.689c-0.192,0.274-4.098,5.759-4.432,6.227c-0.22,0.308-0.743,0.303-0.962,0c-0.245-0.336-4.17-5.842-4.443-6.24C19.876,33.239,20.097,32.855,20.552,32.855z"/></svg>
                                Download Sample
                            </a>
                            <?php } ?>
						</div>
					</div>
					<?php
                      $rating_avg=$this->my_model->aggregate_data('ts_ratings','rating_stars','avg',array('rating_prodid'=>$productdetails[0]['prod_id'])); 
                      $total_rating=$this->my_model->aggregate_data('ts_ratings','rating_stars','count',array('rating_prodid'=>$productdetails[0]['prod_id']));
                    $rating_avg=round($rating_avg); 
                    
					 ?>
					<div class="lk_bottomdiv">
						<div class="lk_ratingdiv">
							<h4>Rating: </h4>
							<ul class="star_rating">
                            <li class="<?php echo ($rating_avg >=1) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=2) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=3) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=4) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=5) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                        </ul>
							 <span class="lk_rating_value"><?php echo $rating_avg; ?>  (<?php echo $total_rating; ?>)</span>
						</div>
						<div class="lk_sharediv">
							<h4>Share</h4> <a href="#" class="lk_sharebtn"><svg version="1.1" x="0px" y="0px" width="17.985px" height="17.999px" viewBox="0 0 17.985 17.999" enable-background="new 0 0 17.985 17.999" xml:space="preserve"><path fill="#FFFFFF" d="M14.679,11.439c-1.051,0-1.977,0.497-2.582,1.257L6.482,9.848C6.556,9.577,6.609,9.295,6.609,9	c0-0.322-0.063-0.625-0.15-0.92l5.589-2.835c0.602,0.794,1.552,1.313,2.631,1.313c1.828,0,3.307-1.467,3.307-3.278	C17.985,1.468,16.507,0,14.679,0c-1.824,0-3.305,1.468-3.305,3.279c0,0.296,0.053,0.578,0.127,0.851L5.89,6.979	c-0.606-0.762-1.534-1.26-2.586-1.26C1.478,5.719,0,7.188,0,9s1.478,3.278,3.304,3.278c1.081,0,2.03-0.52,2.635-1.316l5.586,2.836 c-0.088,0.294-0.15,0.6-0.15,0.922c0,1.811,1.48,3.279,3.305,3.279c1.828,0,3.307-1.469,3.307-3.279	C17.985,12.907,16.507,11.439,14.679,11.439z"/></svg></a>
							<?php $prodName = $this->ts_functions->getProductName($productdetails[0]['prod_id']); ?>
							<div class="lk_shareicon">
								<ul>
                                   <li><a class="fa_share" onclick="site_share(<?php echo $productdetails[0]['prod_id']; ?>,'book')"  ><i class="fa fa-share" aria-hidden="true"></i></a></li>
									<li><a href="https://www.facebook.com/sharer/sharer.php?display=popup&u=<?php echo urlencode($basepath.'item/'.$prodName.$productdetails[0]['prod_uniqid']);?>" class="fa_clr"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
										<li><a class="fa_twt" href="http://twitter.com/share?type=popup&url=<?php echo urlencode($basepath.'item/'.$prodName.$productdetails[0]['prod_uniqid']);?>&text=<?php echo urlencode($productdetails[0]['prod_name']);?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
			<?php
					$prodName = $this->ts_functions->getProductName($productdetails[0]['prod_id']);
					
					
			        $get_subCategory = $this->DatabaseModel->access_database('ts_subcategories','select', '' , array('sub_id'=>$productdetails[0]['prod_subcateid']) );
			        
			        $sub_cate_text = !empty($get_subCategory) ? ' / '.$get_subCategory[0]['sub_name'] : '';
			        
					?>
				<div class="lk_product_single_data lk_anim anim_top">
					<h2><?php echo $productdetails[0]['prod_name'];?></h2>
					<div class="lk_author_detail">
						<?php echo $this->ts_functions->getVendorDisplaybox($productdetails[0]['prod_uid']);?>
					</div>
					<div class="row">
						<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
							<div class="lk_product_features">
								<p><span>Written by: </span><?php echo $productdetails[0]['prod_writter']; ?></p>
								<p><span>Read By: </span<?php echo $productdetails[0]['prod_readby']; ?></p>
								<p><span>Publisher:  </span><?php echo $productdetails[0]['prod_publisher']; ?></p>
							</div>
						</div>
						<div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
							<div class="lk_product_features">
								<p><span>Runtime:  </span><?php echo $productdetails[0]['prod_runtime']; ?> </p>
								<p><span>Release Date: </span><?php echo date_format(date_create ( $productdetails[0]['prod_date'] ) , 'M d, Y');?></p>
								<p><span>Genre:  </span><?php echo $productdetails[0]['cate_name'].$sub_cate_text; ?></p>
							</div>
						</div>
					</div>
					<div class="lk_icon_btndiv">
					<?php if( $productdetails[0]['prod_free'] == 1 ) { ?>
						<a href="<?php echo $basepath;?>dashboard/free_download_product/<?php echo $productdetails[0]['prod_uniqid'];?>" class="lk_iconbtn">free download  <svg version="1.1" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 49.999 40" enable-background="new 0 0 49.999 40" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M39.076,30.341h-7.748v-4.433h7.749c3.649,0,6.618-3.058,6.618-6.816c0-3.759-2.969-6.816-6.618-6.816c-0.218,0-0.44,0.011-0.665,0.034c-0.898,0.095-1.758-0.404-2.15-1.241c-1.118-2.382-3.4-3.861-5.955-3.861c-0.455,0-0.912,0.048-1.358,0.144c-0.701,0.15-1.429-0.068-1.941-0.583c-1.5-1.507-3.475-2.337-5.562-2.337c-3.653,0-6.826,2.552-7.716,6.204c-0.255,1.051-1.208,1.753-2.259,1.67c-0.181-0.016-0.362-0.03-0.546-0.03c-3.65,0-6.619,3.057-6.619,6.816c0,3.759,2.969,6.816,6.619,6.816h7.75v4.432h-7.75C4.9,30.34,0,25.295,0,19.092C0,13.417,4.103,8.71,9.413,7.95c0.413-0.059,0.77-0.329,0.947-0.717C12.354,2.877,16.628,0,21.445,0c2.69,0,5.258,0.894,7.377,2.542c0.234,0.183,0.523,0.273,0.818,0.255c0.222-0.014,0.443-0.021,0.666-0.021c3.48,0,6.754,1.753,8.791,4.595c0.211,0.294,0.536,0.481,0.891,0.511c5.598,0.479,10.011,5.324,10.011,11.21C49.999,25.295,45.099,30.341,39.076,30.341z M20.552,32.855c0.148,0,1.09,0,2.305,0V20.714c0-1.183,0.959-2.143,2.143-2.143c1.183,0,2.143,0.959,2.143,2.143v12.141c1.238,0,2.189,0,2.293,0c0.414,0,0.721,0.348,0.479,0.689c-0.192,0.274-4.098,5.759-4.432,6.227c-0.22,0.308-0.743,0.303-0.962,0c-0.245-0.336-4.17-5.842-4.443-6.24C19.876,33.239,20.097,32.855,20.552,32.855z"></path></svg></a>
					<?php }else {  ?>

					<a href="<?php echo $basepath;?>shop/add_to_cart/products/<?php echo $productdetails[0]['prod_uniqid'];?>" class="lk_iconbtn">Buy Now  <span><?php echo $this->ts_functions->getsettings('portalcurreny','symbol');?><?php echo $productdetails[0]['prod_price'];?></span>  </a>
					<?php } ?>	
						<a href="#" class="lk_iconbtn">Gift <svg version="1.1" x="0px" y="0px" width="22px" height="23px" viewBox="0 0 22 23" enable-background="new 0 0 22 23" xml:space="preserve"><path fill="#FFFFFF" d="M19.801,4.5h-2.595c0.25-0.442,0.395-0.954,0.395-1.5c0-1.654-1.316-3-2.934-3	C13.139,0,11.789,0.801,11,2.016C10.211,0.801,8.862,0,7.334,0C5.716,0,4.4,1.346,4.4,3c0,0.546,0.145,1.058,0.395,1.5H2.2	C0.987,4.5,0,5.509,0,6.75v3.5C0,10.664,0.329,11,0.733,11h0.733v9.75c0,1.24,0.987,2.25,2.2,2.25c0.613,0,13.991,0,14.667,0	c1.213,0,2.199-1.01,2.199-2.25V11h0.733C21.672,11,22,10.664,22,10.25v-3.5C22,5.509,21.014,4.5,19.801,4.5z M7.334,1.5	c1.617,0,2.933,1.346,2.933,3c-0.32,0-2.56,0-2.933,0C6.525,4.5,5.867,3.827,5.867,3S6.525,1.5,7.334,1.5z M8.801,21.5H3.667	c-0.404,0-0.733-0.337-0.733-0.75V11h5.867V21.5z M8.801,9.5c-0.307,0-7.025,0-7.334,0V6.75C1.467,6.336,1.796,6,2.2,6	c0.133,0,6.455,0,6.601,0V9.5L8.801,9.5z M11.733,21.5h-1.467V11h1.467V21.5z M11.733,9.5h-1.467V6c0.531,0,0.937,0,1.467,0V9.5z	 M14.667,1.5c0.809,0,1.467,0.673,1.467,1.5s-0.658,1.5-1.467,1.5c-0.337,0-2.617,0-2.934,0C11.733,2.846,13.05,1.5,14.667,1.5z	 M19.066,20.75c0,0.413-0.328,0.75-0.732,0.75H13.2V11h5.866V20.75L19.066,20.75z M20.533,9.5c-0.308,0-7.027,0-7.333,0V6	c0.145,0,6.468,0,6.601,0c0.404,0,0.732,0.336,0.732,0.75V9.5L20.533,9.5z"/></svg></a>
					</div>
					<h3>Products Description</h3>
					<p><?php echo $productdetails[0]['prod_description'];?></p>
					</div>
			</div>
		</div>
	</div>
</div>
<?php if(!empty($relatedProducts)) { ?>
<div class="lk_graywrappper">		
	<div class="container">				
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_section_title lk_anim anim_top">
                    <h3>Related Products</h3>
                </div>
			</div>
			<div class="lk_audiobookslider">
				<div class="owl-carousel owl-theme">
					<?php foreach($relatedProducts as $solo_related) { 
						
							$prodName = $this->ts_functions->getProductName($solo_related['prod_id']);
							$image_a = explode('.',$solo_related['prod_image']);
							$dis_img=$this->ts_functions->getProductPic($solo_related['prod_id']);
					
							if( $solo_related['prod_type'] == 'Audio' ) {
								$prod_gallery = $this->DatabaseModel->access_database('ts_prodgallery','select', '' , array('prodgallery_pid'=>$solo_related['prod_id']) );
							}
							else {
								$prod_gallery = '';
							}
							$rating_avg=$this->my_model->aggregate_data('ts_ratings','rating_stars','avg',array('rating_prodid'=>$solo_related['prod_id'])); 
                           $rating_avg=round($rating_avg);   
				
					
						?>
					<div class="item">
						<div class="lk_audiobook lk_anim anim_top">
							<div class="image">
								<img src="<?php echo $dis_img;?>" alt="" />
								<div class="overlay">
									<a class="add_action" data-value="<?php echo $solo_related['prod_id']; ?>">
										<svg version="1.1" x="0px" y="0px" width="12.01px" height="11.996px" viewBox="0 0 12.01 11.996" enable-background="new 0 0 12.01 11.996" xml:space="preserve"><path fill="#A8C937" d="M11.358,5.161H6.843v-4.51C6.843,0.446,6.564,0,6.005,0S5.167,0.446,5.167,0.651v4.51H0.652C0.446,5.161,0,5.44,0,5.998c0,0.559,0.446,0.838,0.652,0.838h4.516v4.51c0,0.205,0.279,0.65,0.838,0.65s0.838-0.445,0.838-0.65v-4.51h4.515c0.206,0,0.652-0.279,0.652-0.838C12.01,5.44,11.564,5.161,11.358,5.161z"></path></svg>
										<span></span>
									</a>
									<?php  if( $solo_related['prod_type'] == 'Audio' ) { ?>
									<?php if(!empty($prod_gallery)) { 
											$audio_str = '';
											foreach($prod_gallery as $solo_prod_gallery) { 
												$audio_str .= $solo_prod_gallery['prodgallery_img'].',';
											}
											$audio_str = rtrim($audio_str,',');
										}	
										?>
									<a class="play_action" onclick="play_music('<?php echo base_url().'repo/gallery/p_'.$solo_related['prod_id'].'/'; ?>',this,'single')" data-audio="<?php echo $audio_str;?>" >
	                                <div class="lk_audio_control play">
	                                    <span class="left"></span><span class="right"></span>
	                                </div>
	                               </a>
	                               <?php } else { ?>   <!-- product type ebook  -->
		                            <?php if($solo_related['prod_sample']!=''){ ?>
		                            <a href="<?php echo $basepath.'home/sample_ebook_download/'.$solo_related['prod_uniqid']; ?>" class="download_action">
		                                <svg version="1.1" x="0px" y="0px" width="49.999px" height="40px" viewBox="0 0 49.999 40" enable-background="new 0 0 49.999 40" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M39.076,30.341h-7.748v-4.433h7.749c3.649,0,6.618-3.058,6.618-6.816c0-3.759-2.969-6.816-6.618-6.816c-0.218,0-0.44,0.011-0.665,0.034c-0.898,0.095-1.758-0.404-2.15-1.241c-1.118-2.382-3.4-3.861-5.955-3.861c-0.455,0-0.912,0.048-1.358,0.144c-0.701,0.15-1.429-0.068-1.941-0.583c-1.5-1.507-3.475-2.337-5.562-2.337c-3.653,0-6.826,2.552-7.716,6.204c-0.255,1.051-1.208,1.753-2.259,1.67c-0.181-0.016-0.362-0.03-0.546-0.03c-3.65,0-6.619,3.057-6.619,6.816c0,3.759,2.969,6.816,6.619,6.816h7.75v4.432h-7.75C4.9,30.34,0,25.295,0,19.092C0,13.417,4.103,8.71,9.413,7.95c0.413-0.059,0.77-0.329,0.947-0.717C12.354,2.877,16.628,0,21.445,0c2.69,0,5.258,0.894,7.377,2.542c0.234,0.183,0.523,0.273,0.818,0.255c0.222-0.014,0.443-0.021,0.666-0.021c3.48,0,6.754,1.753,8.791,4.595c0.211,0.294,0.536,0.481,0.891,0.511c5.598,0.479,10.011,5.324,10.011,11.21C49.999,25.295,45.099,30.341,39.076,30.341z M20.552,32.855c0.148,0,1.09,0,2.305,0V20.714c0-1.183,0.959-2.143,2.143-2.143c1.183,0,2.143,0.959,2.143,2.143v12.141c1.238,0,2.189,0,2.293,0c0.414,0,0.721,0.348,0.479,0.689c-0.192,0.274-4.098,5.759-4.432,6.227c-0.22,0.308-0.743,0.303-0.962,0c-0.245-0.336-4.17-5.842-4.443-6.24C19.876,33.239,20.097,32.855,20.552,32.855z"/></svg>
		                                Download Sample
		                            </a>
		                            <?php } } ?>

								</div>
							</div>
							<a href="<?php echo $basepath;?>item/<?php echo $prodName.$solo_related['prod_uniqid'];?>" class="detail">
								<h3><?php echo $solo_related['prod_name'];?></h3>
								<ul class="star_rating">
                            <li class="<?php echo ($rating_avg >=1) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=2) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=3) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=4) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=5) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                        </ul>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
        </div>
	</div>
</div>
<?php } ?>


<div class="lk_transparent_wrapper <?php if(empty($relatedProducts)) echo 'lk_nopadding_wrapper';?>">
	<div class="container">
		<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_section_title lk_anim anim_top">
                    <h3>Reviews</h3>
                </div>
			</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<div class="lk_icon_btndiv">
				<a  href="javascript:" class="lk_iconbtn" data-toggle="modal" data-target="#reviewModal">Write reviews  </a>
			</div>
		</div>

		<?php if(!empty($prod_reviews)){ ?>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_review_div">
					<ul>
					<?php foreach ($prod_reviews as $single_review) {?>
						<li>
						<?php
						$reviewerid=$single_review['rating_uid'];
						$reviewerName = $this->ts_functions->select_single_data('ts_user',"where user_id='$reviewerid'","user_uname");
						$reviewerImage = $this->ts_functions->select_single_data('ts_user',"where user_id='$reviewerid'","user_pic");
						$reviewerImagesrc=base_url().'webimage/dummy_testi.jpg';
						if($reviewerImage){
							$reviewerImagesrc=base_url().'webimage/'.$reviewerImage;
						}
						$rating_stars=$single_review['rating_stars'];
   					?>
							<div class="lk_comment_img">
								<img src="<?php echo $reviewerImagesrc; ?>" class="img-responsive" alt="">
								<h3><?php echo $reviewerName; ?></h3>
								<ul class="star_rating">
                            <li class="<?php echo ($rating_stars >=1) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_stars >=2) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_stars >=3) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_stars >=4) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_stars >=5) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                        </ul>
							</div>
							<div class="lk_comment_content">
								<p><?php echo $single_review['rating_review'];?></p>
							</div>
						</li>
					<?php } ?>	
					</ul>
				</div>
			</div>
			<?php } ?> 

		</div>
	</div>
</div>


  <div class="modal fade lk_popupmodel" id="reviewModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Write Review</h4>
        </div>
        <div class="modal-body">
          
        <div class="dw_rating_form_wrapper">
			<label>Rating</label>
			<ul class="star_rating dw_rating_div">
	            <li class="active" data-value="1"><i class="fa fa-star" aria-hidden="true"></i></li>
	            <li class="" data-value="2"><i class="fa fa-star" aria-hidden="true"></i></li>
	            <li class="" data-value="3"><i class="fa fa-star" aria-hidden="true"></i></li>
	            <li class="" data-value="4"><i class="fa fa-star" aria-hidden="true"></i></li>
	            <li class="" data-value="5"><i class="fa fa-star" aria-hidden="true"></i></li>
	        </ul>
			
			
			<div class="form-group">
				<textarea class="form-control" rows="8" placeholder="Write your Review" id="review" ></textarea>
				 <input type="hidden" id="rating" value="1">
				 <input type="hidden" id="prod_id" value="<?php echo $productdetails[0]['prod_id'];?>">
				 
				 <input type="hidden" id="login_user" value="<?php  if(isset($this->session->userdata['ts_uid'])) { echo 1 ;} ?>">
				
			</div>
			<div class="form-group">
				<a class="lk_btn rating_star">publish</a>
			</div>
		</div>
      </div>
    </div>  
   </div>
  </div>
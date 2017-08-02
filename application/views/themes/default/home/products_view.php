<?php
	$category_Name = '';
?>
<div class="lk_pagebanner_wrapper">
	<div class="lk_pagebanner_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="lk_search_form">
			<form id="productSearchForm" method="post">		
			<input type="hidden" id="sorting" name="sorting" value="<?php echo $order; ?>">		
			<button class="ts_search_btn hide" type="submit" name="searchproductBtn"></button>
			</form>
				<form class="form-inline" action="<?php echo $basepath;?>home/search_products" method="post">
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						<div class="form-group">
							<select class="form-control" name="category" onchange="getSubCategories(this)">
									 <option value="0">Choose one</option>
									 <?php
									 foreach($categoryList as $soloCate) {
									 	if( isset($_POST['category']) ) {
											$selected = ($_POST['category'] == $soloCate['cate_id']) ? 'selected' : '' ;
											if($_POST['category'] == $soloCate['cate_id']) {
												$category_Name = $soloCate['cate_name'];
											}
										}
										else {
											$selected = '';
										}
										if( $cate_type == 'category' ) {
											$selected = ($cateid == $soloCate['cate_id']) ? 'selected' : '' ;
										}
								
										echo '<option value="'.$soloCate['cate_id'].'" '.$selected.'>'.$soloCate['cate_name'].'</option>';
									  } ?>
								</select>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						<div class="form-group" >
                            <select class="form-control" name="sub_category">
								<?php if( isset($_POST['sub_category']) ) { 
									echo '<option value="0">Choose one</option>';
									foreach($sub_categoryList as $solo_subCate) {
									 	if( isset($_POST['sub_category']) ) {
											$selected = ($_POST['sub_category'] == $solo_subCate['sub_id']) ? 'selected' : '' ;
										}
										else {
											$selected = '';
										}
										if( $cate_type != 'category' ) {
											$selected = ($cateid == $solo_subCate['sub_id']) ? 'selected' : '' ;
										}
										echo '<option value="'.$solo_subCate['sub_id'].'" '.$selected.'>'.$solo_subCate['sub_name'].'</option>';
									  } 
								
								 } else { ?>
								  <option value="0">Choose one</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-3 col-xs-12">
						<div class="lk_small_field">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Price From" value="<?php if(isset($_POST['min_price'])) echo $_POST['min_price']; ?>" name="min_price">
							</div>
						</div>
						<div class="lk_small_field">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Price To" value="<?php if(isset($_POST['max_price'])) echo $_POST['max_price']; ?>" name="max_price">
							</div>
						</div>
						<!--<div class="lk_btndiv">
							<button class="lk_searchbtn" type="submit" name="searchInputBtn"><svg version="1.1" x="0px" y="0px" width="12.984px" height="12.984px" viewBox="0 0 12.984 12.984" enable-background="new 0 0 12.984 12.984" xml:space="preserve"><path fill="#616488" d="M12.666,11.131l-2.82-2.82C9.83,8.296,9.813,8.285,9.797,8.271c0.555-0.842,0.879-1.85,0.879-2.934C10.676,2.39,8.286,0,5.338,0S0,2.39,0,5.338c0,2.947,2.39,5.338,5.338,5.338c1.084,0,2.092-0.324,2.934-0.879C8.285,9.813,8.296,9.83,8.311,9.845l2.821,2.821c0.423,0.424,1.11,0.424,1.534,0S13.09,11.555,12.666,11.131z M5.338,8.825c-1.926,0-3.487-1.562-3.487-3.487c0-1.927,1.562-3.488,3.487-3.488s3.487,1.561,3.487,3.488C8.825,7.264,7.264,8.825,5.338,8.825z"></path></svg></button>
						</div>-->
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="lk_searchdiv">
							<input type="text" class="form-control" name="keyword" placeholder="Search....">
							<div class="lk_btndiv">
								<button class="lk_searchbtn" type="submit" name="searchInputBtn"><svg version="1.1" x="0px" y="0px" width="12.984px" height="12.984px" viewBox="0 0 12.984 12.984" enable-background="new 0 0 12.984 12.984" xml:space="preserve"><path fill="#616488" d="M12.666,11.131l-2.82-2.82C9.83,8.296,9.813,8.285,9.797,8.271c0.555-0.842,0.879-1.85,0.879-2.934C10.676,2.39,8.286,0,5.338,0S0,2.39,0,5.338c0,2.947,2.39,5.338,5.338,5.338c1.084,0,2.092-0.324,2.934-0.879C8.285,9.813,8.296,9.83,8.311,9.845l2.821,2.821c0.423,0.424,1.11,0.424,1.534,0S13.09,11.555,12.666,11.131z M5.338,8.825c-1.926,0-3.487-1.562-3.487-3.487c0-1.927,1.562-3.488,3.487-3.488s3.487,1.561,3.487,3.488C8.825,7.264,7.264,8.825,5.338,8.825z"></path></svg></button>
							</div>
							<!--<select class="form-control" id="sorting" name="sorting" onchange="sort_product(this)">
							
								<option value="0">Sort</option>
								<option value="prod_name" <?php if($order == 'prod_name') echo "selected"; ?> >Sort By Name</option>
								<option value="prod_price" <?php if($order == 'prod_price') echo "selected"; ?>>Sort BY Price</option>
								<option value="prod_date" <?php if($order == 'prod_date') echo "selected"; ?>>Sort By Date</option>
							</select>-->
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="lk_collection_single_wrapper">
	<div class="container">
		<div class="row">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_main_tab lk_anim anim_top">
                    <ul>
                        <li><a class="<?php if(isset($featured_audio) || isset($freebies_audio) || isset($recent_audio)) echo 'active'; ?>" href="<?php echo base_url(); ?>">Audiobooks</a></li>
                        <li><a class="<?php if(isset($freebies_ebook)||isset($featured_ebook) || isset($recent_ebook)) echo 'active'?>"  href="<?php echo base_url('ebooks'); ?>">Ebooks</a></li>
                    </ul>
                </div> 
			</div> 
	
            <?php 
			 if( !empty($productdetails) ) {
			 
			 foreach($productdetails as $soloProd) {
                $prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
                $vendorName = $this->ts_functions->getVendorName($soloProd['prod_uid']);
                
				$image_a = explode('.',$soloProd['prod_image']);
				$dis_img=$this->ts_functions->getProductPic($soloProd['prod_id']);
				
				if( $soloProd['prod_type'] == 'Audio' ) {
					$prod_gallery = $this->DatabaseModel->access_database('ts_prodgallery','select', '' , array('prodgallery_pid'=>$soloProd['prod_id']) );
				}
				else {
					$prod_gallery = '';
				}
				$rating_avg=$this->my_model->aggregate_data('ts_ratings','rating_stars','avg',array('rating_prodid'=>$soloProd['prod_id'])); 
                    $rating_avg=round($rating_avg);   
				
            ?>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="<?php echo( $soloProd['prod_type'] == 'Ebook' ) ? 'lk_ebook' : 'lk_audiobook';?> lk_anim anim_top">
                    <div class="image">
                        <img src="<?php echo $dis_img;?>" alt="" />
                        <div class="overlay">
							<a href="" class="add_action">
                                <svg version="1.1" x="0px" y="0px" width="12.01px" height="11.996px" viewBox="0 0 12.01 11.996" enable-background="new 0 0 12.01 11.996" xml:space="preserve"><path fill="#A8C937" d="M11.358,5.161H6.843v-4.51C6.843,0.446,6.564,0,6.005,0S5.167,0.446,5.167,0.651v4.51H0.652C0.446,5.161,0,5.44,0,5.998c0,0.559,0.446,0.838,0.652,0.838h4.516v4.51c0,0.205,0.279,0.65,0.838,0.65s0.838-0.445,0.838-0.65v-4.51h4.515c0.206,0,0.652-0.279,0.652-0.838C12.01,5.44,11.564,5.161,11.358,5.161z"></path></svg>
                                <span></span>
                            </a>

                           <?php  if( $soloProd['prod_type'] == 'Audio' ) { 
	                           $prod_gallery = $this->DatabaseModel->access_database('ts_prodgallery','select', '' , array('prodgallery_pid'=>$productdetails[0]['prod_id']) );
							    if(!empty($prod_gallery)) { 
											$audio_str = '';
											foreach($prod_gallery as $solo_prod_gallery) { 
												$audio_str .= $solo_prod_gallery['prodgallery_img'].',';
											}
											$audio_str = rtrim($audio_str,',');    
							    ?>
	                            <a class="play_action" onclick="play_music('<?php echo base_url().'repo/gallery/p_'.$soloProd['prod_id'].'/'; ?>',this,'single')" data-audio="<?php echo $audio_str;?>" >
	                                <div class="lk_audio_control play">
	                                    <span class="left"></span><span class="right"></span>
	                                </div>
	                            </a>
	                            <?php } ?>


                            <?php } else { ?>   <!-- product type ebook  -->
                            <?php if($soloProd['prod_sample']!=''){ ?>
                            <a href="<?php echo $basepath.'home/sample_ebook_download/'.$soloProd['prod_uniqid']; ?>" class="download_action">
                                <svg version="1.1" x="0px" y="0px" width="49.999px" height="40px" viewBox="0 0 49.999 40" enable-background="new 0 0 49.999 40" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M39.076,30.341h-7.748v-4.433h7.749c3.649,0,6.618-3.058,6.618-6.816c0-3.759-2.969-6.816-6.618-6.816c-0.218,0-0.44,0.011-0.665,0.034c-0.898,0.095-1.758-0.404-2.15-1.241c-1.118-2.382-3.4-3.861-5.955-3.861c-0.455,0-0.912,0.048-1.358,0.144c-0.701,0.15-1.429-0.068-1.941-0.583c-1.5-1.507-3.475-2.337-5.562-2.337c-3.653,0-6.826,2.552-7.716,6.204c-0.255,1.051-1.208,1.753-2.259,1.67c-0.181-0.016-0.362-0.03-0.546-0.03c-3.65,0-6.619,3.057-6.619,6.816c0,3.759,2.969,6.816,6.619,6.816h7.75v4.432h-7.75C4.9,30.34,0,25.295,0,19.092C0,13.417,4.103,8.71,9.413,7.95c0.413-0.059,0.77-0.329,0.947-0.717C12.354,2.877,16.628,0,21.445,0c2.69,0,5.258,0.894,7.377,2.542c0.234,0.183,0.523,0.273,0.818,0.255c0.222-0.014,0.443-0.021,0.666-0.021c3.48,0,6.754,1.753,8.791,4.595c0.211,0.294,0.536,0.481,0.891,0.511c5.598,0.479,10.011,5.324,10.011,11.21C49.999,25.295,45.099,30.341,39.076,30.341z M20.552,32.855c0.148,0,1.09,0,2.305,0V20.714c0-1.183,0.959-2.143,2.143-2.143c1.183,0,2.143,0.959,2.143,2.143v12.141c1.238,0,2.189,0,2.293,0c0.414,0,0.721,0.348,0.479,0.689c-0.192,0.274-4.098,5.759-4.432,6.227c-0.22,0.308-0.743,0.303-0.962,0c-0.245-0.336-4.17-5.842-4.443-6.24C19.876,33.239,20.097,32.855,20.552,32.855z"/></svg>
                                Download Sample
                            </a>
                            <?php } } ?>

                        </div>
                    </div>
                    <a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>" class="detail">
                        <h3><?php echo $soloProd['prod_name'];?></h3>
                        <ul class="star_rating">
                            <li class="<?php echo ($rating_avg >=1) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=2) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=3) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=4) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                            <li class="<?php echo ($rating_avg >=5) ? 'active' :''; ?>"><i class="fa fa-star" aria-hidden="true"></i></li>
                        </ul>
			          <h4><?php if( $soloProd['prod_free'] == 1 ) { echo "free"; } else{   echo $this->ts_functions->getsettings('portalcurreny','symbol').' '.$soloProd['prod_price']; }?></h4>
                    </a>
                </div>
            </div>
            <?php } 

            	

            	} else { ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
				
				<img src="<?php echo $basepath; ?>themes/default/images/web/404.png" alt="404" title="Not found" width="100%" height="500px">
			</div>
			<?php } ?>
			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
			<div class="lk_pagination">
				<div class="search_pagination"><?php echo (isset($pagination_buttons))?$pagination_buttons:''; ?></div>
				<div class="product_pagination"><?php echo (isset($paginationButton))?$paginationButton:''; ?></div>
			</div>
			</div>

        </div>
	</div>
</div>
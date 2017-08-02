<div class="lk_pagebanner_wrapper">
	<div class="lk_pagebanner_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
				<div class="lk_page_title">
					<h3><?php echo $colDetail[0]['col_name']; ?></h3>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="lk_banner_links">
					<ul>
                    <?php  if( isset($this->session->userdata['ts_uid']) ) { ?>
                        <?php if($this->session->userdata['ts_uid']==$colDetail[0]['col_user'] && $colDetail[0]['col_type']==0 ){?>

						<li><a onclick="delete_collection_data(<?php echo $colDetail[0]['col_id'];  ?>)"><svg version="1.1" x="0px" y="0px" width="25.006px" height="24.992px" viewBox="0 0 25.006 24.992" enable-background="new 0 0 25.006 24.992" xml:space="preserve"><g>	<path fill="#ffffff" d="M20.56,0.624h-5.568C14.863,0.26,14.525,0,14.125,0h-3.039c-0.399,0-0.738,0.26-0.866,0.624H4.651		c-1.405,0-2.548,1.167-2.548,2.603v2.368c0,0.52,0.412,0.941,0.921,0.941h1.732v17.522C4.757,24.578,5.17,25,5.678,25h13.855		c0.508,0,0.92-0.422,0.92-0.941V6.537h1.734c0.508,0,0.92-0.422,0.92-0.941V3.228C23.107,1.792,21.964,0.624,20.56,0.624z	 M18.611,23.117H6.6V6.537h12.011V23.117z M21.265,4.654H3.945V3.228c0-0.397,0.316-0.721,0.706-0.721H20.56	c0.389,0,0.705,0.324,0.705,0.721V4.654z M10.191,19.869c0.509,0,0.921-0.422,0.921-0.941V9.008c0-0.52-0.412-0.941-0.921-0.941		S9.27,8.489,9.27,9.008v9.919C9.27,19.447,9.683,19.869,10.191,19.869z M15.019,19.869c0.51,0,0.922-0.422,0.922-0.941V9.008	c0-0.52-0.412-0.941-0.922-0.941c-0.508,0-0.92,0.422-0.92,0.941v9.919C14.099,19.447,14.511,19.869,15.019,19.869z"/></g></svg> delete</a></li>
                        <?php } } ?>
                        <li>
                        <div class="lk_sharediv">
                         <a href="#" class="lk_sharebtn"><svg version="1.1" x="0px" y="0px" width="17.985px" height="17.999px" viewBox="0 0 17.985 17.999" enable-background="new 0 0 17.985 17.999" xml:space="preserve"><path fill="#FFFFFF" d="M14.679,11.439c-1.051,0-1.977,0.497-2.582,1.257L6.482,9.848C6.556,9.577,6.609,9.295,6.609,9 c0-0.322-0.063-0.625-0.15-0.92l5.589-2.835c0.602,0.794,1.552,1.313,2.631,1.313c1.828,0,3.307-1.467,3.307-3.278  C17.985,1.468,16.507,0,14.679,0c-1.824,0-3.305,1.468-3.305,3.279c0,0.296,0.053,0.578,0.127,0.851L5.89,6.979 c-0.606-0.762-1.534-1.26-2.586-1.26C1.478,5.719,0,7.188,0,9s1.478,3.278,3.304,3.278c1.081,0,2.03-0.52,2.635-1.316l5.586,2.836 c-0.088,0.294-0.15,0.6-0.15,0.922c0,1.811,1.48,3.279,3.305,3.279c1.828,0,3.307-1.469,3.307-3.279  C17.985,12.907,16.507,11.439,14.679,11.439z"/></svg></a>
                        <div class="lk_shareicon">
                            <ul>
                            <?php 
                            $colName=$colDetail[0]['col_name']; 

                            ?>
                            <li><a class="fa_share" onclick="site_share(<?php echo $colDetail[0]['col_id']; ?>,'collection')"  ><i class="fa fa-share" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?display=popup&u=<?php echo urlencode($basepath.'collection/'.$colName.'/'.$colDetail[0]['col_id']);?>" class="fa_clr"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a class="fa_twt" href="http://twitter.com/share?type=popup&url=<?php echo urlencode($basepath.'collection/'.$colName.'/'.$colDetail[0]['col_id']);?>&text=<?php echo urlencode($colDetail[0]['col_name']);?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                      </div>
                      </li>						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="lk_collection_single_wrapper"> 
	<div class="container">
		<div class="row">
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
                        <a href="javascript:" class="lk_checkboxdiv" data-checked="0" data-id="<?php echo $soloProd['prod_id']; ?>">
                            <input type="checkbox" class="lk_custom_checkbox" value="<?php echo $soloProd['prod_id']; ?>"  >
                            <span></span>
                        </a>
                        <div class="overlay">
                            <a  class="add_action" data-value="<?php echo $soloProd['prod_id']; ?>">
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
                }  ?>

        </div>
	</div>
</div>
<!--search banner start-->
<div class="lk_searchBanner">
    <div class="lk_searchBanner_inner">
        <h3><?php echo $this->ts_functions->getlanguage('bannerheading','homepage','solo');?></h3>
        <p><?php echo $this->ts_functions->getlanguage('bannersubheading','homepage','solo');?></p>
        <div class="lk_search_input">
            <input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('searchplaceholder','homepage','solo');?>" id="searchInput" />
            <a  class="icon" id="searchInputBtn">
                <svg version="1.1" x="0px" y="0px" width="12.984px" height="12.984px" viewBox="0 0 12.984 12.984" enable-background="new 0 0 12.984 12.984" xml:space="preserve"><path fill="#616488" d="M12.666,11.131l-2.82-2.82C9.83,8.296,9.813,8.285,9.797,8.271c0.555-0.842,0.879-1.85,0.879-2.934C10.676,2.39,8.286,0,5.338,0S0,2.39,0,5.338c0,2.947,2.39,5.338,5.338,5.338c1.084,0,2.092-0.324,2.934-0.879C8.285,9.813,8.296,9.83,8.311,9.845l2.821,2.821c0.423,0.424,1.11,0.424,1.534,0S13.09,11.555,12.666,11.131z M5.338,8.825c-1.926,0-3.487-1.562-3.487-3.487c0-1.927,1.562-3.488,3.487-3.488s3.487,1.561,3.487,3.488C8.825,7.264,7.264,8.825,5.338,8.825z"/></svg>
            </a>
        </div>
    </div>
</div>
<!--search banner end-->
<div class="lk_toptab_menu  ">
    <div class="container">

    <div class="row">
            <div class="col-md-12">
                <div class="lk_main_tab lk_anim anim_top">
                    <ul>
                         <li><a class="active" href="javascript:">Audiobooks</a></li>
                        <li><a href="<?php echo base_url('ebooks'); ?>">Ebooks</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


               <!--Featured  Audio Book Start-->
<?php if(!empty($featured_productdetails)) { ?>
<div class="lk_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="lk_section_title lk_anim anim_top">
                    <h3>Featured</h3>
                    <p>Hand Picked By Lifekeypad Team</p>
                </div>
            </div>
        </div> 
       
        <div class="row">
            <?php foreach($featured_productdetails as $soloProd) {
                    $prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
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
                <div class="lk_audiobook lk_anim anim_top">
                    <div class="image">
                        <img src="<?php echo $dis_img;?>" alt=""  class="img-responsive"/>
                        <div class="overlay">
                         <a class="add_action"  data-value="<?php echo $soloProd['prod_id']; ?>">
                                <svg version="1.1" x="0px" y="0px" width="12.01px" height="11.996px" viewBox="0 0 12.01 11.996" enable-background="new 0 0 12.01 11.996" xml:space="preserve"><path fill="#A8C937" d="M11.358,5.161H6.843v-4.51C6.843,0.446,6.564,0,6.005,0S5.167,0.446,5.167,0.651v4.51H0.652C0.446,5.161,0,5.44,0,5.998c0,0.559,0.446,0.838,0.652,0.838h4.516v4.51c0,0.205,0.279,0.65,0.838,0.65s0.838-0.445,0.838-0.65v-4.51h4.515c0.206,0,0.652-0.279,0.652-0.838C12.01,5.44,11.564,5.161,11.358,5.161z"/></svg>
                                <span></span>
                            </a>
                        <?php if(!empty($prod_gallery)) { 
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
                             <?php } else { ?>
                             <a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>" >
                                <svg version="1.1" x="0px" y="0px" width="12.01px" height="11.996px" viewBox="0 0 12.01 11.996" enable-background="new 0 0 12.01 11.996" xml:space="preserve"><path fill="#A8C937" d="M11.358,5.161H6.843v-4.51C6.843,0.446,6.564,0,6.005,0S5.167,0.446,5.167,0.651v4.51H0.652C0.446,5.161,0,5.44,0,5.998c0,0.559,0.446,0.838,0.652,0.838h4.516v4.51c0,0.205,0.279,0.65,0.838,0.65s0.838-0.445,0.838-0.65v-4.51h4.515c0.206,0,0.652-0.279,0.652-0.838C12.01,5.44,11.564,5.161,11.358,5.161z"/></svg>
                                <span></span>
                            </a>
                            <?php } ?>
                            
                           
                            
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
                    </a>
                </div>
            </div>
           <?php } ?>   
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="<?php echo $basepath;?>home/products/featured-audio" class="lk_btn"><?php echo $this->ts_functions->getlanguage('viewmoretext','commontext','solo');?></a>
            </div>
        </div>

    </div>
</div>
<!--Featured end-->
<?php } ?>





<!--- Recent Ebook   -->

<?php if(!empty($recent_productdetails)) { ?>
<div class="lk_section light_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="lk_section_title lk_anim anim_top">
                    <h3>Recent</h3>
                    <p>Recent Added To Lifekeypad Store</p>
                </div>
            </div>
        </div> 

        <div class="row">
            <?php foreach($recent_productdetails as $soloProd) {
                    $prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
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
                <div class="lk_audiobook lk_anim anim_top">
                    <div class="image">
                        <img src="<?php echo $dis_img;?>" alt=""  class="img-responsive"/>
                        <div class="overlay">
                         <a class="add_action" data-value="<?php echo $soloProd['prod_id']; ?>">
                                <svg version="1.1" x="0px" y="0px" width="12.01px" height="11.996px" viewBox="0 0 12.01 11.996" enable-background="new 0 0 12.01 11.996" xml:space="preserve"><path fill="#A8C937" d="M11.358,5.161H6.843v-4.51C6.843,0.446,6.564,0,6.005,0S5.167,0.446,5.167,0.651v4.51H0.652C0.446,5.161,0,5.44,0,5.998c0,0.559,0.446,0.838,0.652,0.838h4.516v4.51c0,0.205,0.279,0.65,0.838,0.65s0.838-0.445,0.838-0.65v-4.51h4.515c0.206,0,0.652-0.279,0.652-0.838C12.01,5.44,11.564,5.161,11.358,5.161z"/></svg>
                                <span></span>
                            </a>
                        <?php if(!empty($prod_gallery)) { 
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

                            <?php } else { ?>
                             <a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>" >
                                <svg version="1.1" x="0px" y="0px" width="12.01px" height="11.996px" viewBox="0 0 12.01 11.996" enable-background="new 0 0 12.01 11.996" xml:space="preserve"><path fill="#A8C937" d="M11.358,5.161H6.843v-4.51C6.843,0.446,6.564,0,6.005,0S5.167,0.446,5.167,0.651v4.51H0.652C0.446,5.161,0,5.44,0,5.998c0,0.559,0.446,0.838,0.652,0.838h4.516v4.51c0,0.205,0.279,0.65,0.838,0.65s0.838-0.445,0.838-0.65v-4.51h4.515c0.206,0,0.652-0.279,0.652-0.838C12.01,5.44,11.564,5.161,11.358,5.161z"/></svg>
                                <span></span>
                            </a>

                            <?php } ?>
                            
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
                    </a>
                </div>
            </div>
           <?php } ?>
            
            
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="<?php echo $basepath;?>home/products/recent-audio" class="lk_btn"><?php echo $this->ts_functions->getlanguage('viewmoretext','commontext','solo');?></a>
            </div>
        </div>

    </div>
</div>
<?php } ?>
<!--Recent Audio Book End-->


<!--Free Audio start-->
<?php if(!empty($free_productdetails)) { ?>
<div class="lk_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="lk_section_title lk_anim anim_top">
                    <h3>Free</h3>
                    <p>Free Audiobooks By Lifekeypad</p>
                </div>
            </div>
        </div>  

        <div class="row">
            <?php foreach($free_productdetails as $soloProd) {
                    $prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
                    $image_a = explode('.',$soloProd['prod_image']);
                    $dis_img=$this->ts_functions->getProductPic($soloProd['prod_id']);

                    $rating_avg=$this->my_model->aggregate_data('ts_ratings','rating_stars','avg',array('rating_prodid'=>$soloProd['prod_id'])); 
                    $rating_avg=round($rating_avg);   
                ?> 
            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="lk_audiobook lk_anim anim_top">
                    <div class="image">
                        <img src="<?php echo $dis_img;?>" alt=""  class="img-responsive"/>
                        <div class="overlay">
                        <a class="add_action" data-value="<?php echo $soloProd['prod_id']; ?>">
                                <svg version="1.1" x="0px" y="0px" width="12.01px" height="11.996px" viewBox="0 0 12.01 11.996" enable-background="new 0 0 12.01 11.996" xml:space="preserve"><path fill="#A8C937" d="M11.358,5.161H6.843v-4.51C6.843,0.446,6.564,0,6.005,0S5.167,0.446,5.167,0.651v4.51H0.652C0.446,5.161,0,5.44,0,5.998c0,0.559,0.446,0.838,0.652,0.838h4.516v4.51c0,0.205,0.279,0.65,0.838,0.65s0.838-0.445,0.838-0.65v-4.51h4.515c0.206,0,0.652-0.279,0.652-0.838C12.01,5.44,11.564,5.161,11.358,5.161z"/></svg>
                                <span></span>
                            </a>
                           <?php if(!empty($prod_gallery)) { 
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

                            <?php } else { ?>
                             <a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>" >
                                <svg version="1.1" x="0px" y="0px" width="12.01px" height="11.996px" viewBox="0 0 12.01 11.996" enable-background="new 0 0 12.01 11.996" xml:space="preserve"><path fill="#A8C937" d="M11.358,5.161H6.843v-4.51C6.843,0.446,6.564,0,6.005,0S5.167,0.446,5.167,0.651v4.51H0.652C0.446,5.161,0,5.44,0,5.998c0,0.559,0.446,0.838,0.652,0.838h4.516v4.51c0,0.205,0.279,0.65,0.838,0.65s0.838-0.445,0.838-0.65v-4.51h4.515c0.206,0,0.652-0.279,0.652-0.838C12.01,5.44,11.564,5.161,11.358,5.161z"/></svg>
                                <span></span>
                            </a>

                            <?php } ?>

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
                    </a>
                </div>
            </div>
            <?php } ?>
            
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="<?php echo $basepath;?>home/products/freebies-audio" class="lk_btn"><?php echo $this->ts_functions->getlanguage('viewmoretext','commontext','solo');?></a>
            </div>
        </div>

    </div>
</div>
<?php } ?>
<!--Free Audio Book End-->


<div class="container"><hr></div>
<?php if(!empty($categoryList)) { ?>
<div class="lk_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="lk_section_title lk_anim anim_top">
                    <h3>Language</h3>
                </div>
            </div>
        </div>

        <div class="row lk_anim anim_top">
        <?php foreach($categoryList as $soloCate) { 
                    $catename = strtolower($soloCate['cate_urlname']);
                    $catename = str_replace(' ','-',$catename);
                    $catename = preg_replace('!-+!', '-', $catename);
                    $catename = 'category';             
                ?>
            <div class="col-md-4 col-sm-4">
                <a href="<?php echo $basepath;?>home/products/<?php echo $catename;?>/<?php echo $soloCate['cate_id'];?>" class="lk_lang_box">
                    <div class="image">
                        <img src="<?php echo $basepath;?>repo/categories/<?php echo $soloCate['cate_image'];?>" alt="<?php echo $soloCate['cate_name'];?>"  title="<?php echo $soloCate['cate_name'];?>"/>
                    </div>
                    <p><?php echo $soloCate['cate_name'];?></p>
                </a>
            </div>
           <?php } ?> 
            
            
        </div>
    </div>
</div>
<?php } ?>
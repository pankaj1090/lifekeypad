<!--footer start-->
<div class="lk_footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="lk_copyright">
                   
                     <?php if( $this->ts_functions->getsettings('copyright','checkbox') == '1' ) { ?>
                    <p>&copy; <a href="<?php echo $basepath;?>"><?php echo $this->ts_functions->getsettings('sitename','text');?></a> <?php echo $this->ts_functions->getsettings('copyright','text');?> </p>
                    <?php } ?>
                </div>
                <div class="lk_footer_right">
                    <div class="lk_footer_nav">
                        <ul>
                            <li><a href="<?php echo $basepath;?>home/terms">Terms & Conditions</a></li>
                            <li><a href="<?php echo $basepath;?>home/privacy">Privacy Policy</a></li>
                            <li><a href="<?php echo base_url();?>home/contact">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="lk_social">
                        <ul>
                              <?php if( $this->ts_functions->getsettings('fblink','checkbox') == '1' ) { ?>
                                <li><a target="_blank" href="<?php echo $this->ts_functions->getsettings('fblink','url');?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <?php }
                                if( $this->ts_functions->getsettings('googlelink','checkbox') == '1' ) { ?>
                                <li><a target="_blank" href="<?php echo $this->ts_functions->getsettings('googlelink','url');?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <?php }
                                if( $this->ts_functions->getsettings('twitterlink','checkbox') == '1' ) { ?>
                                <li><a target="_blank" href="<?php echo $this->ts_functions->getsettings('twitterlink','url');?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <?php } ?>
                        </ul>
                    </div>
                    <div class="lk_country">
                        <select>
                            <option value="india">India</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer end-->

<!-- Audio Box -->
<div id="audio_box"> 
</div>
<!-- Audio Box -->
<button id="play_music" onclick="trigger_music_play()" style="display:none;">Button</button>


</div>
<!--main wrapper end-->
<input type="hidden" id="basepath" value="<?php echo $basepath;?>">


<!-- site jquery start -->
<script src="<?php echo $basepath;?>themes/default/js/lib/jquery-3.2.1.min.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/lib/bootstrap.min.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/wow.min.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/owl.carousel.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/masonry/modernizr.custom.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/masonry/masonry.pkgd.min.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/masonry/imagesloaded.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/masonry/classie.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/masonry/AnimOnScroll.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/main.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/custom.js"></script>
<!-- site jquery end -->

<!-- site jquery end -->

</body>
</html> 
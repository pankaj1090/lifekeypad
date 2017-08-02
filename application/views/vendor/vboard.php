
<div class="lk_collection_single_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3">
				<form action="" method="post" id="sort_form">
				<div class="lk_filterdiv">
				<div>
					<p><?php echo $this->ts_functions->getlanguage('filtertext','vendorboard','solo');?></p>
					

					<select name="duration" onchange="displayDate(this)" class="lk_selectbox">
						<option value=""><?php echo $this->ts_functions->getlanguage('alltext','homepage','solo');?></option>

						<option value="today" <?php echo ($duration == 'today') ? 'selected' : '' ; ?>><?php echo $this->ts_functions->getlanguage('todaytext','vendorboard','solo');?></option>

						<option value="yesterday" <?php echo ($duration == 'yesterday') ? 'selected' : '' ; ?>><?php echo $this->ts_functions->getlanguage('yesterdaytext','vendorboard','solo');?></option>

						<option value="custom" <?php echo ($duration == 'custom') ? 'selected' : '' ; ?>><?php echo $this->ts_functions->getlanguage('customtext','vendorboard','solo');?></option>
					</select>
				</div>
				<a onclick="submit_sort_form();" class="lk_btn"><?php echo $this->ts_functions->getlanguage('filterw','vendorboard','solo');?></a>
				<div class="th_datepicker lk_customfield_form" <?php echo ($duration != 'custom') ? 'style="display:none;"' : '' ; ?>>
					<input type="text" class="form-control datepicker" placeholder="dd/mm/yyyy" name="d1" value="<?php echo ($duration == 'custom') ? $d1 : '' ; ?>"> <?php echo $this->ts_functions->getlanguage('totext','vendorboard','solo');?>
					<input type="text" class="form-control datepicker" placeholder="dd/mm/yyyy" name="d2" value="<?php echo ($duration == 'custom') ? $d2 : '' ; ?>">
				</div>	
				</div>
				</form>
			</div>
		</div>
		<?php
            $deviceArr = $browserArr = $viewsArr = array();
            if(!empty($prodViews)) {
                foreach($prodViews as $vData) {
                    array_push($viewsArr,$vData['prod_analysis_views']);

                    // Device
                    $dev = $vData['prod_analysis_device'];
                    if(isset($deviceArr[$dev])) {
                        $curValArr = explode(',',$deviceArr[$dev]);
                        $curVal_prev = $curValArr[0];
                        $curVal_demo = $curValArr[1];
                        if( $vData['prod_analysis_pagetype'] == 'Single' ){
                            $cPrev = 1;
                            $cDemo = 0;
                        }
                        else {
                            $cPrev = 0;
                            $cDemo = 1;
                        }
                        $curVal_prev = $curValArr[0] + $cPrev;
                        $curVal_demo = $curValArr[1] + $cDemo;
                        $deviceArr[$dev] = $curVal_prev.','.$curVal_demo;
                    }
                    else {
                        if( $vData['prod_analysis_pagetype'] == 'Single' ){
                            $deviceArr[$dev] = '1,0';
                        }
                        else {
                            $deviceArr[$dev] = '0,1';
                        }
                    }

                    // Browsers
                    $brow = $vData['prod_analysis_browser'];
                    if(isset($browserArr[$brow])) {
                        $curValArr = explode(',',$browserArr[$brow]);
                        $curVal_prev = $curValArr[0];
                        $curVal_demo = $curValArr[1];
                        if( $vData['prod_analysis_pagetype'] == 'Single' ){
                            $cPrev = 1;
                            $cDemo = 0;
                        }
                        else {
                            $cPrev = 0;
                            $cDemo = 1;
                        }
                        $curVal_prev = $curValArr[0] + $cPrev;
                        $curVal_demo = $curValArr[1] + $cDemo;
                        $browserArr[$brow] = $curVal_prev.','.$curVal_demo;
                    }
                    else {
                        if( $vData['prod_analysis_pagetype'] == 'Single' ){
                            $browserArr[$brow] = '1,0';
                        }
                        else {
                            $browserArr[$brow] = '0,1';
                        }

                    }
                }
            }
            $tot_prod_views = array_sum($viewsArr);
        ?>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="lk_product_div">
					<div class="lk_product_icon lk_bluebg">
						<span><svg version="1.1" x="0px" y="0px" width="25.004px" height="19.004px" viewBox="0 0 25.004 19.004" enable-background="new 0 0 25.004 19.004" xml:space="preserve"><g><path fill="#ffffff" d="M6.747,9.28C7.66,8.853,8.534,8.639,9.368,8.639h11.071v-2.16c0-0.828-0.293-1.539-0.878-2.133		s-1.286-0.891-2.103-0.891H10.22V3.023c0-0.828-0.293-1.539-0.878-2.132C8.756,0.297,8.055,0,7.239,0H2.981		C2.165,0,1.464,0.297,0.878,0.891C0.292,1.485,0,2.196,0,3.023v12.958c0,0.036,0.002,0.092,0.006,0.169		c0.005,0.077,0.007,0.133,0.007,0.169l0.066-0.081l4.485-5.345C5.105,10.245,5.833,9.707,6.747,9.28z M24.651,10.542		c-0.235-0.117-0.503-0.176-0.806-0.176H9.368c-0.585,0-1.222,0.16-1.91,0.479s-1.222,0.708-1.604,1.168l-4.471,5.345		c-0.275,0.314-0.413,0.612-0.413,0.891c0,0.27,0.118,0.464,0.353,0.581c0.235,0.116,0.503,0.175,0.805,0.175h14.479		c0.586,0,1.222-0.159,1.91-0.479c0.688-0.32,1.222-0.709,1.604-1.168l4.471-5.345c0.275-0.315,0.412-0.612,0.412-0.892		C25.004,10.852,24.887,10.659,24.651,10.542z"/></g></svg></span>
					</div>
					<div class="lk_product_data">
						<p><?php echo $this->ts_functions->getlanguage('activeprodtext','vendorboard','solo');?> <br> <?php echo count($productdetails_active); ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="lk_product_div">
					<div class="lk_product_icon lk_greenbg">
						<span><svg version="1.1" x="0px" y="0px" width="25.004px" height="19.004px" viewBox="0 0 25.004 19.004" enable-background="new 0 0 25.004 19.004" xml:space="preserve"><g><path fill="#ffffff" d="M6.747,9.28C7.66,8.853,8.534,8.639,9.368,8.639h11.071v-2.16c0-0.828-0.293-1.539-0.878-2.133		s-1.286-0.891-2.103-0.891H10.22V3.023c0-0.828-0.293-1.539-0.878-2.132C8.756,0.297,8.055,0,7.239,0H2.981		C2.165,0,1.464,0.297,0.878,0.891C0.292,1.485,0,2.196,0,3.023v12.958c0,0.036,0.002,0.092,0.006,0.169		c0.005,0.077,0.007,0.133,0.007,0.169l0.066-0.081l4.485-5.345C5.105,10.245,5.833,9.707,6.747,9.28z M24.651,10.542		c-0.235-0.117-0.503-0.176-0.806-0.176H9.368c-0.585,0-1.222,0.16-1.91,0.479s-1.222,0.708-1.604,1.168l-4.471,5.345		c-0.275,0.314-0.413,0.612-0.413,0.891c0,0.27,0.118,0.464,0.353,0.581c0.235,0.116,0.503,0.175,0.805,0.175h14.479		c0.586,0,1.222-0.159,1.91-0.479c0.688-0.32,1.222-0.709,1.604-1.168l4.471-5.345c0.275-0.315,0.412-0.612,0.412-0.892		C25.004,10.852,24.887,10.659,24.651,10.542z"/></g></svg></span>
					</div>
					<div class="lk_product_data">
						<p><?php echo $this->ts_functions->getlanguage('freeprodtext','vendorboard','solo');?> <br> <?php echo count($productdetails_free); ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="lk_product_div">
					<div class="lk_product_icon lk_violetbg">
						<span><svg version="1.1" x="0px" y="0px" width="25.023px" height="15px" viewBox="0 0 25.023 15" enable-background="new 0 0 25.023 15" xml:space="preserve"><path fill="#ffffff" d="M12.512,0C7.731,0,3.395,2.63,0.196,6.903c-0.261,0.35-0.261,0.839,0,1.189C3.395,12.37,7.731,15,12.512,15	c4.78,0,9.116-2.631,12.315-6.903c0.261-0.35,0.261-0.839,0-1.189C21.628,2.63,17.292,0,12.512,0z M12.855,12.782	c-3.174,0.2-5.795-2.43-5.595-5.626c0.164-2.636,2.288-4.772,4.908-4.937c3.174-0.201,5.795,2.43,5.595,5.626	C17.594,10.475,15.47,12.612,12.855,12.782z M12.696,10.341c-1.709,0.108-3.122-1.308-3.01-3.027	c0.087-1.42,1.234-2.568,2.646-2.661c1.71-0.108,3.123,1.308,3.01,3.027C15.25,9.106,14.104,10.254,12.696,10.341z"/></svg></span>
					</div>
					<div class="lk_product_data">
						<p><?php echo $this->ts_functions->getlanguage('totprodviewstext','vendorboard','solo');?> <br> <?php echo $tot_prod_views; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="lk_product_div">
					<div class="lk_product_icon lk_orangebg">
						<span><svg version="1.1" x="0px" y="0px" width="24.996px" height="21px" viewBox="0.013 -6 24.996 21" enable-background="new 0.013 -6 24.996 21" xml:space="preserve"><g><path fill="#ffffff" d="M2.667,10.165c-0.189,0.188-0.415,0.342-0.656,0.444v3.456c0,0.516,0.421,0.93,0.934,0.93h2.103		c0.519,0,0.934-0.419,0.934-0.93V7.01c0-0.047-0.005-0.092-0.011-0.133L2.667,10.165z M24.444-3.309h-0.066		c-1.416,0.066-2.837,0.132-4.252,0.199c-0.221,0.01-0.437,0.021-0.56,0.286c-0.123,0.26,0.016,0.408,0.17,0.562		c0.436,0.434,0.866,0.873,1.308,1.297l-0.482,0.48L16.637,3.42l-0.349,0.348L15.432,4.62l-3.375,3.359l-0.194-0.194L7.827,3.768		L6.97,2.915L6.739,2.685c-0.185-0.184-0.42-0.271-0.661-0.271S5.6,2.506,5.416,2.685l-0.23,0.229L0.287,7.791		c-0.364,0.362-0.364,0.955,0,1.316l0.231,0.23c0.185,0.184,0.42,0.271,0.661,0.271s0.478-0.092,0.662-0.271L6.078,5.12l0.194,0.194		l4.037,4.018l0.856,0.854l0.23,0.229c0.185,0.184,0.421,0.271,0.661,0.271c0.241,0,0.478-0.092,0.662-0.271l0.23-0.229l4.037-4.019		l0.856-0.853l0.349-0.347l3.924-3.906l0.477-0.475l1.282,1.266c0.118,0.118,0.235,0.245,0.405,0.245		c0.062,0,0.133-0.021,0.21-0.061c0.257-0.138,0.313-0.363,0.323-0.613c0.062-1.378,0.128-2.752,0.195-4.131	C25.023-3.12,24.849-3.309,24.444-3.309z M9.76,2.639c0.404,0.194,0.836,0.296,1.271,0.363c0.344,0.056,0.354,0.071,0.359,0.424		c0,0.164,0.005,0.322,0.005,0.485c0,0.204,0.103,0.322,0.308,0.327c0.241,0.005,0.478,0.005,0.718,0		c0.195-0.005,0.298-0.113,0.298-0.307c0-0.22,0.01-0.439,0-0.664s0.087-0.337,0.303-0.398c0.497-0.138,0.923-0.403,1.251-0.796		c0.908-1.098,0.56-2.706-0.728-3.416c-0.405-0.225-0.831-0.393-1.257-0.566c-0.246-0.102-0.482-0.22-0.688-0.388		c-0.41-0.327-0.333-0.853,0.148-1.062c0.134-0.056,0.277-0.077,0.426-0.087c0.554-0.03,1.082,0.072,1.59,0.312		c0.252,0.123,0.334,0.082,0.421-0.179c0.087-0.275,0.164-0.551,0.246-0.832c0.057-0.184-0.01-0.312-0.189-0.388		c-0.323-0.143-0.656-0.245-1-0.296c-0.457-0.071-0.457-0.071-0.457-0.525C12.781-6,12.781-6,12.139-6h-0.281		c-0.303,0.01-0.354,0.061-0.359,0.362c-0.005,0.138,0,0.271,0,0.409c0,0.403-0.005,0.398-0.39,0.536		c-0.934,0.337-1.513,0.97-1.574,1.986C9.478-1.808,9.95-1.201,10.688-0.762c0.457,0.271,0.965,0.434,1.446,0.644		c0.19,0.082,0.369,0.179,0.528,0.306c0.467,0.383,0.38,1.021-0.174,1.261c-0.298,0.128-0.605,0.158-0.929,0.123		c-0.492-0.061-0.97-0.189-1.415-0.424C9.884,1.01,9.806,1.046,9.719,1.332c-0.077,0.245-0.145,0.49-0.211,0.735		C9.411,2.404,9.442,2.486,9.76,2.639z M10.324,11.022L9.468,10.17L7.622,8.332C7.54,8.47,7.493,8.633,7.493,8.802v5.269		c0,0.516,0.421,0.93,0.934,0.93h2.103c0.519,0,0.934-0.419,0.934-0.93v-2.281c-0.338-0.098-0.651-0.281-0.907-0.537L10.324,11.022z		 M13.786,11.022l-0.23,0.229c-0.169,0.169-0.364,0.307-0.58,0.408v2.41c0,0.516,0.421,0.93,0.934,0.93h2.104		c0.518,0,0.934-0.419,0.934-0.93V8.802c0-0.255-0.104-0.485-0.272-0.653L13.786,11.022z M19.028,5.799l-0.349,0.348l-0.226,0.225		v7.689c0,0.516,0.42,0.93,0.934,0.93h2.103c0.518,0,0.934-0.419,0.934-0.93V2.552c0-0.041-0.006-0.082-0.011-0.123L19.028,5.799z"/></g></svg></span>
					</div>
					<div class="lk_product_data">
						<p><?php echo $this->ts_functions->getlanguage('totprodsalestext','vendorboard','solo');?><br><?php echo count($prodSales); ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="lk_contentdiv lk_chartdiv">
                <?php if(!empty($deviceArr)) { ?>
                <div id="device_chart"></div>
                 <?php } else { ?>
					<p><?php echo $this->ts_functions->getlanguage('prodviewdevicetext','vendorboard','solo');?> <span>Nothing is fetched yet.</span></p>
                 <?php } ?>   
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="lk_contentdiv lk_chartdiv">
                <?php if(!empty($browserArr)) { ?>
                <div id="browser_chart"></div>
                <?php } else { ?>
					<p><?php echo $this->ts_functions->getlanguage('prodviewbrowsertext','vendorboard','solo');?> <span>Nothing is fetched yet.</span></p>
                  <?php } ?>  
				</div>
			</div>
		</div>
	</div>
</div>




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

<script src="<?php echo $basepath;?>adminassets/js/plugins/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo $basepath;?>adminassets/js/plugins/morris.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>adminassets/js/plugins/bootstrap-datepicker.js"></script>

<script src="<?php echo $basepath;?>themes/default/js/main.js"></script>
<script src="<?php echo $basepath;?>themes/default/js/custom.js"></script>

<script src="<?php echo $basepath;?>adminassets/js/admin_custom.js" type="text/javascript"></script>
<!-- site jquery end -->


</body>
</html> 
<?php $colorArray = array('#ff5722','#795548','#4caf50','#abd86b','#71fdb0','#ff4400','#29b6f6','#009688','#DAF7A6');?>
<script>
$( document ).ready(function() {
    <?php if(!empty($deviceArr)) { ?>
    Morris.Bar({
      element: 'device_chart',
      data: [<?php foreach($deviceArr as $key=>$value) {
            $vArr = explode(',',$value);
            echo '{y: "'.$key.'" , a: '.$vArr[0].' , b: '.$vArr[1].'},';
         } ?>
      ],
      xkey: 'y',
      ykeys: ['a','b'],
      resize: true,
      labels: ['Preview', 'Live Demo'],
      barColors : ['#5ab2cc','#ffa000']
    });
    <?php } ?>

    <?php if(!empty($browserArr)) { ?>
    Morris.Bar({
      element: 'browser_chart',
      data: [<?php foreach($browserArr as $key=>$value) {
            $vArr = explode(',',$value);
            echo '{y: "'.$key.'" , a: '.$vArr[0].' , b: '.$vArr[1].'},';
         } ?>
      ],
      xkey: 'y',
      ykeys: ['a','b'],
      resize: true,
      labels: ['Preview', 'Live Demo'],
      barColors : ['#d7da14','#2196f3']
    });
    <?php } ?>

});
</script>
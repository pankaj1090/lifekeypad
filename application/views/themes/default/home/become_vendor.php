<div class="lk_searchBanner">
    <div class="lk_searchBanner_inner">
        <h3>Start Selling</h3>
        <p>Sell your awesome audiobooks and ebooks to buyers globally<br>Having audios in any language, upload here and make handsome amount of money out of it.</p>
		<div class="lk_signin_btndiv">
           <?php if(isset($this->session->userdata['ts_level']) ) {
			 if( $this->session->userdata['ts_level'] == '2' ) { ?>
				<a class="lk_signin_btn"  data-toggle="modal" data-target="#tnc_popup">Click to start selling</a>
				<?php } else { ?>
				<a class="lk_signin_btn" href="<?php echo $basepath;?>vendorboard"> Vendor Dashboard </a>
				<?php } } else { ?>
					<a class="lk_signin_btn" href="<?php echo $basepath;?>authenticate/register">Sign in to Start Selling</a>
				<?php } ?>

							
		</div>
    </div>
</div>
<div class="lk_transparent_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_section_title lk_anim anim_top">
                    <h3>Why Sell On Lifekeypad ?</h3>
                </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="lk_whysell_div">
					<img src="<?php echo $basepath;?>themes/default/images/whysell1.png" class="img-responsive" alt="">
					<p>Sell Your Audiobook and <br> Ebooks Globally</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="lk_whysell_div">
					<img src="<?php echo $basepath;?>themes/default/images/whysell2.png" class="img-responsive" alt="">
					<p>No fixed costs,<br>Pay when you sell.</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="lk_whysell_div">
					<img src="<?php echo $basepath;?>themes/default/images/whysell3.png" class="img-responsive" alt="">
					<p>Secure & Timely<br>Payments</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="lk_whysell_div">
					<img src="<?php echo $basepath;?>themes/default/images/whysell4.png" class="img-responsive" alt="">
					<p>Professional Services to help<br>you through every step<br>of selling online</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if(!empty($language_details)) { ?>
<div class="lk_graywrappper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_section_title lk_anim anim_top">
                    <h3>AudioBooks and Ebooks Can Be Sold In These Languages</h3>
                </div>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
				<div class="row">
				<?php	
				foreach($language_details as $solo_lan) {		?>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="lk_language_div">	
							<span><?php echo $solo_lan['lancate_symbol'];?></span>
							<p><?php echo $solo_lan['lancate_name'];?></p>
						</div>
					</div>
				<?php } ?>	

				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<div class="lk_transparent_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_section_title lk_anim anim_top">
                    <h3>How To List Your Audiobook and Ebook On LIfekeypad ?</h3>
                </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 lk_listdiv_after">
				<div class="lk_listdiv">
					<img src="<?php echo $basepath;?>themes/default/images/list1.png" class="img-responsive" alt="">
					<h3>Pick Audio to Sell</h3>
					<p>Select language and category for Audiobook and Ebook</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 lk_listdiv_after">
				<div class="lk_listdiv">
					<img src="<?php echo $basepath;?>themes/default/images/list2.png" class="img-responsive" alt="">
					<h3>Upload Your Content</h3>
					<p>Upload Cover photo Sample in zip file</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 lk_listdiv_after">
				<div class="lk_listdiv">
					<img src="<?php echo $basepath;?>themes/default/images/list3.png" class="img-responsive" alt="">
					<h3>Select The Price</h3>
					<p>Or you can make available for free</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 lk_listdiv_after">
				<div class="lk_listdiv">
					<img src="<?php echo $basepath;?>themes/default/images/list4.png" class="img-responsive" alt="">
					<h3>Verify</h3>
					<p>Audio is Ready to Sell</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="lk_graywrappper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_section_title lk_anim anim_top">
                    <h3>Earn Top Dollar When You Sell</h3>
					<p>You get upto 50% more for your Audiobook And Ebook with our low Commission</p>
                </div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_green_banner">
					<div class="lk_halfdiv">
						<h3>For Every Sale Author Will Get <?php echo 100-$this->ts_functions->getsettings('vendor','commission'); ?> % Royalty</h3>
						<p>When you keep your earning on lifekeypad</p>
					</div>
					<div class="lk_halfdiv">
						<h3><?php echo 100-$this->ts_functions->getsettings('vendor','commission'); ?>%  - 2.9% Safe Transfer Fee <?php echo 100-$this->ts_functions->getsettings('vendor','commission')-2.9 ?> %</h3>
						<p>When you cash out to paypal</p>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_signin_btndiv">
					
					<?php if( isset($this->session->userdata['ts_level']) ) {
						if( $this->session->userdata['ts_level'] == '2' ) { ?>
					<a class="lk_signin_btn lk_green_btn"  data-toggle="modal" data-target="#tnc_popup">Click to start selling</a>
					<?php } else { ?>
					<a class="lk_signin_btn lk_green_btn" href="<?php echo $basepath;?>vendorboard"> Vendor Dashboard </a>
					<?php } } else { ?>
						<a class="lk_signin_btn lk_green_btn" href="<?php echo $basepath;?>authenticate/register">Sign in to Start Selling</a>
					<?php } ?>
					
				</div>
			</div>
		</div>
	</div>
</div>
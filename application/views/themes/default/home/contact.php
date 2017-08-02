<div class="lk_mapdiv">
	
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14005.050453309112!2d77.18448313603236!3d28.651854448800826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d029c5f402ed3%3A0x942174294c9dd946!2sKarol+Bagh%2C+New+Delhi%2C+Delhi!5e0!3m2!1sen!2sin!4v1477015004450" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<div class="lk_collection_single_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_contactform_div">
					<div class="lk_section_title lk_anim anim_top">
						<h3><?php echo $this->ts_functions->getlanguage('headingsupporttext','commontext','solo'); ?></h3>
					</div>
					<form  class="lk_formdiv">
						<div class="row">
						<?php if(!isset($this->session->userdata['ts_uid'])) { ?>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="<?php echo $this->ts_functions->getlanguage('yourname','commontext','solo'); ?>" id="name">
								</div>
								<div class="form-group">
									<input type="text" class="form-control validate" placeholder="Last Name" id="lname">
								</div>
								<div class="form-group">
									<input type="text" class="form-control validate" placeholder="<?php echo $this->ts_functions->getlanguage('youremail','commontext','solo'); ?>" id="email">
								</div>
							</div>
					  <?php } ?>		
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									
									<textarea class="form-control validate" rows="9" placeholder="<?php echo $this->ts_functions->getlanguage('yourmsgtext','commontext','solo'); ?>" id="msg"></textarea>
								</div>
								<button type ="button" class="lk_btn" onclick="sendcontactform(this);"><?php echo $this->ts_functions->getlanguage('sendtext','commontext','solo'); ?></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="sendtext" value="<?php echo $this->ts_functions->getlanguage('sendtext','commontext','solo'); ?>">
<input type="hidden" id="waittext" value="<?php echo $this->ts_functions->getlanguage('waittext','commontext','solo'); ?>">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('empty','message','solo');?>" id="emptyerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('email','message','solo');?>" id="emailerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('contactsuc','message','solo');?>" id="contactsuc_text">

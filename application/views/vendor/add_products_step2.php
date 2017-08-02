
<div class="lk_collection_single_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_section_title lk_anim anim_top">
                    <h3> <?php echo $this->ts_functions->getlanguage('selectfiletext','vendorboard','solo');?></h3>
                </div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_addproduct_form">
					<div class="form-group">
						<div class="col-lg-3 col-md-3">
							<label> </label>
						</div>
						<div class="col-lg-9 col-md-9">
							<p style="color: red;text-align: center;" id="audio_msg"></p>                          
						</div>
					</div>
					<input type="hidden" value="<?php echo $prod_details[0]['prod_id'];?>" id="prod_id" />
					<input type="hidden" value="<?php echo $prod_details[0]['prod_type'];?>" id="prod_type" />
					<div class="form-group">
					<div class="col-lg-3 col-md-3">
						<label> <?php echo $this->ts_functions->getlanguage('selectfiletext','vendorboard','solo');?> </label>
					</div>
					
					<div class="col-lg-6 col-md-6">
						<select class="form-control productfields" id="file_upload_type">
							<option value="Preview.jpg@#jpg,jpeg"><?php echo $this->ts_functions->getlanguage('previewimghelptext','vendorboard','solo');?></option>
						<?php if( $prod_details[0]['prod_type'] == 'Audio' ) { ?>
							<option value="Preview.mp3@#mp3,ogg,wav">Demo Audio file</option>
						<?php } elseif( $prod_details[0]['prod_type'] == 'Video' ) { ?>
							<option value="Preview.mp4@#mp4"><?php echo $this->ts_functions->getlanguage('videodemohelptext','vendorboard','solo');?></option>
						<?php } elseif( $prod_details[0]['prod_type'] == 'Text' ) { ?>
							<option value="Preview.zip@#zip"><?php echo $this->ts_functions->getlanguage('textdemohelptext','vendorboard','solo');?></option>
						<?php } elseif( $prod_details[0]['prod_type'] == 'Other' ) { ?>
							<option value="Preview.zip@#zip"><?php echo $this->ts_functions->getlanguage('otherdemohelptext','vendorboard','solo');?></option>
						<?php } ?>
							<option value="Product.zip@#zip"> <?php echo $this->ts_functions->getlanguage('finalprodhelptext','vendorboard','solo');?></option>	
							<?php if( $prod_details[0]['prod_type'] == 'Ebook' ) { ?>
						<option value="Sample_Ebook@#zip">Sample</option>
					<?php } ?>	
						</select>                            
					</div>
			     </div>


                 <div class="form-group">
				<div class="col-lg-3 col-md-3">
					<label><?php echo $this->ts_functions->getlanguage('uploadtext','vendorboard','solo');?> </label>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="dropzone dz-clickable" id="tp_upload_section" style="min-height: 100px;border: 2px dashed #A8C937;text-align: center;">
						<div class="dz-default dz-message">
							<i class="fa fa-cloud-upload" aria-hidden="true" style="font-size: 40px;"></i>
							<p class="info_text"><?php echo $this->ts_functions->getlanguage('dropzonetext','vendorboard','solo');?></p>
						</div>
					</div>                       
				</div>

               <div class="form-group">
				<div class="col-lg-3 col-md-3">
					<label> </label>
				</div>
				<div class="col-lg-6 col-md-6">
					<p style="color: red;text-align: center;"> Uploading new files, will delete the old files completely.</p>                          
				</div>
			</div>

			<div class="col-lg-12 col-md-12">
				<a class="lk_btn" onclick='window.location.href = "<?php echo $basepath;?>vendorboard/manage_products"'><?php echo $this->ts_functions->getlanguage('completebtn','vendorboard','solo');?></a>
		
			</div>

			</div>

				</div>
			</div>
		</div>
	</div>
</div>
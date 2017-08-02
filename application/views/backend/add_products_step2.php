  
<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
<div class="theme_page">
<?php $topText = 'Add Products ( Step 2 )';?>
    <div class="theme_panel_section">
                    <h4 class="th_title">
                    <?php echo $topText;?>
                    </h4>
                <div class="th_content_section">
<input type="hidden" value="<?php echo $prod_details[0]['prod_id'];?>" id="prod_id" />
<input type="hidden" value="<?php echo $prod_details[0]['prod_type'];?>" id="prod_type" />

<div class="alert alert-info th_setting_text">
	<p><i style="color:#34c309;" class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Section </p>
</div>


	<div class="form-group">
    	<div class="col-lg-12 col-md-12">
    		
    		<div class="form-group">
				<div class="col-lg-3 col-md-3">
					<label> </label>
				</div>
				<div class="col-lg-6 col-md-6">
					<p style="color: red;text-align: center;" id="audio_msg"></p>                          
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-lg-3 col-md-3">
					<label>Select file to upload </label>
				</div>
				<div class="col-lg-6 col-md-6">
					<select class="form-control productfields" id="file_upload_type" onchange="select_file_type(this)">
						<option value="Preview.jpg@#jpg,jpeg">Thumbnail Preview Image, extension .jpg / .jpeg</option>
					<?php if( $prod_details[0]['prod_type'] == 'Audio' ) { ?>
						<option value="Preview.mp3@#mp3,ogg,wav">Demo Audio file</option>
					<?php } elseif( $prod_details[0]['prod_type'] == 'Video' ) { ?>
						<option value="Preview.mp4@#mp4">Demo MP4 file, extension .mp4</option>
					<?php } elseif( $prod_details[0]['prod_type'] == 'Text' ) { ?>
						<option value="Preview.zip@#zip">Demo text file, extension .zip</option>
					<?php } elseif( $prod_details[0]['prod_type'] == 'Other' ) { ?>
						<option value="Preview.zip@#zip">Gallery Images Zip, extension .zip</option>
					<?php } ?>
						<option value="Product.zip@#zip"> Final Product Zip, extension .zip</option>
					<?php if( $prod_details[0]['prod_type'] == 'Ebook' ) { ?>
						<option value="Sample_Ebook@#zip">Sample</option>
					<?php } ?>	
					</select>                            
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-lg-3 col-md-3">
					<label>Upload here </label>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="dropzone dz-clickable" id="tp_upload_section" style="min-height: 100px;border: 2px dashed #6f5499;text-align: center;">
						<div class="dz-default dz-message">
							<i class="fa fa-cloud-upload" aria-hidden="true" style="font-size: 40px;"></i>
							<p class="info_text">Drop file here or Click to browse</p>
						</div>
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
				<div class="th_btn_wrapper">
					<a class="btn theme_btn" onclick='window.location.href = "<?php echo $basepath;?>products/manage_products"'>Complete</a>
				</div>
			</div>
    	
    	</div>
	</div>
						
					
                </div>
    </div>
</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- user content section -->
	</div>
	

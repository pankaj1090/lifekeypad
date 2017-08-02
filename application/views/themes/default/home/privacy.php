    <?php
        if( empty($pageContent)){
            redirect(base_url());
        }
    ?>

<!-- Terms & Conditions Wrapper wrapper Start -->
<div class="lk_pagebanner_wrapper">
	<div class="lk_pagebanner_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
				<div class="lk_pagetitle">
					<h1><?php echo $pageContent[0]['page_heading'];?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="lk_collection_single_wrapper ts_toppadder70 ts_bottompadder70">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="lk_terms_info_section">
					<h3><?php echo $pageContent[0]['page_heading'];?></h3>
					<?php echo $pageContent[0]['page_content'];?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Terms & Conditions Wrapper wrapper End -->



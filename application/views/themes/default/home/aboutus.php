    <?php
        if( empty($pageContent)){
            redirect(base_url());
        }
    ?>
<!-- Breadcrumb wrappe Start -->
<div class="ts_breadcrumb_wrapper ts_toppadder60 ts_bottompadder60">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_pagetitle">
					<h3><?php echo $this->ts_functions->getlanguage('abouttext','menus','solo'); ?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcrumb wrappe End -->

<!-- About Us Wrapper wrapper Start -->
<div class="ts_aboutus_wrapper ts_toppadder70 ts_bottompadder70">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_aboutus_info_section">
					<h3><?php echo $pageContent[0]['page_heading'];?></h3>
					
					<?php echo $pageContent[0]['page_content'];?>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- About Us Wrapper wrapper End -->

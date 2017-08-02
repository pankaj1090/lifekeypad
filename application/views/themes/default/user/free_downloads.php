<!-- Breadcrumb wrappe Start 
<div class="ts_breadcrumb_wrapper ts_toppadder80 ts_bottompadder80">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_pagetitle">
					<h3><?php echo $pageHeading;?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
 Breadcrumb wrappe End -->

<!-- Profile wrapper Start -->
<div class="ts_profile_wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ts_info_menu"> 
				<div class="container"> 
				<?php
				    if( $this->ts_functions->getsettings('portal','revenuemodel') != 'subscription' ) {
				        $mCls = 'ts_3_menu';
				    }
				    else {
				        $mCls = '';
				    }
				$mCls = '';
				?>
					<ul class="<?php echo $mCls;?>">

						<li><a class="<?php echo isset($download_active) ? $download_active : '' ;?>" href="<?php echo $basepath;?>dashboard/free_downloads"><?php echo $this->ts_functions->getlanguage('freedowntext','menus','solo'); ?></a></li>
						
						<li><a class="<?php echo isset($purchase_active) ? $purchase_active : '' ;?>" href="<?php echo $basepath;?>dashboard/purchased"><?php echo $this->ts_functions->getlanguage('paiddowntext','menus','solo'); ?></a></li>

						<li><a class="<?php echo isset($profile_active) ? $profile_active : '' ;?>" href="<?php echo $basepath;?>dashboard/profile"><?php echo $this->ts_functions->getlanguage('profiletext','menus','solo'); ?></a></li>
					</ul>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<div class="ts_profile_wrapper ts_toppadder50 ts_bottompadder40">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<p style="text-align: center;color: #F44336;"><?php echo isset($planMsg) ? $planMsg : '' ;
			    $m = $this->session->flashdata('planMsg');
			    echo ($m) ? $this->session->flashdata('planMsg') : '' ;
			    echo '<br/>';
			    $vm = $this->session->flashdata('vendorplanMsg');
			    echo ($vm) ? $this->session->flashdata('vendorplanMsg') : '' ;
				?>
				<?php
				    if($this->ts_functions->getsettings('portal','revenuemodel') == 'subscription' ) {
                        if( $this->session->userdata['ts_planstatus'] == '0' ) {
                            echo 'Your current plan expired, renew to access products.';
                        }
				    }
				?>
				</p>	
				<div class="ts_download_table">
					<table class="table">
						<tr>
							<th><?php echo $this->ts_functions->getlanguage('freeprodtext','userdashboard','solo');?></th>
							<th><i class="fa fa-tags"></i></th>
							<th><?php echo $this->ts_functions->getlanguage('previewtext','userdashboard','solo');?></th>
							<th><?php echo $this->ts_functions->getlanguage('downloadtext','userdashboard','solo');?></th>
						</tr>
					<?php if(!empty($freeProducts)) {
					    foreach($freeProducts as $soloProd) {
					    $prodName = $this->ts_functions->getProductName($soloProd['prod_id']);
					?>
						<tr>
							<td data-title="<?php echo $this->ts_functions->getlanguage('freeprodtext','userdashboard','solo');?>"><p><?php echo $soloProd['prod_name'];?></p></td>

                            <td data-title="Categories"><p><?php echo $soloProd['cate_name'];?></p></td>

							<td data-title="<?php echo $this->ts_functions->getlanguage('previewtext','userdashboard','solo');?>"><span><a href="<?php echo $basepath;?>item/<?php echo $prodName.$soloProd['prod_uniqid'];?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
							</span></td>

							<td data-title="<?php echo $this->ts_functions->getlanguage('downloadtext','userdashboard','solo');?>"><span><a href="<?php echo $basepath;?>dashboard/free_download_product/<?php echo $soloProd['prod_uniqid'];?>"><i class="fa fa-download" aria-hidden="true"></i></a></span></td>
						</tr>
					<?php } } else { ?>

					<tr>
						<td colspan="4" align="center"> <?php echo $this->ts_functions->getlanguage('emptyfreetext','userdashboard','solo');?></td>
					</tr>

					<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Cart Table wrapper End -->

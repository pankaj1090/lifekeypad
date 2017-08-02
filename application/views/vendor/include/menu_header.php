<?php
		$urlpath = $_SERVER['REQUEST_URI'];
		$urlpath_arr = explode('vendorboard',$urlpath);
		$urlpath_arr1 = explode('products',$urlpath);
		$urlpath_arr3 = explode('sales_history',$urlpath);
		$urlpath_arr4 = explode('withdrawal',$urlpath);
		$urlpath_arr5 = explode('wallet_statement',$urlpath);
	?>
<div class="lk_pagebanner_wrapper">
	<div class="lk_pagebanner_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
				<div class="lk_dashboard_menu">
					<ul>
						<li <?php if($urlpath_arr[1] == '') { ?>class="active" <?php } ?>><a href="<?php echo $basepath;?>vendorboard"">Seller Board</a></li>
						<li <?php if(count($urlpath_arr1) == 2) { ?>class="active" <?php } ?>><a href="javascript:">Products</a>
							<ul class="lk_submenu">
								<li><a href="<?php echo $basepath;?>vendorboard/add_products_1">Add Products</a></li>
								<li><a href="<?php echo $basepath;?>vendorboard/manage_products">Manage Products</a></li>
							</ul>
						</li>
						<li <?php if(count($urlpath_arr3) == 2) { ?>class="active" <?php } ?>><a href="<?php echo $basepath;?>vendorboard/sales_history">Sales History</a></li>
						<li <?php if(count($urlpath_arr4) == 2) { ?>class="active" <?php } ?>><a href="<?php echo $basepath;?>vendorboard/withdrawal">Payment Received</a></li>
						<li <?php if(count($urlpath_arr5) == 2) { ?>class="active" <?php } ?>><a href="<?php echo $basepath;?>vendorboard/wallet_statement">Wallet Statement</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
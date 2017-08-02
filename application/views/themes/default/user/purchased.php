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
							<th><?php echo $this->ts_functions->getlanguage('producttext','userdashboard','solo');?></th>
							<th><?php echo $this->ts_functions->getlanguage('datetext','userdashboard','solo');?></th>
							<th><?php echo $this->ts_functions->getlanguage('purchasecodetext','userdashboard','solo');?></th>
							<th><?php echo $this->ts_functions->getlanguage('downloadtext','userdashboard','solo');?></th>
						</tr>
					<?php if(!empty($purchasedDetails)) {
					    foreach($purchasedDetails as $soloProd) {

					    $prodUniqid = $soloProd['prod_uniqid'];
					    $uid = $this->session->userdata('ts_uid');
                        $checkAvail = $this->ts_functions->checkproductavailablility($prodUniqid,$uid);

                        $transactionDetails = $this->DatabaseModel->access_database('ts_paymentdetails','select','',array('payment_uid'=>$uid,'payment_status'=>'yes'));
                        $purCodeText = '';
                        foreach($transactionDetails as $solo_transaction) {
                            $aArr = explode($prodUniqid,$solo_transaction['payment_pid']);
                            if( count($aArr) > 1 ) {
                                $purCodeText = $solo_transaction['payment_uniqid'];
                            }
                        }
                    ?>
						<tr>
							<td data-title="<?php echo $this->ts_functions->getlanguage('producttext','userdashboard','solo');?>"><p><?php echo $soloProd['prod_name'];?></p></td>
							<td data-title="<?php echo $this->ts_functions->getlanguage('datetext','userdashboard','solo');?>"><p>
							<?php echo isset($dateofplan) ? $dateofplan : date_format(date_create ( $soloProd['purrec_date'] ) , 'M d, Y') ; ?>
							</p></td>
							<!--<td data-title="<?php echo $this->ts_functions->getlanguage('purchasecodetext','userdashboard','solo');?>"><p><?php echo !isset($soloProd['purrec_purcode']) ? '-' : $soloProd['purrec_purcode']; ?></p></td>-->

							<td data-title="<?php echo $this->ts_functions->getlanguage('purchasecodetext','userdashboard','solo');?>"><p><?php echo ($purCodeText == '') ? '-' : $purCodeText; ?></p></td>


							<?php
							    if( isset($dateofplan) ) {
							        $fun = 'free_download_product';
							        $this->session->userdata['is_free']= 'yes';
							    }
							    else {
							        $fun = 'download_product' ;
							        $this->session->userdata['is_free']= 'no';
							    }

							?>
                            <?php
                           $dUrl = '<td data-title="'.$this->ts_functions->getlanguage('downloadtext','userdashboard','solo').'"><span><a href="'. $basepath.'dashboard/'.$fun.'/'.$soloProd['prod_uniqid'].'"><i class="fa fa-download" aria-hidden="true"></i></a> </span></td>';

                                echo ( $checkAvail == '1' ) ? $dUrl : '<td data-title="'.$this->ts_functions->getlanguage('downloadtext','userdashboard','solo').'"><span><i class="fa fa-ban" aria-hidden="true"></i> </span></td>' ;
                            ?>

						</tr>
					<?php } } else { ?>
						<tr>
                            <td colspan="4" align="center"> <?php echo $this->ts_functions->getlanguage('emptyproducttext','userdashboard','solo');?></td>
                        </tr>

					<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Cart Table wrapper End -->

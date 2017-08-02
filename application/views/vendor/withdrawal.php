<div class="lk_collection_single_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="lk_main_tab lk_anim anim_top" id="withdrawal">
                    <ul>
                        <li><a class="active" data-value="payment_detail">Payment Details</a></li>
                        <li><a  data-value="paypal_detail">Paypal</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="lk_amount_detail">
                            <p> <?php echo $this->ts_functions->getlanguage('amntreceivtext','vendorboard','solo');?>  <span><?php echo $this->ts_functions->getsettings('portal','curreny').' ';
                                    echo $withdrawalDetails_received[0]['totalReceivedAmount'] == '' ? 0 : $withdrawalDetails_received[0]['totalReceivedAmount'];
                                    ;?></span></p>
                        </div>
                    </div>
                    <?php
                        $totalCommission = $totalCommissionAmount;
                        $amountReceived = $withdrawalDetails_received[0]['totalReceivedAmount'];
                        $pendingAmount = $totalCommission - $amountReceived;
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="lk_amount_detail">
                            <p>Amount Pending <span><?php echo $this->ts_functions->getsettings('portal','curreny').' '.$pendingAmount;?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
         <div id="payment_detail" class="lk_paymentdiv">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="lk_product_table">
                    <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> <?php echo $this->ts_functions->getlanguage('amounttext','commontext','solo');?> </th>
                                <th> <?php echo $this->ts_functions->getlanguage('notestext','vendorboard','solo');?> </th>
                                <th> <?php echo $this->ts_functions->getlanguage('datetext','userdashboard','solo');?> </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->ts_functions->getlanguage('amounttext','commontext','solo');?></th>
                                <th><?php echo $this->ts_functions->getlanguage('notestext','vendorboard','solo');?></th>
                                <th><?php echo $this->ts_functions->getlanguage('datetext','userdashboard','solo');?></th>
                            </tr>
                        </tfoot>
                         <tbody>
                            <?php if(!empty($withdrawalReceivedDetails)) {
                                $count = 0;
                                foreach($withdrawalReceivedDetails as $soloreceived) {
                                $count++;
                            ?>
                                    <tr>
                                        <td><?php echo $count;?></td>
                                        <td><?php echo $soloreceived['venwith_text'];?></td>
                                        <td><?php echo $soloreceived['venwith_notes'];?></td>
                                        <td><?php echo date_format(date_create ( $soloreceived['venwith_date'] ) , 'M d, Y');?>
                                    </tr>
                            <?php } } ?>
                         </tbody>
                    </table>
                </div>
                
            </div>
           </div>

           <div id="paypal_detail" class="hide lk_paypaldiv">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
                <h5><?php echo $this->ts_functions->getlanguage('withdrawalinfotext','vendorboard','solo');?></h5>
				<div class="lk_basic_information_form">
					<div class="row">
						<div class="form-group">
							<div class="col-lg-3 col-md-3">
							<label>Paypal Email</label>
							</div>
							<div class="col-lg-9 col-md-9">
							<input type="text" class="form-control paypalSettings" id="paypal_email" value="<?php echo (isset($withdrawalDetails_paypal[0]['venwith_text'])) ? $withdrawalDetails_paypal[0]['venwith_text'] : '' ;?>">
							</div>
						</div>
					 </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="th_btn_wrapper">
                            <a onclick="updateWithdrawalSettings('paypalSettings')" class="lk_btn"><?php echo $this->ts_functions->getlanguage('updatebtntext','userdashboard','solo');?></a>
                        </div>
                    </div>
				</div>
                
           </div>
           

        </div>
    </div>
</div>
</div>
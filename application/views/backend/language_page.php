<div class="main_body">
		<!-- user content section -->
		<div class="theme_wrapper">
			<div class="container-fluid">
				<div class="theme_section">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="theme_page">

        <div class="theme_panel_section">
            <div class="panel-group theme_panel" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="one">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion4" aria-expanded="true" aria-controls="accordion4">
                                <?php echo (!empty($solo_lancate) ? 'Update Languages' : 'Add Languages');?>
                            </a>
                        </h4>
                    </div>
                    <div id="accordion4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="one">
                        <div class="panel-body">
                        <form action="<?php echo $basepath;?>backend/language_section" method="post" id="add_language_cate">
                        <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Language Name</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control add_language_cate" name="lanname" value="<?php echo (!empty($solo_lancate) ? $solo_lancate[0]['lancate_name'] : '');?>">
                            </div>
                        </div>

                         <div class="form-group">
                            <div class="col-lg-3 col-md-3">
                                <label>Language Symbol</label>
                            </div>

                            <div class="col-lg-6 col-md-6">
                            <input type="text" class="form-control add_language_cate" name="lansymbol" value="<?php echo (!empty($solo_lancate) ? $solo_lancate[0]['lancate_symbol'] : '');?>">
                            <span class="input_help_info">Just 2 Alphabets</span>
                            </div>
                        </div>
                        

                    <input type="hidden" value="<?php echo (!empty($solo_lancate) ? $solo_lancate[0]['lancate_id'] : '0');?>" name="old_lanid">

                        <div class="col-lg-12 col-md-12">
                            <div class="th_btn_wrapper">
                                <a onclick="updateSettings('add_language_cate')" class="btn theme_btn"><?php echo (!empty($solo_lancate) ? 'UPDATE' : 'ADD');?></a>
                            </div>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="two">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion1" aria-expanded="false" aria-controls="accordion1" class="collapsed">
                                Manage Languages
                            </a>
                        </h4>
                    </div>
                    <div id="accordion1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="two">
                        <div class="panel-body">

                        <div class="table-responsive">
								<table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Language</th>
											<th>Symbol</th>
											<th>Status</th>
											<th class="action">Action</th>
										</tr>
									<thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Language</th>
											<th>Symbol</th>
											<th>Status</th>
											<th class="action">Action</th>
										</tr>
									<tfoot>
									<tbody>
							<?php if(!empty($language_details)) {
							    $count = 0;
							    foreach($language_details as $solo_lancate) {
							    $cid = $solo_lancate['lancate_id'];
							    $count++;

						    ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $solo_lancate['lancate_name'];?></td>
										<td><?php echo $solo_lancate['lancate_symbol'];?></td>
										<td>
										<select onchange="updatethevalue(this,'language');" id="<?php echo $cid.'_status';?>">
										    <option value="1" <?php echo ($solo_lancate['lancate_status'] == '1' ? 'selected' : '' ); ?>>Active</option>
										    <option value="0" <?php echo ($solo_lancate['lancate_status'] == '0' ? 'selected' : '' ); ?>>In Active</option>
										</select></td>
										<td><p><a href="<?php echo $basepath;?>backend/language_section/<?php echo $cid;?>" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> </p></td>
									</tr>
							<?php } } ?>
									<tbody>
								</table>
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

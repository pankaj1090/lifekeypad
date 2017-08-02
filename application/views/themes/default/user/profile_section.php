
<div class="collection_popup">
<div class="lk_custompopup_wrapper">
    <div class="lk_popupdiv">
        <a href="" class="lk_closebtn">X</a>
        <h2>Create New Collection</h2>
        <div class="lk_newcollection_div">
            <form class="lk_collectionform" method="post" action="<?php echo $basepath.'dashboard/create_collection' ?>">
                <div class="form-group">
                    <input type="text" class="form-control" id="new_collection_name" name="new_collection_name" placeholder="Collection Name">
                    <input type="hidden" id="colllection_id" name="collection_id">
                </div>
                <div class="lk_btndiv">
                    <button class="lk_btn" type="submit" onclick="return create_collection()">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="lk_collection_profile">
    <div class="lk_cp_inner">
    <?php if( isset($this->session->userdata['ts_uid']) ) { ?>
     <?php if($this->session->userdata['ts_uid']==$userDetail[0]['user_id']){ ?>
        <div class="lk_cp_menu">
         
            
            <a  href="<?php echo base_url().'dashboard/profile' ?>" ><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="23.99px" height="24px" viewBox="0 0 23.99 24" enable-background="new 0 0 23.99 24" xml:space="preserve"><g><g><path fill="#FFFFFF" d="M22.763,9.481l-1.685-0.286c-0.175-0.566-0.4-1.113-0.677-1.634l0.992-1.389c0.422-0.591,0.356-1.399-0.16-1.91L19.74,2.768c-0.28-0.281-0.651-0.436-1.048-0.436c-0.311,0-0.605,0.095-0.856,0.276L16.442,3.6c-0.541-0.286-1.107-0.521-1.693-0.697l-0.281-1.664C14.348,0.521,13.731,0,13.005,0h-2.11c-0.727,0-1.343,0.521-1.463,1.239L9.141,2.943C8.58,3.119,8.033,3.349,7.513,3.63L6.134,2.637c-0.25-0.181-0.551-0.276-0.862-0.276c-0.396,0-0.771,0.156-1.047,0.436L2.727,4.292C2.215,4.803,2.145,5.61,2.565,6.202l1.003,1.409C3.292,8.137,3.072,8.684,2.901,9.25l-1.663,0.28C0.521,9.651,0,10.268,0,10.995v2.111c0,0.727,0.521,1.344,1.238,1.464l1.703,0.29c0.176,0.563,0.406,1.108,0.687,1.63l-0.986,1.374c-0.422,0.592-0.356,1.398,0.16,1.91l1.493,1.494c0.28,0.28,0.651,0.436,1.048,0.436c0.31,0,0.605-0.096,0.856-0.275l1.408-1.003c0.506,0.266,1.037,0.481,1.584,0.651l0.28,1.686C9.592,23.479,10.208,24,10.935,24h2.115c0.727,0,1.343-0.521,1.464-1.238l0.285-1.686c0.566-0.175,1.112-0.4,1.634-0.676l1.388,0.992c0.251,0.181,0.552,0.275,0.862,0.275c0.396,0,0.767-0.155,1.048-0.436l1.493-1.494c0.511-0.512,0.581-1.318,0.16-1.91l-0.992-1.395c0.275-0.525,0.506-1.072,0.677-1.634l1.684-0.28c0.717-0.121,1.238-0.738,1.238-1.465v-2.11C24,10.218,23.479,9.601,22.763,9.481z M22.651,13.055h-0.005c0,0.065-0.045,0.121-0.11,0.131l-2.104,0.352c-0.266,0.044-0.476,0.24-0.541,0.496c-0.19,0.736-0.481,1.443-0.872,2.1c-0.136,0.23-0.125,0.517,0.03,0.737l1.237,1.745c0.035,0.05,0.03,0.125-0.015,0.17l-1.493,1.494c-0.035,0.035-0.07,0.041-0.096,0.041c-0.03,0-0.055-0.011-0.075-0.025l-1.739-1.238c-0.215-0.156-0.506-0.166-0.736-0.03c-0.656,0.391-1.363,0.682-2.1,0.872c-0.261,0.065-0.456,0.281-0.496,0.541l-0.355,2.105c-0.011,0.066-0.065,0.111-0.131,0.111h-2.11c-0.064,0-0.12-0.045-0.13-0.111l-0.351-2.105c-0.045-0.266-0.241-0.476-0.496-0.541c-0.717-0.186-1.408-0.471-2.055-0.842c-0.105-0.061-0.226-0.091-0.341-0.091c-0.135,0-0.275,0.04-0.391,0.126L5.422,20.34c-0.024,0.015-0.05,0.025-0.075,0.025c-0.02,0-0.06-0.006-0.095-0.041l-1.493-1.494c-0.045-0.045-0.051-0.115-0.016-0.17l1.233-1.73c0.155-0.22,0.165-0.511,0.03-0.741c-0.392-0.651-0.692-1.358-0.883-2.096c-0.069-0.256-0.28-0.451-0.541-0.496l-2.119-0.361c-0.065-0.01-0.111-0.065-0.111-0.13v-2.111c0-0.065,0.046-0.12,0.111-0.13l2.089-0.351c0.266-0.045,0.481-0.241,0.547-0.501C4.284,9.275,4.57,8.563,4.956,7.907c0.136-0.23,0.12-0.517-0.035-0.732L3.674,5.42c-0.035-0.05-0.03-0.125,0.015-0.171l1.493-1.494c0.035-0.035,0.07-0.04,0.096-0.04c0.03,0,0.055,0.01,0.075,0.025l1.729,1.233c0.221,0.155,0.512,0.166,0.742,0.03c0.651-0.391,1.357-0.692,2.095-0.882c0.255-0.07,0.45-0.281,0.496-0.541l0.36-2.121c0.01-0.065,0.065-0.11,0.131-0.11h2.109c0.065,0,0.12,0.045,0.131,0.11l0.351,2.091c0.045,0.266,0.24,0.481,0.501,0.546c0.757,0.19,1.479,0.486,2.15,0.882c0.23,0.135,0.516,0.125,0.736-0.03l1.729-1.243c0.025-0.015,0.051-0.025,0.075-0.025c0.021,0,0.061,0.005,0.096,0.04l1.493,1.494c0.045,0.045,0.051,0.115,0.016,0.17l-1.238,1.74c-0.155,0.215-0.165,0.506-0.03,0.737c0.391,0.657,0.682,1.364,0.872,2.101c0.065,0.261,0.281,0.457,0.541,0.497l2.105,0.356c0.064,0.01,0.109,0.065,0.109,0.13V13.055z M11.997,6.818c-2.856,0-5.177,2.322-5.177,5.179c0,2.858,2.32,5.179,5.177,5.179s5.178-2.32,5.178-5.179C17.175,9.14,14.854,6.818,11.997,6.818z M11.997,15.823c-2.109,0-3.823-1.715-3.823-3.825c0-2.111,1.714-3.825,3.823-3.825c2.11,0,3.824,1.714,3.824,3.825C15.821,14.108,14.107,15.823,11.997,15.823z"/></g></g></svg> Profile Setting</a>
        </div>
        <?php } } ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 col-lg-offset-2 col-md-offset-1">
                    <div class="lk_cp_wrapper lk_anim anim_top">
                    <?php
                    $imgsrc=base_url().'webimage/dummy_testi.jpg';
                    if( $userDetail[0]['user_pic'] != '') {
					 $imgsrc=base_url().'webimage/'.$userDetail[0]['user_pic'];
				}  ?>
                        <div class="lk_cp_img">
                            <img src="<?php echo $imgsrc; ?>" alt="<?php echo $userDetail[0]['user_uname']; ?>" />
                        </div>
                        <div class="lk_cp_detail">
                            <h3><?php echo $userDetail[0]['user_uname']; ?></h3>
                            <div class="lk_cp_meta">
                                <ul>
                                    <li><a href="<?php echo $basepath.'timeline/'.$userDetail[0]['user_uname'].'/'.$userDetail[0]['user_id']; ?>"><?php echo  $this->my_model->aggregate_data('ts_posts','	post_id','count',array('post_uid'=>$userDetail[0]['user_id'])) ?> Posts</a></li>
                                   <li><a href="<?php echo base_url().'follower/'.$userDetail[0]['user_id'].'/'.$userDetail[0]['user_uname']; ?>"><?php echo  $this->my_model->aggregate_data('ts_follower','	fol_id','count',array('fol_follwing'=>$userDetail[0]['user_id'])) ?> Followers</a></li>
                                    <li><a href="<?php echo base_url().'following/'.$userDetail[0]['user_id'].'/'.$userDetail[0]['user_uname']; ?>"><?php echo  $this->my_model->aggregate_data('ts_follower','	fol_id','count',array('fol_follower'=>$userDetail[0]['user_id'])) ?> Following</a></li>
                                </ul>
                            </div>
                            <p><?php echo $userDetail[0]['user_text_status']; ?> </p>
                            <div class="lk_cp_follow">
                            <?php if( isset($this->session->userdata['ts_uid']) ) { ?>
                            <?php if($this->session->userdata['ts_uid']!=$userDetail[0]['user_id']){ ?>
                                <a onclick="follow(<?php echo $userDetail[0]['user_id'];  ?>)"  class="fl_big_btn">Follow</a>
                            <?php } }
						      $social_detail=json_decode($userDetail[0]['user_social'],true);
						      if(isset($social_detail[0]['facebook'])) echo '<a href="'.$social_detail[0]['facebook'].'" class="fl_small_btn facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
						      if(isset($social_detail[1]['twitter'])) echo '<a href="'.$social_detail[1]['twitter'].'" class="fl_small_btn twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';  
						  ?>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
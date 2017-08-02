
<div class="lk_section">
    <div class="container">
        <div class="row hide">
            <div class="col-md-12">
                <div class="lk_main_tab lk_anim anim_top">
                    <ul>
                        <li><a class="active" href="<?php echo $basepath.'collections/'.$userDetail[0]['user_uname'].'/'.$userDetail[0]['user_id']; ?>">Collection</a></li>
                        <li><a href="<?php echo $basepath.'timeline/'.$userDetail[0]['user_uname'].'/'.$userDetail[0]['user_id']; ?>">Timeline</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
        <?php if(!empty($collection)): ?>
         <?php foreach($collection as $single_collection): ?>   
            <div class="col-md-4">
                <div class="lk_collection_box">
                    <div class="lk_cb_image">
                    <?php
                    $join_array = array('ts_products','ts_products.prod_id = ts_collection_data.col_data_prod');
                    $productdetails=$this->my_model->select_data('prod_id,prod_name,prod_image','ts_collection_data',array('col_data_col'=>$single_collection['col_id']),'','','',$join_array);
                    if(!empty($productdetails)){
                        foreach($productdetails as $single_product){
                        if($single_product==''){
                        echo' <span>'.$single_product['name'].'</span>';
                       }else{
                         $dis_img=  $this->ts_functions->getProductPic($single_product['prod_id']);
                        echo ' <span><img src="'.$dis_img.'" alt="" /></span>';
                       }
                     }
                    }
                    $colName=$single_collection['col_name']; 
                     ?>
                       

                        <div class="lk_cb_overlay">
                            <div class="lk_cb_topAction">
                                <ul>
                                <?php if(isset($this->session->userdata['ts_uid'])){ ?>
                                <?php if($this->session->userdata['ts_uid']==$single_collection['col_user'] && $single_collection['col_type']==0){?>
                                    <li>
                                        <a onclick="open_create_collection('<?php echo $single_collection['col_name']; ?>',<?php echo $single_collection['col_id'];?>)">
                                            <svg version="1.1" x="0px" y="0px" width="18.004px" height="18.017px" viewBox="0 0 18.004 18.017" enable-background="new 0 0 18.004 18.017" xml:space="preserve"><path fill="#FFFFFF" d="M16.838,1.166c-1.55-1.555-4.07-1.555-5.62,0L0.915,11.475c-0.081,0.08-0.131,0.185-0.146,0.296L0.005,17.43c-0.023,0.161,0.034,0.322,0.146,0.434c0.096,0.096,0.23,0.153,0.364,0.153c0.023,0,0.046,0,0.069-0.004l3.406-0.461c0.284-0.038,0.483-0.299,0.445-0.583c-0.039-0.284-0.299-0.484-0.583-0.445l-2.731,0.368l0.533-3.946l4.151,4.153c0.096,0.097,0.23,0.154,0.364,0.154s0.269-0.054,0.364-0.154L16.838,6.791c0.752-0.752,1.166-1.75,1.166-2.814C18.004,2.913,17.59,1.915,16.838,1.166z M11.417,2.433l1.73,1.731l-9.402,9.41l-1.73-1.731L11.417,2.433z M6.174,16.001l-1.692-1.693l9.402-9.41l1.692,1.693L6.174,16.001z M16.297,5.85l-4.139-4.143c0.525-0.434,1.182-0.672,1.872-0.672c0.786,0,1.522,0.307,2.079,0.86c0.556,0.553,0.859,1.294,0.859,2.081C16.969,4.671,16.731,5.324,16.297,5.85z"/></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="delete_collection(<?php echo $single_collection['col_id']; ?>)">
                                            <svg version="1.1" x="0px" y="0px" width="15px" height="18px" viewBox="0 0 15 18" enable-background="new 0 0 15 18" xml:space="preserve"><g><g><path fill="#FFFFFF" d="M13.181,0.449H9.203C9.112,0.188,8.87,0,8.585,0h-2.17C6.13,0,5.888,0.188,5.796,0.449H1.819C0.816,0.449,0,1.29,0,2.323v1.705c0,0.375,0.295,0.678,0.658,0.678h1.236v12.616C1.895,17.696,2.189,18,2.553,18h9.894c0.364,0,0.658-0.304,0.658-0.678V4.706h1.237C14.705,4.706,15,4.403,15,4.028V2.324C15,1.29,14.184,0.449,13.181,0.449z M11.789,16.645H3.211V4.706h8.578V16.645z M13.684,3.351H1.315V2.324c0-0.287,0.227-0.52,0.504-0.52h11.361c0.277,0,0.503,0.232,0.503,0.52V3.351z M5.775,14.306c0.363,0,0.658-0.303,0.658-0.678V6.486c0-0.374-0.295-0.678-0.658-0.678S5.118,6.112,5.118,6.486v7.142C5.118,14.003,5.412,14.306,5.775,14.306z M9.224,14.306c0.363,0,0.658-0.303,0.658-0.678V6.486c0-0.374-0.295-0.678-0.658-0.678S8.566,6.112,8.566,6.486v7.142C8.566,14.003,8.86,14.306,9.224,14.306z"/></g></g></svg>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php } ?>
                                       <li>
                                        <div class="lk_sharediv">
                                             <a href="#" class="lk_sharebtn"><svg version="1.1" x="0px" y="0px" width="17.985px" height="17.999px" viewBox="0 0 17.985 17.999" enable-background="new 0 0 17.985 17.999" xml:space="preserve"><path fill="#FFFFFF" d="M14.679,11.439c-1.051,0-1.977,0.497-2.582,1.257L6.482,9.848C6.556,9.577,6.609,9.295,6.609,9 c0-0.322-0.063-0.625-0.15-0.92l5.589-2.835c0.602,0.794,1.552,1.313,2.631,1.313c1.828,0,3.307-1.467,3.307-3.278  C17.985,1.468,16.507,0,14.679,0c-1.824,0-3.305,1.468-3.305,3.279c0,0.296,0.053,0.578,0.127,0.851L5.89,6.979 c-0.606-0.762-1.534-1.26-2.586-1.26C1.478,5.719,0,7.188,0,9s1.478,3.278,3.304,3.278c1.081,0,2.03-0.52,2.635-1.316l5.586,2.836 c-0.088,0.294-0.15,0.6-0.15,0.922c0,1.811,1.48,3.279,3.305,3.279c1.828,0,3.307-1.469,3.307-3.279  C17.985,12.907,16.507,11.439,14.679,11.439z"/></svg></a>
                                            <div class="lk_shareicon">
                                                <ul>
                                                 <li><a class="fa_share" onclick="site_share(<?php echo $single_collection['col_id']; ?>,'collection')"  ><i class="fa fa-share" aria-hidden="true"></i></a></li>
                                                    <li><a href="https://www.facebook.com/sharer/sharer.php?display=popup&u=<?php echo urlencode($basepath.'collection/'.$colName.'/'.$single_collection['col_id']);?>" class="fa_clr"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a class="fa_twt" href="http://twitter.com/share?type=popup&url=<?php echo urlencode($basepath.'collection/'.$colName.'/'.$single_collection['col_id']);?>&text=<?php echo urlencode($single_collection['col_name']);?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="lk_cb_centerAction">
                                <a href="<?php echo $basepath.'collection/'.$this->ts_functions->getUrlName($single_collection['col_name']).$single_collection['col_id']; ?>">View</a>
                            </div>
                            <div class="lk_cb_bottomAction">
                                <span><svg version="1.1" x="0px" y="0px" width="26px" height="15px" viewBox="0 0 26 15" enable-background="new 0 0 26 15" xml:space="preserve"><g><g><path fill="#FFFFFF" d="M25.578,6.254c-1.459-1.904-3.349-3.479-5.466-4.555c-2.16-1.098-4.485-1.667-6.912-1.698C13.134,0,12.866,0,12.799,0.001c-2.426,0.03-4.751,0.6-6.912,1.698C3.771,2.774,1.881,4.35,0.421,6.254c-0.562,0.733-0.562,1.758,0,2.491c1.459,1.904,3.35,3.479,5.466,4.556c2.161,1.098,4.485,1.667,6.912,1.697c0.067,0.002,0.335,0.002,0.402,0c2.426-0.03,4.751-0.6,6.912-1.697c2.117-1.076,4.007-2.651,5.466-4.556C26.141,8.012,26.141,6.987,25.578,6.254z M6.36,12.337c-1.977-1.004-3.741-2.475-5.104-4.253c-0.264-0.344-0.264-0.824,0-1.168c1.363-1.779,3.127-3.25,5.104-4.254C6.921,2.377,7.495,2.13,8.078,1.921C6.576,3.296,5.63,5.287,5.63,7.5c0,2.212,0.946,4.204,2.449,5.578C7.495,12.869,6.921,12.623,6.36,12.337z M13,13.924c-3.48,0-6.313-2.882-6.313-6.424S9.52,1.075,13,1.075s6.313,2.882,6.313,6.425C19.313,11.042,16.48,13.924,13,13.924z M24.744,8.084c-1.362,1.778-3.128,3.249-5.104,4.253c-0.561,0.285-1.133,0.531-1.717,0.739c1.502-1.374,2.447-3.365,2.447-5.577c0-2.212-0.946-4.205-2.449-5.579c0.584,0.209,1.158,0.456,1.719,0.741c1.977,1.004,3.742,2.475,5.104,4.254C25.008,7.26,25.008,7.74,24.744,8.084z M13,4.75c-1.49,0-2.701,1.233-2.701,2.749c0,1.516,1.211,2.75,2.701,2.75c1.489,0,2.701-1.233,2.701-2.75C15.701,5.984,14.489,4.75,13,4.75z M13,9.173c-0.906,0-1.644-0.751-1.644-1.673S12.094,5.827,13,5.827s1.644,0.75,1.644,1.673S13.906,9.173,13,9.173z"/></g></g></svg> 178 Views</span>
                            </div>
                        </div>
                    </div>
                    <div class="lk_cb_detail">
                        <p><?php echo $single_collection['col_name']; ?></p>
                    </div>
                </div>
            </div>
        <?php    endforeach; ?>
        <?php endif; ?>
            <div class="col-md-4">
                <div class="lk_collection_box_create">
                    <div class="lk_cb_image">
                        <img src="<?php echo $basepath;?>themes/default/images/create_new_collection.png" alt="" />
                        <div class="lk_cb_overlay">
                            <div class="lk_cb_centerAction">
                                <a onclick="open_create_collection()">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="lk_cb_detail">
                        <p>Create New Collection</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
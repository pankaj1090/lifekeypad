<div class="lk_collection_single_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="lk_section_title lk_anim anim_top">
                    <h3>Add Products ( Step 1 )</h3>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="lk_addproduct_form">
                    <form>
                        <div class="row">
                        
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Product Type</label>
                                    <select class="form-control productfields" id="p_type">
                                        <option value="Audio" <?php if( isset($productdetails) ){ echo ($productdetails[0]['prod_type'] == 'Audio') ? 'selected' :''; };?> >Audio Book</option>
                                        <option value="Ebook" <?php if( isset($productdetails) ){ echo ($productdetails[0]['prod_type'] == 'Ebook') ? 'selected' :''; };?> >Ebook</option>
                                        <option value="Video" <?php if( isset($productdetails) ){ echo ($productdetails[0]['prod_type'] == 'Video') ? 'selected' :''; };?>>Video</option>
                                        <option value="Text" <?php if( isset($productdetails) ){ echo  ($productdetails[0]['prod_type'] == 'Text') ? 'selected' :''; };?>>Text</option>
                                        <option value="Other" <?php if( isset($productdetails) ){ echo ($productdetails[0]['prod_type'] == 'Other') ? 'selected' :''; };?>>Others</option>
                                   </select>  
                                </div>
                            </div>                          
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Product Language</label>
                                    <select class="form-control productfields" id="p_language">
                                     <option value="0">Choose one</option>
                                     <?php
                                     foreach($language_details as $solo_lan) {
                                        if( isset($productdetails) ) {
                                            $selected = ($productdetails[0]['prod_language'] == $solo_lan['lancate_name']) ? 'selected' : '' ;
                                        }
                                        else {
                                            $selected = '';
                                        }
                                        echo '<option value="'.$solo_lan['lancate_name'].'" '.$selected.'>'.$solo_lan['lancate_name'].'</option>';
                                      } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control productfields" id="p_name" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_name']; } ?>">
                                    <span class="input_help_info hide">Name , will be displayed to customers.</span>
                                    <span class="p_name_counter name_counter hide"> <?php if(isset($productdetails)) { echo 80 - strlen($productdetails[0]['prod_name']); } else { echo 80;} ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>URL Name</label>
                                    <input type="text" class="form-control productfields" id="p_urlname" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_urlname']; } ?>">
                                    <span class="input_help_info hide">URL Name can have hyphen(-), space( ), numbers(0-9) but not other special characters.<br/> This will be used for links and URLs.</span>
                                    <span class="p_name_counter urlname_counter hide"> <?php if(isset($productdetails)) { echo 80 - strlen($productdetails[0]['prod_urlname']); } else { echo 80;} ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <select class="form-control productfields" id="p_category" onchange="getSubCategories(this)">
                                     <option value="0">Choose one</option>
                                     <?php
                                     foreach($categoryList as $soloCate) {
                                        if( isset($productdetails) ) {
                                            $selected = ($productdetails[0]['prod_cateid'] == $soloCate['cate_id']) ? 'selected' : '' ;
                                        }
                                        else {
                                            $selected = '';
                                        }
                                        echo '<option value="'.$soloCate['cate_id'].'" '.$selected.'>'.$soloCate['cate_name'].'</option>';
                                      } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Product Sub Category</label>
                                    <?php
                                        if( isset($productdetails) ) {
                                            $subCate = $this->DatabaseModel->access_database('ts_subcategories','select','',array('sub_parent'=>$productdetails[0]['prod_cateid']));
                                        }
                                        else {
                                            $subCate = '';
                                        }

                                    ?>
                                    <select class="form-control rest_fields" id="p_subcategory">
                                     <option value="0">Choose one</option>
                                     <?php
                                     if(!empty($subCate)) {
                                     foreach($subCate as $solo_subCate) {
                                        if( isset($productdetails) ) {
                                            $selected = ($productdetails[0]['prod_subcateid'] == $solo_subCate['sub_id']) ? 'selected' : '' ;
                                        }
                                        else {
                                            $selected = '';
                                        }
                                        echo '<option value="'.$solo_subCate['sub_id'].'" '.$selected.'>'.$solo_subCate['sub_name'].'</option>';
                                      }
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Read By</label>
                                   <input type="text" class="form-control rest_fields" id="p_readby" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_readby']; } ?>" placeholder="read by">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Written by</label>
                                    <input type="text" class="form-control rest_fields" id="p_writter" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_writter']; } ?>" placeholder="written by">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Runtime</label>
                                    <input type="text" class="form-control rest_fields" id="p_runtime" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_runtime']; } ?>"  placeholder="7:43 Hours">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Recording</label>
                                    <input type="text" class="form-control rest_fields" id="p_recording" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_recording']; } ?>" placeholder="Awesome Studios">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Publisher</label>
                                    
                                    <input type="text" class="form-control rest_fields" id="p_publisher" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_publisher']; } ?>"  placeholder="Publisher Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>ISBN - 13</label>
                                    <input type="text" class="form-control rest_fields" id="p_isbn" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_isbn']; } ?>"  placeholder="00000">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Tags</label>
                                    <textarea rows="5" class="form-control rest_fields" id="p_tags"><?php if(isset($productdetails)) { echo $productdetails[0]['prod_tags']; } ?></textarea>
                                    <span class="input_help_info">Separate each tag by comma (,)</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="8" class="form-control rest_fields" id="p_description"><?php if(isset($productdetails)) { echo $productdetails[0]['prod_description']; } ?></textarea>
                                    <span class="input_help_info">Paste HTML content here</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Youtube preview link</label>
                                    <input type="text" class="form-control rest_fields" id="p_demourl" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_demourl']; } ?>"  placeholder="http://">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Product download link</label>
                                    <input type="text" class="form-control rest_fields" placeholder="http://" id="p_downlink" value="<?php if(isset($productdetails)) {  if( strpos($productdetails[0]['prod_filename'],'/') !== false ) { echo $productdetails[0]['prod_filename']; } } ?>">
                                    <span class="input_help_info">Any server URL which customer will get redirected when tries to download the product  </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Price </label>
                                    <input type="text" class="form-control" id="p_price" value="<?php if(isset($productdetails)) { echo $productdetails[0]['prod_price']; } ?>">
                                    <span class="input_help_info">Just the number </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Make product FREE for all</label>
                                     <input type="checkbox" class="lk_custom_checkbox" id="p_free" value="1" <?php if(isset($productdetails)) { echo ($productdetails[0]['prod_free'] == '1') ? 'checked' : '' ; } ?> >
                                    <input type="text" class="form-control lk_checkbox_feild" readonly value="FREE">
                                <span class="input_help_info">It will overwrite all other Price or plan settings.</span><br/>
                                <span class="input_help_info" style="color:#f0ad4e;">User can access this product after registration only.</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <?php $btnText = (isset($productdetails) ? 'UPDATE  ( Step 1 )' : 'ADD  ( Step 1 )' );?>
                                
                                <a class="lk_btn" onclick="addproductsbutton(this)"><?php echo $btnText; ?></a>
                                <input type="hidden" id="oldprod_id" class="rest_fields" value="<?php echo $oldprod_id;?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
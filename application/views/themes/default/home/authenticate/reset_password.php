<script>
function open_window(url){
    var w = 880, h = 600,
        left = Number((screen.width/2)-(w/2)), tops = Number((screen.height/2)-(h/2)),
        popupWindow = window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=1, copyhistory=no, width='+w+', height='+h+', top='+tops+', left='+left);
    popupWindow.focus(); return false;
}
</script>
<div class="lk_authentication">
    <div class="lk_auth_inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6 left" id="resetpwd_typepage">
                    <div>
                        <h1>Explore <br>The World of <span>Audiobooks</span></h1>
                        <p>Login with Social Media</p>
                        <div class="social_login_btn">
                            <?php if( $this->ts_functions->getsettings('facebook','status') == '1' ) { ?>
                            <a href="javascript:" class="facebook" onclick="open_window('<?php echo $basepath;?>authenticate/facebooklogin');"><i class="fa fa-facebook"></i> Login with Facebook</a>
                         <?php } if( $this->ts_functions->getsettings('google','status') == '1' ) { ?>
                            <a href="javascript:" class="google_plus" onclick="open_window('<?php echo $basepath;?>authenticate/googlelogin');"><i class="fa fa-google-plus"></i> Login with Google +</a>
                           <?php } ?> 
                        </div>
                    </div>
                </div>
                <div class="col-md-6 right">
                    <div>
                        <br><br><br><br>
                        <h3>Reset Password</h3>
                        <div class="lk_input_wrapper with_icon">
                            <input type="password" placeholder="<?php echo $this->ts_functions->getlanguage('logpwdtext','authentication','solo');?>" id="users_pwd" name="users_pwd" class="form-control validate pwd">
                            <span class="icon">
                               <svg version="1.1" x="0px" y="0px" width="15px" height="20px" viewBox="0 0 15 20" enable-background="new 0 0 15 20" xml:space="preserve"><g><g><path fill="#616488" d="M7.5,10.808c-1.131,0-2.05,0.891-2.05,1.984c0,0.543,0.232,1.067,0.64,1.441v1.792c0,0.753,0.633,1.365,1.41,1.365s1.41-0.612,1.41-1.365v-1.792c0.406-0.373,0.64-0.898,0.64-1.441C9.55,11.698,8.63,10.808,7.5,10.808z M8.226,13.537c-0.196,0.179-0.309,0.429-0.309,0.686v1.803c0,0.223-0.187,0.404-0.417,0.404s-0.418-0.182-0.418-0.404v-1.803c0-0.257-0.111-0.507-0.308-0.686c-0.214-0.195-0.332-0.46-0.332-0.745c0-0.564,0.475-1.023,1.058-1.023s1.057,0.459,1.057,1.023C8.557,13.077,8.439,13.342,8.226,13.537z M13.511,8.198h-1.489v-3.82C12.021,1.964,9.993,0,7.5,0S2.979,1.964,2.979,4.378v3.82H1.489C0.668,8.198,0,8.845,0,9.64v8.919C0,19.354,0.668,20,1.489,20h12.021C14.332,20,15,19.354,15,18.559V9.64C15,8.845,14.332,8.198,13.511,8.198z M3.971,4.378c0-1.884,1.583-3.417,3.529-3.417c1.945,0,3.528,1.533,3.528,3.417v3.82H3.971V4.378z M14.007,18.559c0,0.265-0.223,0.48-0.496,0.48H1.489c-0.274,0-0.497-0.216-0.497-0.48V9.64c0-0.265,0.223-0.48,0.497-0.48h12.021c0.273,0,0.496,0.216,0.496,0.48V18.559z"/></g></g></svg>
                            </span>
                        </div>
                         <div class="lk_input_wrapper with_icon">
                            <input type="password" placeholder="<?php echo $this->ts_functions->getlanguage('logconfirmpwdtext','authentication','solo');?>" id="users_repwd" class="form-control validate repwd">
                            <input type="hidden" id="pwdKey" value="<?php echo $pwdKey; ?>">
                            <span class="icon">
                                <svg version="1.1" x="0px" y="0px" width="15px" height="20px" viewBox="0 0 15 20" enable-background="new 0 0 15 20" xml:space="preserve"><g><g><path fill="#616488" d="M7.5,10.808c-1.131,0-2.05,0.891-2.05,1.984c0,0.543,0.232,1.067,0.64,1.441v1.792c0,0.753,0.633,1.365,1.41,1.365s1.41-0.612,1.41-1.365v-1.792c0.406-0.373,0.64-0.898,0.64-1.441C9.55,11.698,8.63,10.808,7.5,10.808z M8.226,13.537c-0.196,0.179-0.309,0.429-0.309,0.686v1.803c0,0.223-0.187,0.404-0.417,0.404s-0.418-0.182-0.418-0.404v-1.803c0-0.257-0.111-0.507-0.308-0.686c-0.214-0.195-0.332-0.46-0.332-0.745c0-0.564,0.475-1.023,1.058-1.023s1.057,0.459,1.057,1.023C8.557,13.077,8.439,13.342,8.226,13.537z M13.511,8.198h-1.489v-3.82C12.021,1.964,9.993,0,7.5,0S2.979,1.964,2.979,4.378v3.82H1.489C0.668,8.198,0,8.845,0,9.64v8.919C0,19.354,0.668,20,1.489,20h12.021C14.332,20,15,19.354,15,18.559V9.64C15,8.845,14.332,8.198,13.511,8.198z M3.971,4.378c0-1.884,1.583-3.417,3.529-3.417c1.945,0,3.528,1.533,3.528,3.417v3.82H3.971V4.378z M14.007,18.559c0,0.265-0.223,0.48-0.496,0.48H1.489c-0.274,0-0.497-0.216-0.497-0.48V9.64c0-0.265,0.223-0.48,0.497-0.48h12.021c0.273,0,0.496,0.216,0.496,0.48V18.559z"/></g></g></svg>
                            </span>
                        </div>
                        <a href="javascript:" onclick="checkformvalidation();" class="auth_btn"><?php echo $this->ts_functions->getlanguage('submittext','authentication','solo');?> </a>
                        <p><?php echo $this->ts_functions->getlanguage('logbottomtext','authentication','solo');?> <a href="<?php echo $basepath; ?>authenticate/register"><?php echo $this->ts_functions->getlanguage('logbottomhreftext','authentication','solo');?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
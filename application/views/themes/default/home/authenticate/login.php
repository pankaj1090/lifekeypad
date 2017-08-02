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
                <div class="col-md-6 left">
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
                <div class="col-md-6 right" id="login_typepage">
                    <div>
                        <h3>Login</h3>
                        <div class="lk_input_wrapper with_icon">
                            <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('logusernametext','authentication','solo');?>" id="users_uname" class="form-control validate" value="<?php if(isset($_COOKIE['ts_emanu'])){ echo $_COOKIE['ts_emanu'];} ?>"/>
                            <span class="icon">
                                <svg version="1.1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve"><path fill="#616488" d="M17.069,2.93C15.181,1.041,12.672,0,10,0S4.819,1.041,2.93,2.93C1.041,4.82,0,7.328,0,10c0,2.672,1.041,5.18,2.93,7.07C4.819,18.959,7.328,20,10,20c1.627,0,3.237-0.397,4.668-1.156c0.36-0.188,0.496-0.635,0.308-0.996c-0.188-0.359-0.636-0.495-0.996-0.307c-1.218,0.644-2.591,0.983-3.979,0.983c-4.701,0-8.524-3.823-8.524-8.524c0-4.701,3.823-8.524,8.524-8.524S18.524,5.299,18.524,10c0,1.582-0.442,2.483-0.815,2.959c-0.397,0.512-0.931,0.803-1.463,0.803c-0.742,0-1.492-0.59-1.492-1.909V6.11c0-0.405-0.332-0.737-0.737-0.737c-0.406,0-0.738,0.332-0.738,0.737v0.324c-0.918-0.922-2.185-1.492-3.586-1.492C6.901,4.938,4.631,7.209,4.631,10s2.271,5.062,5.062,5.062c0.496,0,0.983-0.069,1.451-0.214c0.39-0.114,0.61-0.527,0.496-0.918c-0.115-0.389-0.529-0.61-0.919-0.495c-0.331,0.099-0.68,0.151-1.028,0.151c-1.976,0-3.586-1.606-3.586-3.586c0-1.976,1.606-3.586,3.586-3.586S13.278,8.021,13.278,10v1.853c0,2.222,1.492,3.386,2.968,3.386c0.987,0,1.946-0.5,2.627-1.373C19.61,12.918,20,11.582,20,10C20,7.328,18.959,4.82,17.069,2.93z"/></svg>
                            </span>
                        </div>
                        <div class="lk_input_wrapper with_icon">
                            <input type="password" placeholder="<?php echo $this->ts_functions->getlanguage('logpwdtext','authentication','solo');?>" id="users_pwd" class="form-control validate pwd" value="<?php if(isset($_COOKIE['ts_dwp'])){ echo $_COOKIE['ts_dwp'];} ?>"/>
                            <span class="icon">
                                <svg version="1.1" x="0px" y="0px" width="15px" height="20px" viewBox="0 0 15 20" enable-background="new 0 0 15 20" xml:space="preserve"><g><g><path fill="#616488" d="M7.5,10.808c-1.131,0-2.05,0.891-2.05,1.984c0,0.543,0.232,1.067,0.64,1.441v1.792c0,0.753,0.633,1.365,1.41,1.365s1.41-0.612,1.41-1.365v-1.792c0.406-0.373,0.64-0.898,0.64-1.441C9.55,11.698,8.63,10.808,7.5,10.808z M8.226,13.537c-0.196,0.179-0.309,0.429-0.309,0.686v1.803c0,0.223-0.187,0.404-0.417,0.404s-0.418-0.182-0.418-0.404v-1.803c0-0.257-0.111-0.507-0.308-0.686c-0.214-0.195-0.332-0.46-0.332-0.745c0-0.564,0.475-1.023,1.058-1.023s1.057,0.459,1.057,1.023C8.557,13.077,8.439,13.342,8.226,13.537z M13.511,8.198h-1.489v-3.82C12.021,1.964,9.993,0,7.5,0S2.979,1.964,2.979,4.378v3.82H1.489C0.668,8.198,0,8.845,0,9.64v8.919C0,19.354,0.668,20,1.489,20h12.021C14.332,20,15,19.354,15,18.559V9.64C15,8.845,14.332,8.198,13.511,8.198z M3.971,4.378c0-1.884,1.583-3.417,3.529-3.417c1.945,0,3.528,1.533,3.528,3.417v3.82H3.971V4.378z M14.007,18.559c0,0.265-0.223,0.48-0.496,0.48H1.489c-0.274,0-0.497-0.216-0.497-0.48V9.64c0-0.265,0.223-0.48,0.497-0.48h12.021c0.273,0,0.496,0.216,0.496,0.48V18.559z"/></g></g></svg>
                            </span>
                        </div>
                        <div class="lk_input_wrapper text-left">
                            <div class="lk_checkbox">
                                <input type="checkbox" id="remember_me"  <?php if(isset($_COOKIE['ts_dwp'])){ echo "checked";} ?> />
                                <label for="remember_me">Remember me</label>
                            </div>
                            <a href="<?php echo $basepath;?>authenticate/forgot_password" class="pull-right forgot_pass"><?php echo $this->ts_functions->getlanguage('logforgotpwdtext','authentication','solo');?></a>
                        </div>
                        <a onclick="checkformvalidation();" class="auth_btn"><?php echo $this->ts_functions->getlanguage('logintext','commontext','solo');?></a>
                        <p> <?php echo $this->ts_functions->getlanguage('logbottomtext','authentication','solo');?> <a href="<?php echo $basepath; ?>authenticate/register"><?php echo $this->ts_functions->getlanguage('logbottomhreftext','authentication','solo');?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
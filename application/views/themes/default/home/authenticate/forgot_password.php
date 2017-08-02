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
                <div class="col-md-6 left" id="forgotpwd_typepage">
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
                        <h3>Forgot Password</h3>
                        <div class="lk_input_wrapper with_icon">
                            <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('fgpwdinputtext','authentication','solo');?>" id="users_uname" class="form-control validate">
                            <span class="icon">
                                <svg version="1.1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve"><path fill="#616488" d="M17.069,2.93C15.181,1.041,12.672,0,10,0S4.819,1.041,2.93,2.93C1.041,4.82,0,7.328,0,10c0,2.672,1.041,5.18,2.93,7.07C4.819,18.959,7.328,20,10,20c1.627,0,3.237-0.397,4.668-1.156c0.36-0.188,0.496-0.635,0.308-0.996c-0.188-0.359-0.636-0.495-0.996-0.307c-1.218,0.644-2.591,0.983-3.979,0.983c-4.701,0-8.524-3.823-8.524-8.524c0-4.701,3.823-8.524,8.524-8.524S18.524,5.299,18.524,10c0,1.582-0.442,2.483-0.815,2.959c-0.397,0.512-0.931,0.803-1.463,0.803c-0.742,0-1.492-0.59-1.492-1.909V6.11c0-0.405-0.332-0.737-0.737-0.737c-0.406,0-0.738,0.332-0.738,0.737v0.324c-0.918-0.922-2.185-1.492-3.586-1.492C6.901,4.938,4.631,7.209,4.631,10s2.271,5.062,5.062,5.062c0.496,0,0.983-0.069,1.451-0.214c0.39-0.114,0.61-0.527,0.496-0.918c-0.115-0.389-0.529-0.61-0.919-0.495c-0.331,0.099-0.68,0.151-1.028,0.151c-1.976,0-3.586-1.606-3.586-3.586c0-1.976,1.606-3.586,3.586-3.586S13.278,8.021,13.278,10v1.853c0,2.222,1.492,3.386,2.968,3.386c0.987,0,1.946-0.5,2.627-1.373C19.61,12.918,20,11.582,20,10C20,7.328,18.959,4.82,17.069,2.93z"/></svg>
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
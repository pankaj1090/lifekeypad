</div>
<!--main wrapper end-->

<!-- Error Messages Start -->
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('username','message','solo');?>" id="usernameerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('usernameexists','message','solo');?>" id="usernameexists_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('emailexists','message','solo');?>" id="emailexists_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('email','message','solo');?>" id="emailerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('empty','message','solo');?>" id="emptyerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('password','message','solo');?>" id="pwderr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('repassword','message','solo');?>" id="repwderr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('loginsuc','message','solo');?>" id="loginsuc_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('forgotpassword','message','solo');?>" id="forgotpwdsuc_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('registersuc','message','solo');?>" id="registersuc_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('activateerror','message','solo');?>" id="actvtacnt_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('blockederror','message','solo');?>" id="blockacnt_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('loginerror','message','solo');?>" id="loginerr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('forgotpwderror','message','solo');?>" id="forgotpwderr_text">
<input type="hidden" value="<?php echo $this->ts_functions->getlanguage('resetpwdsuc','message','solo');?>" id="pwdchngsuc_text">

<!-- Error Messages End -->

<!-- site jquery start -->
<input type="hidden" value="<?php echo $basepath; ?>" id="basepath">
<script src="<?php echo $basepath;?>themes/default/js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo $basepath;?>themes/default/js/authenticate/custom_login.js"></script>
<!-- site jquery end -->

</body>
</html> 
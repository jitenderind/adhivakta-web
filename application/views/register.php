<script src="<?php echo base_url(); ?>assets/plugins/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/parsley/parsley.remote.min.js"></script>
<link href="<?php echo base_url(); ?>assets/plugins/parsley/parsley.css" rel="stylesheet"/>
<?php 
$user_type="advocate";
$plan_type="demo";
$staff=($_GET['s'])?base64_decode(base64_decode(base64_decode($_GET['s']))):0;
?>
<div class="auth_reg animated slideInRight">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-signup">
                    <h2 class="card-title text-center">Register</h2>
                     <form class="col-lg-12" id="sign_up_frm" method="POST" action="<?php echo base_url(); ?>register" data-parsley-validate >
                    <div class="row">
                        <div class="col-md-5 offset-md-1 d-none d-sm-block">
                            <div class="form-group-ap form-float">
                                    <div class="form-line-ap">
                                        <input type="text" name="first_name" class="form-control" tabindex="1" aria-describedby="name-format" required="" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-required-message="Please input your first name">
                                        <label class="form-label">First Name</label>
                                    </div>
                                </div>
                                <div class="form-group-ap form-float">
                                    <div class="form-line-ap">
                                        <input type="email" name="email" class="form-control" tabindex="3" required="" data-parsley-trigger="keyup" data-parsley-type="email" data-parsley-required-message="Please input your valid email">
                                        <label class="form-label">Email</label>
                                    </div>
                                    <div class="form-group-ap form-float">
                                    <div class="form-line-ap">
                                        <input type="password" id="password" name="password" class="form-control" tabindex="5" required="" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-required-message="must be more than 5 characters">
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-12 m-t-20">
                    Already have account? <a href="/login" class="">Log in</a>
                </div>
                        </div>
                        <div class="col-md-5">
                           
                                <div class="form-group-ap form-float">
                                    <div class="form-line-ap">
                                        <input type="text" class="form-control" name="last_name" tabindex="2" required="" data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$" data-parsley-required-message="Please input your last name">
                                        <label class="form-label">Last Name</label>
                                    </div>
                                </div>
                                <div class="form-group-ap form-float">
                                    <div class="form-line-ap">
                                        <input type="text" class="form-control" name="mobile" tabindex="4" required="" data-parsley-trigger="keyup" data-parsley-minlength="10" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" data-parsley-required-message="Please input your mobile number">
                                        <label class="form-label">Phone Number</label>
                                    </div>
                                </div>
                                <div class="form-group-ap form-float">
                                    <div class="form-line-ap">
                                        <input type="password" name="confirm_password" class="form-control" tabindex="6" required="" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-equalto="#password" data-parsley-required-message="must be more than 5 characters">
                                        <label class="form-label">Confirm Password</label>
                                    </div>
                                </div>
                                <div class="m-b-30 text-center m-t-20">
                                    <input type="hidden" name="user_type" value="<?php echo $user_type?>" />
                                    <input type="hidden" name="plan_type" value="<?php echo $plan_type?>" />
                                    <input type="hidden" name="registration_type" value="web" />
                                    <input type="hidden" name="staff" value="<?php echo $staff?>" />
                                    <button type="submit" class="btn btn-purple waves-effect">Get Started</button>
                                </div>
                                
                            

                        </div>
                        <div class="col-lg-12 m-b-20 help text-center">
                    By signup and using Adivakta Plus E-Diary, you agree to <a href="/terms" class="">terms of use</a> and <a href="/privacy-policy">Privacy Policy</a>
                </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="auth_bg"></div>
<script>
jQuery(function(){
	  jQuery('#sign_up_frm').parsley().on('field:validated', function() {
	    var ok = jQuery('.parsley-error').length === 0;
	    $('.bs-callout-info').toggleClass('hidden', !ok);
	    $('.bs-callout-warning').toggleClass('hidden', ok);
	  });
});
</script>
<script src="<?php echo base_url();?>assets/js/lite_login_v1.js" type="text/javascript"></script>
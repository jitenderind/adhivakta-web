<script src="<?php echo base_url(); ?>assets/plugins/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/parsley/parsley.remote.min.js"></script>
<link href="<?php echo base_url(); ?>assets/plugins/parsley/parsley.css" rel="stylesheet"/>
<div class="auth animated slideInRight">
    <div class="ap_card">
        <div class="body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header">
                        <div class="logo m-t-0">
                                <img class="w-in-76" src="<?php echo base_url(); ?>assets/img/logo.png" alt="Adhivakta E-Diary"">
                        </div>
                    </div>
                </div>
                <form class="col-lg-12" id="sign_in_frm" method="POST" action="/login">
                    <h5 class="title">Sign in to your Account</h5>
                    <p class="text-danger" id="error"></p>
                    <div class="form-group-ap form-float">
                        <div class="form-line-ap">
                            <input type="text" name="email" class="form-control" tabindex="1" autocomplete="off" required="" data-parsley-trigger="keyup" data-parsley-type="email" data-parsley-required-message="Please input your email to login">
                            <label class="form-label">Email</label>
                        </div>
                    </div>
                    <div class="form-group-ap form-float">
                        <div class="form-line-ap">
                            <input type="password" class="form-control" name="password" tabindex="2" required="" data-parsley-trigger="keyup" data-parsley-required-message="Password is required to login" autocomplete="off">
                            <label class="form-label">Password</label>
                        </div>
                    </div>
                    <div class="form-check pull-left">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remeber_me" value="1">
                            <span class="form-check-sign"></span>
                            Remember me
                        </label>
                    </div>
                     <div class="col-lg-12 m-t-10">
                    <button type="submit" class="btn btn-purple waves-effect">Sign In</button>
                    
                </div>
                </form>
               
                <div class="col-lg-12 m-t-20">
                    New User? <a href="/register" class="">Register Now</a> | <a class="" href="/recover-password">Recover Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="auth_bg"></div>
<script>
jQuery(function(){
	  jQuery('#sign_in_frm').parsley().on('field:validated', function() {
	    var ok = jQuery('.parsley-error').length === 0;
	    $('.bs-callout-info').toggleClass('hidden', !ok);
	    $('.bs-callout-warning').toggleClass('hidden', ok);
	  }).on('form:submit', function(){
			var options={};
			options.type='POST';
			options.url=jQuery("#sign_in_frm").attr('action');
			options.data=jQuery("#sign_in_frm").serialize();
			options.success=function(response){
				if(response==1){
					window.location.replace("/workspace");
				} else if(response==2){
					$("#error").html("Redirecting to subscription page");
					window.location.replace("/subscription-plans");
				} else if(response==3){
				    
				} else {
				    $("#error").html(response);
				}
				
			};
			jQuery.ajax(options);
			return false; // Don't submit form for this demo
});
});
</script>
<script src="<?php echo base_url();?>assets/js/lite_login_v1.js" type="text/javascript"></script>
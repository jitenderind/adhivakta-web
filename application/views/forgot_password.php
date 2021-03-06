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
                            <img class="w-in-76" src="assets/img/logo.png" alt="Adhivakta E-Diary"">
                        </div>
                       <!--  <h1 class="text-white"><?php echo APPLICATION_TITLE;?></h1> -->
                    </div>
                </div>
                <form class="col-lg-12" id="frm" method="POST" action="/recover-password">
                    <h5 class="title">Forgot Password?</h5>
                    <p id="error"></p>
                    <div class="form-group-ap form-float">
                        <div class="form-line-ap">
                            <input type="email" class="form-control" name="email" tabindex="1" required="" data-parsley-trigger="keyup" data-parsley-type="email" data-parsley-required-message="Please input your email here">
                            <label class="form-label">Email</label>
                        </div>
                    </div>
                    <div class="col-lg-12 m-t-10">
                    <button type="submit" class="btn btn-purple waves-effect">Recover Account</button>
                </div>
                </form>
                
                <div class="col-lg-12 m-t-20">
                    <a class="" href="/login">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="auth_bg"></div>
<script>
jQuery(function(){
	  jQuery('#frm').parsley().on('field:validated', function() {
	    var ok = jQuery('.parsley-error').length === 0;
	    $('.bs-callout-info').toggleClass('hidden', !ok);
	    $('.bs-callout-warning').toggleClass('hidden', ok);
	  }).on('form:submit', function(){
			var options={};
			options.type='POST';
			options.url=jQuery("#frm").attr('action');
			options.data=jQuery("#frm").serialize();
			options.success=function(response){
				    $("#error").html(response);
			};
			jQuery.ajax(options);
			return false; // Don't submit form for this demo
});
});
</script>
<script src="<?php echo base_url();?>assets/js/lite_login_v1.js" type="text/javascript"></script>
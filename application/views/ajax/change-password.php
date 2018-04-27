<!--Begin Content-->
<div class="content">
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row">


				<div class="col-lg-12">

					<div class="ap-wrapper">
						<div class="ap-box">
							<h5 class="ap-header">Change Account Password</h5>
							<div class="table-responsive">
								<form id="frm" action="">
									<p  id="error"></p>
									<div class="row">
										<div class="col-lg-4 col-sm-12">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="password" name="current_password" id="current_password"
														class="form-control" tabindex="1" autocomplete="off"
														required="" data-parsley-trigger="keyup"
														data-parsley-required-message="Please enter your current password">
													<label class="form-label">Current Password</label>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-sm-12">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="password" name="new_password" id="new_password"
														class="form-control" tabindex="2" autocomplete="off"
														required="" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-required-message="must be more than 5 characters">
													<label class="form-label">New Password</label>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-sm-12">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="password" name="confirm_password" id="confirm_password"
														class="form-control" tabindex="3" autocomplete="off"
														required="" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-equalto="#new_password" data-parsley-required-message="must be more than 5 characters">
													<label class="form-label">Confirm Password</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-6 text-center">
										<input name="userId" type="hidden" value="<?php echo $_SESSION['user']['userId']?>" />
											<div class="form-group-ap form-float">
												<button type="submit" class="btn btn-purple waves-effect">Change Password</button>
											</div>
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>

	</div>
</div>
<div id="data-loader"></div>
<script>
jQuery(function(){
	  jQuery('#frm').parsley().on('field:validated', function() {
	    var ok = jQuery('.parsley-error').length === 0;
	    $('.bs-callout-info').toggleClass('hidden', !ok);
	    $('.bs-callout-warning').toggleClass('hidden', ok);
	  }).on('form:submit', function(e){
	  //show loading 
		  var effect = "win8_linear";
	    var container = $(".ap-box");
	    $(container).waitMe({
	        effect  : effect,
	        text    : 'Loading..',
	        bg      : "rgba(255, 255, 255, 0.9)",
	        color   : "#9368E9",
	        maxSize : '',
	        waitTime: -1,
	        textPos : 'vertical',
	        fontSize: '20px',
	        source  : '',
	        onClose : function () {
	        }
	    });
	    
		  var data = new FormData($('form')[0]);
		  $.ajax({
          "url": '<?php echo base_url()?>user/change-password',
          "type": "POST",
	          "method": "POST",
          "async": true,
          "crossDomain": true,
          "data":data,
	            "processData": false,
	          "contentType": false,
	          "mimeType": "multipart/form-data",
      }).done(function (response) {
      	$(container).waitMe("hide");
          $('#error').html(response);
});
      return false;
});
});
</script>

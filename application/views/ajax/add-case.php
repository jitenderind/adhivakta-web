
<!--Begin Content-->
<div class="content">
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row">


				<div class="col-lg-12">

					<div class="ap-wrapper">
						<div class="ap-box">
							<h5 class="ap-header">Add New Case</h5>
							<div class="table-responsive">
								<form id="frm" action="">
									<p class="text-danger" id="error"></p>
									<h5>Case Details</h5>
									<div class="row">
										<div class="col-lg-8">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="forums"
														class="form-control" tabindex="1" placeholder
														autocomplete="off" required=""
														data-parsley-trigger="keyup"
														data-parsley-required-message="Please select forum"> <label
														class="form-label">Forum</label> <input type="hidden"
														name="forumId" id="forumIdValue" value="" />
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-sm-6">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="caseType"
														class="form-control" tabindex="2" autocomplete="off"
														required="" data-parsley-trigger="keyup"
														data-parsley-required-message="Please select case type"> <label
														class="form-label">Case Type</label> <input type="hidden"
														name="caseType" id="caseTypeValue" value="" />
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4 col-sm-6">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" name="caseNo" id="caseNo"
														class="form-control" tabindex="3" autocomplete="off"
														required="" data-parsley-trigger="keyup"
														data-parsley-required-message="Please input case number">
													<label class="form-label">Case No</label>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<select name="caseYear" id="caseYear" class="form-control"
														tabindex="4" required="">
														<option value=""></option>
                            <?php
                            $year = date("Y");
                            foreach (range(date('Y'), 1950) as $x) {
                                // echo '<option value="'.$x.'"'.($x === date('Y') ? ' selected="selected"' : '').'>'.$x.'</option>';
                                echo '<option value="' . $x . '">' . $x . '</option>';
                            }
                            ?>
                            </select> <label class="form-label">Case
														Year</label>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" name="fileNo" id="fileNo"
														class="form-control" tabindex="5" autocomplete="off"> <label
														class="form-label">Office File No.</label>
												</div>
											</div>
										</div>
									</div>
									<div class="text-center">
										<button class="btn btn-wd btn-link" tabindex="6" type="button"
											data-toggle="collapse" data-target="#more_details"
											aria-expended="false">
											Add Client and Opposite Counsel Details <br>
											<i class="material-icons">play_for_work</i>
										</button>
									</div>
									<div id="more_details" class="collapse" aria-expended="false">
										<h5>Client Details</h5>
										<div class="row">
											<div class="col-lg-4 col-sm-6">
												<div class="form-group-ap form-float">
													<div class="form-line-ap">
														<input type="text" name="client_name" id="client_name" class="form-control" tabindex="8" autocomplete="off">
														<label class="form-label">Name</label>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6">
												<div class="form-group-ap form-float">
													<div class="form-line-ap">
														<input type="text" name="client_email" id="client_email"
															class="form-control" tabindex="9" autocomplete="off"> <label
															class="form-label">Email</label>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6">
												<div class="form-group-ap form-float">
													<div class="form-line-ap">
														<input type="text" name="client_phone" id="client_phone"
															class="form-control" tabindex="10" autocomplete="off"> <label
															class="form-label">Phone</label>
													</div>
												</div>
											</div>
											<div class="col-lg-12 col-sm-6">
												<div class="form-group-ap form-float">
													<div class="form-line-ap">
														<input type="text" name="client_address"
															id="client_address" class="form-control" tabindex="11"
															autocomplete="off"> <label class="form-label">Address</label>
													</div>
												</div>
											</div>
										</div>
										<h5>Opposite Counsel Details</h5>
										<div class="row">
											<div class="col-lg-4 col-sm-6">
												<div class="form-group-ap form-float">
													<div class="form-line-ap">
														<input type="text" name="opp_counsel_name"
															id="opp_counsel_name" class="form-control" tabindex="12"
															autocomplete="off"> <label class="form-label">Name</label>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6">
												<div class="form-group-ap form-float">
													<div class="form-line-ap">
														<input type="text" name="opp_counsel_email"
															id="opp_counsel_email" class="form-control" tabindex="13"
															autocomplete="off"> <label class="form-label">Email</label>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-6">
												<div class="form-group-ap form-float">
													<div class="form-line-ap">
														<input type="text" name="opp_counsel_phone"
															id="opp_counsel_phone" class="form-control" tabindex="14"
															autocomplete="off"> <label class="form-label">Phone</label>
													</div>
												</div>
											</div>
											<div class="col-lg-12 col-sm-6">
												<div class="form-group-ap form-float">
													<div class="form-line-ap">
														<input type="text" name="opp_counsel_address"
															id="opp_counsel_address" class="form-control"
															tabindex="15" autocomplete="off"> <label
															class="form-label">Address</label>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-6 text-center">
										<input name="userId" type="hidden" value="<?php echo $_SESSION['user']['userId']?>" />
											<div class="form-group-ap form-float">
												<button type="submit" class="btn btn-purple waves-effect">Add
													Case</button>
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
        $("#caseYear").focus();
        $.ajax({
            "url": '<?php echo API_URL.'user-forums/'.$_SESSION['user']['userId']?>',
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            "async": true,
            "crossDomain": true,
            "headers": {
                "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
                "Content-Type": "application/json"
              },
        }).done(function (response) {
            var forums=[];
        	$.each(response, function(i, itemObj) {
            	item = {};
                item ["value"] = response[i].forum;
                dataItem={};
                dataItem ["id"] = response[i].forumId;
                dataItem ["category"] = response[i].category;
                //data.push(dataItem);
                item['data']=dataItem;
                forums.push(item);
        	});
        	$( "#forums" ).devbridgeAutocomplete({
            	lookup: forums,
            	minChars: 0,
            	groupBy:'category',
            	triggerSelectOnValidInput: false,
                onSelect: function (suggestion) {
                    //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                    $("#forumIdValue").val(suggestion.data.id);
                    $('#forums').focus();
                    $('.autocomplete-suggestions').hide();
                    $.ajax({
                        "url": '<?php echo API_URL?>case-types/'+suggestion.data.id,
                        type: "GET",
                        dataType: "json",
                        contentType: "application/json",
                        "async": true,
                        "crossDomain": true,
                        "headers": {
                            "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
                            "Content-Type": "application/json"
                          },
                    }).done(function (response) {
                        var caseTypes=[];
                    	$.each(response, function(i, itemObj) {
                        	item = {};
                            item ["value"] = response[i].caseType;
                            item ["data"] = response[i].abbr;
                            caseTypes.push(item);
                    	});
                        
                    	$( "#caseType" ).devbridgeAutocomplete({
                        	lookup: caseTypes,
                        	minChars: 0,
                        	triggerSelectOnValidInput: false,
                            onSelect: function (suggestion) {
                                //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                            	$("#caseTypeValue").val(suggestion.data);
                                $('#caseType').focus();
                                $('.autocomplete-suggestions').hide();
                                return false;
                            }
                        });
                    });
                    return false;
                }
            });
        });

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
      	            "url": '<?php echo API_URL?>case/add',
      	            "type": "POST",
        	          "method": "POST",
      	            "async": true,
      	            "crossDomain": true,
      	            "data":data,
      	            "headers": {
      	                "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
      	              },
        	            "processData": false,
            	          "contentType": false,
            	          "mimeType": "multipart/form-data",
      	        }).done(function (response) {
      	        	$(container).waitMe("hide");
      	            if(response){
        	              loadPage('/workspace');
      	            }
        });
      	        return false;
        });
    });
        </script>
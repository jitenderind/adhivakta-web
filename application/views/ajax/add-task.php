<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet"/>
<!--Begin Content-->
<div class="content">
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row">


				<div class="col-lg-12">

					<div class="ap-wrapper">
						<div class="ap-box">
							<h5 class="ap-header">Add New Task</h5>
							<div class="table-responsive">
								<form id="frm" action="">
									<p class="text-danger" id="error"></p>
									<div class="row">
										<div class="col-lg-8">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="task" name="task"
														class="form-control" tabindex="1" placeholder
														autocomplete="off" required=""
														data-parsley-trigger="keyup"
														data-parsley-required-message="Please describe task"> <label
														class="form-label">Task</label>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-sm-6">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="due_date" name="due_date"
														class="form-control" tabindex="2" autocomplete="off"
														required="" data-parsley-trigger="keyup"
														data-parsley-required-message="Please select due date"> <label
														class="form-label">Due On</label> 
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-sm-6">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="user-cases"
														class="form-control" tabindex="3" autocomplete="off"
														>
													<label class="form-label">Related Case (optional)</label>
													<input type="hidden"
														name="userCaseId" id="userCaseId" value="" />
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="user-staff"
														class="form-control" tabindex="5" autocomplete="off"> <label
														class="form-label">Assign To</label>
														<input type="hidden"
														name="assignedTo" id="assignedTo" value="" />
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-6 text-center">
										<input name="parentUserId" type="hidden" value="<?php echo $_SESSION['user']['userId']?>" />
										<input name="userId" type="hidden" value="<?php echo $_SESSION['user']['myId']?>" />
											<div class="form-group-ap form-float">
												<button type="submit" class="btn btn-purple waves-effect">Add
													Task</button>
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
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script>
        $.ajax({
            "url": '<?php echo API_URL.'user-cases/'.$_SESSION['user']['userId']?>',
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
            var cases=[];
            var dataObj = response.data;
        	$.each(dataObj, function(i, itemObj) {
            	item = {};
                item ["value"] = dataObj[i].caseTitle +' ['+dataObj[i].caseNo+'/'+dataObj[i].caseYear+']';
                dataItem={};
                dataItem ["id"] = dataObj[i].userCaseId;
                dataItem ["category"] = "All Cases";
                item['data']=dataItem;
                cases.push(item);
        	});
        	$( "#user-cases" ).devbridgeAutocomplete({
            	lookup: cases,
            	minChars: 0,
            	groupBy:'category',
            	triggerSelectOnValidInput: false,
                onSelect: function (suggestion) {
                    //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                    $("#userCaseId").val(suggestion.data.id);
                    $('#user-cases').focus();
                    $('.autocomplete-suggestions').hide();
                }
            });
        });

        $.ajax({
            "url": '<?php echo API_URL.'allstaff/'.$_SESSION['user']['userId']?>',
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
            var staff=[];
        	$.each(response, function(i, itemObj) {
            	item = {};
                item ["value"] = response[i].first_name +' '+response[i].last_name;
                dataItem={};
                dataItem ["id"] = response[i].userId;
                dataItem ["category"] = response[i].user_type;
                item['data']=dataItem;
                staff.push(item);
        	});
        	$( "#user-staff" ).devbridgeAutocomplete({
            	lookup: staff,
            	minChars: 0,
            	groupBy:'category',
            	triggerSelectOnValidInput: false,
                onSelect: function (suggestion) {
                    //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                    $("#assignedTo").val(suggestion.data.id);
                    $('#user-staff').focus();
                    $('.autocomplete-suggestions').hide();
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
      	            "url": '<?php echo API_URL?>task/add',
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
        	              loadPage('/tasks');
      	            }
        });
      	        return false;
        });
    });


        $('#due_date').datepicker({
        	format: "yyyy-mm-dd",
        	autoclose: true,
            startDate: new Date()
        }).on('hide', function () {
      	  if (!this.firstHide) {
  		    if (!$(this).is(":focus")) {
  		      this.firstHide = true;
  		      // this will inadvertently call show (we're trying to hide!)
  		      this.focus(); 
  		    }
  		  } else {
  		    this.firstHide = false;
  		  }
  		})
  		.on('show', function () {
  		  if (this.firstHide) {
  		    // careful, we have an infinite loop!
  		    $(this).datepicker('hide'); 
  		  }
  		});
        </script>
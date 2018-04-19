<link href="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet"/>
<script>
var pageType = '<?php echo $_GET['type']?>';
var userCaseId = '<?php echo $_GET['userCaseId']?>';
</script>
<div class="row">
    <div class="col-lg-12 col-md-12">
<div class="table-responsive">
<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="collapse" data-target="#add_task"
											aria-expended="false"><i class="fa fa-plus"></i> Add New Task</button>
											<div id="add_task" class="collapse" aria-expended="false">
											<form method="post" action="" id="addTaskFrm">
											<div class="row">
											<div class="col-lg-4">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="task" name="task"
														class="form-control" tabindex="1" placeholder
														autocomplete="off" required=""
														data-parsley-trigger="keyup"
														data-parsley-required-message="Please describe task"> <label
														class="form-label">Task</label>
												</div>
											</div></div>
											<div class="col-lg-3">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="due_date" name="due_date"
														class="form-control" tabindex="1" > <label
														class="form-label">Due on</label>
												</div>
											</div></div>
											<div class="col-lg-3">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="user-staff"
														class="form-control" tabindex="5" autocomplete="off"> <label
														class="form-label">Assign To</label>
														<input type="hidden"
														name="assignedTo" id="assignedTo" value="" />
												</div>
											</div></div>
											<div class="col-lg-2">
											<input name="parentUserId" type="hidden" value="<?php echo $_SESSION['user']['userId']?>" />
										<input name="userId" type="hidden" value="<?php echo $_SESSION['user']['myId']?>" />
										<input name="userCaseId" type="hidden" value="<?php echo $_GET['userCaseId']?>" />
											<div class="form-float" style="margin-top:20px;">
												<button type="submit" class="btn btn-sm btn-purple waves-effect">Add
													Task</button>
											</div></div>
											</div>
											</form>
											</div>
											
											<div class="btn-group btn-type" role="group" aria-label="Basic">
                                <button type="button" class="btn btn-outline-info btn-sm" data-type="all">All</button>
                                <button type="button" class="btn btn-outline-info btn-sm active" data-type="open">Open Tasks</button>
                                <button type="button" class="btn btn-outline-info btn-sm" data-type="complete">Completed</button>
                            </div>
								<table class="table">
									<thead>
									</thead>
									<tbody id="case-tasks">
									</tbody>
								</table>
</div>
    </div>
</div>
<script src="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script id="taskTemplate" type="text/x-jQuery-tmpl">
<tr>
<td>
<div class="user_box">
    <div class="user_email">
{{if is_completed==1}}
    <span class="strike">
        ${task}
    </span>
{{else}}
<span class="">
        ${task}
    </span>
{{/if}}
</span>
    </div>
</div>
</td>
<td>
{{if is_completed==1}}
<span class="f-s-14 text-primary strike">
        ${prettyDate(due_date)}
    </span>
{{else}}
<span class="f-s-14 text-primary">
        ${prettyDate(due_date)}
    </span>
{{/if}}
</td>
<td>
{{if is_completed==1}}
<span class="f-s-14 strike">
        ${assignedUser}
    </span>
{{else}}
<span class="f-s-14">
        ${assignedUser}
    </span>
{{/if}}
</td>
<td class="text-center">
{{if is_completed==1 }}
<button type="button" class="btn btn-outline-danger btn-sm archive-btn" data-id="${taskId}" data-title="${task}" data-action="Uncomplete" data-value="0"><i class="fa fa-reply"></i></button>
{{else}}
<button type="button" class="btn btn-outline-primary btn-sm archive-btn" data-id="${taskId}" data-title="${task}" data-action="Complete" data-value="1"><i class="fa fa-check"></i></button>
{{/if}}
<button type="button" class="btn btn-outline-warning btn-sm delete-btn" data-id="${taskId}" data-title="${task}"><i class="fa fa-times"></i></button>
</td>
</tr>
</script>

<script type="text/javascript">

//load staff for case task 
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
    Auth.init();
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
//for page load
        function loadTasks(caseId,type){
pageType=type;
  		    

	var url ='<?php echo API_URL.'case-tasks/'?>'+caseId+'?type='+type;
  		    
        	$.ajax({
                "url": url,
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

            	//console.log(response);
                var html=$('#taskTemplate').tmpl(response);
                $('#case-tasks').html(html);



                //for task status 
                $(".archive-btn").on("click", function (e) {
                    e.preventDefault();
                    var id =$(this).data('id');
                    var title =$(this).data('title');
                    var action =$(this).data('action');
                    var value =$(this).data('value');
                    swal({
                  	  title: "Are you sure?",
                  	  text: "You are goning to Mark task - "+title+" task as "+action,
                  	  type: "warning",
                  	  showCancelButton: true,
                  	  confirmButtonClass: "btn btn-purple waves-effect",
                  	  confirmButtonText: "Yes, Do it!",
                  	  cancelButtonText: "No, cancel!",
                      cancelButtonClass: "btn-secondary",
                  	  closeOnConfirm: false,
                  	  closeOnCancel: false
                  	},
                  	function(isConfirm) {
                  	  if (isConfirm) {
                      	  //send request to update data
                    		$.ajax({
                                "url": '<?php echo API_URL?>task/'+id+'?is_completed='+value,
                                type: "PUT",
                                dataType: "json",
                                contentType: "application/json",
                                "async": true,
                                "crossDomain": true,
                                data:{'is_archived':1},
                                "headers": {
                                    "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
                                    "Content-Type": "application/json"
                                  },
                            }).done(function (response) {
                            	//reload page 
                            	loadTasks(caseId,type);
                            });
                      	  
                  	    swal("Marked "+action+"!", "Your task - "+title+" is marked as "+action+".", "success");
                  	  } else {
                  	    swal("Cancelled", "No action taken on your task!", "error");
                  	  }
                  	});
                    });

                //for task detele 
                $(".delete-btn").on("click", function (e) {
                	var id =$(this).data('id');
                    var title =$(this).data('title');
                    var action =$(this).data('action');
                    var value =$(this).data('value');
                	e.preventDefault();
                    swal({
                  	  title: "Are you sure?",
                  	  text: "You are goning to delete task "+title,
                  	  type: "warning",
                  	  showCancelButton: true,
                  	  confirmButtonClass: "btn btn-purple waves-effect",
                  	  confirmButtonText: "Yes, Delete it!",
                  	  cancelButtonText: "No, cancel!",
                      cancelButtonClass: "btn-secondary",
                  	  closeOnConfirm: false,
                  	  closeOnCancel: false
                  	},
                  	function(isConfirm) {
                  	  if (isConfirm) {
                    		$.ajax({
                                "url": '<?php echo API_URL?>task/'+id,
                                type: "DELETE",
                                "async": true,
                                "crossDomain": true,
                                "headers": {
                                    "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
                                    "Content-Type": "application/json"
                                  },
                            }).done(function (response) {
                            	//reload page 
                            	loadTasks(caseId,type);
                            });
                  	    swal("Deleted!", "Your task is deleted from your task list.", "success");
                  	  } else {
                  	    swal("Cancelled", "Your task is still in task list!", "error");
                  	  }
                  	});
                    });
            });
        }
       loadTasks(userCaseId,pageType);

       //handle button click
       $('.btn-type').on('click', '.btn', function() {
       	  $(this).addClass('active').siblings().removeClass('active');
         	loadTasks(userCaseId,$(this).data('type'));
       	});

   	//handle task form submit 
       jQuery(function(){
      	  jQuery('#addTaskFrm').parsley().on('field:validated', function() {
      	    var ok = jQuery('.parsley-error').length === 0;
      	    $('.bs-callout-info').toggleClass('hidden', !ok);
      	    $('.bs-callout-warning').toggleClass('hidden', ok);
      	  }).on('form:submit', function(e){
        		var taskForm = document.getElementById('addTaskFrm');
      		  var data = new FormData(taskForm);
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
    	            if(response){
    	            	taskForm.reset();
    	            	$("#add_task").collapse("toggle");
    	            	loadTasks(userCaseId,'open');
    	            }
      });
    	        return false;
      });
  });


     	//case due date 
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
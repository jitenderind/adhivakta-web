<script>
var pageKey = '<?php echo $_GET['key']?>';
var pageType = '<?php echo $_GET['type']?>';
var pageUser = '<?php echo $_GET['mine']?>';
</script>
<script id="taskTemplate" type="text/x-jQuery-tmpl">
<tr>
<td>
<div class="user_box">
    <div class="user_email">
{{if is_completed==1}}
    <span class="title strike">
        ${task}
    </span>
{{else}}
<span class="title">
        ${task}
    </span>
{{/if}}
{{if is_completed==1}}
        <span class="f-s-12 text-muted strike">
        ${caseTitle}
    </span>
{{else}}
<span class="f-s-12 text-muted">
        ${caseTitle}
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
<button type="button" class="btn btn-outline-danger btn-sm archive-btn" data-id="${taskId}" data-title="${task}" data-action="Uncomplete" data-value="0">Mark Uncomplete</button>
{{else}}
<button type="button" class="btn btn-outline-primary btn-sm archive-btn" data-id="${taskId}" data-title="${task}" data-action="Complete" data-value="1">Mark Completed</button>
{{/if}}
<button type="button" class="btn btn-outline-danger btn-sm delete-btn" data-id="${taskId}" data-title="${task}">Delete</button>
</td>
</tr>
</script>

<script type="text/javascript">
//for page load
        function loadTasks(page,key,type,mine,refresh){
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
pageKey=key;
pageType=type;
pageUser=mine;
  		    
if(key!=''){
	var url ="<?php echo API_URL.'tasks/'.$_SESSION['user']['userId'].'/search/'?>"+key+'?type='+type+'&mine='+mine+'&page='+page;
}  else {
	var url ='<?php echo API_URL.'tasks/'.$_SESSION['user']['userId']?>?type='+type+'&mine='+mine+'&page='+page;
}
  		    
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
            	$(container).waitMe("hide");

            	//console.log(response);
                var html=$('#taskTemplate').tmpl(response.data);
                $('#data-content').html(html);
                //create pagination
                if(refresh){
                 $('#pagination').twbsPagination('destroy');
                }
                $('#pagination').twbsPagination({
                    totalPages: response.last_page,
                    visiblePages: 10,
                    onPageClick: function (event, page) {
                        
                    }
                }).on('page', function (event, page) {
                	loadTasks(page,key,type,mine,false);
                });



                //for case archive 
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
                            	loadTasks(page,key,type,mine,true);
                            });
                      	  
                  	    swal("Marked "+action+"!", "Your task - "+title+" is marked as "+action+".", "success");
                  	  } else {
                  	    swal("Cancelled", "No action taken on your task!", "error");
                  	  }
                  	});
                    });

                //for case detele 
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
                            	loadTasks(page,key,type,mine,true);
                            });
                  	    swal("Deleted!", "Your case is deleted from your list.", "success");
                  	  } else {
                  	    swal("Cancelled", "Your case is still in active case list!", "error");
                  	  }
                  	});
                    });
            });
        }
       loadTasks(1,pageKey,pageType,pageUser,true);

       //handle button click
       $('.btn-type').on('click', '.btn', function() {
       	  $(this).addClass('active').siblings().removeClass('active');
         	loadTasks(1,pageKey,$(this).data('type'),pageUser,true);
       	});

       $('.btn-user').on('click', '.btn', function() {
           console.log();
     	  $(this).addClass('active').siblings().removeClass('active');
       	loadTasks(1,pageKey,pageType,$(this).data('type'),true);
     	});
</script>
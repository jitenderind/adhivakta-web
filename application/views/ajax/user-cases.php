<script>
var key = '<?php echo $_GET['key']?>';
var arch = '<?php echo $_GET['arch']?>';
var archKey = '<?php echo $_GET['archKey']?>';
</script>
<script id="casesTemplate" type="text/x-jQuery-tmpl">
<tr>
<td>
<div class="user_box">
    <div class="user_email">
    <span class="title">
        ${caseTitle}
    </span>
        <span class="f-s-12">
        ${caseType} - ${caseNo}/${caseYear}
    </span>
</span>
        <span class="f-s-12">
        Diary No: ${diaryNo}
    </span>
{{if status.toUpperCase() =="DISPOSED"}}
<span class="f-s-12 text-success">
        ${status}
    </span>
{{else}}
<span class="f-s-12 text-danger">
        ${status}
    </span>
{{/if}}
    </div>
</div>
</td>
<td>
<span class="f-s-12">
        ${forum}
    </span>

{{if status.toUpperCase() =="PENDING"}}
{{if checkInFuture(nextListing)}}
<span class="badge-purple badge bigTitle">
${formatDate(nextListing)}
</span>
{{else}}
<br>
<span class="badge-success badge f-s-12">
last listed on</span><br>
<span class="bigTitle">
${formatDateFull(nextListing)}
</span><br>
{{/if}}
<span class="f-s-12">
        ${nextListingCourtNo} | Item No:  ${nextListingItemNo}
    </span>
{{/if}}
</td>
<td>
<span class="title text-primary">
        ${client_name}
    </span><br>
<span class="f-s-12">
        ${client_phone} 
    </span><br>
<span class="f-s-12">
        ${client_email} 
    </span>
</td>
<td class="text-center">
{{if archKey!='' || arch==1 }}
<button type="button" class="btn btn-primary btn-sm archive-btn" data-user_case_id="${userCaseId}" data-title="${caseTitle}" data-caseno="${caseNo}" data-caseyear="${caseYear}">Unarchive</button><br>
{{else}}
<button type="button" class="btn btn-primary btn-sm archive-btn" data-user_case_id="${userCaseId}" data-title="${caseTitle}" data-caseno="${caseNo}" data-caseyear="${caseYear}">Archive</button><br>
{{/if}}
<button type="button" class="btn btn-warning btn-sm delete-btn" data-user_case_id="${userCaseId}" data-title="${caseTitle}" data-caseno="${caseNo}" data-caseyear="${caseYear}">Delete</button>
</td>
</tr>
</script>

<script type="text/javascript">
//for page load
        function loadCases(page,key){
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
if(key!=''){
	var url ="<?php echo API_URL.'user-cases/'.$_SESSION['user']['userId'].'/search/'?>"+key;
	var archVal=1;
	var archText="archive";
	var archRText="unarchive";
	var archTitle="Archived";
	var archConfirmText ="archive";
	var archCancelText="active";
} else if(arch==1){
	var url ="<?php echo API_URL.'user-archived-cases/'.$_SESSION['user']['userId']?>";
	var archVal=0;
	var archText="activate";
	var archRText="archive";
	var archTitle="Unarchived";
	var archConfirmText ="active";
	var archCancelText="archive";
} else if(archKey!=''){
	var url ="<?php echo API_URL.'user-archived-cases/'.$_SESSION['user']['userId'].'/search/'?>"+archKey;
	var archVal=0;
	var archText="activate";
	var archRText="archive";
	var archTitle="Unarchived";
	var archConfirmText ="active";
	var archCancelText="archive";
} else {
	var url ="<?php echo API_URL.'user-cases/'.$_SESSION['user']['userId']?>";
	var archVal=1;
	var archText="archive";
	var archRText="unarchive";
	var archTitle="Archived";
	var archConfirmText ="archive";
	var archCancelText="active";
}
  		    
        	$.ajax({
                "url": url+"?page="+page,
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
                var html=$('#casesTemplate').tmpl(response.data);
                $('#data-content').html(html);
                //create pagination
                window.pagObj = $('#pagination').twbsPagination({
                    totalPages: response.last_page,
                    visiblePages: 10,
                    onPageClick: function (event, page) {
                        
                    }
                }).on('page', function (event, page) {
                	loadCases(page,key);
                });



                //for case archive 
                $(".archive-btn").on("click", function (e) {
                    e.preventDefault();
                    var id =$(this).data('user_case_id');
                    swal({
                  	  title: "Are you sure?",
                  	  text: "You are goning to "+archText+" case "+$(this).data('title')+" ["+$(this).data('caseno')+"/"+$(this).data('caseyear')+"]",
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
                                "url": '<?php echo API_URL?>user-case/'+id+'?is_archived='+archVal,
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
                         		 loadCases(1,key);
                            });
                      	  
                  	    swal(archTitle+"!", "Your case is in "+archConfirmText+" list now. You can "+archRText+" it any time you wish to.", "success");
                  	  } else {
                  	    swal("Cancelled", "Your case is still in "+archCancelText+" case list!", "error");
                  	  }
                  	});
                    });

                //for case detele 
                $(".delete-btn").on("click", function (e) {
                    var id =$(this).data('user_case_id');
                	e.preventDefault();
                    swal({
                  	  title: "Are you sure?",
                  	  text: "You are goning to delete case "+$(this).data('title')+" ["+$(this).data('caseno')+"/"+$(this).data('caseyear')+"].",
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
                                "url": '<?php echo API_URL?>user-case/'+id,
                                type: "DELETE",
                                "async": true,
                                "crossDomain": true,
                                "headers": {
                                    "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
                                    "Content-Type": "application/json"
                                  },
                            }).done(function (response) {
                            	//reload page 
                         		 loadCases(1,key);
                            });
                  	    swal("Deleted!", "Your case is deleted from your list.", "success");
                  	  } else {
                  	    swal("Cancelled", "Your case is still in active case list!", "error");
                  	  }
                  	});
                    });
            });
        }
       loadCases(1,key);
</script>
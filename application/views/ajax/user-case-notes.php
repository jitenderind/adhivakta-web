<script>
var userCaseId = '<?php echo $_GET['userCaseId']?>';
</script>
<div class="row">
    <div class="col-lg-12 col-md-12">
<div class="table-responsive">
<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="collapse" data-target="#add_note"
											aria-expended="false"><i class="fa fa-plus"></i> Add New Note</button>
											<div id="add_note" class="collapse" aria-expended="false">
											<form method="post" action="" id="addNoteFrm">
											<div class="row">
											<div class="col-lg-10">
											<div class="form-group-ap form-float">
												<div class="form-line-ap">
													<input type="text" id="data_value" name="data_value"
														class="form-control" tabindex="1" placeholder
														autocomplete="off" required=""
														data-parsley-trigger="keyup"
														data-parsley-required-message="Please describe task"> <label
														class="form-label">Note</label>
												</div>
											</div></div>
											<div class="col-lg-2">
											<input name="parentUserId" type="hidden" value="<?php echo $_SESSION['user']['userId']?>" />
										<input name="data_type" type="hidden" value="note" />
										<input name="userCaseId" type="hidden" value="<?php echo $_GET['userCaseId']?>" />
											<div class="form-float" style="margin-top:20px;">
												<button type="submit" class="btn btn-sm btn-purple waves-effect">Add
													Note</button>
											</div></div>
											</div>
											</form>
											</div>
											
								<table class="table">
									<thead>
									</thead>
									<tbody id="case-notes">
									</tbody>
								</table>
</div>
    </div>
</div>
<script id="noteTemplate" type="text/x-jQuery-tmpl">
<tr>
<td>
<div class="user_box">
    <div class="user_email">
<span class="">
       <a href="#" data-type="text" class="editable" data-pk="${userCaseDataId}" data-id="${userCaseDataId}" name="data_value" data-type="text" data-name="data_value" data-title="Enter Note">${data_value}</a>
    </span>
</span>
    </div>
</div>
</td>
<td class="text-center">
<button type="button" class="btn btn-outline-danger btn-sm delete-btn" data-id="${userCaseDataId}" data-title="${data_value}"><i class="fa fa-times"></i></button>
</td>
</tr>
</script>

<script type="text/javascript">
function loadNotes(userCaseId){
	$.ajax({
        "url": '<?php echo API_URL.'user-case-data/case/'?>'+userCaseId+'/type/note',
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
        var html=$('#noteTemplate').tmpl(response);
        $('#case-notes').html(html);
        $('.editable').each(function() {
        	var current_element = $(this);
        $(this).editable({
        	url: '<?php echo API_URL?>user-case-data/'+current_element.data("id"),
        	inputclass: 'fullWidth',
        	ajaxOptions:{
                type: "PUT",
                dataType: "json",
                "async": true,
                "crossDomain": true,
                "headers": {
                    "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
                    "Content-Type": "application/x-www-form-urlencoded"
                  }
            	},
            mode:'inline',
        	emptytext: "NA",
        });
        });
        
        $(".delete-btn").on("click", function (e) {
        	var id =$(this).data('id');
            var title =$(this).data('title');
        	e.preventDefault();
            swal({
          	  title: "Are you sure?",
          	  text: "You are goning to delete note "+title,
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
                        "url": '<?php echo API_URL?>user-case-data/'+id,
                        type: "DELETE",
                        "async": true,
                        "crossDomain": true,
                        "headers": {
                            "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
                            "Content-Type": "application/json"
                          },
                    }).done(function (response) {
                    	//reload page 
                    	loadNotes(userCaseId)
                    });
          	    swal("Deleted!", "Your case note is deleted.", "success");
          	  } else {
          	    swal("Cancelled", "Your case note is not deleted!", "error");
          	  }
          	});
            });
    });
}

//handle task form submit 
jQuery(function(){
	  jQuery('#addNoteFrm').parsley().on('field:validated', function() {
	    var ok = jQuery('.parsley-error').length === 0;
	    $('.bs-callout-info').toggleClass('hidden', !ok);
	    $('.bs-callout-warning').toggleClass('hidden', ok);
	  }).on('form:submit', function(e){
 		var noteForm = document.getElementById('addNoteFrm');
		  var data = new FormData(noteForm);
		  $.ajax({
	            "url": '<?php echo API_URL?>user-case-data/add',
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
	            	noteForm.reset();
	            	$("#add_note").collapse("toggle");
	            	loadNotes(userCaseId);
	            }
});
	        return false;
});
});

loadNotes(userCaseId);
</script>
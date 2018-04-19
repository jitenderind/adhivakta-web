<?php 
$id =($_GET['id'])?$_GET['id']:$id;
?>
<div class="content ">
<div class="content-sm bg-gray">
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row" id="page-data-content">

			</div>
			
		</div>

	</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row" id="data-content">
<div class="col-lg-12">
                    <div class="ap-wrapper">
                        <div class="ap-box">
                            <div class="bd-example bd-example-tabs" role="tabpanel">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#listing"
                                           role="tab" aria-controls="profile" aria-expanded="false">Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#orders"
                                           role="tab" aria-controls="profile" aria-expanded="false">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#office_reports"
                                           role="tab" aria-controls="profile" aria-expanded="false">Office Reports</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#documents"
                                           role="tab" aria-controls="profile" aria-expanded="false">Documents</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#case_tasks"
                                           role="tab" aria-controls="profile" aria-expanded="false">Tasks</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#case_notes"
                                           role="tab" aria-controls="profile" aria-expanded="false">Notes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#client_details"
                                           role="tab" aria-controls="profile" aria-expanded="false">Client Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#case_details"
                                           role="tab" aria-controls="home" aria-expanded="true">More Details</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="listing" role="tabpanel"
                                         aria-labelledby="profile-tab" aria-expanded="false">
                                        <div id="case-listings-content"></div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel"
                                         aria-labelledby="profile-tab" aria-expanded="false">
                                        <div id="case-orders-content"></div>
                                    </div>
                                    <div class="tab-pane fade" id="office_reports" role="tabpanel"
                                         aria-labelledby="profile-tab" aria-expanded="false">
                                        <div id="case-office-reports-content"></div>
                                    </div>
                                    <div class="tab-pane fade" id="documents" role="tabpanel"
                                         aria-labelledby="profile-tab" aria-expanded="false">
                                        <div id="case-documents-content"></div>
                                    </div>
                                    <div class="tab-pane fade" id="case_tasks" role="tabpanel"
                                         aria-labelledby="profile-tab" aria-expanded="false">
                                        <div id="case-tasks-content"></div>
                                    </div>
                                    <div class="tab-pane fade" id="case_notes" role="tabpanel"
                                         aria-labelledby="profile-tab" aria-expanded="false">
                                        <div id="case-notes-content"></div>
                                    </div>
                                    <div class="tab-pane fade" id="client_details" role="tabpanel"
                                         aria-labelledby="profile-tab" aria-expanded="false">
                                        <div id="client-detail-content"></div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="case_details"
                                         aria-labelledby="home-tab" aria-expanded="true">
                                        <div id="case-detail-content"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>
			
		</div>

	</div>
</div>
</div>

<input type="hidden" id="caseId" value="" />
<div id="data-loader1"></div>

<script id="caseTemplate" type="text/x-jQuery-tmpl">
<div class="col-lg-12">
					<div class="ap-wrapper">
						<div class="ap-box">
						<h5 class="ap-header">
								${caseTitle}

<div class="ap-box-controls">

								</div>
<div class="ap-box-controls">
									<i class="material-icons" data-box="refresh"
										data-effect="win8_linear" data-url="/user-case-data?id=${userCaseId}">refresh</i> <i
										class="material-icons" data-box="fullscreen">fullscreen</i>
								</div>
							</h5>
<div class="row">
<div class="col-lg-4">
{{if status.toUpperCase() =="DISPOSED"}}
<span class="f-s-16 badge" data-color="green">
        ${status}
    </span>
{{else}}
<span class="f-s-16 badge" data-color="red">
        ${status}
    </span>
{{/if}}
<br>
<span class="badge" data-color="black">
${forum}
</span><br>
<span class="f-s-12">
        ${forumCaseType} - ${caseNo}/${caseYear}
    </span>	<br>
<span class="f-s-12">
        Diary No - ${diaryNo}
    </span>
</div>
<div class="col-lg-8">
{{if status.toUpperCase() !="DISPOSED"}}
<span class="f-s-12">
Next Hearing
</span><br>
<span class="bigTitle">
{{if checkInFuture(nextListing)}}
        ${formatDateFull(nextListing)} 

{{else}}
Not Listed
{{/if}}
    </span>
{{if checkInFuture(nextListing)}}
{{if nextListingKind !="cause list"}}
<span class="badge" data-color="blue">Tentitive</span>
{{/if}}
{{/if}}


<span class="f-s-12">Court No. ${nextListingCourtNo} | Item No:  ${nextListingItemNo}
</span>	<br>
<span class="f-s-12">
       Bench - ${nextListingCourt}
    </span>
{{/if}}
</div>
</div>
						</div>
					</div>
				</div>

</script>

<script id="caseDetailTemplate" type="text/x-jQuery-tmpl">
<div class="row">
    <div class="col-lg-12 col-md-12">
<div class="table-responsive">
								<table class="table">
									<thead>
									</thead>
									<tbody>
<tr><td><span class="f-s-14">Case Details</span></td><td><span>${caseNoDetail}</span></td></tr>
<tr><td><span class="f-s-14">Diary</span></td><td><span>${diaryDetail}</span></td></tr>
<tr><td><span class="f-s-14">Status</span></td><td><span>${statusDetail}</span></td></tr>
<tr><td><span class="f-s-14">Category</span></td><td><span>${category}</span></td></tr>
<tr><td><span class="f-s-14">Petitioner</span></td><td><span class="list">{{html convertToListText(petitioner,'ol')}}</span></td></tr>
<tr><td><span class="f-s-14">Respondent</span></td><td><span class="list">{{html convertToListText(respondent,'ol')}}</span></td></tr>
<tr><td><span class="f-s-14">Petitioner Counsel</span></td><td><span>${p_advocate}</span></td></tr>
<tr><td><span class="f-s-14">Respondent Counsel</span></td><td><span>${r_advocate}</span></td></tr>
									</tbody>
								</table>
</div>
    </div>
</div>
</script>
<script id="clientTemplate" type="text/x-jQuery-tmpl">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12">
						<h5 class="ap-header">
								Client Detials
							</h5>
<span class="bigTitle"><a href="#" class="editable" data-pk="1" id="client_name" data-type="text" data-name="client_name" data-title="Enter Client Name">${client_name}</a></span><br>
<span class="f-s-14">Phone: <a href="#" class="editable" data-pk="1" data-type="text"  data-name="client_phone" data-title="Enter Client Phone">${client_phone}</a></span><br>
<span class="f-s-14">Email: <a href="#" class="editable" data-pk="1" data-type="text"  data-name="client_email" data-title="Enter Client Email">${client_email}</a></span><br>
<span class="f-s-14">Address: <a href="#" class="editable" data-pk="1" data-type="text"  data-name="client_address" data-title="Enter Client Address">${client_address}</a></span><br>

<br><span class="f-s-12 text-danger">[Just click the values to update them]</span>
</div>


<div class="col-lg-6 col-md-6 col-sm-12">
<h5 class="ap-header">
								Opposite Counsel Details
							</h5>
<span class="bigTitle"><a href="#" class="editable" data-pk="1" id="opp_counsel_name" data-type="text" data-name="opp_counsel_name" data-title="Enter Client Name">${opp_counsel_name}</a></span><br>
<span class="f-s-14">Phone: <a href="#" class="editable" data-pk="1" data-type="text"  data-name="opp_counsel_phone" data-title="Enter Phone Number">${opp_counsel_phone}</a></span><br>
<span class="f-s-14">Email: <a href="#" class="editable" data-pk="1" data-type="text"  data-name="opp_counsel_email" data-title="Enter  Email">${opp_counsel_email}</a></span><br>
<span class="f-s-14">Address: <a href="#" class="editable" data-pk="1" data-type="text"  data-name="opp_counsel_address" data-title="Enter  Address">${opp_counsel_address}</a></span><br>
<br><span class="f-s-12 text-danger">[Just click the values to update them]</span>

</div>

</script>

<script>
$.ajax({
    "url": "<?php echo API_URL.'user-case/'.$_SESSION['user']['userId'].'/'.$id?>",
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
	var html=$('#caseTemplate').tmpl(response);
    $('#page-data-content').html(html);
    var html=$('#caseDetailTemplate').tmpl(response);
    $('#case-detail-content').html(html);
    var html=$('#clientTemplate').tmpl(response);
    $('#client-detail-content').html(html);
    //make data editable 
    $('.editable').editable({
    	url: '<?php echo API_URL?>user-case/'+response[0].userCaseId,
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
    
    //load case data 
    dataLoadFromServer('/user-case-listing?id='+response[0].caseId,'case-listings-content');
    dataLoadFromServer('/user-case-orders?id='+response[0].caseId,'case-orders-content');
    dataLoadFromServer('/user-case-office-reports?id='+response[0].caseId,'case-office-reports-content');
    
    //now load user case data 
    App.init();
});


</script>

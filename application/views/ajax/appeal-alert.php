<div class="content bg-gray">
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row">


				<div class="col-lg-12">
				
					<div class="ap-wrapper">
						<div class="ap-box">
						<h5 class="ap-header">
								Appeal Alert
								
								
								<div class="ap-box-controls">
    <!-- <input type="submit" value="Submit"/> -->
									<button class="btn btn-primary btn-sm" type="button"
										onClick="pageLoadFromServer('/add-appeal-alert');">
										<i class="fa fa-plus"></i> Add New Appeal Alert
									</button>
									<i class="material-icons" data-box="refresh"
										data-effect="win8_linear" data-url="/user-cases">refresh</i> <i
										class="material-icons" data-box="fullscreen">fullscreen</i>
								</div>
							</h5>
							<div class="table-responsive">
								<table class="table table-separate table-extended">
									<thead>
									<tr>
									<th>Task</th>
									<th>Due on</th>
									<th>Assigned To</th>
									</tr>
									</thead>
									<tbody id="data-content">
									</tbody>
								</table>
								<nav class="navigation pagination">
									<ul id="pagination"></ul>
								</nav>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>

	</div>
</div>
<div id="data-loader"></div>
<script type="text/javascript">
dataLoadFromServer('/user-tasks?type=open&mine=all&key=');

//handle search 
$("#searchFrm").parsley().on('field:validated', function() {
    var ok = jQuery('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  }).on('form:submit', function(e){
	  var url =$("#searchFrm").attr('action');
	  url = url +$('#searchKey').val();
	  dataLoadFromServer(url);
	return false;
});

  //search form
  $("#searchKey").on('keyup',function(){
	  if($(this).val().length) {
	    $('#searchCanelBtn').css("visibility", "visible");
	  } else {
		  $('#searchCanelBtn').css("visibility", "hidden");
	  }
	  });

  $('#searchCanelBtn').on('click',function(){
	  $('#searchKey').val('');
	  $(this).css("visibility", "hidden");
	  });
  
</script>
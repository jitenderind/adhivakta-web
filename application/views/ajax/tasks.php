<div class="content bg-gray">
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row">


				<div class="col-lg-12">
				
					<div class="ap-wrapper">
						<div class="ap-box">
						<div class="row">
				<div class="col-lg-3">
				</div>
				<div class="col-lg-6">
<form class="navbar-forms navbar-left navbar-search-form d-none d-lg-block" id="searchFrm" action="/user-tasks?type=open&mine=all&key=" role="search">
                                <div class="input-group form-control">
                                    <input type="text" class="form-control" id="searchKey" placeholder="Search" data-parsley-trigger="keyup"
														data-parsley-required-message="Please enter keyword to search cases"><i id="searchCanelBtn" class="material-icons text-danger" data-box="refresh"
										data-effect="win8_linear" data-url="/user-tasks?type=open&mine=all&key=">cancel</i>
                                    <span onclick="$('#searchFrm').submit();" class="input-group-addon"><i class="icons icon-magnifier p-r-10"></i></span>
                                </div>
                            </form>
                            </div>
                           <div class="col-lg-3 ">
                           </div>
                           </div>
						<h5 class="ap-header">
								Tasks
								
								
								<div class="ap-box-controls">
    <!-- <input type="submit" value="Submit"/> -->
									<button class="btn btn-primary btn-sm" type="button"
										onClick="pageLoadFromServer('/add-task');">
										<i class="fa fa-plus"></i> Add New Task
									</button>
									<i class="material-icons" data-box="refresh"
										data-effect="win8_linear" data-url="/user-cases">refresh</i> <i
										class="material-icons" data-box="fullscreen">fullscreen</i>
								</div>
							</h5>
							<div class="row">
				<div class="col-lg-3">
				
				</div>
				<div class="col-lg-6 text-center">
				<div class="btn-group btn-type" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-info btn-sm" data-type="all">All</button>
                                <button type="button" class="btn btn-outline-info btn-sm active" data-type="open">Open Tasks</button>
                                <button type="button" class="btn btn-outline-info btn-sm" data-type="complete">Completed</button>
                            </div>
                            <div class="btn-group btn-user" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary btn-sm active" data-type="all">All Tasks</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-type="<?php echo $_SESSION['user']['myId']?>">Only My Task</button>
                            </div>
                            </div>
                           <div class="col-lg-3 ">
                           
                           </div>
                           </div>
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
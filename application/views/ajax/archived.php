
<!--Begin Content-->
<div class="content bg-gray">
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row">


				<div class="col-lg-12">
				<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
<form class="navbar-forms navbar-left navbar-search-form d-none d-lg-block" id="searchFrm" action="/user-cases?archKey=" role="search">
                                <div class="input-group form-control">
                                    <input type="text" class="form-control" id="searchKey" placeholder="Search" data-parsley-trigger="keyup"
														data-parsley-required-message="Please enter keyword to search cases"><i id="searchCanelBtn" class="material-icons text-danger" data-box="refresh"
										data-effect="win8_linear" data-url="/user-cases?arch=1">cancel</i>
                                    <span onclick="$('#searchFrm').submit();" class="input-group-addon"><i class="icons icon-magnifier p-r-10"></i></span>
                                </div>
                            </form>
                            </div>
                           <div class="col-lg-3 "></div>
                           </div>
					<div class="ap-wrapper">
						<div class="ap-box">
						<h5 class="ap-header">
								Archived Cases
								
								
								<div class="ap-box-controls">
    <!-- <input type="submit" value="Submit"/> -->
									<i class="material-icons" data-box="refresh"
										data-effect="win8_linear" data-url="/user-cases?arch=1">refresh</i> <i
										class="material-icons" data-box="fullscreen">fullscreen</i>
								</div>
							</h5>
							<div class="table-responsive">
								<table class="table table-separate table-extended">
									<thead>
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
<!--End Content-->
<script type="text/javascript">
dataLoadFromServer('/user-cases?arch=1');
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


<div class="content">
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row">


				<div class="col-lg-12">
				
					<div class="ap-wrapper">
					<div class="row">
					
					<div class="col-lg-6">
						<div class="ap-box">
						<h5 class="ap-header">
								Plan Details
							</h5>
							<div class="row">
                           </div>
							<div class="table-responsive">
								<table class="table table-extended">
									<thead>
									<tbody id="plan-content">
									</tbody>
								</table>
							</div>
						</div>
						</div>
						
						<div class="col-lg-6">
						<div class="ap-box">
						<h5 class="ap-header">
								Account Details
							</h5>
							<div class="row">
                           </div>
							<div class="table-responsive">
								<table class="table  table-extended">
									<thead>
									<tbody id="account-content">
									</tbody>
								</table>
							</div>
						</div>
						</div>
						
						
						<div class="col-lg-12">
						<div class="ap-box">
						<h5 class="ap-header">
								Invoice & Payments
							</h5>
							<div class="row">
                           </div>
							<div class="table-responsive">
								<table class="table  table-extended">
									<thead>
									<tr>
									<th>Invoice #</th>
									<th>Invoice Date</th>
									<th>Amount</th>
									<th>Tax</th>
									<th>Payable Amount</th>
									<th>Paid ont</th>
									<th>Status</th>
									<th></th>
									</tr>
									</thead>
									<tbody id="payment-content">
									</tbody>
								</table>
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
<div id="data-loader"></div>
<script type="text/javascript">
dataLoadFromServer('/account-details');
$('.dropdown-menu').removeClass('show');
  
</script>
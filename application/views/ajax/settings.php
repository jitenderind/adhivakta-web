<link href="<?php echo base_url(); ?>assets/css/toggle-switch.css"
	rel="stylesheet" />
<div class="content">
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div class="row">


				<div class="col-lg-12">
				
					<div class="ap-wrapper">
					<div class="row">
				
						
						<div class="col-lg-12">
						<div class="ap-box">
							<div class="table-responsive">
								<table class="table table-extended">
									<thead>
									<tbody id="settings-content">
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
$('.dropdown-menu').removeClass('show');
dataLoadFromServer('/account-settings');
  
</script>
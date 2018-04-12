<?php
$id=($_GET['id'])?$_GET['id']:$id;
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
<div class="table-responsive">
								<table class="table">
									<thead>
									</thead>
									<tbody id="case-orders">
									</tbody>
								</table>
</div>
    </div>
</div>
<script id="caseOrderTemplate" type="text/x-jQuery-tmpl">
<tr>
<td><span class="title">${formatDateFull(data_date)}</span> <a href="${data_value}" target="_blank"><span class="smTitle">Check Order</span></a></td>
</tr>								
</script>

<script>
$.ajax({
    "url": "<?php echo API_URL.'case-data/case/'.$id.'/case_order';?>",
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
	var html=$('#caseOrderTemplate').tmpl(response);
    $('#case-orders').html(html);
    //now load user case data 
    //App.init();
}); 
</script>

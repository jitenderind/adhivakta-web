<?php
$id=($_GET['id'])?$_GET['id']:$id;
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
<div class="table-responsive">
								<table class="table">
									<thead>
									</thead>
									<tbody id="case-listings">
									</tbody>
								</table>
</div>
    </div>
</div>
<script id="caseDetailTemplate" type="text/x-jQuery-tmpl">
<tr>
<td><span class="title">${formatDateFull(data_date)}</span><span class="smTitle"> ${listing_type}</span></td>
<td><span class="f-s-14">${bench}</span><br>
<span class="f-s-12">Court No:
{{if courtNo !=null}} 
${courtNo}
{{else}}
NA
{{/if}} | 
Item No: 
{{if itemNo!=null}} 
${itemNo}
{{else}}
NA
{{/if}}
</span></td>
</tr>								
</script>

<script>
$.ajax({
    "url": "<?php echo API_URL.'case-data/case/'.$id.'/case_listing';?>",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    "async": true,
    "crossDomain": true,
    "headers": {
        "Authorization": "Bearer <?php password_hash('aditiaryan',  PASSWORD_DEFAULT, ['cost' => 5])?>",
        "Content-Type": "application/json"
      },
}).done(function (listing_response) {
	var html=$('#caseDetailTemplate').tmpl(listing_response);
    $('#case-listings').html(html);
    //now load user case data 
    //App.init();
}); 
</script>

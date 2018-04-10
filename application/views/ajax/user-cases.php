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
{{if status =="DISPOSED"}}
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
<span class="badge-purple badge bigTitle">
${formatDate(nextListing)}
</span>
<span class="f-s-12">
        ${nextListingCourtNo} | Item No:  ${nextListingItemNo}
    </span>
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
<button type="button" class="btn btn-primary btn-sm">Archive</button><br>
<button type="button" class="btn btn-warning btn-sm">Delete</button>
</td>
</tr>
</script>
<script type="text/javascript">
        function loadCases(){
        	$.ajax({
                "url": '<?php echo API_URL?>user-cases/<?php echo $_SESSION['user']['userId']?>',
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
                var html=$('#casesTemplate').tmpl(response);
                $('#data-content').html(html);
            });
        }
       loadCases();
</script>
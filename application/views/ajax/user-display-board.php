<script id="userDisplayBoardTemplate" type="text/x-jQuery-tmpl">
<div class="ap-wrapper">
<div class="ap-box">
<h5 class="ap-header">
		${forum}
	</h5>
	<div class="table-responsive">
		<table class="table table-separate table-extended">
			<thead>
			</thead>
			<tbody id="data-content">
<tr><th>Court #</th><th>Item #</th><th>Your Item #</th></tr>
{{each data}}
<tr><td>${courtNo}</td><td>${currentItemNo}</td><td>
{{if userItem!='NA'}}
<span class="f-s-14 text-primary" >
${userItem}
</spam>
{{else}}
<span class="f-s-12 text-muted">
${userItem}
</span>
{{/if}}
</td></tr>
{{/each}}
			</tbody>
		</table>
		<nav class="navigation pagination">
			<ul id="pagination"></ul>
		</nav>
	</div>
</div>
</div>
</script>

<script type="text/javascript">
var board_type="all";
var timer;
function loadDisplayBorads(type){
	 var effect = "win8_linear";
	    var container = $("#data-content");
	    $(container).waitMe({
	        effect  : effect,
	        text    : 'Loading..',
	        bg      : "rgba(255, 255, 255, 0.9)",
	        color   : "#9368E9",
	        maxSize : '',
	        waitTime: -1,
	        textPos : 'vertical',
	        fontSize: '20px',
	        source  : '',
	        onClose : function () {
	        }
	    });

	    $.ajax({
            "url": '<?php echo API_URL.'user-display-board/'.$_SESSION['user']['userId']?>?type='+type,
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
            board_type=type;
            //console.log(response);
        	$(container).waitMe("hide");
        	var html=$('#userDisplayBoardTemplate').tmpl(response);
            $('#data-content').html(html);
            while (id--) {
                window.clearTimeout(id); // will do nothing if no timeout with id is present
            }
            var id = window.setTimeout(function(){
            	loadDisplayBorads(type);
                }, 60000);
            
        });
}
loadDisplayBorads(board_type);
$('.btn-group').on('click', '.btn', function() {
	  $(this).addClass('active').siblings().removeClass('active');
	  loadDisplayBorads($(this).data('type'));
	});
</script>


<script id="settingsTemplate" type="text/x-jQuery-tmpl">
<tr>
<td>
<span class="f-s-18">
Auto Renew Subscription Plan:
</span>
</td>
<td>
 <div class="switch">
        <input id="Auto_Renew_Subscription" class="cmn-toggle cmn-toggle-round-flat" data-type="Auto_Renew_Subscription" {{if Auto_Renew_Subscription==1}}checked{{/if}} type="checkbox">
        <label for="Auto_Renew_Subscription"></label>
        </div>
</td>
<td>
<span class="text-muted">Automate you subscription payment. Payments will done using your payment option.</span>
</td>
</tr>
<tr>
<td>
<span class="f-s-18">
Web Notification:
</span>
</td>
<td>
 <div class="switch">
        <input id="Web_Notification" class="cmn-toggle cmn-toggle-round-flat" data-type="Web_Notification" {{if Web_Notification==1}}checked{{/if}} type="checkbox">
        <label for="Web_Notification"></label>
        </div>
</td>
<td>
<span class="text-muted">Allow Notification about cases & tasks in web application UI</span>
</td>
</tr>
<tr>
<td>
<span class="f-s-18">
Push Notification:
</span>
</td>
<td>
 <div class="switch">
        <input id="Push_Notification" class="cmn-toggle cmn-toggle-round-flat" data-type="Push_Notification" {{if Push_Notification==1}}checked{{/if}} type="checkbox">
        <label for="Push_Notification"></label>
        </div>
</td>
<td>
<span class="text-muted">Allow Push Notifications on Web Application and Mobile using Chrome</span>
</td>
</tr>
<tr>
<td>
<span class="f-s-18">
Email Notifications:
</span>
</td>
<td>
 <div class="switch">
        <input id="Email_Notification" class="cmn-toggle cmn-toggle-round-flat" data-type="Email_Notification" {{if Email_Notification==1}}checked{{/if}} type="checkbox">
        <label for="Email_Notification"></label>
        </div>
</td>
<td>
<span class="text-muted">Send notification email about case and task updates to your registered email</span>
</td>
</tr>
<tr>
<td>
<span class="f-s-18">
Reminder for case listing update:
</span>
</td>
<td>
 <div class="switch">
        <input id="Case_Listing_Reminder" class="cmn-toggle cmn-toggle-round-flat" data-type="Case_Listing_Reminder" {{if Case_Listing_Reminder==1}}checked{{/if}} type="checkbox">
        <label for="Case_Listing_Reminder"></label>
        </div>
</td>
<td>
<span class="text-muted">Allow reminders for next listing of your cases through Web, Push or Email notification system</span>
</td>
</tr>
<tr>
<td>
<span class="f-s-18">
Reminder for case updates:
</span>
</td>
<td>
 <div class="switch">
        <input id="Case_Update_Reminder" class="cmn-toggle cmn-toggle-round-flat" data-type="Case_Update_Reminder" {{if Case_Update_Reminder==1}}checked{{/if}} type="checkbox">
        <label for="Case_Update_Reminder"></label>
        </div>
</td>
<td>
<span class="text-muted">Allow reminders for update on cases through Web, Push or Email notification system </span>
</td>
</tr>
<tr>
<td>
<span class="f-s-18">
Daily Task Reminder:
</span>
</td>
<td>
 <div class="switch">
        <input id="Daily_Task_Reminder" class="cmn-toggle cmn-toggle-round-flat" data-type="Daily_Task_Reminder" {{if Daily_Task_Reminder==1}}checked{{/if}} type="checkbox">
        <label for="Daily_Task_Reminder"></label>
        </div>
</td>
<td>
<span class="text-muted">Allow reminders for daily task updates through Web, Push or Email notification system</span>
</td>
</tr>
</script>

<script type="text/javascript">
//for page load
        function loadDetails(){
       	 //show loading 
    		  var effect = "win8_linear";
  		    var container = $(".ap-box");
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
  		    
	var url ="<?php echo base_url().'user/account-settings/'.$_SESSION['user']['userId'];?>";
  		    
        	$.ajax({
                "url": url,
                type: "GET",
                dataType: "json",
                contentType: "application/json",
                "async": true,
                "crossDomain": true,
            }).done(function (response) {
            	$(container).waitMe("hide");

            	//console.log(response);
                var html=$('#settingsTemplate').tmpl(response);
                $('#settings-content').html(html);

                $('.cmn-toggle').change(function() {
				      console.log($(this).prop('checked'));
				      $.ajax({
				          type: "POST",
				          url:  "<?php echo base_url().'user/update_settings'; ?>", 
				          data: {"type":$(this).data('type'),"value": $(this).prop('checked'),"userId":"<?php echo $_SESSION['user']['userId']?>"},
				          dataType: "text",  
				          cache:false,
				          success: 
				               function(data){
				                 //console.log(data);  //as a debugging message.
				               }
				           });
				    });
            });
        }

       loadDetails();

</script>
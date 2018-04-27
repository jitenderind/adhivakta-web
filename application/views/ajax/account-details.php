<script id="accountTemplate" type="text/x-jQuery-tmpl">
<tr>
<td>
Name:
</td>
<td>
<a href="#" class="editable" data-pk="${userId}" id="first_name" data-type="text" data-name="first_name" data-url="/update-profile" data-title="Enter firstt name">${first_name}</a>
<a href="#" class="editable" data-pk="${userId}" id="last_name" data-type="text" data-name="last_name" data-url="/update-profile" data-title="Enter last name">${last_name}</a>
</td>
</tr>
<tr>
<td>
Email:
</td>
<td>${email}
{{if verified==1}}
<i class="material-icons text-success f-s-16">verified_user</i>
{{/if}}
</td>
</tr>
<tr>
<td>
Mobile:
</td>
<td><a href="#" class="editable" data-pk="${userId}" id="mobile" data-type="text" data-name="mobile" data-url="/update-profile" data-title="Enter last name">${mobile}</a></td>
</tr>
<tr>
<td>
Account Type:
</td>
<td>${user_type.toUpperCase()}</td>
</tr>
<tr>
<td>
Password:
</td>
<td><a href="#" onClick="pageLoadFromServer('/change-password');" class="btn btn-sm btn-outline-primary loader-link"><i class="fa fa-key"></i> Change Password</a></td>
</tr>
</script>

<script id="planTemplate" type="text/x-jQuery-tmpl">
<tr>
<td>
Plan:
</td>
<td><b>${plan_type.toUpperCase()}<b> &nbsp; 
{{if plan_type=='demo'}}
<a href="/plans" class="loader-link">Pick a Plan</a>
{{/if}}
</td>
</tr>
<tr>
<td>
Plan Started on:
</td>
<td>
${formatDateFull(plan_start_date)}
</td>
</tr>
<tr>
<td>
Plan valid till:
</td>
<td>
${formatDateFull(plan_valid_till)}
</td>
<tr>
<td colspan="2"><div class="progress">
                                <div class="progress-bar 
{{if calPeriodFinished(plan_start_date,plan_valid_till)>90}}
bg-warning
{{else calPeriodFinished(plan_start_date,plan_valid_till)>95}}
bg-danger
{{else}}
bg-success
{{/if}}
" role="progressbar" style="width: ${calPeriodFinished(plan_start_date,plan_valid_till)}%" aria-valuenow="${calPeriodFinished(plan_start_date,plan_valid_till)}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
{{if plan_type!='demo'}}
<a href="/plans" class="btn btn-sm btn-outline-info loader-link"><i class="fas fa-exchange-alt"></i> Upgrade or Change</a>
{{else}}
<a href="/plans"  class="btn btn-outline-info loader-link"><i class="fa fa-gift"></i> Pick a Plan</a>
{{/if}}
</td>
</tr>
</script>

<script id="paymentTemplate" type="text/x-jQuery-tmpl">
<tr>
<td>
${invoiceId}
</td>
<td>
${formatDateFull(invoiceDate)}
</td>
<td>
${amount}
</td>
<td>
${gst}
</td>
<td>
${payableAmount}
</td>
<td>
${formatDateFull(paymentDate)}
</td>
<td>
${status}
</td>
<td>
{{if status=="Pending"}}
<button type="button" class="btn btn-sm btn-outline-info loader-link">Pay Now</button>
<button type="button" class="btn btn-sm btn-outline-primary loader-link">Download</button>
{{else}}
<button type="button" class="btn btn-sm btn-outline-primary loader-link">Download</button>
{{/if}}
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
  		    
	var url ="<?php echo base_url().'user/account-details/'.$_SESSION['user']['userId'];?>";
  		    
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
                var html=$('#accountTemplate').tmpl(response);
                $('#account-content').html(html);
                html=$('#planTemplate').tmpl(response);
                $('#plan-content').html(html);
                $('.editable').editable({
               	 mode:'inline',
              	emptytext: "NA",
                    });
            });
        }
function loadPaymentDetails(){
	var url ="<?php echo base_url().'user/payment-details/'.$_SESSION['user']['userId'];?>";
    
	$.ajax({
        "url": url,
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        "async": true,
        "crossDomain": true,
    }).done(function (response) {
    	//console.log(response);
        var html=$('#paymentTemplate').tmpl(response);
        $('#payment-content').html(html);
    });
}
       loadDetails();
       loadPaymentDetails();

</script>
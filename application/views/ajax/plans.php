 <link href="<?php echo base_url(); ?>assets/css/plans.css"
	rel="stylesheet" />
  <div class="container">
    <div class="panel pricing-table">
      <?php foreach($result as $r){
          $payable_amount = (float)($r->amount+(float)(($r->amount*18)/100))*100;
          ?>
      <div class="pricing-plan">
        <img src="/assets/img/<?php echo $r->image?>" alt="" class="pricing-img">
        <h2 class="pricing-header"><?php echo $r->plan?></h2>
        <ul class="pricing-features">
          <li class="pricing-features-item">Cases: <?php echo $r->case_limit?></li>
          <li class="pricing-features-item">Users: <?php echo $r->user_limit?></li>
          <li class="pricing-features-item">Document storage limit:<br><?php echo ($r->doc_limit)?$r->doc_limit:'No Limit'?></li>
          <li class="pricing-features-item">Client Management: <?php echo ($r->client_management)?'Yes':'No'?></li>
          <li class="pricing-features-item">Sync with Google Calendar: <?php echo ($r->google_sync)?'Yes':'No'?></li>
          <li class="pricing-features-item">Google Drive/Dropbox Sync: <?php echo ($r->cloud_sync)?'Yes':'No'?></li>
        </ul>
        <span class="pricing-price"><i class="fas fa-rupee-sign"></i> <?php echo $r->amount?></span><br><span class="f-s-12 text-muted">(Taxes extra as applicable)</span>
        <button class="pricing-button" data-plan="<?php echo $r->plan?>" data-key="<?php echo $r->plan_key?>" data-rawamount="<?php echo $r->amount?>" data-amount="<?php echo $payable_amount?>">Select Plan</button>
      </div>
      <?php }?>
    </div>
  </div>
 <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$('.pricing-button').click(function(e){
	var btn = $(this);
	var options = {
		    "key": "<?php echo PAYMENT_GATEWAY_KEY?>",
		    "amount":$(this).data('amount'),
		    "name": "Adhivakta Plus",
		    "description": $(this).data('plan'),
		    "image": "/assets/img/logo.png",
		    "handler": function (response){
		        //alert(response.razorpay_payment_id);
		        //console.log(response);
		        $.ajax({
		        	 "url":"/payment/add",
		        	 "data":{'userId':'<?php echo $_SESSION['user']['userId']?>','plan':btn.data('plan'),'amount':btn.data('rawamount'),'txn_id':response.razorpay_payment_id},
		        	 "method":"POST",
		        	 "success":function(data){
		        		// window.location.replace("/workspace");
		        	 }
			        });
		    },
		    "prefill": {
		        "name": "<?php echo $user['first_name']?>",
		        "email": "<?php echo $user['email']?>",
		        "contact":"<?php echo $user['mobile']?>",
		    },
		    "theme": {
		        "color": "#9368E9"
		    }
		};
		var rzp1 = new Razorpay(options);
		rzp1.open();
	    e.preventDefault();
	
});
  // laod side bar
  	 $('.loader-link').on('click', function(e) {
  		 e.preventDefault();
			$(this).parent().siblings().removeClass('active');
	        $(this).parent().addClass('active');
	      	loadPage($(this).attr('href'),false);
	      	return false;
	      });
  </script>
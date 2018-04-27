<table border="0" cellpadding="0" cellspacing="0" width="100%"
	class="wrapperTable" style="max-width:600px;margin:0 auto;">
	<tbody>
		<tr>
			<td align="center" valign="top"><table border="0" cellpadding="0"
					cellspacing="0" width="100%" class="oneColumn"
					style="background-color: rgb(255, 255, 255); box-shadow: rgb(216, 216, 216) 0px 0px 10px;">
					<tbody>
						<tr>
							<td
								style="background-color: #8d6cd1; font-size: 1px; line-height: 3px"
								class="topBorder" height="3">&nbsp;</td>
						</tr>
						<tr>
							<td align="center" valign="top" class="imgHero"
								style="padding-bottom: 40px;"><a href="#"
								style="text-decoration: none" target="_blank"><img alt=""
									border="0" mc:edit="heroImg"
									src="https://www.adhivaktaplus.com/assets/img/payment.png"
									style="width: 100%; max-width: 600px; height: auto; display: block"
									width="600"></a></td>
						</tr>
						<tr>
							<td align="center" valign="top" class="title"
								style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;"><h2
									class="bigTitle" mc:edit="title"
									style="color: #313131; font-family: 'Open Sans', Helvetica, Arial, sans-serif; font-size: 26px; font-weight: 600; font-style: normal; letter-spacing: normal; line-height: 34px; text-align: center; padding: 0; margin: 0">Hi
									<?php echo $first_name?></h2></td>
						</tr>
						<tr>
							<td align="center" valign="top" class="description"
								style="padding-bottom: 40px; padding-left: 20px; padding-right: 20px;"><p
									class="midText" mc:edit="description"
									style="color: #919191; font-family: 'Open Sans', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 22px; text-align: center; padding: 0; margin: 0">Thanks
									for payment of <?php echo $payableAmount?> for your yearly subscription <?php echo $plan?> plan. </p></td>
						</tr>
						<tr>
							<td align="center" valign="top" class="subTitle"
								style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px"><h4
									class="midTitle" mc:edit="subTitle"
									style="color: #919191; font-family: 'Open Sans', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; font-style: normal; letter-spacing: normal; line-height: 26px; text-align: center; padding: 0; margin: 0">Details of Payment</h4></td>
						</tr>
						<tr>
							<td align="center" valign="top" class="description"
								style="padding-bottom: 40px; padding-left: 20px; padding-right: 20px;">
								<table border="0" cellpadding="0" cellspacing="0" width="60%"
					class="space">
					<tbody>
						<tr>
							<td style="font-size: 1px; line-height: 1px" >Subscription Plan Amount</td>
							<td style="font-size: 1px; line-height: 1px" ><?php echo $amount?></td>
						</tr>
						<tr>
							<td style="font-size: 1px; line-height: 1px" >GST (18%)</td>
							<td style="font-size: 1px; line-height: 1px" ><?php echo $gst?></td>
						</tr>
						<tr>
							<td style="font-size: 1px; line-height: 1px" >Total Amount Paid</td>
							<td style="font-size: 1px; line-height: 1px" ><?php echo $payableAmount?></td>
						</tr>
						<tr>
							<td style="font-size: 1px; line-height: 1px" >Subscription Period</td>
							<td style="font-size: 1px; line-height: 1px" >1 year</td>
						</tr>
						<tr>
							<td style="font-size: 1px; line-height: 1px" >Plan Valid till </td>
							<td style="font-size: 1px; line-height: 1px" ><?php echo date('M d, Y',strtotime($plan_valid_till))?></td>
						</tr>
					</tbody>
				</table>
								
								</td>
						</tr>
						<tr>
							<td align="center" valign="top" class="description"
								style="padding-bottom: 40px; padding-left: 20px; padding-right: 20px;"><p
									class="midText" mc:edit="confirm-link"
									style="color: #313131; font-family: 'Open Sans', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 22px; text-align: center; padding: 0; margin: 0">
									For any help or queries realted to plans and payments, please feel free to send an email at info@adhivaktaplus.com.
								</p>
								<p>
								Thank you!<br>
								Adhivakta Plus Team
								</p>
								</td>
						</tr>
						<tr>
							<td style="font-size: 1px; line-height: 1px" height="10">&nbsp;</td>
						</tr>
					</tbody>
				</table>
				<table border="0" cellpadding="0" cellspacing="0" width="100%"
					class="space">
					<tbody>
						<tr>
							<td style="font-size: 1px; line-height: 1px" height="30">&nbsp;</td>
						</tr>
					</tbody>
				</table></td>
		</tr>
	</tbody>
</table>
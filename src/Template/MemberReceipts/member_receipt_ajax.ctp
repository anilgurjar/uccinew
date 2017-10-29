<div class="col-xs-12">
<?php if(!empty($master_member)){
		foreach($master_member as $member_data){	
		if(empty($member_receipt_count)){ 
		if(!empty($master_membership_fee)){  ?>
<form method="post" class="print">
	<div class="col-sm-12">
		 <?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-print']) . 'Print',['class'=>'btn btn-sm btn-success pull-right print','type'=>'button','style'=>'margin-right:5px;','onclick'=>'window.print();']);
		 
		 
		 //echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'MemberReceipts', 'action' => 'member_receipt_pdf',$receipt_no),['class' => 'btn btn-sm btn-primary pull-right print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
	</div>
</form>
								
<table style="width:100%; margin-top:10px;" border="1" cellpadding="5"><tr><td style="padding:5px;">
								<table style="width:100%; text-align: center;line-height:1.3;">
									<tr>
									<td rowspan="4" ><?php echo $this->Html->image('/images/project_logo/UCCI LOGO.png',['fullBase'=>true,'width'=>'110px','height'=>'119px','style'=>'position:absolute;top: 4%;left: 20%;']); ?></td>
									<td ><b style="font-size:25px">Udaipur Chamber of Commerce & Industry</b></td>
									</tr>
									<tr>
									<td style="font-size: 16px;">Chamber Bhawan, M.I.A., Madri, UDAIPUR-313003 (Raj.)</td>
									</tr>
									<tr>
									<td style="font-size: 16px;">Tel. Nos. : 0294-2491060, 2491061 Fax : 0294-2492212</td>
									</tr>
									<tr>
									<td style="font-size: 16px;">Email : uccisec@hotmail.com, info@ucciudaipur.com</td>
									</tr>
									</table><br/>
									<p style="width:100%; text-align:center;font-size: 22px;">
										<u><strong>INVOICE</strong></u>
									</p>
									<table style="width: 100%;font-size:14px;">
									<tr>
									<td width="60%">
										<table  style="width: 100%;font-size:14px;">
											<tr>
												<td colspan="3"><?php echo $member_data->company_organisation; ?></td>
											</tr>
											<tr>
												<td colspan="3"><?php echo $member_data->address; ?></td>
											</tr>
											<tr><td><?php echo $member_data->city; ?> - <?php echo $member_data->pincode; ?><br/><br/></td></tr>
													<tr>
											<tr>
												<td width="30%"><strong>Ph. No.</strong></td>
												<td width="5%"><strong>:</strong></td>
												<td width="65%"><?php echo $member_data->office_telephone; ?></td>
											</tr>
											<tr>
												<td width="30%"><strong>Email</strong></td>
												<td width="5%"><strong>:</strong></td>
												<td width="65%"><?php echo $member_data->email; ?></td>
											</tr>
											<tr>
												<td width="30%"><strong>Contact Person</strong></td>
												<td width="5%"><strong>:</strong></td>
												<td width="65%"><?php echo $member_data->member_name; ?></td>
											</tr>
										</table>
									</td>
									<td width="40%"><br/><br/>
										<table  style="width: 100%;font-size:14px;">
											<tr>
												<td width="30%" style="text-align: left;"><strong>Invoice No.</strong></td>
												<td width="5%"><strong>:</strong></td>
												<td width="65%">UCCI/I <?php echo $bill_no=sprintf("%04d", $bill_no); ?>/<?php echo $from_year; ?>-<?php echo $to_year; ?></td>
											</tr>
											<tr>
												<td width="30%" style="text-align: left;"><strong>Date</strong></td>
												<td width="5%"><strong>:</strong></td>
												<td width="65%"><?php echo date('d-m-Y', strtotime($tax_date)); ?></td>
											</tr>
											<tr>
												<td width="30%" style="text-align: left;"><strong>ST Reg No.</strong></td>
												<td width="5%"><strong>:</strong></td>
												<td width="65%">AAATU0583ASD0001</td>
											</tr>
											<tr>
												<td width="30%" style="text-align: left;"><strong>PAN No.</strong></td>
												<td width="5%"><strong>:</strong></td>
												<td width="65%">AAATU0583ASD0001</td>
											</tr>
										</table>
									</td>
									</tr>
									</table>
							 
								<table style="width: 100%; font-size:16px; border-collapse: collapse;" border="1">
								<thead>
									 <tr>
										<th width="10%" style=" text-align:center;"><strong>S. No.</strong></th>
										<th width="75%" style="text-align:center;"><strong>Particulars</strong></th>
										<th width="15%" style="text-align:center;"><strong>Amount in (Rs.)</strong></th>
									</tr>
								</thead>
								<tbody>
							   
		<?php				$sr_no=0;
							$sub_total=0;
							$grand_total=0;
							$membership_fee=0;
							$turn_over_fee=0;
							foreach($master_membership_fee as $membership_data){
							$sr_no++;
							?>	
							<tr>
										<td width="10%" style="text-align:center;"><?php echo $sr_no; ?></td>
										<td width="75%" style=""><?php echo $membership_data->component; ?></td>
										<td width="15%" style="text-align:right;"><?php echo $fee=$membership_data->subscription_amount; ?></td>
										
									</tr>
						<?php	$membership_fee+=$fee; $sub_total+=$fee; }
							if(!empty($member_data->turn_over_id)){
								foreach($master_turn_over as $turn_over_data){
									$sr_no++; ?>
										<tr>
											<td width="10%" style="text-align:center"><?php echo $sr_no; ?></td>
											<td width="75%" style=""><?php echo $turn_over_data->component; ?></td>
											<td width="15%" style="text-align:right;"><?php echo $fee=$turn_over_data->subscription_amount; ?></td>
										</tr>
								<?php	
									$turn_over_fee+=$fee;
									$sub_total+=$fee;
								}}  ?>
							</tbody>
							<tfoot>
							<tr>
								<th  width="85%" colspan="2" style="text-align:right;text-align:right;"><strong>Sub Total</strong></th>
								<th width="15%"style="text-align:right;">
								<?php echo number_format($sub_total, 2, '.', ''); ?>
								</th>
								</tr>
							<?php	
								$total_tax=0;
								$grand_total+=$sub_total;
								foreach($taxation_rate as $tax_data => $tax_key)
								{
									foreach($tax_key as $tax_value)
									{ ?>
										
										<tr class="tax_cal">
										<th colspan="2" style="text-align:right;"><strong><?php echo $tax_data; ?></strong></th>
										<th style="text-align:right;">
										<?php	 
										$tax_amount=($sub_total*$tax_value->tax_percentage)/100;
										echo number_format($tax_amount, 2, '.', '');
											$total_tax+=$tax_amount;
											$grand_total+=$tax_amount;
										?>	
										</th>
										</tr>
								<?php }} ?>
								
								
								<tr>
								<th colspan="2" style="text-align:right;"><strong>Grand Total</strong></th>
								<th style="text-align:right;">
							<?php echo $grand_total=number_format($grand_total, 2, '.', ''); ?>
								</th>
								
								</tr>
							</tfoot>
							</table> 
						<?php  $word_value=explode('.',$grand_total);  ?>
								
								<p style="width:100%; text-align:left;font-size: 16px;">
								Amount in words: <?php echo ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[0])]));
								if($word_value[1] != 00){ ?>
									 & paisa <?php echo ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[1])]));
								} ?>
								Only.</p> 
								<p style="width:100%; text-align:right;font-size: 16px;">
								<strong>For: Udaipur Chamber of Commerce & Industry</strong>
								</p><br/><br/><br/><br/>
								<p style="width:100%; text-align:right;font-size: 16px;">
								Authorised Signatory
								</p></td></tr>
								
		<?php	}}	if(!empty($member_receipt_count)){  ?>
		<form method="post">
				<div class="col-sm-12">
					<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-print']) . 'Print',['class'=>'btn btn-sm btn-success pull-right print','type'=>'button','style'=>'margin-right:5px;','onclick'=>'window.print();']);

					echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'MemberReceipts', 'action' => 'member_receipt_pdf',$receipt_no),['class' => 'btn btn-sm btn-primary pull-right print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
				</div>
		</form>
						<table style="width:100%; margin-top:10px;" border="1" cellpadding="5">
						
				<?php } ?>
				<?php  $word_value=explode('.',$amount); ?>
					
					<tr>
					<td style="width:100%; text-align:center;font-size: 22px; padding:5px;">
						<u><strong>RECEIPT</strong></u>
						<br/>
				<table style="width: 100%; font-size: 16px;">
							<tr style="line-height:2;">
								<td style="width: 50%; text-align:left;">UCCI/PR<?php echo $num_padded = sprintf("%04d", $receipt_no); ?>/<?php echo $from_year; ?>-<?php echo $to_year; ?></td>
								<td style="width: 50%; text-align:right;">Date: <?php echo date('d-m-Y'); ?></td>
							</tr>
						<tr>
						<td colspan="2">
							<p style="width: 100%;font-size: 16px; text-align:justify;">
							Received with thanks from <?php echo $member_data->company_organisation; ?>, <?php echo $member_data->city; ?>
							a sum of Rupees <?php echo ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[0])]));
							if(!empty($word_value[1])){
							if($word_value[1] != 00 ) { ?>
								& paisa <?php echo ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[1])])); }} ?>
							Only vide <?php echo $amount_type; echo $cheque_no; ?> dated 
							<?php if(!empty($bank_id)){ ?>
							<?php echo date('d-m-Y',strtotime($cheque_date)); ?>
							<?php }else {
							echo date('d-m-Y');
							}
							if(!empty($drawn_bank)){ ?> drawn on <?php echo $drawn_bank; } ?>   
							on account of <?php echo $master_purpose[0]['purpose_name'];
							if(!empty($narration)){ ?> (<?php echo $narration; ?>) <?php } ?>
							</p>
						</td>
						</tr>
						</table> 
						<table style="width: 100%;font-size:16px;">
							<tr>
							<td colspan="2" style="width: 100%; text-align:right;">
								<strong>For: Udaipur Chamber of Commerce & Industry</strong>
							</td>
							</tr>
							<tr>
							<td  style="width: 30%; text-align:center;">
							<br/><br/><br/><br/>
							<table border="1" style="width: 100%;font-size:20px;">
							<tr><td>
								<strong>Rs. <?php echo number_format($amount, 2, '.', ''); ?></strong>
							</td></tr>
							</table>
							</td>
							<td style="width: 70%; text-align:right;"><br/><br/><br/><br/>Authorised Signatory</td>
							</tr>
						</table>
						</td></tr><tr><td style="width: 100%;font-size: 14px;line:height:2;">Note: Cheque/DD subject to clearance in bank.</td></tr>
						</table>		
							
								
<?php } } ?>
</div>
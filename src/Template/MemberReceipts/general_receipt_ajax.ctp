<style>
.border_none, .border_none th, .border_none td {
	   border:none !important; 
	}
</style>

<?php
$grand_total = 0;
$purpose_name_array = array();
foreach($purpose_array as $purpose_array_data){
	$sub_array = explode('/',$purpose_array_data);
	$purpose_idd = $sub_array[0];
	$quantity = $sub_array[1];
	$amount = $sub_array[2];
	$total_amount = $sub_array[3];
	$grand_total = $grand_total + $total_amount;
	
	$master_purposes = $this->requestAction(['controller'=>'MemberReceipts', 'action'=>'MasterPurposeDetail'],['pass'=>array($purpose_idd)]);	
	foreach($master_purposes as $ddd){
	$purpose_name_array[]=$ddd->purpose_name;	
	}
}
$purpose_name_array_implode=implode(',',$purpose_name_array);

/////////////////////////////count ttotal

 $typeee = 0;							
						        $grand_total_amount = 0;
						        $total_basic_amount = 0;
								$swach_bharat_cess=0; $total_service_tax=0; $krishi_kalyan_cess=0;
								foreach($purpose_array as $purpose_array_data){
								$sub_array = explode('/',$purpose_array_data);
								$purpose_id = $sub_array[0];
								$quantity = $sub_array[1];
								$amount = $sub_array[2];
								$total_amount = $sub_array[3];
							$master_purpose = $this->requestAction(['controller'=>'MemberReceipts', 'action'=>'MasterPurposeDetail'],['pass'=>array($purpose_id)]);						
							if(!empty($master_purpose)){
							if(!empty($master_purpose[0]['purpose_tax'])){
								$typeee = 1;
							$taxation = $this->requestAction(['controller'=>'MemberReceipts', 'action'=>'MasterTaxationsDetail'],['pass'=>array()]);	
						foreach($taxation as $data){
							$taxation_rate[$data->tax_name] = $this->requestAction(['controller'=>'MemberReceipts', 'action'=>'MasterTaxationRatesDetail'],['pass'=>array($data->tax_id)]);
						}
								 $total_tax=0; $html1=''; $n=0; 
										foreach($taxation_rate as $tax_data => $tax_key){
										foreach($tax_key as $tax_value){ $n++; 
											
											$tax_amount=($total_amount*$tax_value->tax_percentage)/100;
											 $tax_amount=number_format($tax_amount, 2, '.', '');
											 if($n == 1){
											 $total_service_tax = $total_service_tax + $tax_amount;
											 }
											 if($n == 2){
											 $swach_bharat_cess = $swach_bharat_cess + $tax_amount;
											 }
											 if($n == 3){
											 $krishi_kalyan_cess = $krishi_kalyan_cess + $tax_amount;
											 }
											 $tax_amount;
											$total_tax+=$tax_amount; 
								 }}
								 $total_basic_amount = $total_basic_amount + $total_tax; 
								 $grand_total_amount = $grand_total_amount + $total_amount; 
								 }else{
								 $grand_total_amount = $grand_total_amount + $total_amount;
								 }}} 
								 $gg_total = $grand_total_amount + $total_basic_amount;


//////////////////count ttotal






foreach($master_member as $member_data){
	 ?>
		<div class="col-sm-12">
	 <?php $word_value=explode('.',$gg_total); ?>
				<div class="col-sm-12">
					<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-print']) . 'Print',['class'=>'btn btn-sm btn-success pull-right print','type'=>'button','style'=>'margin-right:5px;','onclick'=>'window.print();']);

					echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'MemberReceipts', 'action' => 'general_receipt_pdf',$receipt_no),['class' => 'btn btn-sm btn-primary pull-right print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
				</div>
				<table style="width:100%; margin-top:10px;" border="1" cellpadding="5"><tr><td style="border-bottom:none !important;"><br/>
				<table style="width:100%; text-align: center;line-height:1.3;">
									<tr>
									<td <?php if($typeee == 1){ ?> rowspan="5" <?php }else{ ?> rowspan="4" <?php } ?>style="width:15%;">
									<?php echo '<img src="'.ROOT . DS  . 'webroot' . DS  .'images/project_logo/UCCI LOGO.png" width="75px" height="80px" />'; ?></td>
									<td style="width:85%;"><h2>Udaipur Chamber of Commerce & Industry</h2></td>
									</tr>
									<tr>
									<td style="width:85%;font-size: 16px;">Chamber Bhawan, M.I.A., Madri, UDAIPUR-313003 (Raj.)</td>
									</tr>
									<tr>
									<td style="width:85%;font-size: 16px;">Tel. Nos. : 0294-2491060, 2491061 Fax : 0294-2492212</td>
									</tr>
									<tr>
									<td style="width:85%;font-size: 16px;">Email : uccisec@hotmail.com, info@ucciudaipur.com</td>
									</tr>
									<?php if($typeee == 1){ ?>
										<tr>
									<td style="width:85%;font-size: 16px;">Service Tax Number : ABCDE1234F ST 001</td>
									</tr>
										
									<?php } ?>
									</table>
				</td>
				</tr>
				
				<tr><td style="width:100%; text-align:center;font-size: 22px; padding:5px; border-top:none !important;">
							<u><strong>RECEIPT</strong></u>
						<br/>
					
						<table style="width: 100%; font-size: 16px;">
							<tr style="line-height:2;">
								<td style="width: 50%; text-align:left;">UCCI/PR<?php echo $num_padded = sprintf("%04d", $receipt_no); ?>/<?php echo $from_year; ?> - <?php echo $to_year; ?></td>
								<td style="width: 50%; text-align:right;">Date: <?php echo date('d-m-Y'); ?></td>
							</tr>
						<tr>
						<td colspan="2">
						<p style="width: 100%;font-size: 16px; text-align:justify;">
						Received with thanks from <?php echo $member_data->company_organisation; ?>, <?php echo $member_data->city; ?>
						a sum of Rupees <?php echo ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[0])]));
						if(!empty($word_value[1])){
						if($word_value[1] != 00){ ?>
							 & paisa <?php echo ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[0])]));
						}} ?>
						Only vide <?php echo $amount_type; ?> <?php echo $cheque_no; ?> dated 
						<?php if(!empty($bank_id)){
							echo date('d-m-Y',strtotime($cheque_date));
						}else{
							echo date('d-m-Y');
						}
						if(!empty($drawn_bank)){ ?> drawn on <?php $drawn_bank; }  ?>   
						on accounts of <?php echo $purpose_name_array_implode;
						if(!empty($narration)){ ?> (<?php echo $narration; ?>) <?php } ?>
						</p>
						</td>
						</tr>
						</table>
						<br/>
						<table style="width: 100%;">
							<tr>
							
							<?php
                                $type = 0;							
						        $grand_total_amount = 0;
						        $total_basic_amount = 0;
								$swach_bharat_cess=0; $total_service_tax=0; $krishi_kalyan_cess=0;
								foreach($purpose_array as $purpose_array_data){
								$sub_array = explode('/',$purpose_array_data);
								$purpose_id = $sub_array[0];
								$quantity = $sub_array[1];
								$amount = $sub_array[2];
								$total_amount = $sub_array[3];
							$master_purpose = $this->requestAction(['controller'=>'MemberReceipts', 'action'=>'MasterPurposeDetail'],['pass'=>array($purpose_id)]);						
							if(!empty($master_purpose)){
							if(!empty($master_purpose[0]['purpose_tax'])){
								$type = 1;
							$taxation = $this->requestAction(['controller'=>'MemberReceipts', 'action'=>'MasterTaxationsDetail'],['pass'=>array()]);	
						foreach($taxation as $data){
							$taxation_rate[$data->tax_name] = $this->requestAction(['controller'=>'MemberReceipts', 'action'=>'MasterTaxationRatesDetail'],['pass'=>array($data->tax_id)]);
						}
								 $total_tax=0; $html1=''; $n=0; 
										foreach($taxation_rate as $tax_data => $tax_key){
										foreach($tax_key as $tax_value){ $n++; 
											
											$tax_amount=($total_amount*$tax_value->tax_percentage)/100;
											 $tax_amount=number_format($tax_amount, 2, '.', '');
											 if($n == 1){
											 $total_service_tax = $total_service_tax + $tax_amount;
											 }
											 if($n == 2){
											 $swach_bharat_cess = $swach_bharat_cess + $tax_amount;
											 }
											 if($n == 3){
											 $krishi_kalyan_cess = $krishi_kalyan_cess + $tax_amount;
											 }
											 $tax_amount;
											$total_tax+=$tax_amount; 
								 }}
								 $total_basic_amount = $total_basic_amount + $total_tax; 
								 $grand_total_amount = $grand_total_amount + $total_amount; 
								 }else{
								 $grand_total_amount = $grand_total_amount + $total_amount;
								 }}} 
								 $gg_total = $grand_total_amount + $total_basic_amount; 
								 
								 ?>	
								 <?php if($type == 1){ ?>
								 <td rowspan="2" style="width: 40%; text-align:left;font-size:16px;">
									<table  style="text-align:right; width: 100%;" border="1">
								 			<tr>
											<td style="padding-right:5px;">Service Tax</td>
											<td style="padding-right:5px;"><?php echo $total_service_tax; ?></td>
											</tr>
											<tr>
											<td style="padding-right:5px;">Swach Bharat Cess</td>
											<td style="padding-right:5px;"><?php echo $swach_bharat_cess; ?></td>
											</tr>
											<tr>
											<td style="padding-right:5px;">Krishi Kalyan Cess</td>
											<td style="padding-right:5px;"><?php echo $krishi_kalyan_cess; ?></td>
											</tr>
							
									<tr>
									<td style="padding-right:5px;">Basic Amount</td><td style="padding-right: 5px;">
									<?php echo number_format(($grand_total_amount), 2, '.', ''); ?></td>
									</tr>
									<tr>
									<td style="padding-right: 5px;"><strong>Total</strong></td><td style="padding-right: 5px;"><strong>
									<?php echo number_format($gg_total, 2, '.', ''); ?></strong></td>
									</tr>
									</table>
									</td>
									<td style="width: 60%; text-align:right;font-size: 16px;"><strong>For: Udaipur Chamber of Commerce & Industry</strong></td>
									</tr>
									<tr>
									<td style=" text-align:right;font-size: 16px;"><br/><br/><br/><br/>Authorised Signatory</td>
									</tr>
                               <?php }else{  ?>
									<td colspan="2" style="width: 60%; text-align:right;font-size: 16px;">
									<strong>For: Udaipur Chamber of Commerce & Industry</strong></td>
									</tr>
									<tr>
									<td  style="width: 30%; text-align:center;font-size:16px;"><br/><br/><br/><br/>
									<table border="1" style="font-size:20px;width:60%"><tr><td style="text-align:center;">
									Rs. <?php echo number_format($grand_total_amount, 2, '.', ''); ?>
									</td></tr></table>
									</td>
									<td style="width: 70%; text-align:right;font-size: 14px;"><br/><br/><br/><br/>Authorised Signatory</td>
									</tr>
									
								<?php } ?>
								    
						</table></td></tr><tr><td style="width: 100%;font-size: 14px;line:height:2; padding:5px;">Note: Cheque/DD subject to clearance in bank.</td></tr></table>
		</div>
<?php } ?>
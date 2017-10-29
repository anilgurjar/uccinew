<style>
.border_none, .border_none th, .border_none td {
	   border:none !important; 
	}
 .h3, h3 {
    font-size: 25px;
    font-weight: 700;
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-top: 5px;
    margin-bottom: 1px;
}
p{
	 margin:0px !important;
}
 @media print {
	 #logo{ 
		left:8% !important;
		width: 90px !important;
		height:90px !important;
    }
	  .hide_print{
		   display:none;
	   }
	   img
	   {
		   top: 70px !important;
		   left: 50px !important;
	   }
   }
</style>
<?php



foreach($master_member_receipt as $data){

	$receipt_no = $data->receipt_no; 
	$receipt_id = $data->receipt_id; 
	$amount_type = $data->amount_type;
	$cheque_no = $data->cheque_no;
	$bank_id = $data->bank_id;
	$cheque_date = $data->cheque_date;
	$drawn_bank = $data->drawn_bank;
	$narration = $data->narration;
	$tds_amount = $data->tds_amount;	
	$taxamount=$data->taxamount;	
	if($taxamount != 0)
	{
		$typeee=1;
	}
	else{
		$typeee=0;
	}
	
	if(date('m',strtotime($data->date_current)) < 4){
	$from_year=(date('y',strtotime($data->date_current))-1);
	$to_year=date('y',strtotime($data->date_current));
	}else{
		$from_year=date('y',strtotime($data->date_current));
		$to_year=(date('y',strtotime($data->date_current))+1);
	}
	foreach($data->general_receipt_purposes as $purpose)
	{
		$purpose_name[]=$purpose->master_purpose->purpose_name;
	}
	
	 ?>
	 <div style="width:100%; background-color:white; padding:10px; overflow:auto;">
		<div class="col-sm-12">
		
	 <?php $word_value=explode('.',$data->amount); ?>
				<div class="col-sm-12">
					<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-print']) . 'Print',['class'=>'btn btn-sm btn-success pull-right hide_print','type'=>'button','style'=>'margin-right:5px;','onclick'=>'window.print();']);

					echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'MemberReceipts', 'action' => 'general_receipt_pdf',$receipt_id),['class' => 'btn btn-sm btn-primary pull-right hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
				</div>
				<table style="width:100%; margin-top:10px;" border="1" cellpadding="5"><tr><td style="border-bottom:none !important;"><br/>
				<div align="center">
					<div style="float:left;position:absolute;left:20%;top:12%" id="logo">
					<?php 
					echo $this->Html->image('/images/project_logo/UCCI LOGO.png',['fullBase'=>true,'width'=>'90px','height'=>'90px','style'=>'']);
					echo '</div>';
					echo '<div style="float:right;width:100%">';
					foreach($MasterCompanies as $MasterCompany) 
					{
						echo $MasterCompany->company_information;
						$st_reg_no=$MasterCompany->st_reg_no;
						$pan_no=$MasterCompany->pan_no;
						
					}
					if($typeee == 1)
					{
						echo 'Service Tax Number : ABCDE1234FST001';
					}
					?>
					</div>
				</div>
			
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<p style="width:100%; text-align:center;font-size: 22px;">
					<u><strong>RECEIPT</strong></u>
				</p>
				</td>
				</tr>
				
				<tr><td style="width:100%; text-align:center;font-size: 20px; padding:5px; border-top:none !important;">
						
					
						<table style="width: 100%; font-size: 16px;">
							<tr style="line-height:2;">
								<td style="width: 50%; text-align:left;">UCCI/PR<?php echo $num_padded = sprintf("%04d", $receipt_no); ?>/<?php echo $from_year; ?>-<?php echo $to_year; ?></td>
								<td style="width: 50%; text-align:right;">Date: <?php echo date('d-m-Y', strtotime($data->date_current)); ?></td>
							</tr>
						<tr> 	
						<td colspan="2">
						<p style="width: 100%;font-size: 16px; text-align:justify;">
						Received with thanks from <?php echo $data->company->company_organisation; ?>, <?php echo $data->company->city; ?>
						a sum of Rupees <?php echo ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[0])]));
						if(!empty($word_value[1])){
						if($word_value[1] != 00){ ?>
							 & paisa <?php echo ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[0])]));
						}} ?>
						Only vide <?php echo $amount_type; ?> <?php echo $cheque_no; ?> dated 
						<?php if(!empty($bank_id) && $bank_id != 0){
							echo date('d-m-Y',strtotime($cheque_date));
						}else{
							echo date('d-m-Y');
						}
						if(!empty($drawn_bank)){ ?> drawn on <?php $drawn_bank; }  ?>   
						on accounts of <?php echo implode(',',$purpose_name);
						if(!empty($narration)){ ?> (<?php echo $narration; ?>) <?php } ?>
						.</p>
						</td>
						</tr>
						</table>
						<br/>
						<table style="width: 100%;">
							<tr>
							
							
								 <?php if($typeee == 1){ ?>
								 <td rowspan="2" style="width: 40%; text-align:left;font-size:16px;">
									<table  style="text-align:right; width: 100%;" border="1">
									<tr>
									<td style="padding-right:5px;">Basic Amount</td><td style="padding-right: 5px;">
									<?php echo number_format(($data->basic_amount), 2, '.', ''); ?></td>
									</tr>
									<?php
									foreach($data->tax_amounts as $tax_amount)
									{
										?>
										<tr>
										<td style="padding-right:5px;"><?php echo $tax_amount->master_taxation->tax_name; ?> @ <?php echo number_format(($tax_amount->tax_percentage), 2, '.', ''); ?>%</td>
										<td style="padding-right:5px;"><?php echo number_format(($tax_amount->amount), 2, '.', ''); ?></td>
										</tr>
										<?php
									}
									if(!empty($tds_amount)){
									?>
								 	<tr>
									<td style="padding-right: 5px;">Total Amount</td><td style="padding-right: 5px;">
									<?php echo number_format($data->basic_amount+$taxamount, 2, '.', ''); ?></td>
									</tr>	
							
									<tr>
									<td style="padding-right: 5px;">TDS Amount</td><td style="padding-right: 5px;">
									<?php echo number_format($tds_amount, 2, '.', ''); ?></td>
									</tr>
									<?php } ?>
									<tr>
									<td style="padding-right: 5px;"><strong>Grand Total</strong></td><td style="padding-right: 5px;"><strong>
									<?php echo number_format($data->amount, 2, '.', ''); ?></strong></td>
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
									Rs. <?php echo number_format($data->amount, 2, '.', ''); ?>
									</td></tr></table>
									</td>
									<td style="width: 70%; text-align:right;font-size: 14px;"><br/><br/><br/><br/>Authorised Signatory</td>
									</tr>
									
								<?php } ?>
								    
						</table></td></tr><tr><td style="width: 100%;font-size: 14px;line:height:2; padding:5px;">Note: Cheque/DD subject to clearance in bank.</td></tr></table>
		</div>
		</div>
<?php } ?>
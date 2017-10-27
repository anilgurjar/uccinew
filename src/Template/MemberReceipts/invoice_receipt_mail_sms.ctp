<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Mailer\Email;
if(!empty($MemberReceipts))
{
	foreach($MemberReceipts as $member_data)
	{
		$options = new Options();
		$options->set('defaultFont', 'Lato-Hairline');
		$dompdf = new Dompdf($options);
		if(date('m',strtotime($member_data->member_fee->invoice_date)) < 4){
		$from_year_r=(date('y',strtotime($member_data->member_fee->date))-1);
		$f_from_year=(date('Y',strtotime($member_data->member_fee->date))-1);
		$to_year_r=date('y',strtotime($member_data->member_fee->date));
	}else{
		$from_year_r=date('y',strtotime($member_data->member_fee->date));
		$f_from_year=(date('Y',strtotime($member_data->member_fee->date)));
		$to_year_r=(date('y',strtotime($member_data->member_fee->date))+1);
	}
	if(date('m') < 4){
		$from=(date('Y')-1).'-4-1';
		$to=date('Y').'-3-31';
	}else{
		$from=date('Y').'-4-1';
		$to=(date('Y')+1).'-3-31';
	}
	$c_year_of_joining=strtotime($from);
	//$year_of_joining=date('Y',strtotime($member_data->user->year_of_joining));
	$year_of_joining=strtotime($member_data->member_fee->user->year_of_joining);
	if($c_year_of_joining <= $year_of_joining){
		$condition_master_mebership=array('member_type_id'=>$member_data->member_fee->user->member_type_id);
	}else{
		$condition_master_mebership=array('member_type_id'=>$member_data->member_fee->user->member_type_id,'category_name'=>2);
	}
	
	$master_membership_fee=$this->requestAction(['controller'=>'Users', 'action'=>'FetchMasterMembershipFees'],['pass'=>array($condition_master_mebership)]);
	
	if(!empty($master_membership_fee))
	{
		if(!empty($member_data->member_fee->user->turn_over_id))
		{
			$master_turn_over=$this->requestAction(['controller'=>'Users', 'action'=>'FetchMasterTurnOvers'],['pass'=>array($member_data->member_fee->user->turn_over_id)]);
		}
	}
	 
			$html='<html>
<head>
 <style>
  @page { margin: 40px 20px 20px 20px; }

	@font-face {
		font-family: Lato;
		src: url("https://fonts.googleapis.com/css?family=Lato");
	}
	p{
		margin:0;font-family: Lato;line-height: 1;
	}
	table td{
		margin:0;font-family: Lato;padding:0;line-height: 1;
	}
	
	.table_rows, .table_rows th, .table_rows td {
	   border: 1pt thin solid  #000;border-collapse: collapse; 
	}
	table_padding, .table_padding th, .table_padding td {
		padding:2px;
	}
.border_none, .border_none th, .border_none td {
	   border:none; 
	}
	
	
	.table_rows th{
		
	}
		 .h3, h3 {
    font-size: 25px;
    font-weight: 700;
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-top: 5px;
    margin-bottom: 1px;
}
	</style>
</head>
<body><table class="table_rows" style="padding:2px;"><tr><td style="padding-left:1px;">
				<div align="center">
				<div style="float:left;position:absolute;margin-left:7%;top:1%">
					<img src="'.ROOT . DS  . 'webroot' . DS  .'images/project_logo/UCCI LOGO.png" width="90px" height="90px" />
				</div>
				<div style="float:right;width:100%">';
				foreach($MasterCompanies as $MasterCompany) 
				{
					$html.=$MasterCompany->company_information;
					$st_reg_no=$MasterCompany->st_reg_no;
					$pan_no=$MasterCompany->pan_no;
					$gst_number=$MasterCompany->gst_number;
					$compare_date=date("Y-m-d",strtotime($member_data->member_fee->invoice_date)); 
					$compare_date=strtotime($compare_date);
					$gst_date=strtotime("2017-07-01");
					if($gst_date<$compare_date){
						$text_type="GST No.";
						$type_number=$gst_number;
					}else{
						
						$text_type="ST Reg No.";
						$type_number=$st_reg_no;
					}
				}
				$email_to=$member_data->member_fee->user->email;
				$company=$member_data->member_fee->user->company_organisation;
				$address=$member_data->member_fee->user->address;
				$city=$member_data->member_fee->user->city;
				$pincode=$member_data->member_fee->user->pincode;
				$amount=number_format($member_data->amount, 2, '.', '');
				$receipt_id=$member_data->receipt_id;
				$member_name=$member_data->member_fee->user->member_name;
				$html.='</div>
			</div>
		<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
					<p style="width:100%; text-align:center; font-size:20px;">
						<u><strong>INVOICE</strong></u>
					</p>	
					
					
						<table style="width: 100%;" class="border_none">
						<tr>
						<td width="60%">
							<table width="100%" style="padding:2px;">
								<tr>
									<td colspan="3" style="font-size:13px;">'.$member_data->member_fee->user->company_organisation.'</td>
								</tr>
								<tr>
									<td colspan="3" style="font-size:13px;">'.$member_data->member_fee->user->address.'</td>
								</tr>
								<tr><td colspan="3" style="font-size:13px;"> '.$member_data->member_fee->user->city;
								if(!empty($member_data->member_fee->user->pincode))
								{
									$html.=' - '.$member_data->member_fee->user->pincode;
								}
								$html.='<br/></td></tr>
								<tr>
									<td width="30%"><strong style="font-size:13px;">Ph. No.</strong></td>
									<td width="5%"><strong style="font-size:13px;">:</strong></td>
									<td width="65%" style="font-size:13px;">'.$member_data->member_fee->user->office_telephone.'</td>
								</tr>
								<tr>
									<td width="30%"><strong style="font-size:13px;">Email</strong></td>
									<td width="5%"><strong style="font-size:13px;">:</strong></td>
									<td width="65%" style="font-size:13px;">'.$member_data->member_fee->user->email.'</td>
								</tr>';
								if($member_data->member_fee->user->member_type_id==1)
								{
								$html.='<tr>
									<td width="30%"><strong style="font-size:13px;">Authorized Representative</strong></td>
									<td width="5%"><strong style="font-size:13px;">:</strong></td>
									<td width="65%" style="font-size:13px;">'.$member_data->member_fee->user->member_name.'</td>
								</tr>';
								}
							$html.='</table>
						</td>
						<td width="40%">
							<table width="100%">
								<tr>
									<td width="30%" style="text-align: left;"><strong style="font-size:13px;">Invoice No.</strong></td>
									<td width="5%"><strong style="font-size:13px;">:</strong></td>
									<td width="65%" style="font-size:13px;">UCCI/I'.$invoice_no=sprintf("%04d", $member_data->member_fee->invoice_no).'/'.$from_year_r.'-'.$to_year_r.'</td>
								</tr>
								<tr>
									<td width="30%" style="text-align: left;"><strong style="font-size:13px;">Date</strong></td>
									<td width="5%"><strong style="font-size:13px;">:</strong></td>
									<td width="65%" style="font-size:13px;">'.date('d-m-Y', strtotime($member_data->member_fee->invoice_date)).'</td>
								</tr>
								<tr>
									<td width="30%" style="text-align: left;"><strong style="font-size:13px;">'.$text_type.'</strong></td>
									<td width="5%"><strong style="font-size:13px;">:</strong></td>
									<td width="65%" style="font-size:13px;">'.$type_number.'</td>
								</tr>
								<tr>
									<td width="30%" style="text-align: left;"><strong style="font-size:13px;">PAN No.</strong></td>
									<td width="5%"><strong style="font-size:13px;">:</strong></td>
									<td width="65%" style="font-size:13px;">'.$pan_no.'</td>
								</tr>
							</table>
						</td>
						</tr>
						</table>
				 
					<table width="100%" style=" border-collapse: collapse; padding: 5px;"  class="table_rows table_padding">
					<thead>
						 <tr>
							<th width="10%" style=" text-align:center;"><strong style="font-size:15px;">S. No.</strong></th>
							<th width="70%" style="text-align:center;"><strong style="font-size:15px;">Particulars</strong></th>
							<th width="20%" style="text-align:center;"><strong style="font-size:15px;">Amount in (Rs.)</strong></th>
						</tr>
					</thead>
					<tbody>';
					
								$sr_no=0;
								
									if(!empty($member_data->member_fee->user->turn_over_id))
									{						
										foreach($master_turn_over as $turn_over_data)
										{
											$sr_no++;
												$html.='<tr>
														<td width="10%" style="text-align:center; font-size:15px;">'.$sr_no.'</td>
														<td width="75%" style="font-size:15px;">Annual Subscription for F.Y. '.$f_from_year.'-'.$to_year_r.'</td>
														<td width="15%" style="text-align:right; font-size:15px;">'.$fee=number_format($turn_over_data->subscription_amount, 2, '.', '').'</td>
													</tr>';
											
										
										}
									}
									foreach($master_membership_fee as $membership_data)
									{
										$sr_no++;
											$html.='<tr>
													<td width="10%" style="text-align:center; font-size:15px;">'.$sr_no.'</td>
													<td width="75%" style="font-size:15px;">'.$membership_data->component.'</td>
													<td width="15%" style="text-align:right; font-size:15px;">'.$fee=number_format($membership_data->subscription_amount, 2, '.', '').'</td>
												</tr>';
										
										
									}
								$html.='</tbody>
								<tfoot>
								<tr>
								<td colspan="2" style="text-align:right;text-align:right;font-size:15px;">Basic Amount</td>
								<td  style="text-align:right; font-size:15px;">
										'.number_format($member_data->member_fee->sub_total, 2, '.', '').'
									</td>
									</tr>';
									foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
									{
										$html.='<tr class="tax_cal">
											<td colspan="2" style="text-align:right;font-size:15px;">'.$tax_data->master_taxation->tax_name.' @ '.$tax_data->tax_percentage.'%</td>
											<td style="text-align:right; font-size:15px;">';
												
												$html.=number_format($tax_data->amount, 2, '.', '');
												
												
											$html.='</td>
											</tr>';
									}
									
								$html.='<tr>
									<th colspan="2" style="text-align:right;"><strong style="font-size:15px;">Grand Total</strong></th>
									<th style="text-align:right; font-size:15px;">
										'.number_format($member_data->member_fee->grand_total, 2, '.', '').'
									</th>
									</tr>
								</tfoot>
								</table>
									<p style="width:100%; text-align:left;font-size: 14px;padding-left:8px;">
		Amount in words: '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($member_data->member_fee->grand_total)])).' Only.
		</p>';
								$html.='<div style="float:left; width:50%;">';
		$html.='</div><p style="width:100%; text-align:right;font-size: 15px; padding:2px 8px 0px 0px;">
								<strong>For: Udaipur Chamber of Commerce & Industry</strong>
								</p><br/><p  style="width:95%;"><img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/signature.png" width="100px" height="50px" align="right" /></p><br/><br/><br/><br/>
								<p style="width:100%; text-align:right;font-size: 15px; padding-right:8px;">
								Authorised Signatory
								</p></td></tr>';
					
					$word_value=explode('.',$member_data->amount);
					$html.='<tr><td style="padding:2px;">
					<center>
						<span style="width:100%; text-align:center; font-size:20px;">
						<u><strong>RECEIPT</strong></u>
						</span>
					</center>
							<br/>
						
							<table style="width: 100%;" class="border_none table_padding">
								<tr style="line-height:2;">
									<td style="width: 50%; text-align:left; font-size:13px;">UCCI/PR'.$num_padded = sprintf("%04d", $member_data->receipt_no).'/'.$from_year_r.'-'.$to_year_r.'</td>
									<td style="width: 50%; text-align:right; font-size:13px;">Date: '.date('d-m-Y', strtotime($member_data->date_current)).'</td>
								</tr>
							<tr>
							<td colspan="2">
							<p style="width:100%;font-size: 14px; text-align:justify;">
							Received with thanks from M/s. '.$member_data->member_fee->user->company_organisation.', '.$member_data->member_fee->user->city.'
							a sum of Rupees '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[0])]));
							
							if(!empty($word_value[1])){
								if($word_value[1] != 00){
								$html.=' & paisa '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[1])]));
							}}
						$html.=' Only vide '.$member_data->amount_type.' '.$member_data->cheque_no.' dated ';
						if(!empty($member_data->bank_id)){
							$html.=date('d-m-Y',strtotime($member_data->cheque_date));
						}else{
							$html.=date('d-m-Y');
						}
						if(!empty($member_data->drawn_bank)){ $html.=' drawn on '.$member_data->drawn_bank; }    
						$html.=' on account of '.$member_data->master_purpose->purpose_name;
						if(!empty($member_data->narration)){ $html.=' ('.$member_data->narration.')'; }
						$html.='. </p>
							</td>
							</tr>
							</table>
							<table style="width: 100%;" class="border_none">
								<tr>
								<td colspan="2" style="width: 100%; text-align:right; font-size:15px;"><strong>For: Udaipur Chamber of Commerce & Industry</strong></td></tr>
									<tr>
									<td  style="width: 30%; text-align:center;"><br/><br/><br/><br/><table class="table_rows" style="width:60%;"><tr><td style="font-size:16px; text-align:center;line-height:1.5;">
									Rs. '.number_format($member_data->amount, 2, '.', '').'
									</td></tr></table></td>
									
									<td style="width: 70%; text-align:right; font-size:15px;"><br/><p  style="width:95%;"><img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/signature.png" width="100px" height="50px" align="right" /></p><br/><br/><br/><br/>Authorised Signatory</td>
									</tr>
							</table>
							</td></tr><tr><td style="padding:2px;"><span style="width: 100%;font-size:15px; line-height:1;">Note: Cheque/DD subject to clearance in bank.</span></td></tr></table></body></html>';
							/*	$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($name,array('Attachment'=>0));
exit(0);*/
						$dompdf->loadHtml($html);
$dompdf->render();
$output = $dompdf->output();
file_put_contents('InvoiceReceipt.pdf', $output);	

$email = new Email();
$email->transport('SendGrid');

$subject="Annual Subscription for the Financial Year 2017-2018";
$from_name="UCCI";
$email_to=trim($email_to,' ');
//$email_to='ashishbohara1008@gmail.com';

try {
	$email->from(['ucciudaipur@gmail.com' => $from_name])
			->to($email_to)
			->replyTo('uccisec@hotmail.com')
			->subject($subject)
			->profile('default')
			->emailFormat('html')
			->template('invoice_receipt')
			 ->viewVars(['amount' => $amount, 'username' => $company,'address'=>$address,'pincode'=>$pincode,'city'=>$city,'member_name'=>$member_name])
			->attachments([
			'Invoice Receipt.pdf' => [
				'file' => 'InvoiceReceipt.pdf'
			]
		])
		->send();
	
	
	$this->requestAction(['controller'=>'MemberReceipts', 'action'=>'UpdateReceiptMail'],['pass'=>array($receipt_id,2)]);
} catch (Exception $e) {

	echo 'Exception : ',  $e->getMessage(), "\n";
	
	$this->requestAction(['controller'=>'MemberReceipts', 'action'=>'UpdateReceiptMail'],['pass'=>array($receipt_id,0)]);

}
	}
}


?>
<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Mailer\Email;
$options = new Options();
$options->set('defaultFont', 'Lato-Hairline');
$dompdf = new Dompdf($options);
$dompdf = new Dompdf();

foreach($master_member as $member_data)
{ 

//pr($member_data); 
	if(date('m',strtotime($member_data->member_fee->invoice_date)) < 4){
		$from_year_r=(date('y',strtotime($member_data->member_fee->date))-1);
		$f_from_year=(date('Y',strtotime($member_data->member_fee->date))-1);
		$to_year_r=date('y',strtotime($member_data->member_fee->date));
	}else{
		$from_year_r=date('y',strtotime($member_data->member_fee->date));
		$f_from_year=(date('Y',strtotime($member_data->member_fee->date)));
		$to_year_r=(date('y',strtotime($member_data->member_fee->date))+1);
	}
	
	 
			
$html='<html>
<head>
<style>
.border_none, .border_none th, .border_none td {
	   border:none !important; 
	}
.remove_border{
	border:none !important;
}
@page { margin: 15px 15px 10px 30px; }

body{
line-height: 20px;
}
#header { position:fixed; left: 0px; top: -150px; right: 0px; height: 150px;}
#content{
position: relative;
}
@font-face {
font-family: Lato;
src: url("https://fonts.googleapis.com/css?family=Lato");
}
p{
margin:0;font-family: Lato;font-weight: 100;line-height: 1;
}
table td{
margin:0;font-family: Lato;font-weight: 100;padding:0;line-height: 1;
}
table.table_rows tr.odd{
page-break-inside: avoid;
}
.table_rows, .table_rows th, .table_rows td {
border: 1px solid #000;border-collapse: collapse;padding:2px;
}
.itemrow tbody td{
border-bottom: none;border-top: none;
}
.table2 td{
border: 0px solid #000;font-size: 14px;padding:0px;
}
.table3 {
margin-top:-5px; border-top: none;
font-size:14px;
}
.table-amnt td{
border: 0px solid #000;padding:0px;
}
.table_rows th{
font-size:14px;
}
.avoid_break{
page-break-inside: avoid;
}
tr.noBorder > td {
border:0;
}
tr.Borderbottom > td {
border-bottom:0;
}

.text_align{
text-align:center;	
}
</style>
<body><center><strong>INVOICE</strong></center><br/>';
				foreach($MasterCompanies as $MasterCompany) 
				{
					$html1=$MasterCompany->company_information;
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
				
				$html.='<div id="content">

<table width="100%" class="table_rows table3" border="1">
	<tr>
	
	<td align="right" valign="" style="border-right:none;" >
		
		<img src="'.ROOT . DS  . 'webroot' . DS  .'images/project_logo/ucci.png" width="90px" height="90px" style="" alt="">
		
		</td>
	
		<td align="" colspan="4" style="border-left:none;"><center>
	'.$html1.'
		'.$text_type.' '.$type_number.'<br/>
		 PAN No. '.$pan_no.'
		</center>
		</td>
		
		
		<td  colspan="2" valign="top">
			
ORIGINAL FOR RECIPIENT<br/>

Invoice No. <br/> UCCI/I'.$invoice_no=sprintf("%04d", $member_data->member_fee->invoice_no).'/'.$from_year_r.'-'.$to_year_r.'
<br/><br/>
Dated <br/> '.date('d-m-Y', strtotime($member_data->member_fee->invoice_date)).'

			
		</td>
	</tr>
	

	<tr>
	<td align=""  colspan="3">
<strong>'.$member_data->member_fee->company->company_organisation.' </strong> <br/>
		'.$member_data->member_fee->company->address.'<br/>
		'.$member_data->member_fee->company->city.'';
		if(!empty($member_data->member_fee->company->pincode))
							{
								$html.=' - '.$member_data->member_fee->company->pincode;
							} 
		$html.='
		<br/> Ph. No. '.$member_data->member_fee->company->office_telephone.'<br/>
		Email '.$member_data->member_fee->company->users[0]->email .' <br/>
		<span>GSTIN/UIN :  '.$member_data->member_fee->company->gst_number.' <span> <br/>
		';
		if($member_data->member_fee->company_member_type->master_member_type_id==1)
							{
								$html.='Authorized Representative '.$member_data->member_fee->company->users[0]->member_name.'';
							}
	
	$html.='</td>
	<td colspan="4">
	</td>
	</tr>
	<tr>
	<td colspan="7"> Tax is payable on reverse charge (Y/N)</td>
	</tr>
	<tr><td colspan="7">
			<table width="100%" cellspacing="0" cellpadding="0"><tr>
		 
					<th class="text_align" style="border-top:none;border-left:none;">Sr no.</th>
					<th class="text_align" colspan="3" style="border-top:none;">Particulars</th>
					<th class="text_align" colspan="2" style="border-top:none;">HSN/SAC</th>
					<th class="text_align" style="border-top:none;">QTY/UNIT</th>
					<th class="text_align" style="border-top:none;">RATE</th>
					<th class="text_align" style="border-top:none;">TOTAL</th>';
					
				foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
					{
				
					
							$html.='<th colspan="2" align="center" style="border-top:none;">'.$tax_data->master_taxation->gst_name.'</th>';
					}
				$html.='<th rowspan="2" align="center" style="border-top:none;border-right:none;">Total</th>
								
							</tr>';
							
				$html.='<tr>
				<td colspan="9" style="border-left:none;"></td>';
				foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
						{

									$html.='<td align="center">Rate</td>
									<td align="center">Amount</td>';
							}

				$html.='</tr>';	

				$total_tax_am=0;
				$total_include_tax=0;
				if(!empty($member_data->member_fee->company->turn_over_id))
					{	
					$sr_no=0;				
					foreach($master_turn_over as $turn_over_data)
						{
						$sr_no++;
						$html.='<tr>
								<td style="border-left:none;">'.$sr_no.'</td>
								<td style=" " colspan="3"> <strong>Annual Subscription for F.Y. '.$f_from_year.'-'.$to_year_r.' </strong></td>
								
								<td colspan="2" align="center">'.$turn_over_data->HSN.'</td>
									<td align="center">1</td>
									<td align="center">'.$fee=number_format($turn_over_data->subscription_amount, 2, '.', '').'</td>
								<td style="text-align:right; " align="center">'.$fee=number_format($turn_over_data->subscription_amount, 2, '.', '').'</td>';
									
								foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
									{
									


										$html.='<td align="center">'.$tax_data->tax_percentage.' %</td>';
										$amount_sub_tax=$turn_over_data->subscription_amount*$tax_data->tax_percentage/100;
										$total_tax_am+=$amount_sub_tax;
										$total_include_tax+=$amount_sub_tax;
										$html.='<td align="center">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
									}

							$html.=' <td align="right" style="border-right:none;"><strong>'.number_format($total_tax_am+$fee, 2, '.', '').'</strong></td></tr>';



					}
				}
				
				
				foreach($master_membership_fee as $membership_data)
					{ 
					$sr_no++;
						$total_tax_am=0;
					$html.='<tr>
						<td  style="border-left:none; ">'.$sr_no.'</td>
						<td  style=" " colspan="3" ><strong>'.$membership_data->component.'</strong></td>
						
						<td colspan="2" align="center">'.$membership_data->HSN.'</td>
						<td align="center">1</td>
						<td align="center">'.$fee=number_format($membership_data->subscription_amount, 2, '.', '').'</td>

						<td  style=" font-size:15px;" align="center">'.$fee=number_format($membership_data->subscription_amount, 2, '.', '').' </td>';
					foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
									{
									


										$html.='<td align="center">'.$tax_data->tax_percentage.' %</td>';
										$amount_sub_tax=$membership_data->subscription_amount*$tax_data->tax_percentage/100;
										$total_tax_am+=$amount_sub_tax;
										$total_include_tax+=$amount_sub_tax;
										$html.='<td align="center">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
									}


					$html.=' <td align="right" style="border-right:none;"><strong>'.number_format($total_tax_am+$fee, 2, '.', '').'</strong></td></tr>';

					}
				
				$html.='
				<tr>
					
					';
						$siz=sizeof($member_data->member_fee->member_fee_tax_amounts); 
						$siz=$siz*2+9;


						$html.='<td align="right" colspan="'.$siz.'" style="border-bottom:none;"> GRAND TOTAL (INCLUSIVE OF GST) </td>
						';
					$html.='<td  style="text-align:right; font-size:15px;border-bottom:none;border-right:none;"><strong>
					'.number_format($member_data->member_fee->grand_total, 2, '.', '').'</strong>
					</td>
				</tr></table></td></tr>';

			$html.='
				<tr>
					
					<td colspan="6"> <span style="float:left;">Amount Chargeable(in words) </span> <br/>
					<strong>INR '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($member_data->member_fee->grand_total)])).' Only.</strong>
					<br/> <br/> <br/>
						
					</td>
					<td align="right" valign="top">
					<span style="float:right;">E & O.E</span>
					</td>
				</tr> ';
				
				$html.='
				<tr>
				<td colspan="7">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tr>
					<td rowspan="2" align="center" style="border-left:none;border-top:none;" >HSN/SAC</td>
					<td rowspan="2" style="border-top:none;" align="center">Taxable Value</td>';
					foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
					{
				
					
						$html.='<td colspan="2" style="border-top:none;" align="center">'.$tax_data->master_taxation->gst_name.'</td>';
					}
					$html.='<td rowspan="2" style="border-top:none;border-right:none;" align="center">Total Tax Amount</td>
				</tr> 
				<tr>';
					
					foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
					{
				
					
						$html.='<td align="center">Rate</td>
					<td align="center">Amount</td>';
					}
					
					
				$html.='</tr> 
				
				';
				
				
				$total_am=0; $total_taxable_amount=0; $total_tax_amount=0; $total_central_amount=[]; $total_state_amount=0;
				if(!empty($member_data->member_fee->company->turn_over_id))
				{ 					
					foreach($master_turn_over as $turn_over_data)
					{
						$total_taxable_amount+=$turn_over_data->subscription_amount;
						$html.='<tr>
								<td style="border-left:none;">'.$turn_over_data->HSN.'</td>
								<td style=" " align="right">'.number_format($turn_over_data->subscription_amount, 2, '.', '').' </td>';
								$x=0;
									foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
									{$x++; 
									


										$html.='<td align="right">'.$tax_data->tax_percentage.' %</td>';
										$amount_sub_tax=$turn_over_data->subscription_amount*$tax_data->tax_percentage/100;
										/* if($x==1){
											$total_central_amount+=$amount_sub_tax;
										}
										if($x==2){
											$total_state_amount+=$amount_sub_tax;

										} */
										
										@$total_central_amount[$x]+=$amount_sub_tax;
										$total_am+=$amount_sub_tax;
										
										$html.='<td align="right">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
									}
								$total_tax_amount+=$total_am;
								$html.='<td  align="right" style="border-right:none;">'.number_format($total_am, 2, '.', '').' </td>
								
							</tr>';


					}
				}
				
				$colum_amount=0;
				foreach($master_membership_fee as $membership_data)
					{  $total_taxable_amount+=$membership_data->subscription_amount;
					$total_am=0; 
						$html.='
					<tr>
					<td style="border-left:none;">'.$membership_data->HSN.'</td>
					<td align="right">'.number_format($membership_data->subscription_amount, 2, '.', '').'</td>';
					$x=0;
					
					foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
					{
						$x++;
					
						$html.='<td align="right">'.$tax_data->tax_percentage.' %</td>';
						$amount_sub_tax=$membership_data->subscription_amount*$tax_data->tax_percentage/100;
								
								
								@$total_central_amount[$x]+=$amount_sub_tax;
								
						$total_am+=$amount_sub_tax;
						$html.='<td align="right">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
					}
					$colum_amount+=$total_am;
					$total_tax_amount+=$total_am;
					$html.='
					
					
					<td align="right" style="border-right:none;" >'.number_format($total_am, 2, '.', '').'</td>
					</tr> ';
						
						
					}
				
				$html.='<tr>
				<td align="right" style="border-left:none;border-bottom:none;">Total</td>
				<td align="right" style="border-bottom:none;" ><strong>'.number_format($total_taxable_amount, 2, '.', '').'</strong></td>';
				$xxx=0;
				foreach($member_data->member_fee->member_fee_tax_amounts as $tax_data)
					{ $xxx++;
					
				$html.='
				
				<td style="border-bottom:none;"></td> 
				<td align="right" style="border-bottom:none;"><strong>'.number_format($total_central_amount[$xxx], 2, '.', '').'</strong></td> ';
					}
							
				$html.='<td align="right" style="border-right:none;border-bottom:none;"><strong>'.number_format($total_tax_amount, 2, '.', '').'</strong></td> 
				</tr> </table></td></tr>';
				
				$html.='<tr>
					
					<td colspan="2" style="border:none;">';
	/*   foreach($BankDetails as $BankDetail)
		{
			$html.='<table width="100%" style="font-size: 11px;padding-left:8px; border:none;" cellspacing="0">
				
				<tr>
					<td style="text-align:left;font-size: 13px;" class="remove_border"><strong>Bank Details</strong></td>
					
					<td  style="text-align:left;" class="remove_border"></td>
				</tr>
				<tr>
					<td  style="text-align:left;" class="remove_border">Account Holder Name</td>
					
					<td  style="text-align:left;" class="remove_border">'.$BankDetail->account_holder_name.'</td>
				</tr>
				<tr>
					<td  style="text-align:left;" class="remove_border">Bank Name & Address</td>
					
					<td  style="text-align:left;" class="remove_border">'.$BankDetail->bank_name_and_address.'</td>
				</tr>
				<tr>
					<td  style="text-align:left;" class="remove_border">Bank Account Number</td>
					
					<td  style="text-align:left;" class="remove_border">'.$BankDetail->bank_account_number.'</td>
				</tr>
				<tr>
					<td style="text-align:left;" class="remove_border">RTGS/NEFT IFS Code</td>
					
					<td  style="text-align:left;" class="remove_border">'.$BankDetail->rtgs_neft_ifs_code.'</td>
				</tr>
			</table>';
			
		}
					 */
					 //foreach( $signature as $signatur){  <img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/'.$signatur['signature_image'].'" width="100px" height="50px" align="right" />}
					$html.='</td>
					<td colspan="5" align="right"> 
					<strong style="font-size:15px;">For: Udaipur Chamber of Commerce & Industry </strong>
					<br/> <br/>
					<p style="width:100%; text-align:right; font-size: 15px;padding-right:8px;">
					
					<img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/signature1.png" width="100px" height="50px" align="right" />
					 <br/> <br/> <br/> <br/>
						Authorised Signatory</p>
					</td>
					
		</table>
		
		
				
			
		
</div>';


$word_value=explode('.',$member_data->member_receipt->amount);
$html.='<div class="" style="page-break-before:always;"><table width="100%" class="table_rows table3" border="1">
		<tr>
		
		<td align="center" style="border-right:none;">
		
			<img src="'.ROOT . DS  . 'webroot' . DS  .'images/project_logo/ucci.png" width="90px" height="90px" style="" alt="">
			
		</td>
		
			
		
			<td align="" colspan="6" style="border-left:none;">
			
			
			'.$html1.'
				'.$text_type.' '.$type_number.'<br/>
				 PAN No. '.$pan_no.'
				
			</td>
				
		</tr>
		<tr>
			<td colspan="7">
				<center>
						<span style="width:100%; text-align:center; font-size:20px;">
						<u><strong>RECEIPT</strong></u>
						</span>
					</center>
					
					<table style="width: 100%;" class="border_none table_padding">
								<tr style="line-height:2;">
									<td style="width: 50%; text-align:left; font-size:13px;">UCCI/PR'.$num_padded = sprintf("%04d", $member_data->member_receipt->receipt_no).'/'.$from_year_r.'-'.$to_year_r.'</td>
									<td style="width: 50%; text-align:right; font-size:13px;">Date: '.date('d-m-Y', strtotime($member_data->member_receipt->date_current)).'</td>
								</tr>
							<tr>
							<td colspan="2">
							<p style="width:100%;font-size: 14px; text-align:justify;">
							Received with thanks from M/s. '.$member_data->member_fee->company->company_organisation.', '.$member_data->member_fee->company->city.'
							a sum of Rupees '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[0])]));
							
							if(!empty($word_value[1])){
								if($word_value[1] != 00){
								$html.=' & paisa '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[1])]));
							}}
						$html.=' Only vide '.$member_data->member_receipt->amount_type.' '.$member_data->member_receipt->cheque_no.' dated ';
						if(!empty($member_data->member_receipt->bank_id)){
							$html.=date('d-m-Y',strtotime($member_data->member_receipt->cheque_date));
						}else{
							$html.=date('d-m-Y');
						}
						if(!empty($member_data->member_receipt->drawn_bank)){ $html.=' drawn on '.$member_data->member_receipt->drawn_bank; }    
						$html.=' on account of '.$member_data->member_receipt->master_purpose->purpose_name;
						if(!empty($member_data->member_receipt->narration)){ $html.=' ('.$member_data->member_receipt->narration.')'; }
						$html.='. </p>
							</td>
							</tr>
							</table>
					
					<table style="width: 100%;" class="border_none">
								<tr>
								<td colspan="2" style="width: 100%; text-align:right; font-size:15px;"><strong>For: Udaipur Chamber of Commerce & Industry</strong></td></tr>
									<tr>
									<td  style="width: 30%; text-align:center;"><br/><br/><br/><br/><table class="table_rows" style="width:60%;"><tr><td style="font-size:16px; text-align:center;line-height:1.5;">
									Rs. '.number_format($member_data->member_receipt->amount, 2, '.', '').'
									</td></tr></table></td>
									
									<td style="width: 70%; text-align:right; font-size:15px;"><br/><p  style="width:95%;"><img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/signature1.png" width="100px" height="50px" align="right" /></p><br/><br/><br/><br/>Authorised Signatory</td>
									</tr>
									
									
									
							</table>
							
			
			</td>
			<tr><td style="padding:2px;" colspan="7"><span style="width: 100%;font-size:15px; line-height:1;">Note: Cheque/DD subject to clearance in bank.</span></td></tr>
		
		</tr>
		
		
		</table> </div>';



$html.='</body>
</html>';	
	
	
				
	}
	
	
	
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($name,array('Attachment'=>0));
exit(0);


?>

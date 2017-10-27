<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Mailer\Email;

if(!empty($master_member))
{
	
	foreach($master_member as $member_data)
	{
		$users=$member_data->company->users;
		
	$company=$member_data->company->company_organisation;
	$address=$member_data->company->address;
	$city=$member_data->company->city;
	$pincode=$member_data->company->pincode;
	$amount=$member_data->grand_total;
	$member_name=$users[0]->member_name;
	$email_to=$users[0]->email;
		
		if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
			}
			$c_year_of_joining=strtotime($from);
			
					//pr();exit;
					//$year_of_joining=date('Y',strtotime($member_data->user->year_of_joining));
					$year_of_joining=strtotime($member_data->company->year_of_joining);
					if($c_year_of_joining <= $year_of_joining)
					{
						$condition_master_mebership=array('member_type_id'=>$member_data->company_member_type->master_member_type_id);
					}else{
						$condition_master_mebership=array('member_type_id'=>$member_data->company_member_type->master_member_type_id,'category_name'=>2);
					}
						
					$master_membership_fee=$this->requestAction(['controller'=>'Users', 'action'=>'FetchMasterMembershipFees'],['pass'=>array($condition_master_mebership)]);
					
					//pr($master_membership_fee);	exit;
					if(!empty($member_data->company->turn_over_id))
							{
								
								
								$master_turn_over=$this->requestAction(['controller'=>'Users', 'action'=>'FetchMasterTurnOvers'],['pass'=>array($member_data->company->turn_over_id)]);
								
							}
		
		
		
		
	$options = new Options();
	$options->set('defaultFont', 'Lato-Hairline');
	$dompdf = new Dompdf($options);

	
$html='<html>
<head>
<style>
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
font-size:13px;
}
.table-amnt td{
border: 0px solid #000;padding:0px;
}
.table_rows th{
font-size:15px;
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


	$users=$member_data->company->users;

if(date('m',strtotime($member_data->date)) < 4){
		$from_year=(date('y',strtotime($member_data->date))-1);
		$f_from_year=(date('Y',strtotime($member_data->date))-1);
		$to_year=date('y',strtotime($member_data->date));
	}else{
		$from_year=date('y',strtotime($member_data->date));
		$f_from_year=(date('Y',strtotime($member_data->date)));
		$to_year=(date('y',strtotime($member_data->date))+1);
	}
	//pr($master_member);exit;
			foreach($MasterCompanies as $MasterCompany) 
				{
					$html1=$MasterCompany->company_information;
					$st_reg_no=$MasterCompany->st_reg_no;
					$pan_no=$MasterCompany->pan_no;
					$gst_number=$MasterCompany->gst_number;
					$compare_date=date("Y-m-d",strtotime($member_data->date)); 
					$compare_date=strtotime($compare_date);
					$gst_date=strtotime("2017-07-01");
					if($gst_date<$compare_date){
						$text_type="GSTIN/UIN";
						$type_number=$gst_number;
					}else{
						
						$text_type="ST Reg No.";
						$type_number=$st_reg_no;
					}
					
				}

$html.='<div id="content">

<table width="100%" class="table_rows table3">
	<tr>
		<td align="" colspan="3"><center>
	'.$html1.'
		'.$text_type.' '.$type_number.'<br/>
		 PAN No. '.$pan_no.'
		</center>
		</td>
		
		<td  colspan="2" valign="top">
			Invoice No. <br/> UCCI/I'.$performa_invoice_no=sprintf("%04d", $member_data->performa_invoice_no).'/'.$from_year.'-'.$to_year.'
<br/><br/>
Dated <br/> '.date('d-m-Y', strtotime($member_data->date)).'

		</td>
		<td  colspan="2" valign="top">
			
ORIGINAL FOR RECIPIENT<br/>
			DUPLICATE FOR SUPPLIER
		</td>
	</tr>
	

	<tr>
	<td align=""  colspan="3">
<h4>'.$member_data->company->company_organisation.' </h4>
		'.$member_data->company->address.'<br/>
		'.$member_data->company->city.'';
		if(!empty($member_data->company->pincode))
							{
								$html.=' - '.$member_data->company->pincode;
							} 
		$html.='
		<br/> Ph. No. '.$member_data->company->office_telephone.'<br/>
		Email '.$users[0]->email.' <br/>
		<span>GSTIN/UIN :  '.$member_data->company->gst_number.' <span> <br/>
		';
		if($member_data->company_member_type->master_member_type_id==1)
							{
								$html.='Authorized Representative '.$users[0]->member_name.'';
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

					foreach($member_data->member_fee_tax_amounts as $tax_data)
						{
				
					
							$html.='<td colspan="2" align="center" style="border-top:none;">'.$tax_data->master_taxation->gst_name.'</td>';
						}
						$html.='<td rowspan="2" align="center" style="border-top:none;border-right:none;">Total</td>
							</tr>';

						$html.='<tr>
						<td colspan="9" style="border-left:none;"></td>';
						foreach($member_data->member_fee_tax_amounts as $tax_data)
								{

											$html.='<td align="center">Rate</td>
											<td align="center">Amount</td>';
									}

						$html.='</tr>';


				$total_tax_am=0;
				$total_include_tax=0;
				$total_tax_am=0;
				$total_include_tax=0;
				if(!empty($member_data->company->turn_over_id))
				{ $sr_no=0;						
					foreach($master_turn_over as $turn_over_data)
					{
						$sr_no++;
						$html.='<tr>
								<td style="border-left:none;">'.$sr_no.'</td>
								<td style=" " colspan="3"> <strong>Annual Subscription for F.Y. '.$f_from_year.'-'.$to_year.' </strong></td>
								
								<td colspan="2" align="center">'.$turn_over_data->HSN.'</td>
									<td>1</td>
									<td>'.$fee=number_format($turn_over_data->subscription_amount, 2, '.', '').'</td>
								<td style="text-align:right; "><strong>'.$fee=number_format($turn_over_data->subscription_amount, 2, '.', '').'</strong></td>';
									
								foreach($member_data->member_fee_tax_amounts as $tax_data)
									{
									


										$html.='<td align="right">'.$tax_data->tax_percentage.' %</td>';
										$amount_sub_tax=$turn_over_data->subscription_amount*$tax_data->tax_percentage/100;
										$total_tax_am+=$amount_sub_tax;

										$total_include_tax+=$amount_sub_tax;
										$html.='<td align="right">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
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
						<td  style=" " colspan="3"><strong>'.$membership_data->component.'</strong></td>
						
						<td colspan="2" align="center">'.$membership_data->HSN.'</td>
						<td>1</td>
						<td>'.$fee=number_format($membership_data->subscription_amount, 2, '.', '').'</td>

						<td  style="text-align:right; font-size:15px;"><strong>'.$fee=number_format($membership_data->subscription_amount, 2, '.', '').' </strong></td>';
					foreach($member_data->member_fee_tax_amounts as $tax_data)
									{
									


										$html.='<td align="right">'.$tax_data->tax_percentage.' %</td>';
										$amount_sub_tax=$membership_data->subscription_amount*$tax_data->tax_percentage/100;
										$total_tax_am+=$amount_sub_tax;
										$total_include_tax+=$amount_sub_tax;
										$html.='<td align="right">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
									}


					$html.=' <td align="right" style="border-right:none;"><strong>'.number_format($total_tax_am+$fee, 2, '.', '').'</strong></td></tr>';

					}
				/* $sr_no++;
				$html.='
				<tr>
					<td >'.$sr_no.'</td>
					<td style="" colspan="3"><strong>Basic Amount </strong></td>
					
						<td colspan="2"></td>
					<td style="text-align:right; font-size:15px;"><strong>
					'.number_format($member_data->sub_total, 2, '.', '').'</strong>
					</td>
				</tr>';
				//pr($member_data->member_fee_tax_amounts);exit;
				foreach($member_data->member_fee_tax_amounts as $tax_data)
				{
					$sr_no++;

				$html.='<tr class="tax_cal">
				<td>'.$sr_no.'</td>
				<td colspan="3"><strong>'.$tax_data->master_taxation->tax_name.' @ '.$tax_data->tax_percentage.'% </strong></td>
					
					<td colspan="2"></td>
				
				<td style="text-align:right; font-size:15px;"><strong>'.number_format($tax_data->amount, 2, '.', '').'</strong>
				</td>
				</tr>';
				}
				 */


				$html.='
				<tr>
					
					';
						$siz=sizeof($member_data->member_fee_tax_amounts); 
						$siz=$siz*2+9;


						$html.='<td align="right" colspan="'.$siz.'" style="border-bottom:none;"> GRAND TOTAL (INCLUSIVE OF GST) </td>
						';
								
				$html.='<td  style="text-align:right; font-size:15px;border-bottom:none;border-right:none;"><strong>
					'.number_format($member_data->grand_total, 2, '.', '').'</strong>
					</td>
				</tr></table></td></tr>';
				
			$html.='
				<tr>
					
					<td colspan="6"> <span style="float:left;">Amount Chargeable(in words) </span> <br/>
					<strong>INR '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($member_data->grand_total)])).' Only.</strong>
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
					foreach($member_data->member_fee_tax_amounts as $tax_data)
					{
				
					
						$html.='<td colspan="2" style="border-top:none;" align="center">'.$tax_data->master_taxation->gst_name.'</td>';
					}
					$html.='<td rowspan="2" style="border-top:none;border-right:none;" align="center">Total Tax Amount</td>
				</tr> 
				<tr>';
					
					foreach($member_data->member_fee_tax_amounts as $tax_data)
					{
				
					
						$html.='<td align="center">Rate</td>
					<td align="center">Amount</td>';
					}
					
					
				$html.='</tr> 
				
				';
				$total_am=0; $total_taxable_amount=0; $total_tax_amount=0; $total_central_amount=[]; $total_state_amount=0;
				if(!empty($member_data->company->turn_over_id))
				{ 					
					foreach($master_turn_over as $turn_over_data)
					{
						$total_taxable_amount+=$turn_over_data->subscription_amount;
						$html.='<tr>
								<td style="border-left:none;">'.$turn_over_data->HSN.'</td>
								<td style=" " align="right">'.number_format($turn_over_data->subscription_amount, 2, '.', '').' </td>';
								$x=0;
									foreach($member_data->member_fee_tax_amounts as $tax_data)
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
					//pr($member_data->member_fee_tax_amounts);
					foreach($member_data->member_fee_tax_amounts as $tax_data)
					{
						$x++;
					
						$html.='<td align="right">'.$tax_data->tax_percentage.' %</td>';
						$amount_sub_tax=$membership_data->subscription_amount*$tax_data->tax_percentage/100;
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
				foreach($member_data->member_fee_tax_amounts as $tax_data)
					{ $xxx++;
					
				$html.='
				
				<td style="border-bottom:none;"></td> 
				<td align="right" style="border-bottom:none;"><strong>'.number_format($total_central_amount[$xxx], 2, '.', '').'</strong></td> ';
					}
							
				$html.='<td align="right" style="border-right:none;border-bottom:none;"><strong>'.number_format($total_tax_amount, 2, '.', '').'</strong></td> 
				</tr> </table></td></tr>';
			
					$html.='<tr>
					
					<td colspan="3" style="border:none;">';
	  foreach($BankDetails as $BankDetail)
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
					
					$html.='</td>
					<td colspan="4" align="right"> 
					<strong style="font-size:15px;">For: Udaipur Chamber of Commerce & Industry </strong>
					<br/> <br/> <br/> <br/>
					<p style="width:100%; text-align:right; font-size: 15px;padding-right:8px;">
						Authorised Signatory</p>
					</td>
					
				</tr> 
				

</table>

</div>
</body>
</html>';






$invoice_id=$member_data->id;
	
$dompdf->loadHtml($html);
$dompdf->render();
$output = $dompdf->output();
file_put_contents('ProformaInvoice.pdf', $output);	

$email = new Email();
$email->transport('SendGrid');

$subject="Annual Subscription for the Financial Year 2017-2018";
$from_name="UCCI";
$email_to=trim($email_to,' ');

//$email_to="rohitkumarjoshi43@gmail.com";

 try {
	$email->from(['ucciudaipur@gmail.com' => $from_name])
			->to($email_to)
			->replyTo('uccisec@hotmail.com')
			->subject($subject)
			->profile('default')
			 ->template('performa_invoice')
			->emailFormat('html')
			 ->viewVars(['amount' => $amount, 'username' => $company,'address'=>$address,'pincode'=>$pincode,'city'=>$city,'member_name'=>$member_name])
			->attachments([
			'Proforma Invoice.pdf' => [
				'file' => 'ProformaInvoice.pdf'
			]
		])
		->send();
	
	$this->requestAction(['controller'=>'Users', 'action'=>'UpdateInvoiceMail'],['pass'=>array($invoice_id,2)]);
} catch (Exception $e) {

	echo 'Exception : ',  $e->getMessage(), "\n";
	$this->requestAction(['controller'=>'Users', 'action'=>'UpdateInvoiceMail'],['pass'=>array($invoice_id,0)]);

}
}
}
?>
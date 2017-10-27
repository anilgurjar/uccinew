<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Mailer\Email;
$options = new Options();
$options->set('defaultFont', 'Lato-Hairline');
$dompdf = new Dompdf($options);
$dompdf = new Dompdf();

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
	   border: 1pt thin solid  #000;border-collapse: collapse;padding:2px; 
	}

	
	
	.table_rows th{
		font-size:14px;
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
<body>';
foreach($master_member as $member_data)
{
	if(date('m',strtotime($member_data->date)) < 4){
		$from_year=(date('y',strtotime($member_data->date))-1);
		$f_from_year=(date('Y',strtotime($member_data->date))-1);
		$to_year=date('y',strtotime($member_data->date));
	}else{
		$from_year=date('y',strtotime($member_data->date));
		$f_from_year=(date('Y',strtotime($member_data->date)));
		$to_year=(date('y',strtotime($member_data->date))+1);
	}
$html.='<table cellpadding="15" style="width:100%;border:1pt thin solid black;">
<tr>
<td style="padding-left:1px; ">
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
					$compare_date=date("Y-m-d",strtotime($member_data->date)); 
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
				
				$html.='</div>
			</div>
		<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<center>
			
					<p style="width:100%; text-align:center; font-size:20px;">
						<u><strong>PROFORMA INVOICE</strong></u>
					</p>
					</center>					
					<center>
					<table style="width: 100%;">
					<tr>
					<td width="60%">
						<table width="100%">
							<tr>
								<td colspan="3" style="font-size:13px;">'.$member_data->user->company_organisation.'</td>
							</tr>
							<tr>
								<td colspan="3" style="font-size:13px;">'.$member_data->user->address.'</td>
							</tr>
							<tr><td colspan="3" style="font-size:13px;"> '.$member_data->user->city;
							if(!empty($member_data->user->pincode))
							{
								$html.=' - '.$member_data->user->pincode;
							}
							$html.='<br/></td></tr>
							<tr>
								<td width="30%"><strong style="font-size:13px;">Ph. No.</strong></td>
								<td width="5%"><strong style="font-size:13px;">:</strong></td>
								<td width="65%" style="font-size:13px;">'.$member_data->user->office_telephone.'</td>
							</tr>
							<tr>
								<td width="30%"><strong style="font-size:13px;">Email</strong></td>
								<td width="5%"><strong style="font-size:13px;">:</strong></td>
								<td width="65%" style="font-size:13px;">'.$member_data->user->email.'</td>
							</tr>';
							if($member_data->user->member_type_id==1)
							{
							$html.='<tr>
								<td width="30%"><strong style="font-size:13px;">Authorized Representative</strong></td>
								<td width="5%"><strong style="font-size:13px;">:</strong></td>
								<td width="65%" style="font-size:13px;">'.$member_data->user->member_name.'</td>
							</tr>';
							}
						$html.='</table>
					</td>
					<td width="40%">
						<table width="100%">
							<tr>
								<td width="30%" style="text-align: left; font-size:13px;"><strong>Invoice No.</strong></td>
								<td width="5%"><strong style="font-size:13px;">:</strong></td>
								<td width="65%" style="font-size:13px;">UCCI/I'.$performa_invoice_no=sprintf("%04d", $member_data->performa_invoice_no).'/'.$from_year.'-'.$to_year.'</td>
							</tr>
							<tr>
								<td width="30%" style="text-align: left;"><strong style="font-size:13px;">Date</strong></td>
								<td width="5%"><strong style="font-size:13px;">:</strong></td>
								<td width="65%" style="font-size:13px;">'.date('d-m-Y', strtotime($member_data->date)).'</td>
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
		  </center>
		  <table width="100%" style=" border-collapse: collapse; padding: 5px;"  class="table_rows">
			
				 <tr>
						<th width="10%"  style=" text-align:center;"><strong style="font-size:15px;">S. No.</strong></th>
						<th  width="75%" style="text-align:center;"><strong style="font-size:15px;">Particulars</strong></th>
						<th  width="15%" style="text-align:center;"><strong style="font-size:15px;">Amount in (Rs.)</strong></th>
					</tr>';
					
					$sr_no=0;
	
	
	if(!empty($member_data->user->turn_over_id))
	{						
		foreach($master_turn_over as $turn_over_data)
		{
			$sr_no++;
				$html.='<tr>
						<td width="10%" style="text-align:center; font-size:15px;">'.$sr_no.'</td>
						<td width="75%" style="font-size:15px;">Annual Subscription for F.Y. '.$f_from_year.'-'.$to_year.'</td>
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
	$html.='
	<tr>
		<td colspan="2" style="text-align:right;text-align:right;font-size:15px;">Basic Amount</td>
		<td  style="text-align:right; font-size:15px;">
			'.number_format($member_data->sub_total, 2, '.', '').'
		</td>
		</tr>';
		
		
		foreach($member_data->member_fee_tax_amounts as $tax_data)
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
				'.number_format($member_data->grand_total, 2, '.', '').'
			</th>
			
			</tr></table>
	
		<p style="width:100%; text-align:left;font-size: 14px;padding-left:8px;">
		Amount in words: '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($member_data->grand_total)])).' Only.
		</p>';
		$html.='<div style="float:left; width:50%;">';
		foreach($BankDetails as $BankDetail)
		{
			$html.='<table width="100%" style="font-size: 10px;padding-left:8px;">
				
				<tr>
					<td width="30%" style="text-align:left;font-size: 13px;"><strong>Bank Details</strong></td>
					<td width="5%"></td>
					<td width="65%" style="text-align:left;"></td>
				</tr>
				<tr>
					<td width="30%" style="text-align:left;">Account Holder Name</td>
					<td width="5%">:</td>
					<td width="65%" style="text-align:left;">'.$BankDetail->account_holder_name.'</td>
				</tr>
				<tr>
					<td width="30%" style="text-align:left;">Bank Name & Address</td>
					<td width="5%">:</td>
					<td width="65%" style="text-align:left;">'.$BankDetail->bank_name_and_address.'</td>
				</tr>
				<tr>
					<td width="30%" style="text-align:left;">Bank Account Number</td>
					<td width="5%">:</td>
					<td width="65%" style="text-align:left;">'.$BankDetail->bank_account_number.'</td>
				</tr>
				<tr>
					<td width="30%" style="text-align:left;">RTGS/NEFT IFS Code</td>
					<td width="5%">:</td>
					<td width="65%" style="text-align:left;">'.$BankDetail->rtgs_neft_ifs_code.'</td>
				</tr>
			</table>';
			
		}
		$html.='</div>';
		$html.='<p style="width:100%; text-align:right;font-size: 15px;padding:2px 8px 0px 0px;">
		<strong>For: Udaipur Chamber of Commerce & Industry</strong>
		</p><br/><br/><br/><br/>
		<p style="width:100%; text-align:right; font-size: 15px;padding-right:8px;">
	Authorised Signatory</p>
			</td></tr></table>';
}
			$html.='</body></html>';
	
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($name,array('Attachment'=>0));
exit(0);
?>
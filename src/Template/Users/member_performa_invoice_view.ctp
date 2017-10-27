<?php echo $this->Html->css('/assets/Lato2OFLWeb/Lato2OFLWeb/Lato/latofonts.css'); ?>
<?php echo $this->Html->css('/assets/bootstrap/css/bootstrap.min.css'); ?> 
<?php echo $this->Html->css('/assets/font-awesome/css/font-awesome.min.css'); ?> 
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
.remove_border{
	border:none !important;
	font-size:14px;
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
border: 1px solid #000;
}
.itemrow tbody td{
border-bottom: none;border-top: none;
}
.table2 td{
border: 0px solid #000;font-size: 14px;padding:0px;
}
.table3 {
margin-top:-5px; border-top: none;
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
</head>
<body><center><strong>INVOICE</strong></center><br/>';
$member_data=$master_member;

 $member_type=$master_member->company_member_types[0]->master_member_type_id;
 foreach($master_member->users as $user)
 {  



/* if(date('m',strtotime($member_data->date)) < 4){
		$from_year=(date('y',strtotime($member_data->date))-1);
		$f_from_year=(date('Y',strtotime($member_data->date))-1);
		$to_year=date('y',strtotime($member_data->date));
	}else{
		$from_year=date('y',strtotime($member_data->date));
		$f_from_year=(date('Y',strtotime($member_data->date)));
		$to_year=(date('y',strtotime($member_data->date))+1);
	} */
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

<table width="100%" class="table_rows table3" border="" cellspacing="0" >
	<tr>
		<td align="" colspan="3"><center>
	'.$html1.'
		'.$text_type.' '.$type_number.'<br/>
		 PAN No. '.$pan_no.'
		</center>
		</td>
		
		<td  colspan="2">
			Invoice No. <br/> UCCI/I'.$performa_invoice_no=sprintf("%04d", $member_data->performa_invoice_no).'/'.@$from_year.'-'.@$to_year.'
			<br/>
			<br/>
			Dated <br/> '.date('d-m-Y').'

		</td>
		<td  colspan="2">
			ORIGINAL FOR RECIPIENT<br/>
			DUPLICATE FOR SUPPLIER

		</td>
	</tr>
	

	<tr>
	<td align=""  colspan="3">
<h4>'.$member_data->company_organisation.' </h4>
		'.$member_data->address.'<br/>
		'.$member_data->city.'';
		if(!empty($member_data->pincode))
							{
								$html.=' - '.$member_data->pincode;
							} 
							
		$html.='
		<br/> Ph. No. '.$member_data->office_telephone.'<br/>
		Email '.$user->email.' <br/>
		<span>GSTIN/UIN :  '.$member_data->gst_number.' <span> <br/>
		';
		if($member_type==1)
							{
								$html.='Authorized Representative '.$user->member_name.'';
							}
	
	$html.='</td>
	<td colspan="4">
	</td>
		
	
	</tr>
	<tr>
	<td colspan="7"> Tax is payable on reverse charge (Y/N)</td>
	</tr>
	<tr><td colspan="7"><table width="100%" cellspacing="0" cellpadding="0"><tr>
		 
					<th class="text_align" style="border-top:none;">Sr no.</th>
					<th class="text_align" colspan="3" style="border-top:none;">Particulars</th>
					<th class="text_align" colspan="2" style="border-top:none;">HSN/SAC</th>
					<th class="text_align" style="border-top:none;">QTY/UNIT</th>
					<th class="text_align" style="border-top:none;">RATE</th>
					<th class="text_align" style="border-top:none;">TOTAL</th>';
					foreach($taxation_rate as $tax_data)
					{
				
					
						$html.='<td colspan="2" align="center" style="border-top:none;">'.$tax_data->gst_name.'</td>';
					}
					$html.='<td rowspan="2" align="center" style="border-top:none;">Total</td>
					
				</tr>';
				$html.='<tr>
				<td colspan="9"></td>';
				foreach($taxation_rate as $tax_data)
								{


									$html.='<td align="center">Rate</td>
									<td align="center">Amount</td>';
								}

				$html.='</tr>';
				$basic_amount=0; $total_state_amount=[]; $total_tax_am=0;
				$total_include_tax=0;
				if(!empty($member_data->turn_over_id))
				{ $sr_no=0;	
			
					foreach($master_turn_over as $turn_over_data)
					{
						$sr_no++;
						$html.='<tr>
								<td>'.$sr_no.'</td>
								<td style=" " colspan="3"> <strong>Annual Subscription for F.Y. '.@$f_from_year.'-'.@$to_year.' </strong></td>
								
								<td colspan="2" align="center">'.$turn_over_data->HSN.'</td>
									<td>1</td>
									<td>'.$fee=number_format($turn_over_data->subscription_amount, 2, '.', '').'</td>
								<td style="text-align:right; "><strong>'.$fee=number_format($turn_over_data->subscription_amount, 2, '.', '').'</strong></td>';
								
								$b=0;
								
									foreach($taxation_rate as $tax_data)
									
									{ $b++; 
									


										$html.='<td align="right">'.$tax_data->master_taxation_rates[0]->tax_percentage.' %</td>';
										$amount_sub_tax=$turn_over_data->subscription_amount*$tax_data->master_taxation_rates[0]->tax_percentage/100;
										@$total_state_amount[$x]+=$amount_sub_tax;
								
										$total_tax_am+=$amount_sub_tax;
										$total_include_tax+=$amount_sub_tax;
										$html.='<td align="right">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
									}
								
								
								
								
							$html.=' <td align="right"><strong>'.number_format($total_tax_am+$fee, 2, '.', '').'</strong></td></tr>';

						$basic_amount+=$turn_over_data->subscription_amount;
					}
				}
				$total_tax_am=0;
					foreach($master_membership_fee as $membership_data)
					{
					$sr_no++;
					$html.='<tr>
						<td  style=" ">'.$sr_no.'</td>
						<td  style=" " colspan="3"><strong>'.$membership_data->component.'</strong></td>
						
						<td colspan="2" align="center">'.$membership_data->HSN.'</td>
						<td>1</td>
						<td>'.$fee=number_format($membership_data->subscription_amount, 2, '.', '').'</td>
						<td  style="text-align:right; font-size:15px;"><strong>'.$fee=number_format($membership_data->subscription_amount, 2, '.', '').' </strong></td>';
						
								$b=0;
								
									foreach($taxation_rate as $tax_data)
									
									{ $b++; 
									


										$html.='<td align="right">'.$tax_data->master_taxation_rates[0]->tax_percentage.' %</td>';
										$amount_sub_tax=$membership_data->subscription_amount*$tax_data->master_taxation_rates[0]->tax_percentage/100;
										@$total_state_amount[$x]+=$amount_sub_tax;
								
										$total_tax_am+=$amount_sub_tax;
										$total_include_tax+=$amount_sub_tax;
										$html.='<td align="right">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
									}
								$html.=' <td align="right"><strong>'.number_format($total_tax_am+$fee, 2, '.', '').'</strong></td>';
						
						
					$html.='</tr>';
						$basic_amount+=$membership_data->subscription_amount;
					}
				$sr_no++;
				$html.='
				<tr>
					';
					
					 $siz=sizeof($taxation_rate->toArray());  $siz=$siz*2+9;


									$html.='<td align="right" colspan="'.$siz.'" style="border-bottom:none;"> GRAND TOTAL (INCLUSIVE OF GST) </td>
									';
								
					
					$html.='<td  style="text-align:right; font-size:15px;border-bottom:none;"><strong>
					'.number_format($total_include_tax+$basic_amount, 2, '.', '').'</strong>
					</td>
				</tr></table></td></tr>';
				
			$html.='
				<tr>
					
					<td colspan="6"> <span style="float:left;">Amount Chargeable(in words) </span> <br/>
					<strong>INR '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($basic_amount+$total_include_tax)])).' Only.</strong>
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
					<td rowspan="2" align="center" style="border-top:none;" >HSN/SAC</td>
					<td rowspan="2" align="center" style="border-top:none;" >Taxable Value</td>';
					foreach($taxation_rate as $tax_data)
					{
				
					
						$html.='<td colspan="2" align="center" style="border-top:none;">'.$tax_data->gst_name.'</td>';
					}
					$html.='<td rowspan="2" align="center" style="border-top:none;">Total Tax Amount</td>
					
					
				</tr> 
				<tr>';
				foreach($taxation_rate as $tax_data)
					{
				
					
						$html.='<td align="center">Rate</td>
					<td align="center">Amount</td>';
					}
					
					$html.='
					
				</tr> 
				
				
				';
				$total_am=0; $total_taxable_amount=0; $total_tax_amount=0; 
				$total_central_amount=[]; $total_state_amount=0;
				 
				if(!empty($member_data->turn_over_id))
				{ 					
					foreach($master_turn_over as $turn_over_data)
					{
						$total_taxable_amount+=$turn_over_data->subscription_amount;
						$html.='<tr>
								<td>'.$turn_over_data->HSN.'</td>
								<td style=" " align="right">'.number_format($turn_over_data->subscription_amount, 2, '.', '').' </td>';
								$x=0;
								
									foreach($taxation_rate as $tax_data)
									
									{ $x++; 
									


										$html.='<td align="right">'.$tax_data->master_taxation_rates[0]->tax_percentage.' %</td>';
										$amount_sub_tax=$turn_over_data->subscription_amount*$tax_data->master_taxation_rates[0]->tax_percentage/100;
										@$total_central_amount[$x]+=$amount_sub_tax;
								
										$total_am+=$amount_sub_tax;
										
										$html.='<td align="right">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
									}
								$total_tax_amount+=$total_am;
								$html.='<td  align="right">'.number_format($total_am, 2, '.', '').' </td>
								
							</tr>';


					}
				}
				
				
				$colum_amount=0;
				foreach($master_membership_fee as $membership_data)
					{  $total_taxable_amount+=$membership_data->subscription_amount;
					$total_am=0; 
						$html.='
					<tr>
					<td>'.$membership_data->HSN.'</td>
					<td align="right">'.number_format($membership_data->subscription_amount, 2, '.', '').'</td>';
					$x=0;
					//pr($member_data->member_fee_tax_amounts);
					foreach($taxation_rate as $tax_data)
					{
						$x++;
					
						$html.='<td align="right">'.$tax_data->master_taxation_rates[0]->tax_percentage.' %</td>';
						$amount_sub_tax=$membership_data->subscription_amount*$tax_data->master_taxation_rates[0]->tax_percentage/100;
								
								$total_central_amount[$x]+=$amount_sub_tax;
								
						$total_am+=$amount_sub_tax;
						$html.='<td align="right">'.number_format($amount_sub_tax, 2, '.', '').'</td>';
					}
					$colum_amount+=$total_am;
					$total_tax_amount+=$total_am;
					$html.='
					
					
					<td align="right" >'.number_format($total_am, 2, '.', '').'</td>
					</tr> ';
						
						
					}
				$html.='<tr>
				<td align="right" style="border-bottom:none;">Total</td>
				<td align="right" style="border-bottom:none;" ><strong>'.number_format($total_taxable_amount, 2, '.', '').'</strong></td>';
				$xxx=0;
				foreach($taxation_rate as $tax_data)
					{ $xxx++;
					
				$html.='
				
				<td style="border-bottom:none;"></td> 
				<td align="right" style="border-bottom:none;"><strong>'.number_format($total_central_amount[$xxx], 2, '.', '').'</strong></td> ';
					}
				
				
				$html.='<td align="right" style="border-bottom:none;" ><strong>'.number_format($total_tax_amount, 2, '.', '').'</strong></td> 
				</tr>
				
				</table></td></tr>'		;
				
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

}
echo $html;
/* 	
 $dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($name,array('Attachment'=>0)); 
 echo $this->Html->css('/assets/Lato2OFLWeb/Lato2OFLWeb/Lato/latofonts.css'); 
echo $this->Html->css('/assets/bootstrap/css/bootstrap.min.css'); 
echo $this->Html->css('/assets/font-awesome/css/font-awesome.min.css');
exit(0); */


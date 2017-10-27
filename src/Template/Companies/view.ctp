<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Mailer\Email;
$options = new Options();
$options->set('defaultFont', 'Lato-Hairline');
$dompdf = new Dompdf($options);
$dompdf = new Dompdf();
$co_registrations=$company->co_registrations;
//pr($co_registrations);exit;
	 
			
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
<body><center><strong>Receipt Non Member Exporter </strong></center><br/>';
				foreach($MasterCompanies as $MasterCompany) 
				{
					$html1=$MasterCompany->company_information;
					$st_reg_no=$MasterCompany->st_reg_no;
					$pan_no=$MasterCompany->pan_no;
					$gst_number=$MasterCompany->gst_number;
						
						$text_type="GST No.";
						$type_number=$gst_number;
					
					
				}
				
				$html.='<div id="content">

<table width="100%" class="table_rows table3" border="1">
	<tr>
	
	<td align="right" valign="" style="border-right:none;" >
		
		<img src="'.ROOT . DS  . 'webroot' . DS  .'images/project_logo/ucci.png" width="90px" height="90px" style="" alt="">
		
		</td>
	
		<td align="" colspan="3" style="border-left:none;"><center>
	'.$html1.'
		'.$text_type.' '.$type_number.'<br/>
		 PAN No. '.$pan_no.'
		</center>
		</td>
		
		<td  colspan="2" valign="top">
			Form No. <br/> UCCI/'.sprintf("%04d", $company->form_number).'
<br/><br/>
Date <br/> '.date('d-m-Y', strtotime($company->year_of_joining)).'

		</td>
		
	</tr>
	
	<tr>
		  <td align="" colspan="6">
			Exporter Name: '.$company->company_organisation.'<br/>
			GSTIN : '.$company->gst_number.'<br/>
			Export Type : '.$company->export.'<br/>
			Contact Person : '.$company->users[0]->member_name.'<br/>
			Nationality: '.$company->nationality.'<br/>
			Address: '.$company->address.'<br/>
			Email: '.$company->users[0]->email.' <br/>
			Mobile: '.$company->users[0]->mobile.' <br/>
			Phone : '.$company->office_telephone.'
		  </td>
		
	</tr>
	
	<tr>
		<th >Sr no.</th>
		<th >Particulars</th>
		<th >Amount</th>';
	foreach($taxations as $taxation){
		$html.='<th>'.$taxation->tax_name. ' ( ' .$taxation->master_taxation_rates[0]->tax_percentage.' % )</th>';
	}
		
	$html.='<th>Total</th></tr><tr> <td>1</td>';
	$i=0; $total=0;
	foreach($master_membership_fees as $master_membership_fee){
				$subscription_amount=$master_membership_fee->subscription_amount;
				$total+=$subscription_amount;
				$html.='<td>'.$master_membership_fee->component.'</td>';
				
			}
			$html.='<td>'.$co_registrations[0]->amount.'</td>';
				
			foreach($co_registrations[0]->co_tax_amounts as $taxation){
					
					$html.='<td>'.$taxation->amount.'</td>';
			}
			
		
		$html.='<td align="right">'.$co_registrations[0]->total_amount.'</td>
				
		</tr>';
		

		$html.='<tr>
		<td colspan="5" align="right">Total</td>
		<td align="right"><strong>'.number_format($co_registrations[0]->total_amount, 2, '.', '').' </strong></td>
	</tr>';	
	
	$html.='<tr>
		
		<td colspan="6"><strong>(Rupees (in words) :  '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($co_registrations[0]->total_amount)])).' </strong></td>
	</tr>';	
	
	$html.='<tr>
		<td colspan="6" align="right"> 
					<strong style="font-size:15px;">For: Udaipur Chamber of Commerce & Industry </strong>
					<br/> <br/>
					<p style="width:100%; text-align:right; font-size: 15px;padding-right:8px;">
					<img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/signature.png" width="100px" height="50px" align="right" />
					 <br/> <br/> <br/> <br/>
						Authorised Signatory</p>
					</td>
	
	</tr>';	
	
	
	
		$html.='</table> </div>';



$html.='</body>
</html>';	
	
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($name,array('Attachment'=>0));
exit(0);


?>


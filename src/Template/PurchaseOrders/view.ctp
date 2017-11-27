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
<body><center><strong>PURCHASE ORDER</strong></center><br/>';
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
	
		<td align="center" colspan="3" style="border-left:none;">
	'.$html1.'
		'.$text_type.' '.$type_number.'<br/>
		 PAN No. '.$pan_no.'
		
		</td>
		
		<td  colspan="2" valign="top">
			Purchase Order No. <br/> UCCI/'.sprintf("%04d", $purchaseOrder->purchase_order_no).'
<br/><br/>
Date & Time <br/> '.date('d-m-Y', strtotime($purchaseOrder->date)).' & '.$purchaseOrder->time.'

		</td>
		
	</tr>
	
	<tr>
		<td align="" colspan="3">
		Supplier Name: '.$purchaseOrder->supplier->name.'<br/>
		company Name: '.$purchaseOrder->supplier->company.'<br/>
		Address: '.$purchaseOrder->supplier->address.'<br/>
		Email: '.$purchaseOrder->supplier->email.' <br/>
		Mobile: '.$purchaseOrder->supplier->mobile.' <br/>
		GSTIN : '.$purchaseOrder->supplier->gst_number.'
		</td>
		
		<td  colspan="3" valign="top">
			Delivery: '.$purchaseOrder->delivery.'<br/>
			Payment: By '.$purchaseOrder->payment_type.'<br/>
			Cust. TIN No: '.$purchaseOrder->tin_no.'<br/>
			Freight: '.$purchaseOrder->freight.' <br/>
			Tax: CGST, SGST : (As  applicable to all)
		</td>
		
	</tr>
	
	<tr>
		<th width="5%">Sr no.</th>
		<th colspan="2">Items</th>
		<th width="10%">Qty</th>
		<th width="15%">Rate</th>
		<th width="15%">Amount</th>
		
	</tr>';
	$i=0; $total=0;
	foreach($purchaseOrder->purchase_order_rows as $purchase_order_row){
		$i++;
		$total+=$purchase_order_row->amount;
		$html.='<tr>
		<td style="text-align:center">'.$i.'</td>
		
		<td colspan="2" style="text-align:center">'.$this->Text->autoParagraph($purchase_order_row->item_name).'</td>
		<td style="text-align:center">'.$purchase_order_row->quty.'</td>
		<td style="text-align:center">'.$purchase_order_row->rate.'</td>
		<td align="center">'.$purchase_order_row->amount.'</td>
				
		</tr>';
		
	}
	
		$html.='<tr>
		<td colspan="5" align="right">Total</td>
		<td align="center"><strong>'.number_format($total, 2, '.', '').' </strong></td>
		</tr>';
		
		$html.='<tr class="Tax">
			
			<td colspan="5" align="right">Total Tax</td>
			<td align="center"><strong>'.$purchaseOrder->taxamount.' </strong></td>
		</tr>
		<tr>
		<td colspan="5" align="right"> Grand Total</td>
		<td align="center"><strong>'.$purchaseOrder->amount.' </strong></td>
	</tr>';	
		
	
	$html.='<tr>
		
		<td colspan="6"><strong>Rupees (in words) :  '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($purchaseOrder->amount)])).' </strong></td>
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
	
//echo $html;		
	
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($name,array('Attachment'=>0));
exit(0);


?>


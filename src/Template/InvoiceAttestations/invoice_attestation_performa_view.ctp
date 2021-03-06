<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
require_once(ROOT . DS  .'vendor' . DS  . 'phpqrcode' . DS . 'qrlib.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Mailer\Email;
$options = new Options();
$options->set('defaultFont', 'Lato-Hairline');
$dompdf = new Dompdf($options);
$dompdf = new Dompdf();

foreach($invoice_attestaions as $data){
$port_of_loading = $data->port_of_loading;	
$final_destination	= $data->final_destination;
$port_of_discharge = $data->port_of_discharge;
$exporter = $data->exporter;	
$consignee = $data->consignee;
$invoice_no = $data->invoice_no;
$invoice_date = $data->invoice_date;
$manufacturer = $data->manufacturer;
$despatched_by = $data->despatched_by;
$show_amount = $data->show_amount;
$origin_no = $data->origin_no;
$certificate_origin = $data->certificate_origin_goods;
$current_date = $data->date_current;
$currency_name = $data->currency;
$coo_verification_code = $data->coo_verification_code;
$total_before_discount = $data->total_before_discount;
$discount = $data->discount;
$other_info = $data->other_info;
$freight_amount = $data->freight_amount;
$total_amount = $data->total_amount;
$company_address = $data->company->address;
$unit_name = $data->master_unit->unit_name;

$currency_unit = $data->currency_unit;
}

$invoice_date = date('d-m-Y',strtotime($invoice_date));
$current_date = date('d.m.Y',strtotime($current_date));


if(date('m',strtotime($current_date)) < 4)
{
	$from_year=(date('Y',strtotime($current_date))-1);
	$to_year=date('y',strtotime($current_date));
}
else
{
	$from_year=date('Y',strtotime($current_date));
	$to_year=(date('y',strtotime($current_date))+1);
}



           
   $PNG_TEMP_DIR = ROOT.DIRECTORY_SEPARATOR.'webroot'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;     
   // $PNG_WEB_DIR = 'temp/';
    if (!file_exists($PNG_TEMP_DIR))
     mkdir($PNG_TEMP_DIR); 
    $filename = $PNG_TEMP_DIR.'test.png';
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 2.3;
	//$qrcode="Co Number: ".$origin_no."";
	
	if(!empty($coo_verification_code)){
		$qrcode="http://ucciudaipur.com/app/co_pdf/".$coo_verification_code.'.pdf';
	}else{
		$qrcode="http://ucciudaipur.com/app/co_pdf/".$origin_no.'.pdf';
	}
	
	//$qrcode="http://ucciudaipur.com/app/co_pdf/".$origin_no.'.pdf';
	//$qrcode="http://ucciudaipur.com/uccinew/co_pdf/".$origin_no.'.pdf';
	$code=$origin_no;
      $filename = $PNG_TEMP_DIR.$code.'.png';
          QRcode::png($qrcode, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
                                  
$qr='<img src="'.$filename.'" width="90px" height="90px" style="" alt="">';							 
      


	 
			
$html_content='<html>
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
<body><center><strong>Invoice Attestation</strong></center><br/>';
				foreach($MasterCompanies as $MasterCompany) 
				{
					$html1=$MasterCompany->company_information;
					$st_reg_no=$MasterCompany->st_reg_no;
					$pan_no=$MasterCompany->pan_no;
					$gst_number=$MasterCompany->gst_number;
						
						$text_type="GST No.";
						$type_number=$gst_number;
					
					
				}
				
		$html_content.='<div id="content"> 

		<table width="100%" class="table_rows table3" border="1">
		<tr>
		<td align="right" style="border-right:none;">
		<center>
		<img src="'.ROOT . DS  . 'webroot' . DS  .'images/project_logo/ucci.png" width="90px" height="90px" style="" alt="">
		</center>
		</td>
		<td align="left" colspan="3" style="border-left:none;border-right:none;">
		<center>
			'.$html1.'
		</center>
		</td>

		<td align="right" style="border-right:none;border-left:none;" colspan="2">
		<center>
		'.$qr.'
		</center>
		</td>


		</tr>';
		
		$html_content.='<tr>
		<td align="" style="border-right:none;" colspan="3">
		
		<b>UCCI : MISC : 46/IE/'. $from_year .'-'. $to_year.'/'. $origin_no .'</b>
		
		</td>
		<td align="right" colspan="3" style="border-left:none;">
			<b>Date : '. $current_date .'</b></p>

		</td>



		</tr>';
		
		
		$html_content.='<tr>
		<td align="right" style="border-right:none;">
		<center>
		<b>Exporter : </b>
		</center>
		</td>
		<td colspan="2"> '. $exporter.'<br/>'.$company_address.'</td>
		<td align="left"  style="border-left:none;">
			<b>Port of Loading</b></p>

		</td>
		<td colspan="2"> '. $port_of_loading.'</td>

		</tr>';
		
		$html_content.='<tr>
		<td align="right" style="border-right:none;">
		<center>
		<b>Consignee : </b>
		</center>
		</td>
		<td colspan="2"> '. $consignee.'</td>
		<td align="left"  style="border-left:none;">
			<b>Final Destination</b></p>

		</td>
		<td colspan="2"> '.$final_destination.'</td>

		</tr>';
		
		$html_content.='<tr>
		<td align="right" style="border-right:none;">
		<center>
		<b>Invoice No. & Date </b>
		</center>
		</td>
		<td colspan="2"> '. $invoice_no.' &nbsp; & &nbsp;'. $invoice_date.'</td>
		<td align="left"  style="border-left:none;">
			<b>Port of Discharge</b></p>

		</td>
		<td colspan="2"> '.$port_of_discharge.'</td>

		</tr>';
		
		$html_content.='<tr>
		<td align="right" style="border-right:none;">
		<center>
		<b>Manufacturer : </b>
		</center>
		</td>
		<td colspan="5"> '. $manufacturer.'</td>
		
		
		</tr>';
		
		
		$html_content.='<tr>
		<td align="right" style="border-right:none;">
		<center>
		<b>Despatched by :  </b>
		</center>
		</td>
		
		<td colspan="5"> ';  if($despatched_by == 0){ $html_content.=' Sea'; }else if($despatched_by == 1){ $html_content.=' Air'; }else{ $html_content.=' Road'; } $html_content.='</td>

		

		</tr>';
		
		$html_content.='<tr>
		<td align="right" style="border-right:none;">
		<center>
		<b>Other information : </b>
		</center>
		</td>
		<td colspan="5"> '. $other_info.'</td>
		
		
		</tr>';
		
	
	
		$html_content.='<tr>
		<td  style="border-right:none;" colspan="6">
		<center>
		<b> CERTIFICATION </b>
		</center>
		<br/>
		<p>It is hereby certified that to the best of our knowledge and belief the goods mentioned above are the product of Indian Republic and are wholly of Indian Origin.</p>
		<br/>
		
		<table class="border_none" width="100%">
		<tr>
			
			
			<td style="text-align:right;">
			For : Udaipur Chamber of Commerce & Industry
			<br/>
			<br/>
			
			<br/>';
			
			
			if(!empty($CertificateOriginAuthorizeds[0]->signature)){
				
				$html_content.='<img src="'.ROOT . DS  . 'webroot' . DS  .''.$CertificateOriginAuthorizeds[0]->signature.'" width="90px" height="90px" style="" alt="">';
				
				}
				
			$html_content.='<br/>
			
							
						<p>Authorised Signatory</p>
			</td>
		</tr>
		</table>
		</td>
		
		
		</tr>';
		
	$html_content.='<tr>
		<td  style="border-right:none;" colspan="6">
		
		<p>This Certificate is a Digitally Signed document generated on www.ucciudaipur.com.
To verify the authenticity of this document, scan the QR code or go to our website and navigate to Services>Certificate of Origin>Verify and enter the CO number. 
</p>
	<br/>
	<p>
	If you find any discrepancy in the document then please inform us on info@ucciudaipur.com.
UCCI is not liable for any misrepresentation of consignment details by the exporter.
Forging this document is a legally punishable offense. 

	</p>
		</td>
		
	
		</tr>';
		
		
		$html_content.='</table>';


 if(!empty($coo_verification_code)){
	$path='co_pdf/'.$coo_verification_code.'.pdf';
 }else{
	$path='co_pdf/'.$origin_no.'.pdf';
 } 
    	
		
$dompdf->loadHtml($html_content);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
file_put_contents($path, $dompdf->output());		
	
$dompdf->stream($name,array('Attachment'=>0));
exit(0);
	
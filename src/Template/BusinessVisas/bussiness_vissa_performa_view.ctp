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

foreach($bussiness_vissas as $data){
	
$id=$data['id'];
$company_name=$data['company']['company_organisation'];
$company_address=$data['company']['address'];
$company_city=$data['company']['city'];
$company_pincode=$data['company']['pincode'];
$origin_no=$data['origin_no'];
$sender_address=$data['sender_address'];
$company_manufacture=$data['company_manufacture'];
$subject=$data['subject'];
$visitor_name=$data['visitor_name'];
$visitor_designation=$data['visitor_designation'];
$visit_country=$data['visit_country'];
$visit_month=$data['visit_month'];
$visit_place=$data['visit_place'];
$visit_reason=$data['visit_reason'];
$bs_verification_code=$data['bs_verification_code'];
$passport_no=$data['passport_no'];
$issue_date=$data['issue_date'];
$issue_place=$data['issue_place'];
$expiry_date=$data['expiry_date'];
$date_current=$data['date_current'];
}


$expiry_date = date('d-m-Y',strtotime($expiry_date));
$issue_date = date('d-m-Y',strtotime($issue_date));
$date_current = date('d.m.Y',strtotime($date_current));


if(date('m',strtotime($date_current)) < 4)
{
	$from_year=(date('Y',strtotime($date_current))-1);
	$to_year=date('y',strtotime($date_current));
}
else
{
	$from_year=date('Y',strtotime($date_current));
	$to_year=(date('y',strtotime($date_current))+1);
}




           
   $PNG_TEMP_DIR = ROOT.DIRECTORY_SEPARATOR.'webroot'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;     
   // $PNG_WEB_DIR = 'temp/';
    if (!file_exists($PNG_TEMP_DIR))
     mkdir($PNG_TEMP_DIR); 
    $filename = $PNG_TEMP_DIR.'test.png';
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 2.3;
	
		$qrcode="http://ucciudaipur.com/uccinew/bussiness_vissa_pdf/".$bs_verification_code.'.pdf';
	
	
	//$qrcode="http://ucciudaipur.com/app/co_pdf/".$origin_no.'.pdf';
	//$qrcode="http://ucciudaipur.com/uccinew/co_pdf/".$origin_no.'.pdf';
	$code=$bs_verification_code;
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

.bordernone{
border-bottom: none  !important;
border-top: none   !important;	
border-right: none  !important;	
border-left: none   !important;	
}
</style>
<body><center><strong>Business Visa</strong></center><br/>';
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
		<td  style="border-right:none;">
		<center>
		<img src="'.ROOT . DS  . 'webroot' . DS  .'images/project_logo/ucci.png" width="90px" height="90px" style="" alt="">
		</center>
		</td>
		<td align="left" style="border-left:none;border-right:none;">
		<center>
			'.$html1.'
		</center>
		</td>

		<td align="right" style="border-right:none;border-left:none;" >
		<center>
		'.    $qr.'
		</center>
		</td>


		</tr>';
		
	
	
	$html_content.='<tr>
			<td align="" style="border-right:none;" colspan="2" >
			
			<b>UCCI : MISC : 46/IE/'. $from_year .'-'. $to_year.'/'. $origin_no .'</b>
			
			</td>
			<td align="right"  style="border-left:none;">
				<b>Date : '. $date_current .'</b></p>

			</td>
		</tr>';
	
	$html_content.='<tr ><td colspan="3">';
		if($membertype==1){
			
				$html_content.='<table >
					 <tr >
						<td colspan="3" class="bordernone"><br/><b>'.   $sender_address . '</b></td>
					</tr>
					 <tr>
						<td colspan="3" class="bordernone"><br/>Sub:<b>'. $subject  .'</b></td>
					</tr>
					 <tr>
						<td colspan="3" class="bordernone"><br/>Dear Sir,</td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><br/><p>This is to inform you that M/s <b>'.$company_name  .','.$company_address.','. $company_city.' - '.  $company_pincode.'</b> is our member. The company is manufacturer of <b>'. $company_manufacture .'</b></p></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><p>We hereby request you to issue Business Visa to <b> '. $visitor_name  .','. $visitor_designation .'</b> of <b>'.  $company_name  .'</b> to visit <b>'. $visit_country  .'</b> during the month of <b>'.  $visit_month  .'</b> for <b>'.  $visit_reason  .'</b>. </p></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><p>The particulars of his passport are given below: </p></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;" class="bordernone">1. Passport No</th>
						<td colspan="2" class="bordernone">'.   $passport_no .'</td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;" class="bordernone"><br/>2. Date of Issue</th>
						<td colspan="2" class="bordernone"><br/><b>'.    $issue_date   .'</b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;" class="bordernone"><br/>3. Place of Issue</th>
						<td colspan="2" class="bordernone"><br/><b>'.  $issue_place  .'</b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;" class="bordernone"><br/>4. Date of Expiry</th>
						<td colspan="2" class="bordernone"><br/><b>'.   $expiry_date  .'</b></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><br/><p>We wish him all the success, as this visit be beneficial to both the countries.</p></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><p>It is requested that Multiple Business Visa to visit <b>'.   $visit_country  .'</b> may kindly be issued.</p></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><p>Thanking you in anticipation,</p></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><p>Yours Sincerely,</p></td>
					</tr>
					
				</table>';
			 } 
			else{   
			
				$html_content.='		
					<!--non member vissa  start-->
				<table >
					<tr>
						<td colspan="3" class="bordernone"><br/><b>'.   $sender_address . '</b></td>
					</tr>
					 <tr>
						<td colspan="3" class="bordernone"><br/>Sub:<b>'.    $subject   .'</b></td>
					</tr>
					 <tr>
						<td colspan="3" class="bordernone"><br/>Dear Sir,</td>
					</tr>
					
					<tr>
						<td colspan="3" class="bordernone"><p>We hereby request you to issue Multiple Visits Entry Business Visa to Mr.<b>' .  $visitor_name.','.   $visitor_designation . '</b> of <b>'.  $company_name  .'</b>  having there registered office at <b>'.   $company_address.','. $company_city.' - '. $company_pincode   .'</b> to travel  during <b>'.  $visit_place.' </b> for <b>'.$visit_reason   .'</b>. </p></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><p>The particulars of his passport are given below: </p></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;" class="bordernone">1. Passport No.</th>
						<td colspan="2" class="bordernone"><b>'.   $passport_no  .'</b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;" class="bordernone"><br/>2. Date of Issue</th>
						<td colspan="2" class="bordernone"><br/><b>'   .    $issue_date    .'</b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;" class="bordernone"><br/>3. Place of Issue</th>
						<td colspan="2" class="bordernone"><br/><b>'.$issue_place.'</b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;" class="bordernone"><br/>4. Date of Expiry</th>
						<td colspan="2" class="bordernone"><br/><b>'.  $expiry_date   .'</b></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><br/><p>We wish him all the success, as this visit be beneficial to both the countries.</p></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><p>It is requested that Multiple Visits Entry Business Visa for visit  <b>'.   $visit_country  .  '</b> may kindly be issued.</p></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><p>Thanking you in anticipation,</p></td>
					</tr>
					<tr>
						<td colspan="3" class="bordernone"><p>Yours Sincerely,</p></td>
					</tr>
					
				</table>';
			 } 
	
	
	
	
	
	$html_content.='</td></tr>
		<tr>
			
			
			<td style="" colspan="3">
			For : Udaipur Chamber of Commerce & Industry
			<br/>
			<br/>
			
			<br/>';
			
			
			
		
			if(!empty($CertificateOriginAuthorizeds[0]->signature)){
				
				$html_content.='<img src="'.ROOT . DS  . 'webroot' . DS  .''.$CertificateOriginAuthorizeds[0]->signature.'" width="90px" height="90px" style="" alt="">';
				
				}
				
			$html_content.='<br/>';
							
					$html_content.='<p>'.$CertificateOriginAuthorizeds[0]->user->member_name.' <br/>President UCCI</p>';
					 
					
							
						$html_content.='
			</td>
		</tr>';
			
		
	/*$html_content.='<tr>
		<td  style="border-right:none;" colspan="3">
			<p>This Certificate is a Digitally Signed document generated on www.ucciudaipur.com.
				To verify the authenticity of this document, scan the QR code or go to our website and navigate to Services>Bussiness Vissa>Verify and enter the Bussiness Vissa number. 
				</p>
					<br/>
					<p>
					If you find any discrepancy in the document then please inform us on info@ucciudaipur.com.
				UCCI is not liable for any misrepresentation of consignment details by the exporter.
				Forging this document is a legally punishable offense. 

			</p>
		</td>
		
	
		</tr>';*/
		
		
		$html_content.='</table>';
		

$path='bussiness_vissa_pdf/'.$bs_verification_code.'.pdf';
$dompdf->loadHtml($html_content);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
file_put_contents($path, $dompdf->output());		
	
$dompdf->stream($name,array('Attachment'=>0));
exit(0);
	
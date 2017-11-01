<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Mailer\Email;
$options = new Options();
$options->set('defaultFont', 'Lato-Hairline');
$dompdf = new Dompdf($options);
$dompdf = new Dompdf();

foreach($master_member_receipt as $data){
	$receipt_no = $data->receipt_no; 
	$amount_type = $data->amount_type;
	$cheque_no = $data->cheque_no;
	$bank_id = $data->bank_id;
	$cheque_date = $data->cheque_date;
	$drawn_bank = $data->drawn_bank;
	$narration = $data->narration;	
	$taxamount=$data->taxamount;
	$tds_amount = $data->tds_amount;	
	if(date('m',strtotime($data->date_current)) < 4){
	$from_year=(date('y',strtotime($data->date_current))-1);
	$to_year=date('y',strtotime($data->date_current));
	}else{
		$from_year=date('y',strtotime($data->date_current));
		$to_year=(date('y',strtotime($data->date_current))+1);
	}
	if($taxamount != 0)
	{
		$typeee=1;
	}
	foreach($data->general_receipt_purposes as $purpose)
	{
		$purpose_name[]=$purpose->master_purpose->purpose_name;
	}
	$word_value=explode('.',$data->amount);
	
	
	
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
	table_rows1, .table_rows1 th, .table_rows1 td {
	   border: 1pt thin solid  #000 !important;border-collapse: collapse;padding:5px; 
	}
	.border_none, .border_none th, .border_none td {
	   border:none; 
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
<body><table class="table_rows"><tr><td style="padding-left:1px;">
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
					$compare_date=date("Y-m-d",strtotime($data->date_current)); 
				
					$compare_date=strtotime($compare_date);
					$gst_date=strtotime("2017-07-01");
					if($gst_date<$compare_date){
						$text_type="Gst Number";
						$type_number=$gst_number;
					}else{
						
						$text_type="Service Tax Number";
						$type_number="ABCDE1234FST001";
					}
				}
				if($typeee == 1){
					$html.=''.$text_type.' : '.$type_number.'';
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
				<br/>
			        <center>
					<span style="width:100%; text-align:center;font-size: 20px;">
					<u><strong>RECEIPT</strong></u>
				</span>
				</center>
				<br/>
				
					<table style="width: 100%;" class="border_none">
						<tr style="line-height:2;">
							<td style="width: 50%; text-align:left; font-size:13px;">UCCI/PR'.$num_padded = sprintf("%04d", $receipt_no).'/'.$from_year.'-'.$to_year.'</td>
							<td style="width: 50%; text-align:right; font-size:13px;">Date: '.date('d-m-Y', strtotime($data->date_current)).'</td>
						</tr>
					
					<tr>
					<td colspan="2">
					<p style="width: 100%;font-size: 14px; text-align:justify; margin-top:10px;">
					Received with thanks from '.$data->company->company_organisation.', '.$data->company->city.'
					a sum of Rupees '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[0])]));
					if(!empty($word_value[1])){
					if($word_value[1] != 00){
						$html.=' & paisa '.ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($word_value[1])]));
					}}
					$html.=' Only vide '.$data->amount_type.' '.$data->cheque_no.' dated ';
					if(!empty($data->bank_id)){
						$html.=date('d-m-Y',strtotime($data->cheque_date));
					}else{
						$html.=date('d-m-Y',strtotime($data->date_current));
					}
					
					if(!empty($data->drawn_bank)){ $html.=' drawn on '.$data->drawn_bank; }    
					$html.=' on account of '.implode(',',$purpose_name);
					if(!empty($data->narration)){ $html.=' ('.$data->narration.')'; }
					
					$html.='. </p>
					</td>
					</tr>
					</table>
					
						<table style="width: 100%;" class="border_none" >
							<tr>';
							
                               
								
							 if($typeee == 1){ 
								  $html.='<td rowspan="2" style="width: 45%; text-align:left;" valign="top">
									<table  class="table_rows1"  style="width: 100%; font-size:14px; margin-top:50px;border-collapse: collapse;padding:2px;" >';
									$html.='<tr>
									<td  style="text-align:right;">Basic Amount</td><td  style="text-align:right;"">'.number_format(($data->basic_amount), 2, '.', '').'</td>
									</tr>';
									foreach($data->tax_amounts as $tax_amount)
									{
										$html.=' <tr>
										 <td style="text-align:right;">'.$tax_amount->master_taxation->tax_name.' @ '.number_format(($tax_amount->tax_percentage), 2, '.', '').'%</td>
										 <td style="text-align:right;">'.number_format(($tax_amount->amount), 2, '.', '').'</td>
										 </tr>';
									}
								   if(!empty($tds_amount)){
									
								 	$html.='<tr>
									<td style="text-align:right;">Total Amount</td><td style="text-align:right;">
									'.number_format($data->basic_amount+$taxamount, 2, '.', '').'</td>
									</tr>	
							
									<tr>
									<td style="text-align:right;">TDS Amount</td><td style="text-align:right;">
									'.number_format($tds_amount, 2, '.', '').'</td>
									</tr>';
									} 
									$html.='<tr>
									<td style="text-align:right;"><strong>Grand Total</strong></td>
									<td style="text-align:right;"><strong>'.number_format($data->amount, 2, '.', '').'</strong></td>
									</tr>
									</table>';
									
									$html.='</td>
									<td style="width: 55%; text-align:right;font-size: 15px;"><strong>For: Udaipur Chamber of Commerce & Industry</strong></td>';
									$html.='</tr>
									<tr>
									<td style=" text-align:right;font-size: 15px;"><br/><p  style="width:95%;"><img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/signature.png" width="100px" height="50px" align="right" /></p><br/><br/><br/><br/>Authorised Signatory</td>
									</tr>';
								  }else{ 
								 
								 
								 
								 $html.='<td colspan="2" style="width: 60%; text-align:right;font-size: 15px;"><strong>For: Udaipur Chamber of Commerce & Industry</strong></td>';
								$html.='</tr>
									<tr>
									<td  style="width: 30%; text-align:center;font-size:16px;"><br/><br/><br/><br/><table class="table_rows" style="font-size:16px; width:100%;"><tr><td style="text-align:center;">
									Rs. '.number_format($data->amount, 2, '.', '').'
									</td></tr></table></td>
									<td style="width: 70%; text-align:right;font-size: 15px;"><br/><p  style="width:95%;"><img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/signature.png" width="100px" height="50px" align="right" /></p><br/><br/><br/><br/>Authorised Signatory</td>
									</tr>';
								 
								 
								   } 
									 
									
								
								$html.='</table></td></tr><tr><td><span style="width: 100%;font-size: 15px;line-height:1;">Note: Cheque/DD subject to clearance in bank.</span></td></tr></table></body></html>';  
				
	 
	 
 } 


$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($name,array('Attachment'=>0));
exit(0);


?>

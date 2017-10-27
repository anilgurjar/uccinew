<?php


foreach($certificate_origins as $data){
$port_of_loading = $data->port_of_loading;	
$final_destination	= $data->final_destination;
$port_of_discharge = $data->port_of_discharge;
$exporter = $data->exporter;	
$consignee = $data->consignee;
$invoice_no = $data->invoice_no;
$invoice_date = $data->invoice_date;
$manufacturer = $data->manufacturer;
$despatched_by = $data->despatched_by;
$origin_no = $data->origin_no;
$certificate_origin = $data->certificate_origin_goods;
$current_date = $data->date_current;
$currency_name = $data->master_currency->currency_name;
$unit_name = $data->master_unit->unit_name;
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


?>

<style>
 .h3, h3 {
    font-size: 25px;
    font-weight: 700;
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-top: 5px;
    margin-bottom: 1px;
}
 @media print {
	  #logo{
		left:8% !important;
		top:5% !important;
		width: 90px !important;
		height:90px !important;
    }
	   .print_width
	   {
		   width:100% !important;
	   }
	   .hide_print{
		   display:none;
	   }
   }
</style>

<center>
<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-print']) . 'Print',['class'=>'btn btn-sm btn-success pull-right hide_print','type'=>'button','style'=>'margin-right:5px;','onclick'=>'window.print();']); ?>
<div style="background-color:white; width:80%; padding:15px;" class="print_width">
<div align="center">
					<div style="float:left;position:absolute;left:35%;" id="logo">
					<?php 
					echo $this->Html->image('/images/project_logo/UCCI LOGO.png',['fullBase'=>true,'width'=>'90px','height'=>'90px','style'=>'']);
					echo '</div>';
					echo '<div style="float:right;width:100%">';
					foreach($MasterCompanies as $MasterCompany) 
					{
						echo $MasterCompany->company_information;
						$st_reg_no=$MasterCompany->st_reg_no;
						$pan_no=$MasterCompany->pan_no;
						
					}
					
					?>
					</div>
				</div>

	<table border="0" style="width:100%;">
	<tr>
	<td style="text-align:left;"><p style="font-size:15px;"><b>UCCI : MISC : 46/IE/<?= $from_year ?>-<?= $to_year ?>/<?= $origin_no ?></b></p></td>
	<td style="text-align:right;"><p style="font-size:15px;"><b>Date : <?php echo $current_date; ?></b></p></td>
	</tr>
	</table>
	<table border="0" style="width:100%;">
	<tr>
		<td style="text-align:center;" colspan="2"><p style="font-size:20px;"><b>CERTIFICATE OF ORIGIN</b><p></td>
	</tr>
	<tr>
	<td style="width:50%;">
	  <table border="0" style="width:100%; line-height: 2;" >
	  <tr>
	  <td style="width:35%;" valign="top">Exporter</td>
	  <td>: <?php echo $exporter; ?></td></tr>
	  <tr>
	  <td valign="top">Consignee</td>
	  <td>: <?php echo $consignee; ?></td>
	  </tr>
	  <tr>
	  <td valign="top">Invoice No. & Date</td>
	  <td>: <?php echo $invoice_no; ?> &nbsp; <?php echo $invoice_date; ?></td>
	 </tr>
	  </table>
	</td>
	<td>
	  <table  style="width:100%; line-height: 2;">
		  <tr><td style="width:35%; text-align:center;"><span>Port of Loading</span></td><td style="text-align:center;"><span><?php echo $port_of_loading; ?></span></td></tr>
		  <tr><td style="text-align:center;"><span>Final Destination</span></td><td style="text-align:center;"><span><?php echo $final_destination; ?></span></td></tr>
		  <tr><td style="text-align:center;"><span>Port of Discharge</span></td><td style="text-align:center;"><span><?php echo $port_of_discharge; ?></span></td></tr>  
	  </table>
	</td>
	</tr>
	</table>
	<table border="0" style="width:100%; line-height: 2;">
	
	<tr>
	<td style="width:17.4%" valign="top">Manufacturar</td>
	<td>: <?php echo $manufacturer; ?></td>
	</tr>
	<tr>
	<td valign="top">Dispatched By</td>
	<td>: <?php if($despatched_by == 0){ echo "Sea"; }else if($despatched_by == 1){ echo "Air"; }else{ echo "Road"; } ?></td>
	</tr>
	</table>
	<br/>
	<table border="1" style="width:100%;">
	<tr>
	<td colspan="6" style="text-align:center;"><span style="font-size:17px;"><b>PARTICULARS OF GOODS</b></span></td>
	</tr>
	<tr>
		<td style="width:15%; text-align:center;"><b>Marks</b></td>
		<td style="width:15%; text-align:center;"><b>Container No.</b></td>
		<td style="width:15%; text-align:center;"><b>No. & kind of packing</b></td>
		<td style="width:35%; text-align:center;"><b>Description of Goods</b></td>
		<td style="width:10%; text-align:center;"><b>Quantity</b></td>
		<td style="width:10%; text-align:center;"><b>Value</b></td>
	</tr>
	<?php 
	$total_value = 0;
	$total_qty = 0;
	foreach($certificate_origin as $dataa){ 
	$total_qty = $total_qty + $dataa->quantity;
	$total_value = $total_value + $dataa->value;
	?>
	<tr>
		<td style="text-align:center;"><?php echo $dataa->marks; ?></td>
		<td style="text-align:center;"><?php echo $dataa->container_no; ?></td>
		<td style="text-align:center;"><?php echo $dataa->no_and_packing; ?></td>
		<td style="text-align:center;"><?php echo $dataa->description_of_goods; ?></td>
		<td style="text-align:center;"><?php echo $dataa->quantity.' '.$unit_name; ?></td>
		<td style="text-align:center;"><?php echo $currency_name.' '.$dataa->value; ?></td>
	</tr>
	<?php } ?>
	<tr>
	<td colspan="4" style="text-align:right;">
	<b>Total</b>
	</td>
	<td style="text-align:center;"><b><?php echo $total_qty.' '.$unit_name; ?><b/></td>
	<td style="text-align:center;"><b><?php echo $currency_name.' '.$total_value; ?></b></td>
	</tr>
	</table>
	<br/>
	<table border="0" style="width:100%;">
	<tr>
	<td style="text-align:center;"><span style="font-size:18px;"><b>CERTIFICATION</b></span></td>
	</tr>
	<tr>
	<td>It is hereby certified that to the best of our knowledge and belife the goods mentioned above are the product of INDIAN Republic and are wholly of INDIAN ORIGIN.</td>
	</tr>
	</table><br/>
	<table style="width:100%;" border="0">
	<tr>
	<td style="text-align:right;"><p>For Udaipur Chamber of Commerce & Industry</p></td>
	</tr>
	<tr>
	<td style="text-align:right;"><br/>
			<?php 
			if(!empty($CertificateOriginAuthorizeds[0]->signature)){
				echo $this->Html->image('/'.$CertificateOriginAuthorizeds[0]->signature, ['style'=>'width:10%;height:15%;']); }
			 ?>
							
							<br/><br/><p>Authorised Signatory</p></td>
	</tr>
	
	
	
	</table>
	
	
	
	
</div>
</center>
<?php
//use Cake\View\Helper\UrlHelper::build();
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

?>
<style>
@media print {
  body * {
    visibility: hidden;
	
  }
  .print
  {
	  display:none;
  }
  #certificate_form, #certificate_form * {
    visibility: visible;
  }
  #certificate_form {
	margin-left: auto;
	margin-right: auto;
	left: 0;
	right: 0;
	top:0;
  }
}
.value_padding{
	margin: 0px;padding: 0px !important;
}
</style>
<div class="col-md-12" id="certificate_form">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	<center>
	  <h3 class="box-title"><strong>CERTIFICATE OF ORIGIN</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
		<div class="box-body">
			<?= $this->Form->create($CertificateOrigins) ?>
			<?php
			
			foreach($certificate_origins as $certificate_origin)
			{
				?>
				<div class="col-sm-12">
					<div class="col-sm-6 value_padding">
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Exporter</label>
						  <div class="col-sm-8">
							<?= $certificate_origin->exporter ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Consignee</label>
						  <div class="col-sm-8">
							<?= $certificate_origin->consignee ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Invoice No. & Date</label>
						  <div class="col-sm-4">
							<?= $certificate_origin->invoice_no ?>
						  </div>
						   <div class="col-sm-4">
							<?= date('d-m-Y', strtotime($certificate_origin->invoice_date)) ?>							
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Manufacturer</label>
						  <div class="col-sm-8">
							<?= $certificate_origin->manufacturer ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Despatched by</label>
						  <div class="col-sm-8">
							<?php if($certificate_origin->despatched_by==0){ echo 'Sea'; }else if($certificate_origin->despatched_by==1){ echo 'Air'; } else{ echo "Road"; } ?>
						  </div>
						</div>
					</div>
					<div class="col-sm-6 value_padding">
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Port of Loading</label>
						  <div class="col-sm-8">
							<?= $certificate_origin->port_of_loading ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Final Destination</label>
						  <div class="col-sm-8">
							<?= $certificate_origin->final_destination ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Port of Discharge</label>
						  <div class="col-sm-8">
							<?= $certificate_origin->port_of_discharge ?>
						  </div>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="table-responsive no-padding">
					<table class="table table-bordered" id="parant_table" style="width:100%;">
						<thead>
							<tr>
								<th colspan="7" style="text-align:center;"><h4><strong>PARTICULARS OF GOODS<strong></h4></th>
							</tr>
							<tr>
								<th>Marks</th><th>Container No.</th><th>No. & kind of packings</th><th>Description of Goods</th><th>Quantity</th><th>Value</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$total_value = 0;
						$total_qty = 0;
						foreach($certificate_origin->certificate_origin_goods as $certificate_goods)
						{
							$total_qty = $total_qty + $certificate_goods->quantity;
							$total_value = $total_value + $certificate_goods->value;
							echo '<tr><td>'.$certificate_goods->marks.'</td>
							<td>'.$certificate_goods->container_no.'</td>
							<td>'.$certificate_goods->no_and_packing.'</td>
							<td>'.$certificate_goods->description_of_goods.'</td>
							<td style="text-align:center;">'.$certificate_goods->quantity.' </td>
							<td style="text-align:center;"> '.$certificate_goods->value.'</td></tr>';
						}
					
						?>
						<tr>
						<td colspan="5" style="text-align:right;">
						<b>Total</b>
						</td>
						<!--<td style="text-align:center;"><b><?php echo $total_qty.' '.$certificate_origin->master_unit->unit_name; ?><b/></td>-->
						<td style="text-align:center;"><b><?php echo $certificate_origin->currency.' '.$total_value; ?></b></td>
						</tr>
						
						
						<tr>
												
						<td style="text-align:left;" colspan="6" ><span >Amount Chargeable(in words):- <?php echo $certificate_origin->currency ?> &nbsp; </span>
		<strong><?php echo ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($total_value)])); ?> Only.</strong></td>
						</tr>
						
						</tbody>
					</table>
					</div>
				</div>
				
				<div class="col-sm-12">
					
					<?php
				//	pr($certificate_origin);
						if($certificate_origin->invoice_attachment=='true'){

							$dir = new Folder(WWW_ROOT . 'img/coo_invoice/'.$certificate_origin->id);
							$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice/'.$certificate_origin->id;

							$files = $dir->find('.*', true);
							$arr_ext = array('jpg', 'jpeg', 'png'); 
							foreach($files as $file){
								echo"<div class='col-sm-4'>";
									$ext = substr(strtolower(strrchr($file, '.')), 1);
									if (in_array($ext, $arr_ext)) {
										echo $this->Html->image('/img/coo_invoice/'.$certificate_origin->id.'/'.$file, ['style'=>'width:300px; height:300px;']);
									}else{
		echo 
		'<iframe src="'.$this->Url->build('/img/coo_invoice/'.$certificate_origin->id.'/'.$file).'" title="your_title" align="top" height="300" width="100%" frameborder="0" scrolling="auto" target="Message"></iframe>';
									}
								echo'</div>'; 
							}

						}
					
					
					
					?>
					
					
					
				</div>
				
				
				<div class="col-sm-12">
					<center><h4><strong><u>CERTIFICATION</u><strong></h4></center>
					<p>It is hereby certified that to the best of our knowledge and belief the goods mentioned above are the product of Indian Republic and are wholly of Indian Origin.</p>
				</div>
				<div class="col-sm-12">
					<div style="float:right;">For : Udaipur Chamber of Commerce & Industry</div>
				</div>
				<div class="col-sm-12">
					<div style="float:left; margin-top:30px; width:50%;">Seal of Chamber</div>
					<div style="float:right; margin-top:30px; width:50%; text-align:right;">Authorised Signatory</div>
				</div>
				<div class="col-sm-12 no-print">
					<center>
					
					
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Approve') ,['class'=>'btn btn-success','type'=>'Submit','name'=>'certificate_approve_submit','value'=>$certificate_origin->id]);
					?>
					
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-ban']) . __(' Not Approve'),['class'=>'btn btn-danger','type'=>'Submit','name'=>'certificate_notapprove_submit','value'=>$certificate_origin->id]);
					?>
					</center>
				</div>
				
			 <?php
			}
			echo $this->Form->end(); 
			?>
    </div>
	</div>
</div>
 
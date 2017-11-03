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
						<div class="col-sm-12 value_padding">
							<label class="col-sm-4">Other Info</label>
							<div class="col-sm-8">
								<?= $certificate_origin->other_info ?>
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
						<?php if(!empty($certificate_origin->authorised_remarks)){   ?>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Remarks</label>
						  <div class="col-sm-8">
							<?= $certificate_origin->authorised_remarks ?>
						  </div>
						</div>
						<?php  }  ?>
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
						if($show_amount=='Yes'){
						$total_before_discount=$certificate_origin->total_before_discount;
						 if($total_before_discount>0){
							?>
							<tr>
							<td colspan="5" style="text-align:right;">
							<b>Total</b>
							</td>
							<!--<td style="text-align:center;"><b><?php echo $total_qty.' '.$certificate_origin->master_unit->unit_name; ?><b/></td>-->
							<td style="text-align:center;"><b><?php echo $certificate_origin->total_before_discount; ?></b></td>
							</tr>
							<tr>
							<td colspan="5" style="text-align:right;">
							<b>Discount</b>
							</td>
							<td style="text-align:center;"><b><?php echo $certificate_origin->discount; ?></b></td>
							</tr>
							<tr>
							<td colspan="5" style="text-align:right;">
							<b>Freight Amount</b>
							</td>
							<td style="text-align:center;"><b><?php echo $certificate_origin->freight_amount; ?></b></td>
							</tr>
							<tr>
							<td colspan="5" style="text-align:right;">
							<b>Total Amount</b>
							</td>
							<td style="text-align:center;"><b><?php echo $certificate_origin->currency.' '.$certificate_origin->total_amount; ?></b></td>
							</tr>
							<?php
						}
						else 
						{ ?>
							<tr>
								<td colspan="5" style="text-align:right;">
								<b>Total</b>
								</td>
								<!--<td style="text-align:center;"><b><?php echo $total_qty.' '.$certificate_origin->master_unit->unit_name; ?><b/></td>-->
								<td style="text-align:center;"><b><?php echo $certificate_origin->currency.' '.$total_value; ?></b></td>
							</tr>	 
						
						<?php }
						if($total_before_discount>0){
						
							$grand_total=explode('.',$certificate_origin->total_amount);
							$rupees=$grand_total[0];
							$paisa_text='';
							if(sizeof($grand_total)==2 )
							{
								$grand_total[1]=str_pad($grand_total[1], 2, '0', STR_PAD_RIGHT);
								
								$paisa=(int)$grand_total[1];
								if(!empty($paisa)){
									$paisa_text=' and ' .ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($grand_total[1])])).' Paisa';
								}
							}else{ $paisa_text=""; }
						?>
						
						<tr>
												
						<td style="text-align:left;" colspan="6" ><span >Amount Chargeable(in words):- <?php echo $certificate_origin->currency ?> &nbsp; </span>
						<strong><?= ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($rupees)])).$paisa_text   ?> Only.</strong></td>
						</tr>
						<?php }else{
							$grand_total=explode('.',$certificate_origin->total_value);
							$rupees=$grand_total[0];
							$paisa_text='';
							if(sizeof($grand_total)==2 )
							{
								$grand_total[1]=str_pad($grand_total[1], 2, '0', STR_PAD_RIGHT);
								
								$paisa=(int)$grand_total[1];
								if(!empty($paisa)){
									$paisa_text=' and ' .ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($grand_total[1])])).' Paisa';
								}
							}else{ $paisa_text=""; }
						?>
							<tr>
												
						<td style="text-align:left;" colspan="6" ><span >Amount Chargeable(in words):- <?php echo $certificate_origin->currency ?> &nbsp; </span>
						<strong><?= ucwords($this->requestAction(['controller'=>'Users', 'action'=>'convert_number_to_words'],['pass'=>array($rupees)])).$paisa_text  ?>  Only.</strong></td>
						</tr>
						<?php } } ?>
						
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
		echo '<iframe src="'.$this->Url->build('/img/coo_invoice/'.$certificate_origin->id.'/'.$file).'" title="your_title" align="top" height="300" width="100%" frameborder="0" scrolling="auto" target="Message"></iframe>';
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
					 
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Verify') ,['class'=>'btn btn-success','type'=>'button','data-toggle'=>'modal','data-target'=>'#verify','value'=>$certificate_origin->id]);
					?>
					
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Verify') ,['class'=>'btn btn-danger','type'=>'button','data-toggle'=>'modal','data-target'=>'#notverify','value'=>$certificate_origin->id]);
					?>
						
					</center>
					<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left !important">Do you want to verify this COO</h4>
							  </div>
							  <div class="modal-body">
								<div class="row">
								<?php if($DocumentCheck>0){ ?>
									<div class="col-md-12 pad" >
										<div class="col-md-12">
											<div class="form-group">
												<label class=" control-label" style="text-align:left !important">
												
												Documents are still panding, do you wish to continue 
												</label>
												
													 
												
											</div>
										</div>
									</div>
								<?php }?>
								</div>
							  </div>
							  <div class="modal-footer">
							  <div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Verify') ,['class'=>'btn btn-success','type'=>'Submit','name'=>'certificate_approve_submit','value'=>$certificate_origin->id]);
								?>	 
							  </div>
							</div>
						  </div>
						</div>
					<div class="modal fade" id="notverify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left">Do you want to not verify this COO</h4>
							  </div>
							  <div class="modal-body">
								<div class="row">

									<div class="col-md-12 pad" >
											 
											<div class="col-md-12">
												<div class="form-group">
													<label class=" control-label" style="text-align:left !important">Remarks</label>
														<?php echo $this->Form->textarea('ucci_content', ['label' => false,'placeholder'=>'Remarks','class'=>'form-control ', 'name'=>'verify_remarks']); ?>
												</div>
											</div>
										</div>

									</div>
							  </div>
							  <div class="modal-footer">
							  <div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Verify') ,['class'=>'btn btn-danger','type'=>'Submit','name'=>'certificate_notapprove_submit','value'=>$certificate_origin->id]);
								?>	 
							  </div>
							</div>
						  </div>
						</div>
				</div>
				
			 <?php
			}
			echo $this->Form->end(); 
			?>
    </div>
	</div>
</div>
 
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
	  <h3 class="box-title"><strong>Invoice Attestation</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
		<div class="box-body">
			<?= $this->Form->create($InvoiceAttestations_new) ?>
			<?php
			 
			foreach($InvoiceAttestations as $InvoiceAttestation)
			{
				?>
				<div class="col-sm-12">
					<div class="col-sm-6 value_padding">
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Exporter</label>
						  <div class="col-sm-8">
							<?= $InvoiceAttestation->exporter ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Consignee</label>
						  <div class="col-sm-8">
							<?= $InvoiceAttestation->consignee ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Invoice No. & Date</label>
						  <div class="col-sm-4">
							<?= $InvoiceAttestation->invoice_no ?>
						  </div>
						   <div class="col-sm-4">
							<?= date('d-m-Y', strtotime($InvoiceAttestation->invoice_date)) ?>							
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Manufacturer</label>
						  <div class="col-sm-8">
							<?= $InvoiceAttestation->manufacturer ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Despatched by</label>
						  <div class="col-sm-8">
							<?php if($InvoiceAttestation->despatched_by==0){ echo 'Sea'; }else if($InvoiceAttestation->despatched_by==1){ echo 'Air'; } else{ echo "Road"; } ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
							<label class="col-sm-4">Other Info</label>
							<div class="col-sm-8">
								<?= $InvoiceAttestation->other_info ?>
							</div>
						</div>
					</div>
					<div class="col-sm-6 value_padding">
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Port of Loading</label>
						  <div class="col-sm-8">
							<?= $InvoiceAttestation->port_of_loading ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Final Destination</label>
						  <div class="col-sm-8">
							<?= $InvoiceAttestation->final_destination ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Port of Discharge</label>
						  <div class="col-sm-8">
							<?= $InvoiceAttestation->port_of_discharge ?>
						  </div>
						</div>
						
					</div>
				</div>
				<div class="col-md-12">
					<?php if(!empty($InvoiceAttestation->authorised_remarks)){ ?>	
					<div class="col-sm-6 ">
						<div class="form-group">
							<label class="col-sm-4 control-label" style="color:red">Return Reason</label>
							<div class="col-sm-8">
							<?php
								echo $InvoiceAttestation->authorised_remarks;
								 ?> 
						   </div>
						</div>
					</div>
					
				<?php } ?>
				</div>
				
				<div class="col-sm-12">
					
					<?php
				//	pr($InvoiceAttestation);
						if($InvoiceAttestation->invoice_attachment=='true'){

							$dir = new Folder(WWW_ROOT . 'img/coo_invoice_attestation/'.$InvoiceAttestation->id);
							$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice_attestation/'.$InvoiceAttestation->id;

							$files = $dir->find('.*', true);
							$arr_ext = array('jpg', 'jpeg', 'png'); 
							foreach($files as $file){
								echo"<div class='col-sm-4'>";
									$ext = substr(strtolower(strrchr($file, '.')), 1);
									if (in_array($ext, $arr_ext)) {
										echo $this->Html->image('/img/coo_invoice_attestation/'.$InvoiceAttestation->id.'/'.$file, ['style'=>'width:300px; height:300px;']);
									}else{
		echo '<iframe src="'.$this->Url->build('/img/coo_invoice_attestation/'.$InvoiceAttestation->id.'/'.$file).'" title="your_title" align="top" height="300" width="100%" frameborder="0" scrolling="auto" target="Message"></iframe>';
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
					 
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Verify') ,['class'=>'btn btn-success','type'=>'button','data-toggle'=>'modal','data-target'=>'#verify','value'=>$InvoiceAttestation->id]);
					?>
					
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Verify') ,['class'=>'btn btn-danger','type'=>'button','data-toggle'=>'modal','data-target'=>'#notverify','value'=>$InvoiceAttestation->id]);
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
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Verify') ,['class'=>'btn btn-success','type'=>'Submit','name'=>'invoice_attestation_approve_submit','value'=>$InvoiceAttestation->id]);
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
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Verify') ,['class'=>'btn btn-danger','type'=>'Submit','name'=>'invoice_attestation_notapprove_submit','value'=>$InvoiceAttestation->id]);
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
 
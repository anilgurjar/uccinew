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
			<?= $this->Form->create($InvoiceAttestations) ?>
			<?php
			
			foreach($invoice_attestations as $invoice_attestation)
			{
				?>
				<div class="col-sm-12">
					<div class="col-sm-6 value_padding">
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Exporter</label>
						  <div class="col-sm-8">
							<?= $invoice_attestation->exporter ?>
						  </div>
						</div>
						<?php 
						if($invoice_attestation->invoice_type=="Invoice Attestation"){ ?>	
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Consignee</label>
						  <div class="col-sm-8">
							<?= $invoice_attestation->consignee ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Invoice No. & Date</label>
						  <div class="col-sm-4">
							<?= $invoice_attestation->invoice_no ?>
						  </div>
						   <div class="col-sm-4">
							<?= date('d-m-Y', strtotime($invoice_attestation->invoice_date)) ?>							
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Manufacturer</label>
						  <div class="col-sm-8">
							<?= $invoice_attestation->manufacturer ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Despatched by</label>
						  <div class="col-sm-8">
							<?php if($invoice_attestation->despatched_by==0){ echo 'Sea'; }else if($invoice_attestation->despatched_by==1){ echo 'Air'; } else{ echo "Road"; } ?>
						  </div>
						</div>
						<?php } ?>
						
						<div class="col-sm-12 value_padding">
							<label class="col-sm-4">Type</label>
							<div class="col-sm-8">
								<?= $invoice_attestation->invoice_type ?>
							</div>
						</div>
						<div class="col-sm-12 value_padding">
							<label class="col-sm-4">Other Info</label>
							<div class="col-sm-8">
								<?= $invoice_attestation->other_info ?>
							</div>
						</div>
						<div class="col-sm-12 value_padding">
							<label class="col-sm-4" style="color:red;">Verify By</label>
							<div class="col-sm-8">
								<?php echo $verify_member; ?>
							</div>
						</div>
					</div>
					<?php 
					if($invoice_attestation->invoice_type=="Invoice Attestation"){ ?>
					<div class="col-sm-6 value_padding">
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Port of Loading</label>
						  <div class="col-sm-8">
							<?= $invoice_attestation->port_of_loading ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Final Destination</label>
						  <div class="col-sm-8">
							<?= $invoice_attestation->final_destination ?>
						  </div>
						</div>
						<div class="col-sm-12 value_padding">
						  <label class="col-sm-4">Port of Discharge</label>
						  <div class="col-sm-8">
							<?= $invoice_attestation->port_of_discharge ?>
						  </div>
						</div>
					</div>
				<?php } ?>	
				</div>
				
				
				
				<div class="col-sm-12">
					
					<?php
				//	pr($certificate_origin);
						if($invoice_attestation->invoice_attachment=='true'){
							echo"<div class='col-sm-4'>";
							echo '<iframe src="'.$this->Url->build('/img/coo_invoice_attestation/'.$invoice_attestation->id.'/'.$invoice_attestation->file_name).'" title="your_title" align="top" height="300" width="100%" frameborder="0" scrolling="auto" target="Message"></iframe>';
							echo'</div>'; 
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
					 
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Approve') ,['class'=>'btn btn-success','type'=>'button','data-toggle'=>'modal','data-target'=>'#verify','value'=>$invoice_attestation->id]);
					?>
					
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Approve') ,['class'=>'btn btn-danger','type'=>'button','data-toggle'=>'modal','data-target'=>'#notverify','value'=>$invoice_attestation->id]);
					?>
					</center>
					<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left !important">Do you want to Approve this Invoice Attestation</h4>
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
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Approve') ,['class'=>'btn btn-success','type'=>'Submit','name'=>'invoice_attestation_approve_submit','value'=>$invoice_attestation->id]);
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
								<h4 class="modal-title" id="myModalLabel" style="text-align:left">Do you want to not Approve this INVOICE ATTESTATION</h4>
							  </div>
							  <div class="modal-body">
								<div class="row">

									<div class="col-md-12 pad" >
											 
											<div class="col-md-12">
												<div class="form-group">
													<label class=" control-label" style="text-align:left !important">Remarks</label>
														<?php echo $this->Form->textarea('ucci_content', ['label' => false,'placeholder'=>'Remarks','class'=>'form-control ', 'name'=>'authorised_remarks']); ?>
												</div>
											</div>
										</div>

									</div>
							  </div>
							  <div class="modal-footer">
							  <div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
								echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-ban']) . __(' Not Approve'),['class'=>'btn btn-danger','type'=>'Submit','name'=>'invoice_attestation_notapprove_submit','value'=>$invoice_attestation->id]);
								?> 
							  </div>
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
 
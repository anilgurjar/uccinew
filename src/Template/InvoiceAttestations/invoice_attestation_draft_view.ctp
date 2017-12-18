
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	<center>
	  <h3 class="box-title"><strong>DRAFT INVOICE ATTESTATION</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
	<div class="box-body">
	 <?= $this->Form->create() ?>
	  <div class="col-sm-12 no-print">
				<div class="table-responsive no-padding">
				<table class="table table-bordered" id="parant_table" style="width:100%;">
					<thead>
						<tr>
							<th>Sr.No.</th><th>Exporter</th><th>Origin No</th><th>Date</th><th>Consignee</th><th>Invoice No.</th><th>Invoice Date</th><th>Manufacturer</th><th>Despatched by</th><th>Action</th>
							<?php if($role_id==1 || $role_id==4){	
							echo"<th></th>";
							} ?>
						</tr>
					</thead>
					<tbody>
						
									
					<?php $sr=0; foreach ($certificate_origins as $certificate_origin): ?>
					<tr>
					    <td><?= ++$sr ?></td>
						<td><?= $certificate_origin->exporter ?></td>
						<td><?= $certificate_origin->origin_no ?></td>
						<td><?= $certificate_origin->date_current ?></td>
						<td><?= $certificate_origin->consignee ?></td>
						<td><?= $certificate_origin->invoice_no ?></td>
						<td><?= date('d-m-Y', strtotime($certificate_origin->invoice_date)) ?></td>
						<td><?= $certificate_origin->manufacturer ?></td>
						<td><?php if($certificate_origin->despatched_by==0){ echo 'Sea'; }else if($certificate_origin->despatched_by==1){ echo 'Air'; }else{ echo 'Road'; } ?></td>
						<td><?= $this->Form->button(__('Publish') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-success btn-sm','formaction'=>'attestationDraftView/'.$certificate_origin->id.'','type'=>'Submit','name'=>'view']);   ?> </td>
						
						
						<?php
						
						if($role_id==1 || $role_id==4){	
						echo"<td>";
							echo $this->Form->button( __('Move') ,['class'=>'btn btn-danger btn-sm','type'=>'button','data-toggle'=>'modal','data-target'=>'#notverify'.$certificate_origin->id.'','value'=>$certificate_origin->id]);
							
						?>  
						
						<div class="modal fade" id="notverify<?php echo $certificate_origin->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left">Why Do you want to move to verification screen ?</h4>
							  </div>
							  <div class="modal-body">
								<div class="row">

									<div class="col-md-12 pad" >
											 
											<div class="col-md-12">
												<div class="form-group">
													<label class=" control-label" style="text-align:left !important">Reason</label>
														<?php echo $this->Form->textarea('ucci_content', ['label' => false,'placeholder'=>'Reason','class'=>'form-control ', 'name'=>'reason_move'.$certificate_origin->id.'']); ?>
												</div>
											</div>
										</div>

									</div>
							  </div>
							  <div class="modal-footer">
							  <div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
									echo $this->Form->button(__('Move') ,['class'=>'btn btn-danger','type'=>'Submit','name'=>'invoice_attestation_move_submit','value'=>$certificate_origin->id]);
								?>	 
							  </div>
							</div>
						  </div>
						</div>
						
						
						
						</td>
						<?php } ?>
						</tr>

					
					<?php endforeach; ?>
					
				
						
					
				 	
					</tbody>
				</table>
				</div>
			</div>
		 <?php echo $this->Form->end(); ?>
	 
    </div>
  </div>
</div>
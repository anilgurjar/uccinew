
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	<center>
	  <h3 class="box-title"><strong>APPROVE INVOICE ATTESTATION</strong></h3>
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
							<th>Sr.No.</th><th>Exporter</th><th>Consignee</th><th>Invoice No.</th><th>Date</th><th>Manufacturer</th><th>Despatched by</th><th>View</th>
						</tr>
					</thead>
					<tbody>
						
									
					<?php $sr=0; foreach ($invoice_attestations as $invoice_attestation): ?>
					<tr>
					    <td><?= ++$sr ?></td>
						<td><?= $invoice_attestation->exporter ?></td>
						<td><?= $invoice_attestation->consignee ?></td>
						<td><?= $invoice_attestation->invoice_no ?></td>
						<td><?= date('d-m-Y', strtotime($invoice_attestation->invoice_date)) ?></td>
						<td><?= $invoice_attestation->manufacturer ?></td>
						<td><?php if($invoice_attestation->despatched_by==0){ echo 'Sea'; }else if($invoice_attestation->despatched_by==1){ echo 'Air'; } else{ echo 'Road'; }?></td>
						<td><?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formaction'=>'invoice_attestation_approve_view','value'=>$invoice_attestation->id,'type'=>'Submit','name'=>'view']);
					   ?></td>
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
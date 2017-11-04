
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	<center>
	  <h3 class="box-title"><strong>DRAFT CERTIFICATE OF ORIGIN</strong></h3>
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
						<td><?= $this->Form->button(__('Publish') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-success btn-sm','formaction'=>'draftView/'.$certificate_origin->id.'','type'=>'Submit','name'=>'view']);   ?> </td>
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
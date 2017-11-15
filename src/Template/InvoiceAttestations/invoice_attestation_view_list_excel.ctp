<div class="col-sm-12 no-print">
	<div class="table-responsive no-padding">
	<table class="table table-bordered" id="parant_table" style="width:100%;">
		<thead>
			<tr>
				<th>Sr.No.</th><th>Exporter</th><th>Origin No</th><th>Date</th><th>Consignee</th><th>Invoice No.</th><th>Invoice Date</th><th>Manufacturer</th><th>Despatched by</th><th>View</th>
			</tr>
		</thead>
		<tbody class="show_div">
			
						
		<?php $sr=0; foreach ($invoice_attestation as $invoice_attestatio): 
		 pr($invoice_attestatio);  exit;?>
		<tr>
			
			<td><?= ++$sr ?></td>
			<td><?= $invoice_attestatio['exporter'] ?></td>
			<td><?= $invoice_attestatio['origin_no'] ?></td>
			<td><?= $invoice_attestatio['date_current'] ?></td>
			<td><?= $invoice_attestatio['consignee'] ?></td>
			<td><?= $invoice_attestatio['invoice_no'] ?></td>
			<td><?= date('d-m-Y', strtotime($invoice_attestatio['invoice_date'])) ?></td>
			<td><?= $invoice_attestatio['manufacturer'] ?></td>
			<td><?php if($invoice_attestatio['despatched_by']==0){ echo 'Sea'; }else if($invoice_attestatio['despatched_by']==1){ echo 'Air'; }else{ echo 'Road'; } ?></td>
			<td><?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formaction'=>'certificate_origin_performa_view','formtarget'=>'_blank','value'=>$invoice_attestatio['id'],'type'=>'Submit','name'=>'view']);   ?> </td>
			</tr>

		
		<?php endforeach; ?>
		
	
			
		
		
		</tbody>
	</table>
	</div>
</div>
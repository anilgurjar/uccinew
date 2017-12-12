<div class="col-sm-12 no-print">
	<div class="table-responsive no-padding">
	<table class="table table-bordered" id="parant_table" style="width:100%;">
		<thead>
			<tr>
				<th>Sr.No.</th><th>Exporter</th><th>Origin No</th><th>Date</th><th>Consignee</th><th>Invoice No.</th><th>Invoice Date</th><th>Manufacturer</th><th>Despatched by</th>
			</tr>
		</thead>
		<tbody class="show_div">
			
						
		<?php $sr=0; foreach ($Users as $certificate_origin): ?>
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
			
			</tr>

		
		<?php endforeach; ?>
		</tbody>
	</table>
	</div>
</div>
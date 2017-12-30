<div >
	 <?= $this->Form->create() ?>
	<?php $sr=0; foreach ($Users as $invoice_attestation): ?>
	<tr>
		<td><?= ++$sr ?></td>
		<td><?= $invoice_attestation->exporter ?></td>
		<td><?= $invoice_attestation->origin_no ?></td>
		
		<td><?= $invoice_attestation->date_current ?></td>
		<td><?= $invoice_attestation->consignee ?></td>
		<td><?= $invoice_attestation->invoice_no ?></td>
		<td><?php if($invoice_attestation->invoice_type=='Invoice Attestation'){ echo date('d-m-Y', strtotime($invoice_attestation->invoice_date)); }?></td>
		<td><?= $invoice_attestation->manufacturer ?></td>
		<td><?php if($invoice_attestation->invoice_type=='Invoice Attestation'){ if($invoice_attestation->despatched_by==0){ echo 'Sea'; }else if($invoice_attestation->despatched_by==1){ echo 'Air'; }else{ echo 'Road'; } } ?></td>
		<td><?= $invoice_attestation->invoice_type ?></td>
		<td><?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formtarget'=>'_blank','value'=>$invoice_attestation->id,'type'=>'Submit','name'=>'view']);   ?> </td>
	</tr>
	<?php endforeach; ?>
	<?php echo $this->Form->end(); ?>
</div>	
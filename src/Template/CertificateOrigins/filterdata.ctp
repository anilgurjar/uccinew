<div >
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
		<td><?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formaction'=>'certificate_origin_performa_view','formtarget'=>'_blank','value'=>$certificate_origin->id,'type'=>'Submit','name'=>'view']);   ?> </td>
		</tr>


	<?php endforeach; ?>
</div>	
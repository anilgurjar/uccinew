<div >
	<?php $sr=0; foreach ($bussiness_vissas as $bussiness_vissa): 
	?>
	<tr>
		<td><?= ++$sr ?></td>
		<td><?= $bussiness_vissa['company']['company_organisation'] ?></td>
		<td><?= $bussiness_vissa['origin_no'] ?></td>
		<td><?= $bussiness_vissa['company_manufacture'] ?></td>
		<td><?= $bussiness_vissa['visitor_name'] ?></td>
		<td><?= $bussiness_vissa['visit_country'] ?></td>
		<td><?= $bussiness_vissa['visit_month'] ?></td>
		<td><?= $bussiness_vissa['visit_reason'] ?></td>
		<td><?= $bussiness_vissa['passport_no'] ?></td>
		<td><?= date('d-m-Y', strtotime($bussiness_vissa['issue_date'])) ?></td>
		<td><?= $bussiness_vissa['issue_place'] ?></td>
		<td><?= date('d-m-Y', strtotime($bussiness_vissa['expiry_date'])) ?></td>
		<td><?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formaction'=>'bussiness_vissa_performa_view','formtarget'=>'_blank','value'=>$bussiness_vissa['id'],'type'=>'Submit','name'=>'view']);   ?> </td>
		</tr>

	
	<?php endforeach; ?>
</div>	
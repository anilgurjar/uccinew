<div class="col-md-12">
	<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Member Request</h3>
			</div>
		<div class="box-body" style="display: block;">
			<div class="row">
									
				<div class="col-md-12" id="report">
					
			<div class="related">
		
			<table cellpadding="0" cellspacing="0" class="table table-bordered" >
				<thead>
					<tr style="background-color:#3C8DBC; color:#fff">
						<th scope="col"><?= __('Sr no.') ?></th>
						<th scope="col"><?= __('Name') ?></th>
						<th scope="col"><?= __('Mobile') ?></th>
						<th scope="col"><?= __('Email') ?></th>
						<th scope="col"><?= __('Company Name') ?></th>
						<th scope="col"><?= __('Designation') ?></th>
						<th scope="col"><?= __('Member Type') ?></th>
						<th scope="col"><?= __('Request date') ?></th>
						
						<!--<th scope="col" class="actions"><?= __('Actions') ?></th>-->
						
					</tr>
				</thead>
				<tbody>
				<?php foreach ($memberRequests as $memberRequest): ?>
				<tr>
					<td><?= $this->Number->format($memberRequest->id) ?></td>
					<td><?= h($memberRequest->name) ?></td>
					<td><?= h($memberRequest->mobile) ?></td>
					<td><?= h($memberRequest->email) ?></td>
					<td><?= h($memberRequest->company_name) ?></td>
					<td><?= h($memberRequest->designation) ?></td>
					<td><?= $memberRequest->master_member_type->member_type ?></td>
					<td><?= date("d-m-Y",strtotime($memberRequest->request_date)) ?></td>
					
					<!-- <td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $memberRequest->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $memberRequest->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $memberRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $memberRequest->id)]) ?>
					</td> -->
				</tr>
            <?php endforeach; ?>
				
				</tbody>
			</table>
			
		</div>
	
				</div>
			</div>
		</div>
	</div>
</div>


<style>
.font_color{
	color:white;
}
</style>


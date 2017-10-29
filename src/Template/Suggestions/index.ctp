<style>
@media print {
  body * {
    visibility: hidden;
  }
  .print{
	  display:none;
  }
  #fee_data, #fee_data * {
    visibility: visible;
  }
  #fee_data{
	margin-left: auto;
	margin-right: auto;
	left: 0;
	right: 0;
  }
}
</style>
<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border no-print">
			<h3 class="box-title">Suggestions View</h3>
		</div>
		<div class="box-body">
		
		<div class="col-sm-12 no-print">
	<div class="table-responsive no-padding">
		<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
			<thead>
				 <tr>
					<th scope="col">S.No.</th>
					<th scope="col"><?= $this->Paginator->sort('comments') ?></th>
					<th scope="col"><?= $this->Paginator->sort('frequency') ?></th>
					<th scope="col"><?= $this->Paginator->sort('attachment') ?></th>
					<th scope="col"><?= $this->Paginator->sort('create_on') ?></th> 
					<th scope="col" class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; foreach ($suggestions as $suggestion): 
				$i++; ?>
					<tr>
						<td><?= $i ?></td>
						<td><?= h($suggestion->comments) ?></td>
						<td><?= h($suggestion->frequency) ?></td>
						<td><?php echo $this->Html->Image('/'.$suggestion->attachment,['width'=>'40px','height'=>'40px']); ?></td>
						<td><?= h($suggestion->create_on) ?></td> 
						<td class="actions">
							<!--<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $suggestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $suggestion->id)]);?>-->

							<?= $this->Html->link(__('Delete') ,['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#Delete'.$suggestion->id,'class' => 'btn btn-danger btn-sm re_open',
							'escape' => false]) ?>
							 
							<div class="modal fade" id="Delete<?php echo $suggestion->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel" style="color:black;">Are you sure you want to delete this suggestion ?</h4>
										<input type="hidden" name="suggestion_id" value="<?php echo $suggestion->id ; ?>">								
									  </div>
									 
									  <div class="modal-footer">
											<?= $this->Form->postLink(__('Yes'),['action' => 'delete',$suggestion->id],['class'=>'btn btn-success publish','type'=>'submit']);
											?>
											<button type="button" class="btn btn-default cls" data-dismiss="modal">No</button>
									  </div>
									</div>
								  </div>
								</div>
								 
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		
		</div>
	</div>
	
	    </div>
	</div>
</div>
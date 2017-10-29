<div class="col-md-12">
	<div class="box box-primary">
    <?= $this->Form->create($initiativeCategory) ?>
	
		<div class="box-header with-border">
			<h3 class="box-title">Add Initiative Category</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
						
				<div class="col-md-12 pad">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Category Name</label>
							<?php echo $this->Form->input('name', ['label' => false,'placeholder'=>'Category Name','class'=>'form-control']); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer">
				<center>
				
				<?= $this->Form->button( $this->Html->tag('i', '', ['class'=>'fa fa-plus']). __(' Submit') ,['class'=>'btn btn-success','type'=>'Submit']);
					   ?>
				</center>
			</div>
	
    <?= $this->Form->end() ?>
	<br/>
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col">Sr. No.</th>
                <th scope="col"><?= $this->Paginator->sort('Category') ?></th>
                <!--<th scope="col" class="actions"><?= __('Actions') ?></th>-->
            </tr>
        </thead>
        <tbody>
            <?php $sr_no=0; foreach ($initiativeCategories as $initiative): ?>
            <tr>
                <td><?= $this->Number->format(++$sr_no) ?></td>
                <td><?= h($initiative->name) ?></td>
                <!--<td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $initiative->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $initiative->id], ['confirm' => __('Are you sure you want to delete # {0}?', $initiative->id)]) ?>
                </td>-->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
	</div>
	
</div>





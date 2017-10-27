<div class="col-md-12">
	<div class="box box-primary">
    <?= $this->Form->create($industrialDepartment) ?>
	
		<div class="box-header with-border">
			<h3 class="box-title">Add Industrial Department</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
						
				<div class="col-md-12 pad">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Department Name</label>
							<?php echo $this->Form->input('department_name', ['label' => false,'placeholder'=>'Department Name','class'=>'form-control']); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer">
				<center>
				
				<?= $this->Form->button(__('Submit') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-success','type'=>'Submit']);
					   ?>
				</center>
			</div>
	
    <?= $this->Form->end() ?>
	<br/>
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col">Sr. No.</th>
                <th scope="col"><?= $this->Paginator->sort('department_name') ?></th>
                <!--<th scope="col" class="actions"><?= __('Actions') ?></th>-->
            </tr>
        </thead>
        <tbody>
            <?php $sr_no=0; foreach ($industrialDepartments as $industrialDepartment): ?>
            <tr>
                <td><?= $this->Number->format(++$sr_no) ?></td>
                <td><?= h($industrialDepartment->department_name) ?></td>
                <!--<td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $industrialDepartment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $industrialDepartment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $industrialDepartment->id)]) ?>
                </td>-->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
	</div>
	
</div>



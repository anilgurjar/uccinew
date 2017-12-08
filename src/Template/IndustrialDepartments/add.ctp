<div class="col-md-12">
	<div class="box box-primary">
    <?= $this->Form->create($industrialDepartment) ?>
	
		<div class="box-header with-border">
			<h3 class="box-title">Add Industrial Department</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
						
				<div class="col-md-12 pad">
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Department Name</label>
							<?php echo $this->Form->input('company_organisation', ['label' => false,'placeholder'=>'Department Name','class'=>'form-control']); ?>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Member Name</label>
							<?php echo $this->Form->input('users[0][member_name]', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control']); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Member Designation</label>
							<?php echo $this->Form->input('users[0][member_designation]', ['label' => false,'placeholder'=>'Member Designation','class'=>'form-control']); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Email</label>
							<?php echo $this->Form->input('users[0][email]', ['label' => false,'placeholder'=>'Email','class'=>'form-control']); ?>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Mobile</label>
							<?php echo $this->Form->input('users[0][mobile]', ['label' => false,'placeholder'=>'Mobile','class'=>'form-control']); ?>
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Department Address</label>
							<?php echo $this->Form->input('address', ['label' => false,'placeholder'=>'Department Address','class'=>'form-control','rows'=>3]); ?>
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
            <?php  $sr_no=0; foreach ($industrialDepartments as $industrialDepartment): ?>
            <tr>
                <td><?= $this->Number->format(++$sr_no) ?></td>
                <td><?= h($industrialDepartment->company_organisation) ?></td>
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



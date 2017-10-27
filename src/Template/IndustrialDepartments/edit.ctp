<div class="col-md-12">
    <?= $this->Form->create($industrialDepartment) ?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Industrial Department</h3>
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
	</div>
    <?= $this->Form->end() ?>
</div>


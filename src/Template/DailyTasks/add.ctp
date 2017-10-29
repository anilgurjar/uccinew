
<!--<div class="dailyTasks form large-9 medium-8 columns content">
    <?= $this->Form->create($dailyTask) ?>
    <fieldset>
        <legend><?= __('Add Daily Task') ?></legend>
        <?php
            echo $this->Form->input('date');
            echo $this->Form->input('time');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('task_completed');
            echo $this->Form->input('task_initiated');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>-->



<div class="col-md-12">
<?php echo $this->Form->create($dailyTask, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Add Daily Task</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							 <div class="col-md-4">
								<div class="form-group">
								<label class="control-label">Member</label>
									<?php 
									echo $this->Form->input('event_category_id', ['empty'=> '--Select--','data-placeholder'=>'Select a member','label' => false,'class'=>'form-control master_purpose_id select2','options'=>$users]); ?>

								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Date</label>
									<?php echo $this->Form->input('date', ['label' => false,'placeholder'=>'Date','data-date-format'=>'dd-mm-yyyy','type'=>'text','data-date-start-date'=>''.date('d-m-Y').'','class'=>'form-control date-picker']); ?>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group bootstrap-timepicker">
									<label class="control-label">Time</label>
									<?php echo $this->Form->input('time', ['label' => false,'placeholder'=>'Time','type'=>'text','class'=>'form-control timepicker']); ?>
								</div>
							</div>
							
								
					</div>
					
					<div class="col-md-12 pad">
						
														
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Task Completed</label>
									<?php echo $this->Form->input('task_completed', ['label' => false,'placeholder'=>'Task Completed','class'=>'form-control']); ?>
								</div>
							</div>
							
							
							
					</div>
					
					<div class="col-md-12 pad">
						
														
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Task Initiated</label>
									<?php echo $this->Form->input('task_initiated', ['label' => false,'placeholder'=>'Task Initiated','class'=>'form-control']); ?>
								</div>
							</div>
							
							
							
					</div>
					
			
				</div>
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) .__(' Submit'),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
					</center>
					
				</div>
		</div>
			<?php echo $this->Form->end(); ?>
</div>

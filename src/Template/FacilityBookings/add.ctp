<style>
.pad{
	padding-right: 0px;
padding-left: 0px;
}
.form-group
{
	margin-bottom: 0px;
}

</style>
<div class="col-md-12">
<?php echo $this->Form->create($facilityBooking); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Facility Booking</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
					<div class="col-md-12 pad">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Event Name</label>
								<?php echo $this->Form->input('name', ['label' => false,'placeholder'=>'Enter Event Name','class'=>'form-control']); ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Expected Person</label>
								<?php echo $this->Form->input('expected_person', ['label' => false,'placeholder'=>'Expected Person','class'=>'form-control']); ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Select Venue</label>
								<?php echo $this->Form->input('venue_id', ['label' => false,'options' => $venues,'placeholder'=>'GST NUMBER','class'=>'form-control ']); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12 pad">
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Date From </label>
								<?php echo $this->Form->input('date_from', ['label' => false,'placeholder'=>'Date From','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy', 'type'=>'text','value'=>'']); ?>
							</div>
						</div>	
						<div class="col-md-2">
							<div class="form-group">
								<label class="control-label">Date To </label>		
								<?php echo $this->Form->input('date_to', ['label' => false,'placeholder'=>'Date To','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy', 'type'=>'text','value'=>'']); ?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bootstrap-timepicker">
								<label class="control-label">Time From</label>
								<?php echo $this->Form->input('time_from', ['label' =>false,'placeholder'=>'Time From','class'=>'form-control timepicker','time-format'=>'h:i:s', 'type'=>'text','value'=>'']); ?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bootstrap-timepicker">	
								<label class="control-label">Time To</label>
								<?php echo $this->Form->input('time_to', ['label' =>false,'placeholder'=>'Time To','class'=>'form-control timepicker','time-type'=>'h:i:s', 'type'=>'text','value'=>'']); ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Description</label>
								<?php echo $this->Form->input('description', ['label' => false,'placeholder'=>'Enter Description','class'=>'form-control']); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
				<center>
				
				<?= $this->Form->button(__('Submit') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-success','type'=>'Submit','id'=>'submit_member','name'=>'registration_submit']);
					   ?>
				</center>
			</div>
			</div>
			<?php echo $this->Form->end(); ?>
			</div>
    
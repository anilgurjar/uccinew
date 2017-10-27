<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Add Business Visa</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?php echo $this->Form->create($businessVisa, ['type' => 'post','id'=>'bussinesForm']); ?>
	<div class="box-body">
		<div class="form-group">
			<label class="col-sm-2 control-label">Sender Address</label>
			<div class="col-sm-4">
		  <?php echo $this->Form->input('sender_address', ['label' => false,'placeholder'=>'Sender Address','class'=>'form-control']); ?>
			</div>
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">Company/Organisation</label>
		  <div class="col-sm-4">
				<?php
				$options=array();
				
				foreach($members as $master_member_data)
				{
					$options[$master_member_data->id] = $master_member_data->company_organisation;
				}

				echo $this->Form->input('company_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
				</div>
				<label class="col-sm-2 control-label">Subject</label>
		  <div class="col-sm-4">
			<?php echo $this->Form->input('subject', ['label' => false,'placeholder'=>'subject Name','class'=>'form-control']); ?>
		  </div>
		  <label class="col-sm-2 control-label">Manufacturer</label>
		  <div class="col-sm-4">
			<?php echo $this->Form->input('company_manufacture', ['label' => false,'placeholder'=>'Company Manufacturer','class'=>'form-control']); ?>
		  </div>
			
		  
		  
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">Name of Visitor</label>
		  <div class="col-sm-4">
			<?php echo $this->Form->input('visitor_name', ['label' => false,'placeholder'=>'Name of Visitor','class'=>'form-control']); ?>
		  </div>
		  <label class="col-sm-2 control-label">Designation</label>
		  <div class="col-sm-4">
			<?php echo $this->Form->input('visitor_designation', ['label' => false,'placeholder'=>'Visitor Designation','class'=>'form-control']); ?>
		  </div>
		   <label class="col-sm-2 control-label">Visit Country</label>
		  <div class="col-sm-4">
			<?php echo $this->Form->input('visit_country', ['label' => false,'placeholder'=>'Country Name','class'=>'form-control']); ?>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">Visit Month</label>
		  <div class="col-sm-4">
			<?php echo $this->Form->input('visit_month', ['label' => false,'placeholder'=>'Visit Month','class'=>'form-control date-picker','data-date-format'=>'mm-yyyy', 'type'=>'text']); ?>
		  </div>
		  <label class="col-sm-2 control-label">Reason for Visit</label>
		  <div class="col-sm-4">
			<?php echo $this->Form->input('visit_reason', ['label' => false,'placeholder'=>'Reason for Visit','class'=>'form-control']); ?>
		  </div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Passport No. </label>
			<div class="col-sm-4">
			<?php echo $this->Form->input('passport_no', ['label' => false,'placeholder'=>'Passport No.','class'=>'form-control']); ?>
			</div>
			<label class="col-sm-2 control-label">Date of Issue</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('issue_date', ['label' => false,'placeholder'=>'Date of Issue','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy', 'type'=>'text']); ?>
			</div>
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">Place of Issue</label>
		  <div class="col-sm-4">
			<?php echo $this->Form->input('issue_place', ['label' => false,'placeholder'=>'Place of Issue','class'=>'form-control']); ?>
		  </div>
		   <label class="col-sm-2 control-label">Date of Expiry</label>
		  <div class="col-sm-4">	
			<?php echo $this->Form->input('expiry_date', ['label' => false,'placeholder'=>'Date of Expiry','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy', 'type'=>'text']); ?>
		  </div>
		</div>
	</div>
	  <!-- /.box-body -->
	  <div class="box-footer">
		<center>
			
			<?= $this->Form->button(__('Submit') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-success','type'=>'Submit','name'=>'business_submit']);
					   ?>
		</center>
	  </div>
	  <!-- /.box-footer -->
	<?php echo $this->Form->end(); ?>
	
  </div>
  <!-- /.box -->
         
           
             
</div>
       

<div class="col-md-12">
<?= $this->Form->create($supplier) ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title"><?= __('Edit Supplier') ?></h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							 <div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Supplier Name</label>
									<?php echo $this->Form->input('name', ['label' => false,'placeholder'=>'Supplier Name','class'=>'form-control']); ?>
								</div>
							</div>
							
							 <div class="col-md-4">
								<div class="form-group">
								<label class="control-label">Company Name</label>
									<?php echo $this->Form->input('company', ['label' => false,'placeholder'=>'Company Name','class'=>'form-control']); ?>

								</div>
							</div>	
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Email</label>
									<?php echo $this->Form->input('email', ['label' => false,'placeholder'=>'email','class'=>'form-control']); ?>
								</div>
							</div>
					</div>
					
					<div class="col-md-12 pad">
												
									
							 <div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Mobile</label>
									<?php echo $this->Form->input('mobile', ['label' => false,'placeholder'=>'Mobile','class'=>'form-control']); ?>
								</div>
							</div>
							
													
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Gst No</label>
									<?php echo $this->Form->input('gst_number', ['label' => false,'placeholder'=>'Gst No','class'=>'form-control']); ?>
								</div>
							</div>
							
							 <div class="col-md-4">
								<div class="form-group">
									<label class="control-label">State</label>
									<?php echo $this->Form->input('master_state_id', ['label' => false,'options'=>$state,'placeholder'=>'State  Name','class'=>'form-control','value'=>$supplier]); ?>
								</div>
							</div>
							
					</div>
					<div class="col-md-12 pad">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Address</label>
								<?php echo $this->Form->input('address', ['label' => false,'placeholder'=>'address','class'=>'form-control','rows'=>'3']); ?>
							</div>
						</div>
					</div>
			
				</div>
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) .__(' Submit'),['class'=>'btn btn-success','type'=>'Submit']) ?>
					</center>
					
				</div>
		</div>
			<?php echo $this->Form->end(); ?>
</div>
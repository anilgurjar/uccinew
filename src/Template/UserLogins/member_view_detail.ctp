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
	<?php echo $this->Form->create($master_user, ['type' => 'post','id'=>'registratiomForm']); ?>
	<?php echo $this->Form->hidden('member_id', ['value'=>'']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Member Registration</h3>
			</div>
				<div class="box-body" style="display: block;">
					<div class="row">
						<div class="col-md-12 pad">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Company/Organisation</label>
									<?php echo $this->Form->input('company_organisation', ['label' => false,'placeholder'=>'Company/Organisation','class'=>'form-control','value'=>'']); ?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">End Products / Items Dealing in</label>
									<?php echo $this->Form->input('end_products_item_dealing_in', ['label' => false,'placeholder'=>'End Products / Items Dealing in','class'=>'form-control','value'=>'']); ?>
								</div>
							</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">PAN No.</label>
							<?php echo $this->Form->input('pan_no', ['label' => false,'placeholder'=>'PAN No.','class'=>'form-control','value'=>'']); ?>
						</div>
					</div>
	               </div>
				<div class="col-md-12 pad">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Date of Joining</label>
							<?php echo $this->Form->input('year_of_joining', ['label' => false,'placeholder'=>'Date of Joining','class'=>'form-control date-picker','value'=>'','data-date-end-date'=>'+0d','data-date-format'=>'dd-mm-yyyy']); ?>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label">Member Type</label><br/>
							<?php foreach($member_type as $member_type_data){ ?>
								<!--<input type="radio" name="member_type_id" value="<?php echo $member_type_data['master_member_type']['id']; ?>" <?php if($data['master_member']['member_type_id']==$member_type_data['master_member_type']['id']){ echo 'checked'; } ?>><?php echo $member_type_data['master_member_type']['member_type']; ?> -->
		<label class="radio inline " style="margin-left: 22px !important;">
		<?php echo $this->Form->input('member_type_id', ['type' => 'radio','label' => false,'value'=>'']); ?>
		</label>									
		<?php } ?>
		<label id="member_type_id-error" class="error" for="member_type_id"></label>
						</div>
					</div>
				</div>
	
	
	
						</div>					
					</div>
				</div>
			</div>
	<?php echo $this->Form->end(); ?>
</div>
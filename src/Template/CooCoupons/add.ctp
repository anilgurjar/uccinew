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
<?php echo $this->Form->create($cooCoupon ,['id'=>'registratiomForm']); ?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Coo Coupon</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
				<div class="col-md-12 pad">
					<div class="form-group col-sm-3">
					  <label>Company/Organisation</label>
						<?php  
								$options=array();
								foreach($master_member as $master_member_data)
								{
									
										$options[] = ['text' => $master_member_data->company_organisation, 'value' => $master_member_data->id, 'state' => $master_member_data->master_state_id]; 
								
								}
						echo $this->Form->input('company_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control select2 state changecompany','options'=>$options,'style'=>'width:100%;']);  ?>
						<label id="company-id-error" class="error" for="company-id"></label>
					</div>
				   
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Valid From</label>
							<?php echo $this->Form->input('valid_from', ['label' => false,'placeholder'=>'Valid From','class'=>'form-control date-picker','format'=>"",'type'=>'text','data-date-format'=>'dd-mm-yyyy']); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Valid To</label>
							<?php echo $this->Form->input('valid_to', ['label' => false,'placeholder'=>'Valid To','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','type'=>'text']); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">How many Coupon Generate</label>
							<?php echo $this->Form->input('coupon_number', ['label' => false,'placeholder'=>'Coupon Number ','class'=>'form-control','value'=>1,'maxlength'=>'3']); ?>
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
					
			
					
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<script>

$(document).ready(function() { 


$("#registratiomForm").validate({ 
		rules: {
			company_id: {
				required: true
			},
			coupon_number: {
				number: true
			}
			
		},
		
		submitHandler: function () {
				
				$("#submit_member").attr('disabled','disabled');
				
				 form.submit();
			}
	}); 

});
</script>
       
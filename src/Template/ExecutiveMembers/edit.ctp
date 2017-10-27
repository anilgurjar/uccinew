<div class="col-md-12">
<?php echo $this->Form->create($executiveMember, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Edit Executive Member</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Financial Year</label>
									<?=  $this->Form->input('master_financial_year_id', ['empty'=> '--Select--','data-placeholder'=>'Select a category','label' => false,'class'=>'form-control master_purpose_id','options'=>$masterFinancialYears,'required'=>'required','value'=>''.$id.'']); ?>
									
									
								</div>
							</div>
					</div>
					
					
					<?php $x=0;  foreach($executiveMember as $executive){ 
					$executive_members_data=$executive->executive_members;	
					
					?>
						<div class="col-md-12 pad">
							<div class="form-group" style="background-color: #3887b7;padding: 4px;color:#fff;">
								<label class="control-label" style="margin-left:10px"><?php echo $executive->name; ?></label>
							</div>
						<?php  
						foreach($executive_members_data as $executive_member){  ?>
							<div class="col-md-4">
								<div class="form-group">
									
									<?=  $this->Form->input('executive_members['.$x.'][user_id]', ['empty'=> '--Select--','data-placeholder'=>'Select a Executive-Members','label' => false,'class'=>'select2 form-control','options'=>$users,'required'=>'required','value'=>''.$executive_member->user_id.'']);
									
									?>
									<br/>
									<?=  $this->Form->input('executive_members['.$x.'][designation_id]', ['empty'=> '--Select--','data-placeholder'=>'Select a designation','label' => false,'class'=>'select2 form-control','options'=>$designations,'value'=>''.@$executive_member->designation->id.'']);
									
									?>
									
									 <?php echo $this->Form->input('executive_members['.$x.'][executive_category_id]', ['type' => 'hidden' , 'value'=>''.$executive_member->executive_category_id.'','label' => false , 'class'=>'']); ?>
									
									 <?php echo $this->Form->input('executive_members['.$x.'][master_financial_year_id]', ['type' => 'hidden' , 'value'=>''.$executive_member->master_financial_year_id.'','label' => false , 'class'=>'financial_year']); ?>
									 
									  <?php echo $this->Form->input('executive_members['.$x.'][created_by]', ['type' => 'hidden' , 'value'=>''.$user_id.'','label' => false , 'class'=>'']); ?>
																		
								</div>
							</div>
						<?php $x++; } ?>	
						</div>	
					<?php } ?>
					
					
					
					
				</div>
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) .__(' Submit'),['class'=>'btn btn-primary','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
					</center>
					
				</div>
		</div>
			<?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).on("change",".master_purpose_id",function(){  
		var id=$(this).val();
		$('.financial_year').val(id);
		 
	});

</script>
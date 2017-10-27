<style>
.pad{
	padding-right: 0px;
padding-left: 0px;
}
.form-group
{
	margin-bottom: 0px;
}
input[type="checkbox"]{
	margin-right: 2px;
}
</style>   
<div class="col-md-12">
<?php echo $this->Form->create($notice, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Create Notice</h3>
			</div>
			<div class="box-body" style="display: block;">
			<div class="row">
						
			<div class="col-md-12 pad">
						

				<div class="col-md-4">
					<div class="form-group">
					
						<?php
						$options=array();
						
						$options[1] = 'Member Type';
						$options[2] = 'Individual';
						echo $this->Form->input('type_of_member', array('templates' => ['radioWrapper' => '<div class="radio inline radio-div">{{label}}</div>'],'type' => 'radio','label' => false,'options' => $options,'hiddenField' => false)); ?>
						<label id="type-of-member-error" class="error" for="type_of_member" style="display: none;"></label>
						<div id="member" style="display:none;">
							<?php
							$itemGroups=array();
							foreach($MasterMemberTypes as $member_type_data){
								$itemGroups[$member_type_data->id] = $member_type_data['member_type'];
							  } 

								echo $this->Form->input('member_type_id', ['templates' => [ 
								'checkboxWrapper' => '<div class=" inline" style="margin-left: 5px !important;">{{label}}</div>',
								],'hiddenField' => false,'label' => false,'options' => $itemGroups,'multiple' => 'checkbox','name'=>'member_type_id']);
								unset($itemGroups);
							  ?>
							<label id="member_type_id[]-error" class="error" for="member_type_id[]" style="display: none;"></label>
						
						</div>
						
						
						
						<div id="individual" style="display:none;">
							<?php 
								$options=array();
								foreach($User as $user_data){ 
									$options[$user_data->id] = $user_data->email;
									
								}
								echo $this->Form->input('email_id', ['empty'=> '--Select--','data-placeholder'=>'Select a member','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;','multiple'=>'multiple']); ?>
													
								
							 <label id="email-id-error" class="error" for="email-id" style="display: none;"></label>
						</div>
												
					</div>
				</div>
					
						
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Category</label>
						<?php 
						$options=array();
						foreach($noticeCategories as $category_data){
							
							$options[$category_data->id] = $category_data->category_name;
						}
                        echo $this->Form->input('notice_category_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Category','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
							<label id="notice-category-id-error" class="error" for="notice-category-id" style="display: none;"></label>
						</div>
					</div>
					
					 <div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Subject</label>
							<?php echo $this->Form->input('title', ['label' => false,'placeholder'=>'Subject','class'=>'form-control']); ?>
						</div>
					</div>
					
			</div>
			
			<textarea id="description" name="description" hidden=""></textarea>
			<div class="col-md-12 ">
					<div class="box-body  pad">
					<textarea class="txtEditor"></textarea>
					
					</div>
			    
			</div>
			
			<div class="col-md-12 ">
				<table id="file_table" style="line-height:2.5">
				<tr>
				<td><?= $this->Form->file('file[]',['multiple'=>'multiple']); ?></td>
				<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?></td>
				<td></td>
				</tr>
				</table>
					
			</div>
			</div>
			</div>
			<div class="box-footer">
				<center>
				
				<?= $this->Form->button(__('Submit') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
				</center>
				
			</div>
			</div>
			<?php echo $this->Form->end(); ?>
			</div>
			<table id="copy_row" style="display:none;">	
			<tbody>
			<tr>
				<td><?= $this->Form->file('file[]',['multiple'=>'multiple']); ?></td>
				<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?>
				</td>
				<td>
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-trash']) . __(' Delete'), ['class'=>'btn btn-block btn-danger btn-sm delete_row','type'=>'button']) ?></td>
				</tr>
				</tbody>
			</table>
					
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<script>

$(document).ready(function() { 
	$("button:submit").click(function(){ 
		$('#description').text($('.txtEditor').Editor("getText"));
	}); 
	
	$(document).on('click','button.add_more',function() {
		var row=$('#copy_row tbody').html();
		$('#file_table tbody').append(row);
		
	});
	$(document).on('click','button.delete_row',function() {
		$(this).closest('tr').remove();
	});
	$('input[name="type_of_member"]').on('change',function() { 
		var member_type_id=$(this).val();
		if(member_type_id==1)
		{
			$('#member').show();
			$('#individual').hide();
		}
		else
		{
			$('#individual').show();
			$('#member').hide();
		}
		
	});
	
	
	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
	$("#registratiomForm").validate({
		rules: {
			
			type_of_member: {
				required: true
			},
			notice_category_id: {
				required: true
			},
			description: {
				required: true
			},
			
			'email_id[]': {
				required: true,
			},
			'member_type_id[]': {
				required: true,
				
			},
						
		},
		submitHandler: function () {
				
				$("#create_notice").attr('disabled','disabled');
				
				 form.submit();
			},
		messages: {
			member_type_id: {
					required: "Please select a member type."
				}
		}
	});

});
</script>
       

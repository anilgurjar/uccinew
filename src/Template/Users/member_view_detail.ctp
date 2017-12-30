<style>
.pad{
	padding-right: 0px;
padding-left: 0px;
}
.form-group
{
	margin-bottom: 0px;
}

fieldset {
 padding: 10px ;
 border: 1px solid #bfb7b7f7;
 margin: 12px;
}
legend{
margin-left: 20px;	
//color:#144277; 
color:#144277c9; 
font-size: 17px;
margin-bottom: 0px;
border:none;
}


</style>

<div class="col-md-12">
<?php echo $this->Form->create($update, ['type' => 'file','id'=>'registratiomForm2']); 
	 $company_member_types=$update->company_member_types; 
			$users=$update->users;
			foreach($company_member_types as $company_member_type){
				$master_member_type_id[]=$company_member_type->master_member_type_id;
			}	?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Member Registration</h3>
			</div>
			<div class="box-body" style="display: block;">
			<div class="row">
			
		<fieldset border="1" style="margin-left: 50px;margin-right: 50px;">
			<legend><b>COMPANY INFORMATION </b></legend>
				
				
				<div class="col-md-12 pad">
				
					  <div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Company/Organisation</label>
								<?php echo $this->Form->input('company_organisation', ['label' => false,'placeholder'=>'Company/Organisation','class'=>'form-control','value'=>$update->company_organisation]); ?>
							</div>
						</div>
					   
					   <div class="col-md-4">
							<div class="form-group">
								<label class="control-label">End Products / Items Dealing in</label>
								<?php echo $this->Form->input('end_products_item_dealing_in', ['label' => false,'placeholder'=>'End Products / Items Dealing in','class'=>'form-control','value'=>$update->end_products_item_dealing_in]); ?>
							</div>
						</div>
					  <div class="col-md-4">
							<div class="form-group">
								<label class="control-label">PAN No.</label>
								<?php echo $this->Form->input('pan_no', ['label' => false,'placeholder'=>'PAN No.','class'=>'form-control','value'=>@$data->pan_no]); ?>
							</div>
					 </div>
				</div>
			<div class="col-md-12 pad">
				<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Date of Joining</label>
							<?php echo $this->Form->input('year_of_joining', ['label' => false,'placeholder'=>'Date of Joining','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','data-date-end-date'=>'+0d', 'type'=>'text','value'=>date('d-m-Y',strtotime($update->year_of_joining))]); ?>
						</div>
					</div>
				<div class="col-md-8">
					<div class="form-group">
						<label class="control-label">Member Type</label><br/>
						
						<?php
						$options=array();
						foreach($member_type as $member_type_data){
							$options[$member_type_data->id] = '   '.$member_type_data['member_type'];
					
						}
						
						echo $this->Form->input('company_member_types[master_member_type_id]', ['templates' => ['checkboxWrapper' => '<div class=" inline" style="margin-left: 5px !important;">{{label}}</div>',
								],'hiddenField' => false,'label' => false,'options' => $options,'multiple' => 'checkbox','value'=>$master_member_type_id,'disabled'=>'disabled']); ?>
							<label id="company_member_types[master_member_type_id][]-error" class="error" for="company_member_types[master_member_type_id][]"></label>
						</div>
				</div>
				
				
			</div>
			<div class="col-md-12 pad">
			
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Gst Number </label>
							<?php echo $this->Form->input('gst_number', ['label' => false,'placeholder'=>'GST NUMBER','class'=>'form-control ','type'=>'text','value'=>$update->gst_number]); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Grade</label>
						<?php 
						$options=array();
						foreach($fetch_master_grade as $grade_data){
							$options[$grade_data->id] = $grade_data['grade_name'];
						}
                        echo $this->Form->input('grade', ['empty'=> '--Select--','data-placeholder'=>'Select a Grade','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;','value'=>$update->grade]); ?>
							<label id="grade-error" class="error" for="grade"></label>
						</div>
					</div>
			
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Category</label>
						<?php 
						$options=array();
						foreach($fetch_master_category as $category_data){
							$options[$category_data->id] = $category_data['category_name'];
						}
                        echo $this->Form->input('category', ['empty'=> '--Select--','data-placeholder'=>'Select a Category','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;','value'=>$update->category]); ?>
							<label id="category-error" class="error" for="category"></label>
						</div>
					</div>
					
			</div>
			<div class="col-md-12 pad">
			
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Classification</label>
							<?php 
							$options=array();
							foreach($fetch_master_classification as $classification_data){
								$options[$classification_data->id] = $classification_data['classification_name'];
							}
							echo $this->Form->input('classification', ['empty'=> '--Select--','data-placeholder'=>'Select a Category','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;','value'=>$update->classification]); ?>
							<label id="classification-error" class="error" for="classification"></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Member Turn Over</label>
							<?php 
							$options=array();
							foreach($turn_over as $turn_over_data){
								$options[$turn_over_data->id] = $turn_over_data['component'];
							}
							echo $this->Form->input('turn_over_id', ['empty'=> '---Select Turn Over---','label' => false,'class'=>'form-control','options'=>$options,'value'=>$update->turn_over_id]); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Office-Telephone</label>
							<?php echo $this->Form->input('office_telephone', ['label' => false,'placeholder'=>'Office-Telephone','class'=>'form-control','value'=>$update->office_telephone]); ?>
						</div>
					</div>
					
			</div>
			<div class="col-md-12 pad">
				
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Residential-Telephone</label>
							<?php echo $this->Form->input('residential_telephone', ['label' => false,'placeholder'=>'Residential-Telephone','class'=>'form-control','value'=>$update->residential_telephone]); ?>
						</div>
					</div>
					
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label">Address</label>
							<?php echo $this->Form->input('address', ['label' => false,'placeholder'=>'Company Address','class'=>'form-control','type'=>'textarea','style'=>'resize:none;','rows'=>'2','value'=>$update->address]); ?>
						</div>
					</div>
					
			</div>
			<div class="col-md-12 pad">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">City</label>
						<?php echo $this->Form->input('city', ['label' => false,'placeholder'=>'City Name','class'=>'form-control','value'=>$update->city]); ?>
					</div>
				</div>
				<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">State</label>
							<?php echo $this->Form->input('master_state_id', ['label' => false,'options'=>$state,'placeholder'=>'State  Name','class'=>'form-control select2','value'=>$update->master_state_id]); ?>
						</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Pincode</label>
						<?php echo $this->Form->input('pincode', ['label' => false,'placeholder'=>'pincode','class'=>'form-control','value'=>$update->pincode,'type'=>'text']); ?>
					</div>
				</div>
			</div>
		</fieldset>		
		
		<fieldset style="margin-left: 50px;margin-right: 50px;">	
			<legend><b>FIRST NOMINEE </b></legend>
			<div class="col-md-12 pad">
					<div class="col-md-4">
						<div class="form-group" style="text-align:center"> 
							<?php 
							  if (file_exists(WWW_ROOT . ''.@$users[0]->image.'')){ 
									$html_img= $this->Html->image('/'.@$users[0]->image.'',['width'=>'100px','height'=>'100px']); 
								 }
									else{ 
									
										$html_img= $this->Html->image('/img/tab2.png',['width'=>'100px','height'=>'80px']); 
									}
									echo $html_img;
									//pr($users);
									?>

						</div>
					</div>
					
					
					
					<div class="col-md-4">
						<div class="form-group" >
							<label class="control-label">Name</label>
							<?php echo $this->Form->input('users[0][member_name]', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control','value'=>@$users[0]->member_name]); ?>

							<?php echo $this->Form->input('users[0][member_nominee_type]', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control nominee_first','type'=>'hidden','value'=>@$users[0]->member_nominee_type]); ?>

					<?php echo $this->Form->input('users[0][id]', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control nominee_first','type'=>'hidden','value'=>@$users[0]->id]); ?>
						</div>
					</div>
					
					
					<div class="col-md-4">
						<div class="form-group">
								<label class="control-label">Designation</label>
								<?php echo $this->Form->input('users[0][member_designation]', ['label' => false,'placeholder'=>'Designation','class'=>'form-control first']); ?>
						</div>
					</div>
			
					
				</div>
				
				<div class="col-md-12 pad">
					
					<div class="col-md-4">
						<div class="form-group" style="text-align:center"> 
							<label class="control-label">Upload Photograph </label><br/> 
							<div class="col-md-offset-3 col-md-9">
							<?= $this->Form->file('member_image') ?>
							</div>
						</div>
					</div>
						
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">E-mail</label>
							<?php echo $this->Form->input('users[0][email]', ['label' => false,'placeholder'=>'Company E-mail','class'=>'form-control','value'=>@$users[0]->email]); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Mobile No.</label>
							<?php echo $this->Form->input('users[0][mobile_no]', ['label' => false,'placeholder'=>'Mobile Number','class'=>'form-control','value'=>@$users[0]->mobile_no]); ?>
						</div>
					</div>
				
				</div>
				
				
			</fieldset>		
			
			<fieldset style="margin-left: 50px;margin-right: 50px;">	
			  <legend><b>SECOND NOMINEE </b></legend>

				<div class="col-md-12 pad">
				
					<div class="col-md-4">
						<div class="form-group" style="text-align:center">
						<?php

						   if(file_exists(WWW_ROOT . ''.@$users[1]->image.'')){ 
								$html_img1= $this->Html->image('/'.@$users[1]->image.'',['width'=>'100px','height'=>'100px']); 
							   }
								else{ 
									
										$html_img= $this->Html->image('/img/tab2.png',['width'=>'100px','height'=>'80px']); 
									}
									echo $html_img;
								?>
							
							
						</div>
					</div>
				
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Name</label>
							<?php echo $this->Form->input('users[1][member_name]', ['label' => false,'placeholder'=>'Alternate Nominee','class'=>'form-control second','value'=>@$users[1]->member_name]); ?>

							<?php echo $this->Form->input('users[1][member_nominee_type]', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control nominee_second','type'=>'hidden','value'=>@$users[1]->member_nominee_type]); ?>
						<?php echo $this->Form->input('users[1][id]', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control nominee_first','type'=>'hidden','value'=>@$users[1]->id]); ?>
						</div>
					</div>
					
					<div class="col-md-4">
								<div class="form-group">
										<label class="control-label">Designation</label>
										<?php echo $this->Form->input('users[1][member_designation]', ['label' => false,'placeholder'=>'Designation','class'=>'form-control first']); ?>
								</div>
					</div>
							
					
					
					
				</div>
				<div class="col-md-12 pad">
					
					<div class="col-md-4">
						<div class="form-group" style="text-align:center">
							<label class="control-label">Upload Photograph  </label><br/>
							<div class="col-md-offset-3 col-md-9">
							<?= $this->Form->file('alternate_image') ?>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">E-mail</label>
							<?php echo $this->Form->input('users[1][email]', ['label' => false,'placeholder'=>'Company E-mail','class'=>'form-control second','value'=>@$users[1]->email]); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Mobile No.</label>
							<?php echo $this->Form->input('users[1][mobile_no]', ['label' => false,'placeholder'=>'Mobile Number','class'=>'form-control second','value'=>@$users[1]->mobile_no]); ?>
						</div>
					</div>
					
				</div>
			</div>
			</div>
			<div class="box-footer">
				<center>
				
				<?= $this->Form->button(__('Submit') . $this->Html->tag('i', '', ['class'=>'fa fa-btn']),['class'=>'btn btn-success btn btn-primary','type'=>'Submit','name'=>'registration_update']);
					   ?>
				</center>
			</div>
			</div>
			
			<?php echo $this->Form->end(); ?>
			</div>
					
			
					
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>


<script>

$(document).ready(function() { 

$('.second').on('keyup change',function() {
var x=$(this).val();
	if(x.length>0){
		$('.nominee_second').val('second');
	}else{
		$('.nominee_second').val('');
	}

});
  
	$("#registratiomForm2").validate({ 
		rules: {  
			company_organisation: {
				required: true
			},
			'users[0][member_name]': {
				required: true
			},
			address: {
				required: true
			},
			
			
			'users[0][email]': {
				required: true,
				email:true,
				
			}, 
			'users[1][email_id]': {
				email:true,
				
			},
			'users[0][mobile_no]': {
				number: true,
				minlength: 10,
                maxlength: 10
				
			},
			'users[1][mobile_no]': {
				number: true,
				minlength: 10,
                maxlength: 10
				
			},
			city: {
				
			},
			pincode: {
				
				number: true,
				minlength: 6,
                maxlength: 6
			},
			pan_no: {
				pan_no:true
			},
			grade: {
				required: true
			},
			category: {
				required: true
			},
			classification: {
				required: true
			},
			year_of_joining: {
				required: true
			},
			'company_member_types[master_member_type_id][]': {
				required: true
			},
			turn_over_id: {
				required: true
			} 
			
		},
		messages: {
			 email: {
              remote: "This E-mail is already exist."
            },
			 alternate_email: {
              remote: "This E-mail is already exist."
            },
			member_name: {
				required: "Please enter a username."
			},
			member_type_id: {
					required: "Please select a member type."
				}
		}
	});

});
</script>
       
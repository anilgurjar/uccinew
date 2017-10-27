<div class="col-md-12">
	<div class="box box-primary">
    <?php echo $this->Form->create($Users, ['type' => 'file','id'=>'registratiomForm']); ?>
		<div class="box-header with-border">
			<h3 class="box-title">Add Staff Login</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
						
				
				<div class="col-md-12 pad">
					<div class="col-md-3"> 
						<div class="form-group">
							<label class="control-label">Department </label>
													
						<?php echo $this->Form->input('industrial_department_id', array('empty'=> '--Select--','label' => false,'options' => $IndustrialDepartments,'hiddenField' => false,'value'=>'','class'=>'form-control select2')); ?>
						
						<?php echo $this->Form->input('company_id', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control ','type'=>'hidden','value'=>$company_id]); ?>
						
						<label id="industrial-department-id-error" class="error" for="industrial-department-id"></label>
						</div>
					</div> 
				
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Contact Person</label>
							<?php echo $this->Form->input('member_name', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control']); ?>
							
							<?php echo $this->Form->input('member_nominee_type', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control nominee_first','type'=>'hidden','value'=>'']); ?>
							
						</div>
					</div>
					<div class="col-md-3"> 
						<div class="form-group">
							<label class="control-label">Email </label>
							<?php echo $this->Form->input('email', ['label' => false,'placeholder'=>'Company E-mail','class'=>'form-control ']); ?>
						</div>
					</div> 
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Mobile No.</label>
							<?php echo $this->Form->input('mobile_no', ['label' => false,'placeholder'=>'Mobile Number','class'=>'form-control']); ?>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="box-footer">
				<center>
				
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).__(' Submit')  ,['class'=>'btn btn-success','type'=>'Submit']);
					   ?>
				</center>
			</div>
	
    <?= $this->Form->end() ?>
	<br/>
	
	
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col">Sr. No.</th>
                <th scope="col"><?= $this->Paginator->sort('Department_name') ?></th>
				 <th scope="col"><?= $this->Paginator->sort('Contact Person') ?></th>
				  <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
				   <th scope="col"><?= $this->Paginator->sort('Mobile') ?></th>
               
            </tr>
        </thead>
        <tbody>
            <?php $sr_no=0; foreach ($Companies_datas[0]->users as $users_data): ?>
            <tr>
                <td><?= $this->Number->format(++$sr_no) ?></td>
                <td><?= h($users_data->industrial_department->department_name) ?></td> <td><?= h($users_data->member_name) ?></td> 
				<td><?= h($users_data->email) ?></td>
				<td><?= h($users_data->mobile_no) ?></td>
              
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
	</div>
	
</div>
					
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function() { 
 $("#registratiomForm").validate({ 
		rules: {
			industrial_department_id: {
				required: true
			},
			member_name: {
				required: true
			},
			
			
			email: {
				
				email:true
				//remote:"check_email"
			},
			
			mobile_no: {
				number: true,
				minlength: 10,
                maxlength: 10
				
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
		},
		submitHandler: function () {
				
				$("#submit_member").attr('disabled','disabled');
				
				 form.submit();
			}
	}); 

});
</script>



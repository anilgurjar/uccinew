<div class="col-md-12">
	<div class="box box-primary">
    <?php echo $this->Form->create($Users, ['type' => 'file','id'=>'registratiomForm']); ?>
		<div class="box-header with-border">
			<h3 class="box-title">Add Member</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
						
				
				<div class="col-md-12 pad">
					<div class="col-md-3"> 
						<div class="form-group">
							<label class="control-label">Designation </label>
							<?php    
							echo $this->Form->input('member_designation', ['empty'=>'---Select---','label' => false,'placeholder'=>'Select Designation','class'=>'form-control select2','options'=>$member_designations,'required']);  ?>
							<label id="member-designation-error" class="error" for="member-designation"></label>
						</div>
					</div> 
				
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Contact Person</label>
							<?php echo $this->Form->input('member_name', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control','required']); ?>
						</div>
					</div>
					<div class="col-md-3"> 
						<div class="form-group">
							<label class="control-label">Email </label>
							<?php echo $this->Form->input('email', ['label' => false,'placeholder'=>'E-mail','class'=>'form-control ','required']); ?>
						</div>
					</div> 
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Mobile No.</label>
							<?php echo $this->Form->input('mobile_no', ['label' => false,'placeholder'=>'Mobile Number','class'=>'form-control','required']); ?>
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
                <th scope="col"><?= $this->Paginator->sort('Contact Person') ?></th>
				 <th scope="col"> <?= $this->Paginator->sort('Designation') ?></th>
				  <th scope="col"><?= $this->Paginator->sort('Email') ?></th>
				   <th scope="col"><?= $this->Paginator->sort('Mobile') ?></th>
               
            </tr>
        </thead>
        <tbody>
            <?php $sr_no=0;foreach ($result_Users as $users_data):
			 ?>
            <tr>
                <td><?= $this->Number->format(++$sr_no) ?></td>
                <td><?= h($users_data->member_name) ?></td> 
				<td><?= h($users_data->member_designation) ?></td> 
				<td><?= h($users_data->email) ?></td> 
				
				<td><?= h($users_data->mobile_no) ?></td> 
				<td>	
					<?php
						echo $this->Form->button( __('delete') ,['class'=>'btn btn-danger btn-sm','type'=>'button','data-toggle'=>'modal','data-target'=>'#notverify'.$users_data->id.'','value'=>$users_data->id]);

					?>
					<div class="modal fade" id="notverify<?php echo $users_data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left">Do you want to delete member ?</h4>
							  </div>
							  <div class="modal-body">
								
							  </div>
							  <div class="modal-footer">
							  <div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">NO</button>
								<?php
									echo $this->Html->link('Yes', array('controller' => 'Companies', 'action' => 'add_member_delete',$users_data->id),['class' => 'btn  btn-primary btn-flat pull-right hide_print', 'style'=>'margin-right:5px;','escape'=>false]); ?>
							 
							  </div>
							</div>
						  </div>
						</div>
				</td>		
            </tr>
            <?php   endforeach; ?>
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
				required: "Please enter member name"
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



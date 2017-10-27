<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Change Password</h3>
	</div>
	<?php echo $this->Form->create($password, ['type' => 'post','id'=>'password','class'=>'form-horizontal cmxform']); ?>
	 <div class="box-body">
		<div class="form-group">
		  <label class="col-sm-2 control-label">User Login</label>
		  <div class="col-sm-6">
			<?php 
						$options=array();
						foreach($fetch_login as $data){
							$options[$data->id]=''.$data->member_name.'          ('.$data->email.')';
						}
                        echo $this->Form->input('user_id', ['empty'=> '--Select--','data-placeholder'=>'Select ID...','label' => false,'class'=>'form-control select2 user_id','options'=>$options,'style'=>'width:100%;','id'=>'user_id']); ?>
			<span class="help-block">
			Provide your login id to change password</span>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">Password</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('password',['label'=>false,'class'=>'form-control','type'=>'password','placeholder'=>'Password','autocomplete'=>'off','id'=>'first_p']);
			?>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">Re-type Password</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('retype_password',['label'=>false,'class'=>'form-control','type'=>'password','placeholder'=>'Re-type Password','autocomplete'=>'off','id'=>'new_p']);
			?>
		  </div>
		</div>
	  </div>
	   <div class="box-footer">
	   <div class="col-sm-6">
		<center>
		<?= $this->Form->button($this->html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success','id'=>'admin_change_password']); ?>
		</center>
		 </div>
	  </div>
	<?php echo $this->Form->end(); ?>
  </div>
 </div>
 
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>


<script type="text/javascript">
$(document).ready(function()
{
	
	
		$("#password").validate({
		rules: {
			password: {
				required: true
			},
			retype_password: {
				equalTo: '[name="password"]'
			},
			user_id: {
				required: true
			}
			
			
		},
		submitHandler: function () {
				
				$("#admin_change_password").attr('disabled','disabled');
				
				 form.submit();
			},
		
	});
	
	
	
	
	
	
	
	
	
});		
</script>
           
             

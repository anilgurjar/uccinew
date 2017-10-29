<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Create Login</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?= $this->Form->create($user,['id'=>'login_edit','class'=>'form-horizontal cmxform','method'=>'post']) ?>
	  <div class="box-body">
	  <div class="form-group">
		  <label class="col-sm-2 control-label">User Name</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('member_name',['label'=>false,'class'=>'form-control','type'=>'text','placeholder'=>'User Name','autocomplete'=>'off']);
			?>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">E-mail</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('email',['label'=>false,'class'=>'form-control','type'=>'text','placeholder'=>'E-mail','autocomplete'=>'off']);
			?>
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
		<div class="form-group">
		  <label class="col-sm-2 control-label">Role ID</label>
		  <div class="col-sm-4">
		 
				
					<?php
					foreach($fetch_role as $data)
					{
						$itemGroups[$data->id]=$data->role_name;
					}
					
					echo $this->Form->input("role_id", ['empty'=>'---Select Role---','options' => $itemGroups,'hiddenField'=>false,'label' => false,'class' => 'form-control select2','data-placeholder' => 'Select Role','tabindex'=>'-1']); 
					unset($itemGroups);
					?>
					
		  
		  </div>
		</div>
	  </div>
	  			
	  <!-- /.box-body -->
	  <div class="box-footer">
	   <div class="col-sm-6">
		<center>
		<?=  $this->Form->button(__('Submit ') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-success','type'=>'Submit','id'=>'create_login']) ?>
		</center>
		 </div>
	  </div>
	  <!-- /.box-footer -->
	<?php echo $this->Form->end(); ?>
	
  </div>
 </div>
  <!-- /.box -->
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function() { 

	jQuery.validator.addMethod("[name=email]", function(value, element) {
		return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test( value );
	});
	
	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
	$("#login_edit").validate({
		rules: {
			password: {
				required: true
			},
			retype_password: {
				equalTo: '[name="password"]'
			},
			email: {
				required: true,
				email:true,
				remote:"check_email"
			}
			
		},
			submitHandler: function () {
				
				$("#create_login").attr('disabled','disabled');
				
				 form.submit();
			},
		messages: {
			 email: {
              remote: "This E-mail is already exist."
            }
		}
	});
});
</script>

           
             

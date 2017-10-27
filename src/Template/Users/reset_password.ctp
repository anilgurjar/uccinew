<style>
.login-box, .register-box {
    width: 450px !important;
}
</style>
<div class="login-box" style="margin-top:10px !important;">
	<div class="login-logo">
		<a href="#">
		<?php	echo $this->Html->image('/images/project_logo/UCCI LOGO.png', ['style'=>'width:120px;']); ?>
		</a>
	</div>
   <div class="login-box-body">
   <?= $this->Flash->render() ?>
    <p class="login-box-msg">Change Password</p>
		<?= $this->Form->create($user,['class'=>'form-horizontal cmxform']) ?>
		<div class="form-group has-feedback">
			
			  <label class="col-sm-4">New Password</label>
			  <div class="col-sm-8">
				<?php echo $this->Form->password("password", ['label' => false,'class'=>'form-control','placeholder'=>'Password', 'required' => true]); ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			  </div>
			
		</div>
		<div class="form-group  has-feedback">
			
			  <label class="col-sm-4">Confirm Password</label>
			  <div class="col-sm-8">
				<?php echo $this->Form->password("confirm_password", ['label' => false,'class'=>'form-control','placeholder'=>'Confirm Password', 'required' => true]); ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			  </div>
			
			</div>
		<div class="row">
			<div class="col-xs-8">
				
			</div>
			<div class="col-xs-4">
			<?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary btn-block btn-flat']); ?>
			</div>
			
		</div>
		<?= $this->Form->end() ?>
	</form>
  </div>
</div>

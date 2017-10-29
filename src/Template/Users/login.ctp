<style>
.alert-dismissible{
	width: 325px !important;
	margin-right: 0px !important; 
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
    <p class="login-box-msg">Sign in to start your session</p>
		<?= $this->Form->create() ?>
		<div class="form-group has-feedback">
			 <?= $this->Form->input('username',['class'=>'form-control','placeholder'=>'User Name','label'=>false]) ?>
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<?= $this->Form->input('password',['class'=>'form-control','placeholder'=>'Password','label'=>false]) ?>
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<div class="row">
			<div class="col-xs-8">
				 <?php  echo $this->Html->link("Forgot your password?<br/>", array('controller' => 'Users', 'action' => 'forgot_password'),['class' => '','style'=>'text-align:left;width:100%;','escape'=>false]); ?>
			</div>
			<div class="col-xs-4">
			<?= $this->Form->button(__('Login'),['class'=>'btn btn-primary btn-block btn-flat']); ?>
			</div>
			
		</div>
		<?= $this->Form->end() ?>
	</form>
  </div>
</div>

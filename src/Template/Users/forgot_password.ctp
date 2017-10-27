
<div class="login-box" style="margin-top:10px !important;">
	<div class="login-logo">
		<a href="#">
		<?php	echo $this->Html->image('/images/project_logo/UCCI LOGO.png', ['style'=>'width:120px;']); ?>
		</a>
	</div>
   <div class="login-box-body">
   <?= $this->Flash->render() ?>
    <p class="login-box-msg">Forget Password ?</p>
	<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<?= $this->Form->create() ?>
		<div class="form-group has-feedback">
			 <?= $this->Form->input('email',['class'=>'form-control','placeholder'=>'Email','label'=>false]) ?>
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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

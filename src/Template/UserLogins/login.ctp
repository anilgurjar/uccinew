<div class="login-box" style="margin-top:5px !important;">
	<div class="login-logo">
		<a href="#">
		<?php	echo $this->Html->image('/images/project_logo/UCCI LOGO.png', ['style'=>'width:120px;']); ?>
		</a>
	</div>
   <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
	<form  method="post">
		<div class="form-group has-feedback">
			<input type="email" class="form-control" name="email" placeholder="Email">
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<input type="password" class="form-control" name="password" placeholder="Password">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<?php echo @$wrong4; ?>
		<div class="row">
			<div class="col-xs-12">
			<button type="submit" name="login_submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div>
		</div>
	</form>
  </div>
</div>
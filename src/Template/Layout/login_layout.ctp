<!DOCTYPE html>
<html lang="en">
<head>
<title>UCCI</title>
<?php
echo $this->fetch('meta');
 //Configure::write('debug', 0);
 ?>
	<?php echo $this->Html->css('/assets/Lato2OFLWeb/Lato2OFLWeb/Lato/latofonts.css'); ?>
	<?php echo $this->Html->css('/assets/font-awesome/css/font-awesome.min.css'); ?> 
	<?php echo $this->Html->css('/assets/bootstrap/css/bootstrap.min.css'); ?> 
		<?php echo $this->Html->css('/assets/ionicons/css/ionicons.min.css'); ?> 
	<?php echo $this->Html->css('/assets/dist/css/AdminLTE.min.css'); ?> 
	<?php echo $this->Html->css('/assets/plugins/iCheck/square/blue.css'); ?> 
		<?php
	echo $this->Html->meta(
    'favicon.ico',
    '/images/shortcut_icon/favicon.ico',
    ['type' => 'icon']
);
?>
	<style>
	body{
font-family: 'LatoHairline';
font-size:14px;
}
 	</style>
	
<?php
//$this->requestAction(array('controller' => 'Nonmovinginventory', 'action' => 'ajax_function'), array());
?>
</head>
<body class="hold-transition login-page" >
<!-- --------------------------------start  menu  header--------------------------------------------- -->
<?php    
?>
<!-- --------------------------------end  menu  header--------------------------------------------- -->

<?php echo $this->fetch('content'); ?>
 <!-- --------------------------------start  footer menu--------------------------------------------- -->


	<?php echo $this->Html->script('/assets/dist/js/sb-admin-2.js'); ?>
	<?php echo $this->Html->script('/assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>
	<?php echo $this->Html->script('/assets/bootstrap/js/bootstrap.min.js'); ?>
	<?php echo $this->Html->script('/assets/plugins/iCheck/icheck.min.js'); ?>

</body>
</html>



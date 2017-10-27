
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Master Company</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?= $this->Form->create($MasterCompanies,['id'=>'purposeForm','class'=>'form-horizontal cmxform','method'=>'post']) ?>
	  <div class="box-body  pad">
			<textarea class="textarea wysihtml5textarea"  name="company_information" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
	  </div>
	  			
	  <!-- /.box-body -->
	  <div class="box-footer">
	   <div class="col-sm-6">
		<center>
		<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success']); ?>
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

	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
	$("#purposeForm").validate({
		rules: {
			role_name: {
				required: true
			}
		}
		
	});

});
</script>
           
             

<style>
.capitalize {
    text-transform: capitalize;
}
</style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Master Turn Over</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?= $this->Form->create($MasterTurnOvers,['id'=>'turnoverForm','class'=>'form-horizontal cmxform','method'=>'post']) ?>
	  <div class="box-body">
		<div class="form-group">
		  <label class="col-sm-2 control-label">Component</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('component',['label'=>false,'class'=>'form-control capitalize','type'=>'text','placeholder'=>'Component Description']);
			?>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">Amount</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('subscription_amount',['label'=>false,'class'=>'form-control','type'=>'text','placeholder'=>'Subscription amount without tax']);
			?>
		  </div>
		</div>
	  </div>
	  <!-- /.box-body -->
	  <div class="box-footer">
	   <div class="col-sm-6">
		<center>
		<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success','id'=>'master_turn_over']); ?>
		</center>
		 </div>
	  </div>
	  <!-- /.box-footer -->
	<?php echo $this->Form->end(); ?>
	
  </div>
  <!-- /.box -->
</div>


<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">View</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table width="100%" class=" table table-responsive table-bordered" style="border:1px solid #3C8DBC;">
	<tr style="background-color:#3C8DBC; color:#fff">
	<th>#</th>
	<th>Component</th>
	<th>Amount</th>
	</tr>
	
	<?php 
	$i=0;
	foreach($fetch_master_turn_over as $data)
	{
	$i++;
	
	?>
	<tr>
	<td><?php echo $i;?>
    <td><a href="#" class="editable_text" field_name="component" table_id="<?php echo $data->id; ?>"  data-type="text" data-pk="1"><?php echo $data->component; ?></a></td>
	
    <td><a href="#" class="editable_text" field_name="subscription_amount" table_id="<?php echo $data->id; ?>"  data-type="text" data-pk="1"><?php echo $data->subscription_amount; ?></a></td>
	</tr>
<?php }?>
	</table>	
  </div>
 </div>

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function() { 
	 //global settings
	$.fn.editable.defaults.mode = 'inline';
	$.fn.editable.defaults.inputclass = 'form-control input-small';
	
	$('.editable_text').editable();
	$(document).on('click', '.editable-submit', function(e)
	{
		var m_data = new FormData();
		var class_name=$(this).closest('td').find('a.editable_text').length;
		
		
			var field_name=$(this).closest('td').find('a').attr('field_name');
			var value=$(this).closest('form').find('input.form-control').val();  
			m_data.append(field_name,value);
			var table_id=$(this).closest('td').find('a').attr('table_id');
			m_data.append('id',table_id);
			
			$.ajax({
			url: "autoEdit",
			data: m_data,
			processData: false,
			contentType: false,
			type: 'POST',
			dataType:'json',
			success: function(data)   // A function to be called if request succeeds
			{
			}	
			})
		
		
	});
});
///////
$(document).ready(function() { 

	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
	$("#turnoverForm").validate({
		rules: {
			component: {
				required: true
			},
			subscription_amount: {
				required: true,
				number: true
			}
		},
		submitHandler: function () {
				
				$("#master_turn_over").attr('disabled','disabled');
				
				 form.submit();
			}
		
	});

});
</script>
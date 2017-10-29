<style>
.capitalize {
    text-transform: capitalize;
}
</style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Master Purpose</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?= $this->Form->create($MasterPurposes,['id'=>'purposeForm','class'=>'form-horizontal cmxform','method'=>'post']) ?>
	  <div class="box-body">
		<div class="form-group">
		  <label class="col-sm-2 control-label">Name</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('purpose_name',['label'=>false,'class'=>'form-control capitalize','type'=>'text','placeholder'=>'Purpose Name']);
			?>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">Tax</label>
		  <div class="col-sm-4">
			<select class="form-control" name="purpose_tax">
				<option value="">---Select---</option>
				<option value="1">Yes</option>
				<option value="0">No</option>
			</select>
		  </div>
		   
		</div>
		<div class="form-group">
		  <label class="col-sm-2 control-label">Email</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('email[0]',['label'=>false,'class'=>'form-control','type'=>'text','placeholder'=>'Email of Purpose Committee']);
			?>
		  </div>
		  <div class="col-sm-1">
		 
		  <?php
			echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-info form-control add_row','type'=>'button']);
			?>
		  </div>
		</div>
	  </div>
	  			
	  <!-- /.box-body -->
	  <div class="box-footer">
	   <div class="col-sm-6">
		<center>
		<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success','id'=>'master_purpose']); ?>
		</center>
		 </div>
	  </div>
	  <!-- /.box-footer -->
	<?php echo $this->Form->end(); ?>
	<div class="hidden" id="add_row">
		<div class="form-group">
		  <label class="col-sm-2 control-label">Email</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('email',['label'=>false,'class'=>'form-control','type'=>'text','placeholder'=>'Email of Purpose Committee']);
			?>
		  </div>
		  <div class="col-sm-1">
			<?php
			echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-info form-control add_row','type'=>'button']);
			?>
		  </div>
		  <div class="col-sm-1">
			<?php
			echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-trash']),['class'=>'btn btn-danger form-control remove_row','type'=>'button']);
			?>
		  </div>
		</div>
	</div>
  </div>
 </div>
 
  <!-- /.box -->

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
	<th>Name</th>
	<th>Tax</th>
	<th>Email</th>
	</tr>
	
	<?php 
	$i=0;
	foreach($fetch_master_purpose as $data)
	{
	$i++;
	$purpose_tax=$data->purpose_tax;
	if($purpose_tax==1)
	{
	$purpose_tax1='Yes';
	}
	else{
	$purpose_tax1='No';
	}
	
	?>
	<tr>
	<td><?php echo $i;?>
    <td><a href="#" class="editable_text" field_name="purpose_name" table_id="<?php echo $data->id; ?>"  data-type="text" data-pk="1"><?php echo $data->purpose_name; ?></a></td>
	
	<td><a href="#" class="editable_select" field_name="purpose_tax" table_id="<?php echo $data->id; ?>"  data-type="select" data-pk="1" data-value="<?php echo $purpose_tax; ?>"><?php echo $purpose_tax1; ?></a></td>
	
    <td><a href="#" class="editable_text" field_name="email" table_id="<?php echo $data->id; ?>"  data-type="text" data-pk="1"><?php echo $data->email; ?></a></td>
	
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
	$.fn.editable.defaults.inputclass = 'form-control input-small get-value';
	////////////////////////////
	var editable_select = [];
	$.each({
				1: "Yes",
				0: "No",
		
	}, function (k, v) {
		editable_select.push({
			value: k,
			text: v
		});
	});
	
	$('.editable_select').editable({
		inputclass: 'form-control input-small get-value',
		source: editable_select
	});
	//////////////////////////////
	$('.editable_text').editable();
	$(document).on('click', '.editable-submit', function(e)
	{
		var m_data = new FormData();
		var class_name=$(this).closest('td').find('a.editable_text').length;
		var field_name=$(this).closest('td').find('a').attr('field_name');
		var table_id=$(this).closest('td').find('a').attr('table_id');
		m_data.append('id',table_id);
		var data_type=$(this).closest('td').find('a').attr('data-type');
		if(data_type=="text")
		{
			var value=$(this).closest('form').find('.get-value').val();  
		}
		else if(data_type=="select")
		{
			var value=$(this).closest('form').find('.get-value option:selected').val();  
		}
		m_data.append(field_name,value);
		$.ajax({
		url: "auto_edit",
		data: m_data,
		processData: false,
		contentType: false,
		type: 'POST',
		dataType:'json',
		success: function(data)   // A function to be called if request succeeds
		{
		}	
		});
	});
	
});
$(document).ready(function() { 
	$( document ).on( 'click', '.add_row', function() {
		var new_line=$('#add_row').html();
		
		$(".box-body").append(new_line);
		var i=0;
		$("[name^=email]").each(function () {
			
			$(this).attr('name','email['+i+']');
			$(this).rules("add", {
				required: true,
				email: true
			});
			i++;
		});
	});
	$( document ).on( 'click', '.remove_row', function() {
		$(this).closest(".form-group").remove();
	});
	
	jQuery.validator.addMethod("[name^=email]", function(value, element) { 
		return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test( value );
	});
	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
	$("#purposeForm").validate({
		rules: {
			purpose_name: {
				required: true
			},
			
			purpose_tax: {
				required: true
			},
			'email[0]': {
				required: true,
				email: true
			}
			
			
		},
		submitHandler: function () {
				
				$("#master_purpose").attr('disabled','disabled');
				
				 form.submit();
			}
		
	});

});
</script>
           
             

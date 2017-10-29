<style>
.capitalize {
    text-transform: capitalize;
}
input[type="checkbox"]{
	margin-right: 2px;
}
</style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Master Membership Fee</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?= $this->Form->create($MasterMembershipFees,['id'=>'memberfeeForm','class'=>'form-horizontal cmxform','method'=>'post']) ?>
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
		  <label class="col-sm-2 control-label">Category</label>
		  <div class="col-sm-4">
			<?php
			$itemGroups['1']='Once in a life time';
			$itemGroups['2']='Annual';
			echo $this->Form->input("category_name", ['empty'=>'---Select Category---','options' => $itemGroups,'hiddenField'=>false,'label' => false,'class' => 'form-control ','data-placeholder' => 'Select Category','tabindex'=>'-1']); 
			unset($itemGroups);
			?>
		  </div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Member Type</label>
			<div class="col-sm-4">
			<?php
			foreach($member_type as $member_type_data)
			{
				$itemGroups[$member_type_data->id]=$member_type_data->member_type;
			}
			echo $this->Form->input('accessories_id', ['templates' => [ 
						'checkboxWrapper' => '<div class=" inline" style="margin-left: 5px !important;">{{label}}</div>',
					],'hiddenField' => false,'label' => false,'options' => $itemGroups,'multiple' => 'checkbox','name'=>'member_type_id']);
					unset($itemGroups);
			?>
			<label id="member_type_id[]-error" class="error" for="member_type_id[]"></label>
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
		<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success','id'=>'master_membership_fee']); ?>
		</center>
		 </div>
	  </div>
	  <!-- /.box-footer -->
	<?php echo $this->Form->end(); ?>
	
  </div>
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
	<th>Category</th>
	<th>Member Type</th>
	<th>Amount</th>
	</tr>
	
	<?php 
	$i=0;
	foreach($fetch_master_membership_fee as $data)
	{
		
	$i++;
	$id=$data->id;
	$component=$data->component;
	$category_name=$data->category_name;
	$member_type_id=$data->member_type_id;
	$subscription_amount=$data->subscription_amount;
	
	if($category_name==1)
	{
		$category_name1='Once in a life time';
	}
	else{
		$category_name1='Annual';
	}
		$member_type_name = $this->requestAction(['controller'=>'MasterMembershipFees', 'action'=>'get_member_type'],['pass'=>array($member_type_id)]);
		
	?>
	<tr>
	<td><?php echo $i;?>
    <td><a href="#" class="editable_text" field_name="component" table_id="<?php echo $id; ?>"  data-type="text" data-pk="1"><?php echo $component; ?></a></td>
	<td><a href="#" class="editable_select" field_name="category_name" table_id="<?php echo $id; ?>"  data-type="select" data-pk="1" data-value="<?php echo $category_name; ?>"><?php echo $category_name1; ?></a></td>
   <td><a href="#" class="editable_select1" field_name="member_type_id" table_id="<?php echo $id; ?>"  data-type="select" data-pk="1" data-value="<?php echo $member_type_id; ?>"><?php echo $member_type_name[0]->member_type; ?></a></td>
    <td><a href="#" class="editable_text" field_name="subscription_amount" table_id="<?php echo $id; ?>"  data-type="text" data-pk="1"><?php echo $subscription_amount; ?></a></td>
	</tr>
	
<?php }?>
	
	
	</table>	
  </div>
 </div>
  <!-- /.box -->
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function() {
	 //global settings
	$.fn.editable.defaults.mode = 'inline';
	$.fn.editable.defaults.inputclass = 'form-control input-small get-value';
	
	////////////////////////////
	var editable_select = [];
	$.each({
				1: "Once in a life time",
				2: "Annual",
		
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
	var editable_select1 = [];
	$.each({
				<?php 
		foreach($member_type as $data1) 
		{
		?>
		"<?php echo $data1->id; ?>": "<?php echo $data1->member_type; ?>",
		<?php }?>
		
	}, function (k, v) {
		editable_select1.push({
			value: k,
			text: v
		});
	});
	
	$('.editable_select1').editable({
		inputclass: 'form-control input-small get-value',
		source: editable_select1
	});
	
	
	
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
///////
$(document).ready(function() { 
	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
	$("#memberfeeForm").validate({
		rules: {
			component: {
				required: true
			},
			category_name: {
				required: true
			},
			subscription_amount: {
				required: true,
				number: true
			},
			
			'member_type_id[]': {
				required: true
			}
			
			
		},
		submitHandler: function () {
				
				$("#master_membership_fee").attr('disabled','disabled');
				
				 form.submit();
			},
		messages: {
			'member_type_id[]': {
					required: "Please select a member type"
				}
				
		}
	});

});
</script>
           
             

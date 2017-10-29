<style>
@media print {
  body * {
    visibility: hidden;
	
  }
  .print
  {
	  display:none;
  }
  #fee_data, #fee_data * {
    visibility: visible;
  }
  #fee_data {
	margin-left: auto;
	margin-right: auto;
	left: 0;
	right: 0;
  }
}
</style>
<div class="col-md-12">
   <div class="box box-primary">
	<div class="box-header with-border no-print">
	  <h3 class="box-title">Proforma Invoice</h3>
	</div>
	<div class="box-body">
	<?= $this->Form->create('',['class'=>'cmxform']) ?>
		<div class="col-sm-12 no-print">
			<div class="form-group col-sm-3">
			  <label class="">Company/Organisation</label>
			  <?php 
						$options=array();
						foreach($master_member as $master_member_data)
						{
							$options[$master_member_data->id] = $master_member_data->company_organisation;
							
						}
						
                        echo $this->Form->input('member_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<div class="form-group col-sm-3">
			  <label class="">Grade</label>
				 <?php 
						$options=array();
						foreach($fetch_master_grade as $grade_data){
							$options[$grade_data->id] = $grade_data->grade_name;
						}
                        echo $this->Form->input('grade', ['empty'=> '--Select--','data-placeholder'=>'Select a Grade','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<div class="form-group col-sm-3">
			  <label class="">Category</label>
				<?php  $options=array();
						foreach($fetch_master_category as $category_data){
							$options[$category_data->id] = $category_data->category_name;
						}
                        echo $this->Form->input('category', ['empty'=> '--Select--','data-placeholder'=>'Select a Category','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<div class="form-group col-sm-3">
			  <label class="">Member Type</label>
				<?php  $options=array();
						foreach($member_type as $member_type_data){
							$options[$member_type_data->id] = $member_type_data->member_type;
						}
                        echo $this->Form->input('member_type_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Member type','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
		</div>
		<div class="row" id="fee_data">
		</div>
	<?= $this->Form->end() ?>
  </div>
  
  <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function(){
	$('select[name="member_id"],select[name="grade"],select[name="category"],select[name="member_type_id"]').on( 'change',function() {  
		var name=$(this).attr('name');
		var value=$(this).val();
		
		$.ajax({
		url:"member_performa_invoice_ajax?"+name+"="+value,
		success:function(data) {
			 
		 $('#fee_data').html(data); 
		}
	  });
	});
	
	$(document).on('change','input[name="check_all"]',function() {
		if($(this).is(':checked'))
		{
			$('input[name="member_id[]"]').prop('checked',true);
		}
		else
		{
			$('input[name="member_id[]"]').prop('checked',false);
		}
		
	});
	
});
</script>
	<label>Member Type</label>
	<?php 
	$options=array();

	foreach($Companies['company_member_types'] as $company_member_type){

		$options[$company_member_type['id']] = $company_member_type['master_member_type']['member_type'];
	}
	echo $this->Form->input('company_member_type_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Member Type','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;','multiple'=>true]); ?>

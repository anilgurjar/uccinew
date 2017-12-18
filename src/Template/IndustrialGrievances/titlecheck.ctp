<div class="col-md-4">
	<div class="form-group">
		<label class=" control-label">Grievance Title</label>
			<?php
			$options=[];
			$options1=[];
			foreach($grievance_titles as $grievance_title){
				$title=$grievance_title['title'];
				$id=$grievance_title['id'];
				$options[$id]=$title;
				   
			}
			
			echo $this->Form->input('old_grievance_id', ['empty'=> '--Select--','data-placeholder'=>'Select Title ','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']);
			 ?>
	</div>
</div>
					
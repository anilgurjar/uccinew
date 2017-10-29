<div class="col-md-4">
	<div class="form-group">
		<label class=" control-label">Issue Related Problem</label>
		
			<?php
			
			
			echo $this->Form->input('grievance_issue_related_id', ['empty'=> '--Select--','data-placeholder'=>'Select Grievance ','label' => false,'class'=>'form-control select2','options'=>$GrievanceIssueRelated,'style'=>'width:100%;']); ?>
		<label id="grievance-issue-related-id-error" class="error" for="grievance-issue-related-id"></label>
	</div>
</div>
						
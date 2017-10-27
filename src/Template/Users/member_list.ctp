<?php
$master_member = $master_member->toArray();

?>

<style>
@media print {
  body * {
    visibility: hidden;
  }
  .print{
	  display:none;
  }
  #fee_data, #fee_data * {
    visibility: visible;
  }
  #fee_data{
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
			<h3 class="box-title">Member List</h3>
		</div>
		<div class="box-body">
		<form method="get">
		    <div class="col-sm-12 no-print">
				<div class="form-group col-sm-3">
					<label class="">Company/Organisation</label>
						<?php   $options=array();
						foreach($master_members as $master_member_data){
							$options[$master_member_data->id] = $master_member_data->company_organisation;
						}
						
                        echo $this->Form->input('member_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
				</div>
		    
			<div class="form-group col-sm-3">
				<label class="">Grade</label>
					<?php $options=array();
					foreach($fetch_master_grade as $grade_data){
					$options[$grade_data->id] = $grade_data['grade_name'];
					}
					echo $this->Form->input('grade', ['empty'=> '--Select--','data-placeholder'=>'Select a Grade','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<div class="form-group col-sm-3">
			  <label class="">Category</label>
				<?php $options=array();
					foreach($fetch_master_category as $category_data){
					$options[$category_data->id] = $category_data['category_name'];
					}
					echo $this->Form->input('category', ['empty'=> '--Select--','data-placeholder'=>'Select a Category','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<div class="form-group col-sm-3">
			  <label class="">Member Type</label>
				<?php $options=array();
					foreach($member_type as $member_type_data){
					$options[$member_type_data->id] = $member_type_data['member_type'];
					}
					echo $this->Form->input('member_type_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Member type','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
		</div>
		<div class="no-print">
		<center>
			<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-file-text'])  .  ' Report' 
			,['class'=>'btn btn-info','type'=>'submit','style'=>'margin-right:5px;','name'=>'member_report',
			'value'=>'member_report']); ?>
		</center>
		</div>
		</form>
		<div class="col-sm-12 no-print">
	<div class="table-responsive no-padding">
	
		<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
			<thead>
				 <tr>
					<th>S.No.</th>
					<th>Company/Organisation</th>
					<!--<th>Turn Over</th>
					<th>Date of Joining</th>-->
					<th>Member Name</th>
					<th>E-mail</th>
					<th>Mobile No.</th>
					<th>View More</th>
					</tr>
			</thead>
			<tbody>
			<?php
			//pr($master_member); exit;
			$sr_no=0; foreach($master_member as $data) {

				foreach($data->users as $user){
			?>
 				<tr>
					<td><?php echo ++$sr_no; ?></td>
					<td><?php echo $data->company_organisation; ?></td>
					<!--<td><?php echo $data->master_turn_over->component; ?></td>
					<td><?php echo date('d-m-Y',strtotime($data->year_of_joining)); ?></td>-->
					<td><?php echo $user->member_name; ?></td>
					<td><?php echo $user->email; ?></td>
					<td><?php echo $user->mobile_no; ?></td>
					<td><center>
					<?php  echo $this->Html->link('<i class="fa fa-book"></i> View', 
					array('controller' => 'Users', 'action' => 'profile-member-view',$data->id),
					['class' => 'btn btn-info btn-sm','escape'=>false]); ?>
					</td>
					
				</tr>
			<?php } } ?>
			</tbody>
		</table>
		</div>
	</div>
	<?php if(!empty($master_member)) { ?>
	<div  class="col-sm-12 no print">
		<div class="pull-left">
			<div style="margin-top: 20px;white-space: nowrap;font-weight: 600;">
			Showing &nbsp; <?= $this->Paginator->counter(); ?></div>
		</div>
		<div class="pull-right" style="float:right;">
			<div class="paginator" style="float:right;">
				<ul class="pagination">
					<?= $this->Paginator->prev(__('Previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('Next')) ?>
				</ul>
			</div>
		</div>
	</div>
	<?php } ?>	
	    </div>
	</div>
</div>
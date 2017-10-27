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
			<h3 class="box-title">Member View</h3>
		</div>
		<div class="box-body">
		    <div class="col-sm-12 no-print">
				<div class="form-group col-sm-3">
					<label class="">Company/Organisation</label>
						<?php $options=array();
						foreach($master_member as $master_member_data){
							$options[$master_member_data->member_id] = $master_member_data['company_organisation'];
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
		
		<div class="col-sm-12 no-print">
	<div class="table-responsive no-padding">
	<?php echo $this->Form->create($master_user, ['type' => 'post','url' => ['action' => 'member_view_detail']]); ?>
		<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
			<thead>
				 <tr>
					<th>S.No.</th>
					<th>Company/Organisation</th>
					<th>Date of Joining</th>
					<th>Member Type</th>
					<th>E-mail</th>
					<th>Mobile No.</th>
					<th>View More</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sr_no=0;
			foreach($master_member as $data)
			{
				echo '<tr>
					<td>'.++$sr_no.'</td>
					<td>'.$data->company_organisation.'</td>
					<td>'.date('d-m-Y',strtotime($data->year_of_joining)).'</td>
					<td>'.$data->master_member_type->member_type.'</td>
					<td>'.$data->email.'</td>
					<td>'.$data->mobile_no.'</td>
					<td><center><button type="submit" name="member_view" value="'.$data->member_id.'" class="btn btn-info btn-sm"><i class="fa fa-book"></i> View</button></td>
				</tr>';
			}
		?>
			</tbody>
		</table>
	<?php echo $this->Form->end(); ?>
		</div>
	</div>
		
		
		
		
		
		
		
		
	    </div>
	</div>
</div>
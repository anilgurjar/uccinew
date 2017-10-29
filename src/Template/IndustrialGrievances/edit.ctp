<style>
legend {
    display: block;
    padding: 0;
    margin-bottom: 0px !important;
    font-size: 17px;
    line-height: inherit;
    color: #333;
    border: 0;
    border-bottom: 0px  !important;
}
fieldset{
	border: 1px solid silver !important;
	padding: .35em .625em .75em !important;
}
</style>
<div class="col-md-12">
	<?php echo $this->Form->create($industrialGrievance, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Industrial Grievance</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
						
				<div class="col-md-12 pad" style="padding-left: 0px;">
					<div class="col-md-8">
						<div class="form-group">
						  <label class="col-sm-4 control-label">Name of Member Organisation :</label>

						  <div class="col-sm-6">
							<?= $company_organisation ?>
						  </div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
						  <label class="col-sm-4 control-label">Company Address :</label>

						  <div class="col-sm-6">
							<?= $address.' '.$city.' - '.$pincode ?>
						  </div>
						</div>
					</div>
					
				</div>
				<div class="col-md-12 pad" style="padding-left: 0px;">
					<div class="col-md-8">
						<div class="form-group">
							<label class="col-md-12 control-label">Name of concerned Person(s) with his Contact details :</label>
							<div class="col-md-6">
							<?php echo $this->Form->input('name_of_person', ['label' => false,'placeholder'=>'Person Name','class'=>'form-control']); ?>
							</div>
							<div class="col-md-6">
							<?php echo $this->Form->input('contact_details', ['label' => false,'placeholder'=>'Contact Details','class'=>'form-control']); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 ">
					<div class="col-md-8">
						<div class="form-group">
							<label class="control-label">Industrial Grievance relating to the Department/s :</label>
							<?php
							$industrial_department_id=explode(',',$industrialGrievance->industrial_department_id);
							$options=array();
							foreach($IndustrialDepartments as $IndustrialDepartment){ 
								$options[$IndustrialDepartment->id] = $IndustrialDepartment->department_name;
							}
							echo $this->Form->input('industrial_department_id', ['empty'=> '--Select--','data-placeholder'=>'Select Department','label' => false,'class'=>'form-control select2','options'=>$options,'value'=>$industrial_department_id,'style'=>'width:100%;','multiple'=>'multiple']); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Issue/Problem/Grievance pending since :</label>
							<?php echo $this->Form->input('grievance_pending', ['label' => false,'placeholder'=>'Pending since','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','data-date-end-date'=>'+0d', 'type'=>'text','value'=>date('d-m-Y',strtotime($industrialGrievance->grievance_pending))]); ?>
						</div>
					</div>
				</div>
				<div class="col-md-12 ">
				<fieldset>
					<legend>Nature of Issue/Problem/Grievance :</legend>
				<div class="col-md-12"  style="padding-left: 0px;">
					<div class="col-md-4">
						<div class="form-group">
							<label class=" control-label">Repairing & Maintenace :</label>
								<?php
								$options=array();
								$repair_maintenance=explode(',',$industrialGrievance->repair_maintenance);
								$options['Roads'] = 'Roads';
								$options['Draingage'] = 'Draingage';
								$options['Street Light'] = 'Street Light';
								$options['Cleanliness'] = 'Cleanliness';
								$options['Others'] = 'Others';
								
								echo $this->Form->input('repair_maintenance', ['empty'=> '--Select--','data-placeholder'=>'Select...','label' => false,'class'=>'form-control select2','options'=>$options,'value'=>$repair_maintenance,'style'=>'width:100%;','multiple'=>'multiple']); ?>
							
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">New construction/Work :</label>
							<?php
								$options=array();
								$construction=explode(',',$industrialGrievance->construction);
								$options['New construction'] = 'New construction';
								$options['Work'] = 'Work';
								
								echo $this->Form->input('construction', ['empty'=> '--Select--','data-placeholder'=>'Select...','label' => false,'class'=>'form-control select2','options'=>$options,'value'=>$construction,'style'=>'width:100%;','multiple'=>'multiple']); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Clearance of Pending Matter :</label>
							<?php
								$options=array();
								$clearance_matter=explode(',',$industrialGrievance->clearance_matter);
								$options['Application'] = 'Application';
								$options['File'] = 'File';
								$options['Licence'] = 'Licence';
								$options['Permission'] = 'Permission';
								
								echo $this->Form->input('clearance_matter', ['empty'=> '--Select--','data-placeholder'=>'Select...','label' => false,'class'=>'form-control select2','options'=>$options,'value'=>$clearance_matter,'style'=>'width:100%;','multiple'=>'multiple']); ?>
						</div>
					</div>
				</div>
				<div class="col-md-12"  style="padding-left: 0px;">
					<div class="col-md-4">
						<div class="form-group">
							
							<label>
								<?php  echo $this->Form->checkbox('payment_issue', ['hiddenField' => false,'value'=>'Payment Related Issues']);   ?>
								Payment Related Issues</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>
								<?php  echo $this->Form->checkbox('refund_issue', ['hiddenField' => false,'value'=>'Refund Related Issues']);   ?>
								Refund Related Issues</label>
						</div>
					</div>
				</div>
				
					<div class="col-md-12 " style="padding-left: 0px;">
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Issues Regarding :</label>
								
									<?php
									$options=array();
									$issue_regarding=explode(',',$industrialGrievance->issue_regarding);
									$options['Mining lease'] = 'Mining lease';
									$options['Renewals'] = 'Renewals';
									$options['Leas Concession'] = 'Leas Concession';
									$options['Royalty'] = 'Royalty';
									$options['Dead Rent'] = 'Dead Rent';
									$options['Others'] = 'Others';
									
									echo $this->Form->input('issue_regarding', ['empty'=> '--Select--','data-placeholder'=>'Select...','label' => false,'class'=>'form-control select2','options'=>$options,'value'=>$issue_regarding,'style'=>'width:100%;','multiple'=>'multiple']); ?>
								
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class=" control-label">Any other issue/problem which is not coverd above :</label>
								
									<?php echo $this->Form->input('other_issue', ['label' => false,'placeholder'=>'Other Issue/Problem','class'=>'form-control']); ?>
								
							</div>
						</div>
					</div>
					
					
					</fieldset>
					
				</div>
				<div class="col-md-12 pad" >
					<div class="col-md-12" >
						<div class="form-group">
							<label class=" control-label">Specified remedial action required to address the issue/problem :</label>
							
							<?php echo $this->Form->input('address_issue', ['label' => false,'placeholder'=>'Issue/Problem','class'=>'form-control']); ?>
							
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class=" control-label">Any other information/suggestion(s). which you may deem to be provided :</label>
							
								<?php echo $this->Form->input('other_information', ['label' => false,'placeholder'=>'Information/Suggestion','class'=>'form-control']); ?>
							
						</div>
					</div>
				</div>
				<div class="col-md-12 ">
				<?php
				$directory=WWW_ROOT . 'img/grievance/'.$industrialGrievance->id;
				$files = scandir($directory);
				$num_files = count($files)-2;;
				?>
				<table  style="line-height:2.5">
				<?php
				$no_file=2;
				for($i=$num_files; $i>0; $i--)
				{
					?>
					<tr>
					<td>
					<?= $files[$no_file] ?>
					</td>
					<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-trash']) . __(' Delete'), ['class'=>'btn btn-block btn-danger btn-sm delete_file','grievance_id'=>$industrialGrievance->id,'file_name'=>$files[$no_file],'type'=>'button']) ?></td>
					</tr>
					<?php
					$no_file++;
				}
				?>
				</table>
				<table id="file_table" style="line-height:2.5">
				<tr>
				<td><?= $this->Form->file('file[]',['multiple'=>'multiple']); ?></td>
				<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?></td>
				<td></td>
				</tr>
				</table>
			</div>
			</div>
		</div>
		<div class="box-footer">
				<center>
				
				<?= $this->Form->button(__('Submit') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-success','type'=>'Submit']);
					   ?>
				</center>
			</div>
	</div>
    <?= $this->Form->end() ?>
</div>
<table id="copy_row" style="display:none;">	
			<tbody>
			<tr>
				<td><?= $this->Form->file('file[]',['multiple'=>'multiple']); ?></td>
				<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?>
				</td>
				<td>
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-trash']) . __(' Delete'), ['class'=>'btn btn-block btn-danger btn-sm delete_row','type'=>'button']) ?></td>
				</tr>
				</tbody>
			</table>	
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<script>

$(document).ready(function() { 
	
	$(document).on('click','button.add_more',function() {
		var row=$('#copy_row tbody').html();
		$('#file_table tbody').append(row);
	});
	
	$(document).on('click','button.delete_row',function() {
		$(this).closest('tr').remove();
	});
	
	$(document).on('click','button.delete_file',function() {
		var tr=$(this).closest('tr');
		var grievance_id=$(this).attr('grievance_id');
		var file_name=$(this).attr('file_name'); 
		var url="<?php echo $this->Url->build(['controller'=>'IndustrialGrievances','action'=>'deleteGrievanceFile']); ?>";
		
		url=url+'/'+grievance_id+'/'+file_name;
		
		$.ajax({
			url:url,
			type: 'GET',
			success:function(data) {
				
			 tr.remove();
			}
		});
	});
	
});
</script>
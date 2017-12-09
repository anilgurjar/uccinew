<style>
@media print { 
.print_screen { display: none !important; } 
}
</style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
		<div class="print_screen" style="float:right;"> 
			<div style="float:left;margin-right:6px"><button class="btn btn-block btn-primary " type="button"  style="margin-bottom: 2px;" onclick="window.print();"><b>Print </b></button>  </div>
			
		</div>
		<h3 class="box-title">Grievance Published Report</h3>
	</div>
	<div class="box-header with-border no-print">
		<div class="col-md-2 pad">
			<?php
			echo $this->Form->input('industrial_department_id', ['empty'=> '--Select Departmant--','label' => false,'class'=>'form-control select2','name'=>'department','options'=>$IndustrialDepartments,'style'=>'width:100%;']); ?>
		</div>
		<div class="col-md-2 pad">
			<?php
			echo $this->Form->input('from', ['placeholder'=>'From','label' => false,'class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','name'=>'from','style'=>'width:100%;']); ?>
		</div>
		<div class="col-md-2 pad">
			<?php
			echo $this->Form->input('to', ['placeholder'=>'To','label' => false,'class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','name'=>'to','style'=>'width:100%;']); ?>
		</div>
		<div class="col-md-2 pad">
			<?php
			echo $this->Form->input('title', ['placeholder'=>'Title','label' => false,'class'=>'form-control title','type'=>'text','name'=>'title','style'=>'width:100%;']); ?>
		</div>
		
		<div class="col-md-1 pad">
			<?= $this->Form->button(__('Go') ,['class'=>'btn btn-primary btn-sm go','type'=>'button','name'=>'go','style'=>'margin-bottom: 2px;']) ?>
		</div>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
	<div class="box-body">
	 <?= $this->Form->create() ?>
	  <div class="col-sm-12 " >
				<div class="table-responsive no-padding" id="report">
					<?php  if (!empty($IndustrialGrievances)): ?>
					<table cellpadding="0" cellspacing="0" class="table table-bordered" >
						<thead>
							<tr style="background-color:#3C8DBC; color:#fff">
								<th scope="col"><?= __('Sr no.') ?></th>
								<th scope="col"><?= __('Departmant') ?></th> 
								<th scope="col"><?= __('Grievance Description') ?></th>
								<th scope="col"><?= __('Complaint') ?></th>
								<th scope="col"><?= __('Action Taken By UCCI') ?></th>
								<th scope="col"><?= __('Created on') ?></th>
								<th scope="col"><?= __('Pending on') ?></th>
								<th scope="col" width="80" class="print_screen"><?= __('Action') ?></th>
								
							</tr>
						</thead>
						<tbody>
						<?php $i=0;  foreach ($IndustrialGrievances as $departments):  ?>
						
							<?php
							$k=1; 
							foreach($departments->industrial_grievances as $industrial_grievance)
							{ $class="";
								$complete_status=$industrial_grievance->complete_status;
								?>
								<tr <?php if($complete_status=="hold"){ $class="font_color"; ?> style="background-color:rgba(255, 0, 0, 0.7); " <?php } ?>>
								<?php
								if($k==1)
								{  $i++; 
									?>
									<td rowspan="<?php echo sizeof($departments->industrial_grievances); ?>" class="<?php echo $class; ?> font_cl"><?= h($i) ?></td>
									<td rowspan="<?php echo sizeof($departments->industrial_grievances); ?>" class="<?php echo $class; ?> font_cl"><?= h($departments->company_organisation) ?></td>
									<?php
								}
								?>
								<td class="<?php echo $class; ?> font_cl"><?= h($industrial_grievance->description) ?></td>
								<td class="<?php echo $class; ?> font_cl"><?= h($industrial_grievance->user->company->company_organisation) ?></td> 
								
								<?php  if (!empty($industrial_grievance->industrial_grievance_follows)){  ?>
								<?php
								foreach($industrial_grievance->industrial_grievance_follows as $industrial_grievance_follow)
								{ ?>
								<!--<td class="<?php echo $class; ?> font_cl department"><?= h($industrial_grievance_follow->department_content) ?></td>-->
								<td class="<?php echo $class; ?> font_cl ucci"><?= h($industrial_grievance_follow->ucci_content) ?></td>
								
								<?php
								goto a;
								}
								a:
								}
								else{ 
									echo '<td class="ucci"></td>';
								}
								?>
								<td class="<?php echo $class; ?> font_cl"><?= h(date('d-m-Y', strtotime($industrial_grievance->created_on))) ?></td>
								<td class="<?php echo $class; ?> font_cl"><?php echo $industrial_grievance->grievance_age .' '. $industrial_grievance->grievance_period?></td>
								
								<td class="actions  print_screen">
									<?php
									//echo $this->Html->link(' <i class="fa fa-book"></i>', ['action' => 'industrial_grievance_published_view', $industrial_grievance->id],['escape' => false]) ;
									?>
									<?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formaction'=>'industrial_grievance_published_view','formtarget'=>'_blank','value'=>$industrial_grievance->id,'type'=>'Submit','name'=>'view']);   ?>
								</td>
								</tr>
								<?php
								$k++;
							}
							?>
						<?php endforeach; ?>
						</tbody>
					</table>
					<?php endif; ?>
				</div>
			</div>
		 <?php echo $this->Form->end(); ?>
	 
    </div>
  </div>
</div>

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script('/assets/plugins/jquery/jsapi.js'); ?>
<script>
$(document).ready(function() { 

	$('.go').on( 'click',function() { 	

	$("#loading").html('<div align="center"><?php echo $this->Html->Image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		 var from=$('input[name="from"]').val();
		var to=$('input[name="to"]').val();
		var id=$('select[name="department"]').val();
		var title=$('input[name="title"]').val();
		
		if(from==""){
			from=0;
			
		}
		if(to==""){
			to=0;
		}
		if(id==""){
			
			id=0;
		}
		
		
		var url="<?php echo $this->Url->build(['controller'=>'IndustrialGrievances','action'=>'industrial_grievance_ajax_published']); ?>";
		url=url+'/'+id+'/'+from+'/'+to+'/'+title;
		
		$.ajax({
			url:url,
			success:function(data) {
				
				$("#loading").html('');
				$('#report').html(data); 
				
	  
			}
		});
		 
		
	});
	
	
});
</script>

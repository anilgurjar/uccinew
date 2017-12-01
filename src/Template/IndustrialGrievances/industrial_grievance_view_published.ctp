
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	<center>
	  <h3 class="box-title"><strong>Industrial Grievance</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
	<div class="box-body">
	 <?= $this->Form->create() ?>
	  <div class="col-sm-12 no-print">
				<div class="table-responsive no-padding">
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
						<th scope="col" width="80"><?= __('Action') ?></th>
						
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
						
						<td class="actions">
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


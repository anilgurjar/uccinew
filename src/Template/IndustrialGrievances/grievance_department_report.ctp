<div class="col-md-12">
	<div class="box box-primary">
		<div class="related">
			<div class="col-md-12">
			<h4 style="width:30%"><?= __('Grievance Report') ?></h4>
			<?php  
					echo $this->Html->link('<i class="fa fa-download"></i> Export',
						['controller' => 'IndustrialGrievances', 'action' => 'grievanceDepartmentExport'],
						['class' => 'btn btn-primary btn-sm btn-flat pull-right',
							'escape' => false]
					);
					?>
			 </div>
			<?php if (!empty($IndustrialGrievances)): ?>
			<table cellpadding="0" cellspacing="0" class="table table-bordered">
				<tr style="background-color:#3C8DBC; color:#fff">
					<th scope="col"><?= __('Sr. No.') ?></th>
					<th scope="col"><?= __('Departmant Name') ?></th>
					<th scope="col"><?= __('Complainant Description') ?></th>
					<th scope="col"><?= __('Complainant') ?></th>
					<th scope="col"><?= __('Action Taken By Department') ?></th>
					<th scope="col"><?= __('Action Taken By UCCI') ?></th>
				</tr>
				<?php $i=0; foreach ($IndustrialGrievances as $departments): $i++; ?>
				
					<?php
					$k=1;
					foreach($departments->industrial_grievances as $industrial_grievance)
					{
						
						?>
						<tr>
						<?php
						if($k==1)
						{
							?>
							<td rowspan="<?php echo sizeof($departments->industrial_grievances); ?>"><?= h($i) ?></td>
							<td rowspan="<?php echo sizeof($departments->industrial_grievances); ?>"><?= h($departments->department_name) ?></td>
							<?php
						}
						?>
						<td><?= h($industrial_grievance->address_issue) ?></td>
						<td><?= h($industrial_grievance->user->company_organisation) ?></td>
						<?php
						foreach($industrial_grievance->industrial_grievance_follows as $industrial_grievance_follow)
						{ ?>
						<td><?= h($industrial_grievance_follow->department_content) ?></td>
						<td><?= h($industrial_grievance_follow->ucci_content) ?></td>
						
						<?php
						goto a;
						}
						a:
						?>
						
						</tr>
						<?php
						$k++;
					}
					?>
					
					
				
				<?php endforeach; ?>
			</table>
			<?php endif; ?>
		</div>
	</div>
</div>
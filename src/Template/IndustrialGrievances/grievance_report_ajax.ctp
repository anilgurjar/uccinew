
			<?php if (!empty($IndustrialGrievances)): ?>
			<table cellpadding="0" cellspacing="0" class="table table-bordered">
				<tr style="background-color:#3C8DBC; color:#fff">
					<th scope="col"><?= __('Sr. No.') ?></th>
					<th scope="col"><?= __('Complain Description') ?></th>
					<th scope="col"><?= __('Complainant') ?></th>
					<th scope="col"><?= __('Action Taken By Department') ?></th>
					<th scope="col"><?= __('Action Taken By UCCI') ?></th>
					
				</tr>
				<?php $i=0; foreach ($IndustrialGrievances as $industrial_grievance): $i++; ?>
				
						<tr>
						
							<td><?= h($i) ?></td>
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
						 endforeach; ?>
			</table>
			<?php endif; ?>
<div class="col-md-12">
<div class="box box-primary">
	<div class="col-md-12">
		<h4> Profile Updation approval </h4>
	</div>

<table cellpadding="0" cellspacing="0" class="table table-bordered">
            <tr style="background-color:#3C8DBC; color:#fff">
                <th scope="col"><?= __('Sr no.') ?></th>
				<th scope="col"><?= __('Member Name') ?></th>
				<th scope="col"><?= __('Company') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php $i=0; foreach($UserProfiles_new as $UserProfiles):  $i++;
						$alternate=$UserProfiles->member_name;
						$member_name=$UserProfiles->member_name;
						$email=$UserProfiles->email;
						$company_organisation=$UserProfiles->company_organisation;
						$status=$UserProfiles->status;
					
					
			?>
            <tr>
				<td><?= h($i) ?></td>
				<td><?= h($member_name) ?></td>
				<td><?= h($company_organisation) ?></td>
				<td><?= h($email) ?></td>
				<td> <?php if($status==0){ echo"<strong style='color:#f39c12;'>Pending </strong>"; } ?> </td>
            
               <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'profile_update_view', $UserProfiles->company_id]) ?>
                  
                </td>
            </tr>
            <?php endforeach; ?>
 </table>

   
</div>
</div>
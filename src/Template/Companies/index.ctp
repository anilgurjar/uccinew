<div class="col-md-12">
  <div class="box box-primary">
    <h3><?= __('List of Member ') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
              
                <th scope="col"><?= $this->Paginator->sort('company_organisation') ?></th>
              
                <th scope="col"><?= $this->Paginator->sort('Member name') ?></th>
				 <th scope="col"><?= $this->Paginator->sort('Nominee Type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Image') ?></th>
             
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0;  foreach ($companies as $company):
			foreach ($company->users as $user):
			$i++; ?>
            <tr>
                <td><?= $i ?></td>
                
                <td><?= h($company->company_organisation) ?></td>
               
                <td><?= h($user->member_name) ?></td>  
				<td><?= h($user->member_nominee_type) ?></td> 
				<td><?= $this->Html->image('/'.$user->image.'',['fullBase'=>true,'width'=>'90px','height'=>'90px','style'=>'']) ?></td>
              
            </tr>
            <?php endforeach; ?>
			<?php endforeach; ?>
        </tbody>
    </table>
   
</div>   
</div>

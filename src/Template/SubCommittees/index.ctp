<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Sub Committee Member Session </h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
               <tr>
                <th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Session') ?></th>
               
                <th scope="col" class="actions"><?= __('Actions') ?></th> 
            </tr>
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach($subCommittees as $subCommittee): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
                <td><?= h($subCommittee->financial_year) ?></td>
                <td>
				<?= $this->Html->link(__('View'), ['action' => 'view', $subCommittee->id],['class'=>'btn btn-success btn-sm']) ?></td>
              
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   </div>
 </div>





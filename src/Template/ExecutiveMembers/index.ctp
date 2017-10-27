
<!--<div class="executiveMembers index large-9 medium-8 columns content">
    <h3><?= __('Executive Members') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('master_financial_year_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('executive_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('designation_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; foreach($executiveMembers as $executiveMember): $i++; ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $executiveMember->financial_year ?></td>
                <td><?= $executiveMember->has('master_financial_year') ? $this->Html->link($executiveMember->master_financial_year->id, ['controller' => 'MasterFinancialYears', 'action' => 'view', $executiveMember->master_financial_year->id]) : '' ?></td>
                <td><?= $executiveMember->has('executive_category') ? $this->Html->link($executiveMember->executive_category->name, ['controller' => 'ExecutiveCategories', 'action' => 'view', $executiveMember->executive_category->id]) : '' ?></td>
                <td><?= $executiveMember->has('designation') ? $this->Html->link($executiveMember->designation->name, ['controller' => 'Designations', 'action' => 'view', $executiveMember->designation->id]) : '' ?></td>
                <td><?= h($executiveMember->status) ?></td>
                <td><?= $this->Number->format($executiveMember->created_by) ?></td>
                <td><?= h($executiveMember->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $executiveMember->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $executiveMember->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $executiveMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $executiveMember->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>-->

<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Executive Committee sessions </h3>
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
            <?php $i=0; foreach($executiveMembers as $executiveMember): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
                <td><?= h($executiveMember->financial_year) ?></td>
                <td>
				<?= $this->Html->link(__('View'), ['action' => 'view', $executiveMember->id],['class'=>'btn btn-success btn-sm']) ?></td>
              
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
  </div>
 </div>



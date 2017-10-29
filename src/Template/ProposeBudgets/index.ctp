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
			<h3 class="box-title">Propose Budgets</h3>
		</div>
		<div class="box-body">
		 
		<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('master_purpose_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('financial_year_from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('financial_year_to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expenditure_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receipt_amount') ?></th>
                 <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proposeBudgets as $proposeBudget): ?>
            <tr> 
                <td><?= $this->Number->format($proposeBudget->id) ?></td>
                <td><?= $proposeBudget->master_purpose->purpose_name ? $this->Html->link($proposeBudget->master_purpose->purpose_name, ['controller' => 'MasterPurposes', 'action' => 'master-purpose']) : '' ?></td>
                <td><?= h($proposeBudget->financial_year_from) ?></td>
                <td><?= h($proposeBudget->financial_year_to) ?></td>
                <td><?= $this->Number->format($proposeBudget->expenditure_amount) ?></td>
                <td><?= $this->Number->format($proposeBudget->receipt_amount) ?></td>
                <td class="actions">
                    <!--<?= $this->Html->link(__('Edit'), ['action' => 'edit', $proposeBudget->id]) ?>--->
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $proposeBudget->id], ['confirm' => __('Are you sure you want to delete # {0}?', $proposeBudget->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	
		</div>
	</div>
	<?php if(!empty($master_member)) { ?>
	<div  class="col-sm-12 no print">
		<div class="pull-left">
			<div style="margin-top: 20px;white-space: nowrap;font-weight: 600;">
			Showing &nbsp; <?= $this->Paginator->counter(); ?></div>
		</div>
		<div class="pull-right" style="float:right;">
			<div class="paginator" style="float:right;">
				<ul class="pagination">
					<?= $this->Paginator->prev(__('Previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('Next')) ?>
				</ul>
			</div>
		</div>
	</div>
	<?php } ?>	
	    </div>
	</div>
</div>
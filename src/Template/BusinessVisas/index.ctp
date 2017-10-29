<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Business Visas </h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Company/Organisation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_manufacture') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visitor_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visit_country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visit_month') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visit_reason') ?></th>
                <th scope="col"><?= $this->Paginator->sort('passport_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('issue_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('issue_place') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expiry_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach ($businessVisas as $businessVisa): ?>
            <tr>
                <td><?= $this->Number->format($businessVisa->id) ?></td>
                <td><?= h($businessVisa->company->company_organisation) ?></td>
                <td><?= h($businessVisa->company_manufacture) ?></td>
                <td><?= h($businessVisa->visitor_name) ?></td>
                <td><?= h($businessVisa->visit_country) ?></td>
                <td><?= h($businessVisa->visit_month) ?></td>
                <td><?= h($businessVisa->visit_reason) ?></td>
                <td><?= h($businessVisa->passport_no) ?></td>
                <td><?= h(date('d-m-Y',strtotime($businessVisa->issue_date))) ?></td>
                <td><?= h($businessVisa->issue_place) ?></td>
                <td><?= h(date('d-m-Y',strtotime($businessVisa->expiry_date))) ?></td>
                <td class="actions">
				 <?= $this->Html->link(__('View'), ['action' => 'view', $businessVisa->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $businessVisa->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $businessVisa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $businessVisa->id)]) ?>
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
</div>
</div>

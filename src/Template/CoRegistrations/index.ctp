<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Co Registration'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Master Financial Years'), ['controller' => 'MasterFinancialYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Master Financial Year'), ['controller' => 'MasterFinancialYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Co Tax Amounts'), ['controller' => 'CoTaxAmounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Co Tax Amount'), ['controller' => 'CoTaxAmounts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coRegistrations index large-9 medium-8 columns content">
    <h3><?= __('Co Registrations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('master_financial_year_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tax_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coRegistrations as $coRegistration): ?>
            <tr>
                <td><?= $this->Number->format($coRegistration->id) ?></td>
                <td><?= $coRegistration->has('company') ? $this->Html->link($coRegistration->company->id, ['controller' => 'Companies', 'action' => 'view', $coRegistration->company->id]) : '' ?></td>
                <td><?= $coRegistration->has('master_financial_year') ? $this->Html->link($coRegistration->master_financial_year->financial_year, ['controller' => 'MasterFinancialYears', 'action' => 'view', $coRegistration->master_financial_year->id]) : '' ?></td>
                <td><?= $this->Number->format($coRegistration->amount) ?></td>
                <td><?= $this->Number->format($coRegistration->tax_amount) ?></td>
                <td><?= $this->Number->format($coRegistration->total_amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $coRegistration->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $coRegistration->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $coRegistration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coRegistration->id)]) ?>
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

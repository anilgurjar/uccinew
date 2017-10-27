<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Master Financial Year'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="masterFinancialYears index large-9 medium-8 columns content">
    <h3><?= __('Master Financial Years') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('financial_year_from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('financial_year_to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($masterFinancialYears as $masterFinancialYear): ?>
            <tr>
                <td><?= $this->Number->format($masterFinancialYear->id) ?></td>
                <td><?= h($masterFinancialYear->financial_year_from) ?></td>
                <td><?= $this->Number->format($masterFinancialYear->financial_year_to) ?></td>
                <td><?= $this->Number->format($masterFinancialYear->flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $masterFinancialYear->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $masterFinancialYear->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $masterFinancialYear->id], ['confirm' => __('Are you sure you want to delete # {0}?', $masterFinancialYear->id)]) ?>
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

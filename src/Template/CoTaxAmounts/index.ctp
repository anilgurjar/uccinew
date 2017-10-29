<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Co Tax Amount'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Co Registrations'), ['controller' => 'CoRegistrations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Co Registration'), ['controller' => 'CoRegistrations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coTaxAmounts index large-9 medium-8 columns content">
    <h3><?= __('Co Tax Amounts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('co_registration_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tax_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tax_percentage') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coTaxAmounts as $coTaxAmount): ?>
            <tr>
                <td><?= $this->Number->format($coTaxAmount->id) ?></td>
                <td><?= $coTaxAmount->has('co_registration') ? $this->Html->link($coTaxAmount->co_registration->id, ['controller' => 'CoRegistrations', 'action' => 'view', $coTaxAmount->co_registration->id]) : '' ?></td>
                <td><?= $this->Number->format($coTaxAmount->tax_id) ?></td>
                <td><?= $this->Number->format($coTaxAmount->tax_percentage) ?></td>
                <td><?= $this->Number->format($coTaxAmount->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $coTaxAmount->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $coTaxAmount->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $coTaxAmount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coTaxAmount->id)]) ?>
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

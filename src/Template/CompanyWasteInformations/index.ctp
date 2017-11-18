<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Company Waste Information'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companyWasteInformations index large-9 medium-8 columns content">
    <h3><?= __('Company Waste Informations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('waste_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('volume') ?></th>
                <th scope="col"><?= $this->Paginator->sort('inventory') ?></th>
                <th scope="col"><?= $this->Paginator->sort('storage_method') ?></th>
                <th scope="col"><?= $this->Paginator->sort('size_storage_container') ?></th>
                <th scope="col"><?= $this->Paginator->sort('timestamp') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companyWasteInformations as $companyWasteInformation): ?>
            <tr>
                <td><?= $this->Number->format($companyWasteInformation->id) ?></td>
                <td><?= $companyWasteInformation->has('company') ? $this->Html->link($companyWasteInformation->company->id, ['controller' => 'Companies', 'action' => 'view', $companyWasteInformation->company->id]) : '' ?></td>
                <td><?= h($companyWasteInformation->number) ?></td>
                <td><?= h($companyWasteInformation->waste_type) ?></td>
                <td><?= h($companyWasteInformation->volume) ?></td>
                <td><?= h($companyWasteInformation->inventory) ?></td>
                <td><?= h($companyWasteInformation->storage_method) ?></td>
                <td><?= h($companyWasteInformation->size_storage_container) ?></td>
                <td><?= h($companyWasteInformation->timestamp) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $companyWasteInformation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $companyWasteInformation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $companyWasteInformation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $companyWasteInformation->id)]) ?>
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

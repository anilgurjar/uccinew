<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Company Wastage Information'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companyWastageInformations index large-9 medium-8 columns content">
    <h3><?= __('Company Wastage Informations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code_hm_rule') ?></th>
                <th scope="col"><?= $this->Paginator->sort('waste_description_incinerable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('waste_description_non') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity_month_incinerable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity_month_non') ?></th>
                <th scope="col"><?= $this->Paginator->sort('inventory_incinerable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('inventory_non') ?></th>
                <th scope="col"><?= $this->Paginator->sort('storage_method_incinerable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('storage_method_non') ?></th>
                <th scope="col"><?= $this->Paginator->sort('timestamp') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companyWastageInformations as $companyWastageInformation): ?>
            <tr>
                <td><?= $this->Number->format($companyWastageInformation->id) ?></td>
                <td><?= $companyWastageInformation->has('company') ? $this->Html->link($companyWastageInformation->company->id, ['controller' => 'Companies', 'action' => 'view', $companyWastageInformation->company->id]) : '' ?></td>
                <td><?= h($companyWastageInformation->code_hm_rule) ?></td>
                <td><?= h($companyWastageInformation->waste_description_incinerable) ?></td>
                <td><?= h($companyWastageInformation->waste_description_non) ?></td>
                <td><?= h($companyWastageInformation->quantity_month_incinerable) ?></td>
                <td><?= h($companyWastageInformation->quantity_month_non) ?></td>
                <td><?= h($companyWastageInformation->inventory_incinerable) ?></td>
                <td><?= h($companyWastageInformation->inventory_non) ?></td>
                <td><?= h($companyWastageInformation->storage_method_incinerable) ?></td>
                <td><?= h($companyWastageInformation->storage_method_non) ?></td>
                <td><?= h($companyWastageInformation->timestamp) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $companyWastageInformation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $companyWastageInformation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $companyWastageInformation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $companyWastageInformation->id)]) ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company Wastage Information'), ['action' => 'edit', $companyWastageInformation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company Wastage Information'), ['action' => 'delete', $companyWastageInformation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $companyWastageInformation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Company Wastage Informations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company Wastage Information'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="companyWastageInformations view large-9 medium-8 columns content">
    <h3><?= h($companyWastageInformation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $companyWastageInformation->has('company') ? $this->Html->link($companyWastageInformation->company->id, ['controller' => 'Companies', 'action' => 'view', $companyWastageInformation->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code Hm Rule') ?></th>
            <td><?= h($companyWastageInformation->code_hm_rule) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Waste Description Incinerable') ?></th>
            <td><?= h($companyWastageInformation->waste_description_incinerable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Waste Description Non') ?></th>
            <td><?= h($companyWastageInformation->waste_description_non) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity Month Incinerable') ?></th>
            <td><?= h($companyWastageInformation->quantity_month_incinerable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity Month Non') ?></th>
            <td><?= h($companyWastageInformation->quantity_month_non) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inventory Incinerable') ?></th>
            <td><?= h($companyWastageInformation->inventory_incinerable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inventory Non') ?></th>
            <td><?= h($companyWastageInformation->inventory_non) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Storage Method Incinerable') ?></th>
            <td><?= h($companyWastageInformation->storage_method_incinerable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Storage Method Non') ?></th>
            <td><?= h($companyWastageInformation->storage_method_non) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($companyWastageInformation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Timestamp') ?></th>
            <td><?= h($companyWastageInformation->timestamp) ?></td>
        </tr>
    </table>
</div>

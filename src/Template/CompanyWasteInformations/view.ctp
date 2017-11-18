<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company Waste Information'), ['action' => 'edit', $companyWasteInformation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company Waste Information'), ['action' => 'delete', $companyWasteInformation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $companyWasteInformation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Company Waste Informations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company Waste Information'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="companyWasteInformations view large-9 medium-8 columns content">
    <h3><?= h($companyWasteInformation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $companyWasteInformation->has('company') ? $this->Html->link($companyWasteInformation->company->id, ['controller' => 'Companies', 'action' => 'view', $companyWasteInformation->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number') ?></th>
            <td><?= h($companyWasteInformation->number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Waste Type') ?></th>
            <td><?= h($companyWasteInformation->waste_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Volume') ?></th>
            <td><?= h($companyWasteInformation->volume) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inventory') ?></th>
            <td><?= h($companyWasteInformation->inventory) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Storage Method') ?></th>
            <td><?= h($companyWasteInformation->storage_method) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size Storage Container') ?></th>
            <td><?= h($companyWasteInformation->size_storage_container) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($companyWasteInformation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Timestamp') ?></th>
            <td><?= h($companyWasteInformation->timestamp) ?></td>
        </tr>
    </table>
</div>

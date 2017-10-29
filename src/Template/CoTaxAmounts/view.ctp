<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Co Tax Amount'), ['action' => 'edit', $coTaxAmount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Co Tax Amount'), ['action' => 'delete', $coTaxAmount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coTaxAmount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Co Tax Amounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Co Tax Amount'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Co Registrations'), ['controller' => 'CoRegistrations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Co Registration'), ['controller' => 'CoRegistrations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="coTaxAmounts view large-9 medium-8 columns content">
    <h3><?= h($coTaxAmount->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Co Registration') ?></th>
            <td><?= $coTaxAmount->has('co_registration') ? $this->Html->link($coTaxAmount->co_registration->id, ['controller' => 'CoRegistrations', 'action' => 'view', $coTaxAmount->co_registration->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($coTaxAmount->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax Id') ?></th>
            <td><?= $this->Number->format($coTaxAmount->tax_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax Percentage') ?></th>
            <td><?= $this->Number->format($coTaxAmount->tax_percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($coTaxAmount->amount) ?></td>
        </tr>
    </table>
</div>

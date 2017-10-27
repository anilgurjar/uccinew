<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Member Request'), ['action' => 'edit', $memberRequest->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Member Request'), ['action' => 'delete', $memberRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $memberRequest->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Member Requests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member Request'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Master Member Types'), ['controller' => 'MasterMemberTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Member Type'), ['controller' => 'MasterMemberTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="memberRequests view large-9 medium-8 columns content">
    <h3><?= h($memberRequest->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($memberRequest->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($memberRequest->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($memberRequest->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Name') ?></th>
            <td><?= h($memberRequest->company_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Designation') ?></th>
            <td><?= h($memberRequest->designation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Master Member Type') ?></th>
            <td><?= $memberRequest->has('master_member_type') ? $this->Html->link($memberRequest->master_member_type->id, ['controller' => 'MasterMemberTypes', 'action' => 'view', $memberRequest->master_member_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $memberRequest->has('user') ? $this->Html->link($memberRequest->user->id, ['controller' => 'Users', 'action' => 'view', $memberRequest->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($memberRequest->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Request Date') ?></th>
            <td><?= h($memberRequest->request_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Company Address') ?></h4>
        <?= $this->Text->autoParagraph(h($memberRequest->company_address)); ?>
    </div>
    <div class="row">
        <h4><?= __('Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($memberRequest->remarks)); ?>
    </div>
</div>

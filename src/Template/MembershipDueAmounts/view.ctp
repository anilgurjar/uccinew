<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Membership Due Amount'), ['action' => 'edit', $membershipDueAmount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Membership Due Amount'), ['action' => 'delete', $membershipDueAmount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membershipDueAmount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Membership Due Amounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Membership Due Amount'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Company Masters'), ['controller' => 'CompanyMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company Master'), ['controller' => 'CompanyMasters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="membershipDueAmounts view large-9 medium-8 columns content">
    <h3><?= h($membershipDueAmount->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company Master') ?></th>
            <td><?= $membershipDueAmount->has('company_master') ? $this->Html->link($membershipDueAmount->company_master->id, ['controller' => 'CompanyMasters', 'action' => 'view', $membershipDueAmount->company_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($membershipDueAmount->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member Type Id') ?></th>
            <td><?= $this->Number->format($membershipDueAmount->member_type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Due Amount') ?></th>
            <td><?= $this->Number->format($membershipDueAmount->due_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flag') ?></th>
            <td><?= $this->Number->format($membershipDueAmount->flag) ?></td>
        </tr>
    </table>
</div>

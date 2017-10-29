<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Membership Due Amount'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Company Masters'), ['controller' => 'CompanyMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company Master'), ['controller' => 'CompanyMasters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="membershipDueAmounts index large-9 medium-8 columns content">
    <h3><?= __('Membership Due Amounts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_master_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('due_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($membershipDueAmounts as $membershipDueAmount): ?>
            <tr>
                <td><?= $this->Number->format($membershipDueAmount->id) ?></td>
                <td><?= $membershipDueAmount->has('company_master') ? $this->Html->link($membershipDueAmount->company_master->id, ['controller' => 'CompanyMasters', 'action' => 'view', $membershipDueAmount->company_master->id]) : '' ?></td>
                <td><?= $this->Number->format($membershipDueAmount->member_type_id) ?></td>
                <td><?= $this->Number->format($membershipDueAmount->due_amount) ?></td>
                <td><?= $this->Number->format($membershipDueAmount->flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $membershipDueAmount->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $membershipDueAmount->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $membershipDueAmount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $membershipDueAmount->id)]) ?>
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

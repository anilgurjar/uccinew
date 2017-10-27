<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Coo Email Approval'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Certificate Origins'), ['controller' => 'CertificateOrigins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Certificate Origin'), ['controller' => 'CertificateOrigins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cooEmailApprovals index large-9 medium-8 columns content">
    <h3><?= __('Coo Email Approvals') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('certificate_origin_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cooEmailApprovals as $cooEmailApproval): ?>
            <tr>
                <td><?= $this->Number->format($cooEmailApproval->id) ?></td>
                <td><?= $cooEmailApproval->has('certificate_origin') ? $this->Html->link($cooEmailApproval->certificate_origin->id, ['controller' => 'CertificateOrigins', 'action' => 'view', $cooEmailApproval->certificate_origin->id]) : '' ?></td>
                <td><?= $cooEmailApproval->has('user') ? $this->Html->link($cooEmailApproval->user->member_name, ['controller' => 'Users', 'action' => 'view', $cooEmailApproval->user->id]) : '' ?></td>
                <td><?= $this->Number->format($cooEmailApproval->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cooEmailApproval->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cooEmailApproval->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cooEmailApproval->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cooEmailApproval->id)]) ?>
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

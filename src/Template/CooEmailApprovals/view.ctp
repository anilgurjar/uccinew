<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Coo Email Approval'), ['action' => 'edit', $cooEmailApproval->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Coo Email Approval'), ['action' => 'delete', $cooEmailApproval->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cooEmailApproval->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Coo Email Approvals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Coo Email Approval'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Certificate Origins'), ['controller' => 'CertificateOrigins', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Certificate Origin'), ['controller' => 'CertificateOrigins', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cooEmailApprovals view large-9 medium-8 columns content">
    <h3><?= h($cooEmailApproval->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Certificate Origin') ?></th>
            <td><?= $cooEmailApproval->has('certificate_origin') ? $this->Html->link($cooEmailApproval->certificate_origin->id, ['controller' => 'CertificateOrigins', 'action' => 'view', $cooEmailApproval->certificate_origin->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $cooEmailApproval->has('user') ? $this->Html->link($cooEmailApproval->user->member_name, ['controller' => 'Users', 'action' => 'view', $cooEmailApproval->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cooEmailApproval->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($cooEmailApproval->status) ?></td>
        </tr>
    </table>
</div>

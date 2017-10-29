<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Coo Email Approvals'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Certificate Origins'), ['controller' => 'CertificateOrigins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Certificate Origin'), ['controller' => 'CertificateOrigins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cooEmailApprovals form large-9 medium-8 columns content">
    <?= $this->Form->create($cooEmailApproval) ?>
    <fieldset>
        <legend><?= __('Add Coo Email Approval') ?></legend>
        <?php
            echo $this->Form->input('certificate_origin_id', ['options' => $certificateOrigins]);
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

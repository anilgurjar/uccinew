<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Membership Due Amounts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Company Masters'), ['controller' => 'CompanyMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company Master'), ['controller' => 'CompanyMasters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="membershipDueAmounts form large-9 medium-8 columns content">
    <?= $this->Form->create($membershipDueAmount) ?>
    <fieldset>
        <legend><?= __('Add Membership Due Amount') ?></legend>
        <?php
            echo $this->Form->input('company_master_id', ['options' => $companyMasters]);
            echo $this->Form->input('member_type_id');
            echo $this->Form->input('due_amount');
            echo $this->Form->input('flag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Member Requests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Master Member Types'), ['controller' => 'MasterMemberTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Master Member Type'), ['controller' => 'MasterMemberTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="memberRequests form large-9 medium-8 columns content">
    <?= $this->Form->create($memberRequest) ?>
    <fieldset>
        <legend><?= __('Add Member Request') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('mobile');
            echo $this->Form->input('email');
            echo $this->Form->input('company_name');
            echo $this->Form->input('company_address');
            echo $this->Form->input('designation');
            echo $this->Form->input('master_member_type_id', ['options' => $masterMemberTypes]);
            echo $this->Form->input('remarks');
            echo $this->Form->input('request_date');
            echo $this->Form->input('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

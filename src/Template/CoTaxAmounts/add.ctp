<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Co Tax Amounts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Co Registrations'), ['controller' => 'CoRegistrations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Co Registration'), ['controller' => 'CoRegistrations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coTaxAmounts form large-9 medium-8 columns content">
    <?= $this->Form->create($coTaxAmount) ?>
    <fieldset>
        <legend><?= __('Add Co Tax Amount') ?></legend>
        <?php
            echo $this->Form->input('co_registration_id', ['options' => $coRegistrations]);
            echo $this->Form->input('tax_id');
            echo $this->Form->input('tax_percentage');
            echo $this->Form->input('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

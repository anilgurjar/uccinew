<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Company Waste Informations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companyWasteInformations form large-9 medium-8 columns content">
    <?= $this->Form->create($companyWasteInformation) ?>
    <fieldset>
        <legend><?= __('Add Company Waste Information') ?></legend>
        <?php
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('number');
            echo $this->Form->input('waste_type');
            echo $this->Form->input('volume');
            echo $this->Form->input('inventory');
            echo $this->Form->input('storage_method');
            echo $this->Form->input('size_storage_container');
            echo $this->Form->input('timestamp');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

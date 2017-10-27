<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Co Registrations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Master Financial Years'), ['controller' => 'MasterFinancialYears', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Master Financial Year'), ['controller' => 'MasterFinancialYears', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Co Tax Amounts'), ['controller' => 'CoTaxAmounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Co Tax Amount'), ['controller' => 'CoTaxAmounts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coRegistrations form large-9 medium-8 columns content">
    <?= $this->Form->create($coRegistration) ?>
    <fieldset>
        <legend><?= __('Add Co Registration') ?></legend>
        <?php
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('master_financial_year_id', ['options' => $masterFinancialYears]);
            echo $this->Form->input('amount');
            echo $this->Form->input('tax_amount');
            echo $this->Form->input('total_amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

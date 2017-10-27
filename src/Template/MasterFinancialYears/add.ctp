<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Master Financial Years'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="masterFinancialYears form large-9 medium-8 columns content">
    <?= $this->Form->create($masterFinancialYear) ?>
    <fieldset>
        <legend><?= __('Add Master Financial Year') ?></legend>
        <?php
            echo $this->Form->input('financial_year_from');
            echo $this->Form->input('financial_year_to');
            echo $this->Form->input('flag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

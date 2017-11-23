<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $companyWastageInformation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $companyWastageInformation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Company Wastage Informations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companyWastageInformations form large-9 medium-8 columns content">
    <?= $this->Form->create($companyWastageInformation) ?>
    <fieldset>
        <legend><?= __('Edit Company Wastage Information') ?></legend>
        <?php
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('code_hm_rule');
            echo $this->Form->input('waste_description_incinerable');
            echo $this->Form->input('waste_description_non');
            echo $this->Form->input('quantity_month_incinerable');
            echo $this->Form->input('quantity_month_non');
            echo $this->Form->input('inventory_incinerable');
            echo $this->Form->input('inventory_non');
            echo $this->Form->input('storage_method_incinerable');
            echo $this->Form->input('storage_method_non');
            echo $this->Form->input('timestamp');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

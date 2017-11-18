<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Company Hwm Informations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companyHwmInformations form large-9 medium-8 columns content">
    <?= $this->Form->create($companyHwmInformation) ?>
    <fieldset>
        <legend><?= __('Add Company Hwm Information') ?></legend>
        <?php
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('company_name');
            echo $this->Form->input('waste_description');
            echo $this->Form->input('waste_type_number');
            echo $this->Form->input('process_generating_waste');
            echo $this->Form->input('generation_rate');
            echo $this->Form->input('disposal_arrangement');
            echo $this->Form->input('chemical_composition');
            echo $this->Form->input('company_service_type');
            echo $this->Form->input('chemical_composition_sheet');
            echo $this->Form->input('off_site_company_name');
            echo $this->Form->input('off_site_address');
            echo $this->Form->input('on_site_disposal_method');
            echo $this->Form->input('disposal_waste_use');
            echo $this->Form->input('waste_stream');
            echo $this->Form->input('solid_type');
            echo $this->Form->input('liquid_type');
            echo $this->Form->input('sludge_type');
            echo $this->Form->input('constituents_present');
            echo $this->Form->input('principal_components');
            echo $this->Form->input('acidic_basic');
            echo $this->Form->input('waste_combustible');
            echo $this->Form->input('potential_reuse');
            echo $this->Form->input('timestamp');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company Hwm Information'), ['action' => 'edit', $companyHwmInformation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company Hwm Information'), ['action' => 'delete', $companyHwmInformation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $companyHwmInformation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Company Hwm Informations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company Hwm Information'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="companyHwmInformations view large-9 medium-8 columns content">
    <h3><?= h($companyHwmInformation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $companyHwmInformation->has('company') ? $this->Html->link($companyHwmInformation->company->id, ['controller' => 'Companies', 'action' => 'view', $companyHwmInformation->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Name') ?></th>
            <td><?= h($companyHwmInformation->company_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Waste Description') ?></th>
            <td><?= h($companyHwmInformation->waste_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Waste Type Number') ?></th>
            <td><?= h($companyHwmInformation->waste_type_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Process Generating Waste') ?></th>
            <td><?= h($companyHwmInformation->process_generating_waste) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Generation Rate') ?></th>
            <td><?= h($companyHwmInformation->generation_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Disposal Arrangement') ?></th>
            <td><?= h($companyHwmInformation->disposal_arrangement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Chemical Composition') ?></th>
            <td><?= h($companyHwmInformation->chemical_composition) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Service Type') ?></th>
            <td><?= h($companyHwmInformation->company_service_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Off Site Company Name') ?></th>
            <td><?= h($companyHwmInformation->off_site_company_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('On Site Disposal Method') ?></th>
            <td><?= h($companyHwmInformation->on_site_disposal_method) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Disposal Waste Use') ?></th>
            <td><?= h($companyHwmInformation->disposal_waste_use) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Waste Stream') ?></th>
            <td><?= h($companyHwmInformation->waste_stream) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Solid Type') ?></th>
            <td><?= h($companyHwmInformation->solid_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Liquid Type') ?></th>
            <td><?= h($companyHwmInformation->liquid_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sludge Type') ?></th>
            <td><?= h($companyHwmInformation->sludge_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($companyHwmInformation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Timestamp') ?></th>
            <td><?= h($companyHwmInformation->timestamp) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Chemical Composition Sheet') ?></h4>
        <?= $this->Text->autoParagraph(h($companyHwmInformation->chemical_composition_sheet)); ?>
    </div>
    <div class="row">
        <h4><?= __('Off Site Address') ?></h4>
        <?= $this->Text->autoParagraph(h($companyHwmInformation->off_site_address)); ?>
    </div>
    <div class="row">
        <h4><?= __('Constituents Present') ?></h4>
        <?= $this->Text->autoParagraph(h($companyHwmInformation->constituents_present)); ?>
    </div>
    <div class="row">
        <h4><?= __('Principal Components') ?></h4>
        <?= $this->Text->autoParagraph(h($companyHwmInformation->principal_components)); ?>
    </div>
    <div class="row">
        <h4><?= __('Acidic Basic') ?></h4>
        <?= $this->Text->autoParagraph(h($companyHwmInformation->acidic_basic)); ?>
    </div>
    <div class="row">
        <h4><?= __('Waste Combustible') ?></h4>
        <?= $this->Text->autoParagraph(h($companyHwmInformation->waste_combustible)); ?>
    </div>
    <div class="row">
        <h4><?= __('Potential Reuse') ?></h4>
        <?= $this->Text->autoParagraph(h($companyHwmInformation->potential_reuse)); ?>
    </div>
</div>

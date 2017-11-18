<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Company Hwm Information'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companyHwmInformations index large-9 medium-8 columns content">
    <h3><?= __('Company Hwm Informations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('waste_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('waste_type_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('process_generating_waste') ?></th>
                <th scope="col"><?= $this->Paginator->sort('generation_rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('disposal_arrangement') ?></th>
                <th scope="col"><?= $this->Paginator->sort('chemical_composition') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_service_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('off_site_company_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('on_site_disposal_method') ?></th>
                <th scope="col"><?= $this->Paginator->sort('disposal_waste_use') ?></th>
                <th scope="col"><?= $this->Paginator->sort('waste_stream') ?></th>
                <th scope="col"><?= $this->Paginator->sort('solid_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('liquid_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sludge_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('timestamp') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companyHwmInformations as $companyHwmInformation): ?>
            <tr>
                <td><?= $this->Number->format($companyHwmInformation->id) ?></td>
                <td><?= $companyHwmInformation->has('company') ? $this->Html->link($companyHwmInformation->company->id, ['controller' => 'Companies', 'action' => 'view', $companyHwmInformation->company->id]) : '' ?></td>
                <td><?= h($companyHwmInformation->company_name) ?></td>
                <td><?= h($companyHwmInformation->waste_description) ?></td>
                <td><?= h($companyHwmInformation->waste_type_number) ?></td>
                <td><?= h($companyHwmInformation->process_generating_waste) ?></td>
                <td><?= h($companyHwmInformation->generation_rate) ?></td>
                <td><?= h($companyHwmInformation->disposal_arrangement) ?></td>
                <td><?= h($companyHwmInformation->chemical_composition) ?></td>
                <td><?= h($companyHwmInformation->company_service_type) ?></td>
                <td><?= h($companyHwmInformation->off_site_company_name) ?></td>
                <td><?= h($companyHwmInformation->on_site_disposal_method) ?></td>
                <td><?= h($companyHwmInformation->disposal_waste_use) ?></td>
                <td><?= h($companyHwmInformation->waste_stream) ?></td>
                <td><?= h($companyHwmInformation->solid_type) ?></td>
                <td><?= h($companyHwmInformation->liquid_type) ?></td>
                <td><?= h($companyHwmInformation->sludge_type) ?></td>
                <td><?= h($companyHwmInformation->timestamp) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $companyHwmInformation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $companyHwmInformation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $companyHwmInformation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $companyHwmInformation->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

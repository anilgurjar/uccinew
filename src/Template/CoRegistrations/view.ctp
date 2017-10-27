<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Co Registration'), ['action' => 'edit', $coRegistration->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Co Registration'), ['action' => 'delete', $coRegistration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coRegistration->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Co Registrations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Co Registration'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Master Financial Years'), ['controller' => 'MasterFinancialYears', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Financial Year'), ['controller' => 'MasterFinancialYears', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Co Tax Amounts'), ['controller' => 'CoTaxAmounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Co Tax Amount'), ['controller' => 'CoTaxAmounts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="coRegistrations view large-9 medium-8 columns content">
    <h3><?= h($coRegistration->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $coRegistration->has('company') ? $this->Html->link($coRegistration->company->id, ['controller' => 'Companies', 'action' => 'view', $coRegistration->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Master Financial Year') ?></th>
            <td><?= $coRegistration->has('master_financial_year') ? $this->Html->link($coRegistration->master_financial_year->financial_year, ['controller' => 'MasterFinancialYears', 'action' => 'view', $coRegistration->master_financial_year->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($coRegistration->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($coRegistration->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax Amount') ?></th>
            <td><?= $this->Number->format($coRegistration->tax_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Amount') ?></th>
            <td><?= $this->Number->format($coRegistration->total_amount) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Co Tax Amounts') ?></h4>
        <?php if (!empty($coRegistration->co_tax_amounts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Co Registration Id') ?></th>
                <th scope="col"><?= __('Tax Id') ?></th>
                <th scope="col"><?= __('Tax Percentage') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($coRegistration->co_tax_amounts as $coTaxAmounts): ?>
            <tr>
                <td><?= h($coTaxAmounts->id) ?></td>
                <td><?= h($coTaxAmounts->co_registration_id) ?></td>
                <td><?= h($coTaxAmounts->tax_id) ?></td>
                <td><?= h($coTaxAmounts->tax_percentage) ?></td>
                <td><?= h($coTaxAmounts->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CoTaxAmounts', 'action' => 'view', $coTaxAmounts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CoTaxAmounts', 'action' => 'edit', $coTaxAmounts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CoTaxAmounts', 'action' => 'delete', $coTaxAmounts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coTaxAmounts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

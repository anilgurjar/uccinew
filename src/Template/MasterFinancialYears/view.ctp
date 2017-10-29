<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Master Financial Year'), ['action' => 'edit', $masterFinancialYear->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Master Financial Year'), ['action' => 'delete', $masterFinancialYear->id], ['confirm' => __('Are you sure you want to delete # {0}?', $masterFinancialYear->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Master Financial Years'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Financial Year'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="masterFinancialYears view large-9 medium-8 columns content">
    <h3><?= h($masterFinancialYear->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Financial Year From') ?></th>
            <td><?= h($masterFinancialYear->financial_year_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($masterFinancialYear->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financial Year To') ?></th>
            <td><?= $this->Number->format($masterFinancialYear->financial_year_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flag') ?></th>
            <td><?= $this->Number->format($masterFinancialYear->flag) ?></td>
        </tr>
    </table>
</div>

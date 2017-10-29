<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Propose Budget'), ['action' => 'edit', $proposeBudget->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Propose Budget'), ['action' => 'delete', $proposeBudget->id], ['confirm' => __('Are you sure you want to delete # {0}?', $proposeBudget->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Propose Budgets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Propose Budget'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Master Purposes'), ['controller' => 'MasterPurposes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Purpose'), ['controller' => 'MasterPurposes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="proposeBudgets view large-9 medium-8 columns content">
    <h3><?= h($proposeBudget->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Master Purpose') ?></th>
            <td><?= $proposeBudget->has('master_purpose') ? $this->Html->link($proposeBudget->master_purpose->id, ['controller' => 'MasterPurposes', 'action' => 'view', $proposeBudget->master_purpose->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $proposeBudget->has('user') ? $this->Html->link($proposeBudget->user->id, ['controller' => 'Users', 'action' => 'view', $proposeBudget->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($proposeBudget->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expenditure Amount') ?></th>
            <td><?= $this->Number->format($proposeBudget->expenditure_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receipt Amount') ?></th>
            <td><?= $this->Number->format($proposeBudget->receipt_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financial Year From') ?></th>
            <td><?= h($proposeBudget->financial_year_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financial Year To') ?></th>
            <td><?= h($proposeBudget->financial_year_to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Current') ?></th>
            <td><?= h($proposeBudget->date_current) ?></td>
        </tr>
    </table>
</div>

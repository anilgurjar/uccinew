<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Daily Task'), ['action' => 'edit', $dailyTask->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Daily Task'), ['action' => 'delete', $dailyTask->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dailyTask->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Daily Tasks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Daily Task'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dailyTasks view large-9 medium-8 columns content">
    <h3><?= h($dailyTask->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Time') ?></th>
            <td><?= h($dailyTask->time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $dailyTask->has('user') ? $this->Html->link($dailyTask->user->member_name, ['controller' => 'Users', 'action' => 'view', $dailyTask->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($dailyTask->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($dailyTask->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($dailyTask->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($dailyTask->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Task Completed') ?></h4>
        <?= $this->Text->autoParagraph(h($dailyTask->task_completed)); ?>
    </div>
    <div class="row">
        <h4><?= __('Task Initiated') ?></h4>
        <?= $this->Text->autoParagraph(h($dailyTask->task_initiated)); ?>
    </div>
</div>

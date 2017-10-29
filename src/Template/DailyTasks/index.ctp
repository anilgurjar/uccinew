<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Daily Task'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dailyTasks index large-9 medium-8 columns content">
    <h3><?= __('Daily Tasks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dailyTasks as $dailyTask): ?>
            <tr>
                <td><?= $this->Number->format($dailyTask->id) ?></td>
                <td><?= h($dailyTask->date) ?></td>
                <td><?= h($dailyTask->time) ?></td>
                <td><?= $dailyTask->has('user') ? $this->Html->link($dailyTask->user->member_name, ['controller' => 'Users', 'action' => 'view', $dailyTask->user->id]) : '' ?></td>
                <td><?= h($dailyTask->created_on) ?></td>
                <td><?= $this->Number->format($dailyTask->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dailyTask->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dailyTask->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dailyTask->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dailyTask->id)]) ?>
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

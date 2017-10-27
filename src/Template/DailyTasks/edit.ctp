<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dailyTask->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dailyTask->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Daily Tasks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dailyTasks form large-9 medium-8 columns content">
    <?= $this->Form->create($dailyTask) ?>
    <fieldset>
        <legend><?= __('Edit Daily Task') ?></legend>
        <?php
            echo $this->Form->input('date');
            echo $this->Form->input('time');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('task_completed');
            echo $this->Form->input('task_initiated');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

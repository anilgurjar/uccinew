<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $masterSession->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $masterSession->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Master Sessions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Executive Members'), ['controller' => 'ExecutiveMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Executive Member'), ['controller' => 'ExecutiveMembers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="masterSessions form large-9 medium-8 columns content">
    <?= $this->Form->create($masterSession) ?>
    <fieldset>
        <legend><?= __('Edit Master Session') ?></legend>
        <?php
            echo $this->Form->input('session');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

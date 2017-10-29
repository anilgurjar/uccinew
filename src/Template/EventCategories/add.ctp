<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Event Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Event Histories'), ['controller' => 'EventHistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event History'), ['controller' => 'EventHistories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($eventCategory) ?>
    <fieldset>
        <legend><?= __('Add Event Category') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

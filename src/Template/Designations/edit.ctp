<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $designation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $designation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Designations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Executive Members'), ['controller' => 'ExecutiveMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Executive Member'), ['controller' => 'ExecutiveMembers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="designations form large-9 medium-8 columns content">
    <?= $this->Form->create($designation) ?>
    <fieldset>
        <legend><?= __('Edit Designation') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

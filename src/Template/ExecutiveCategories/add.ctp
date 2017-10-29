<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Executive Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Executive Members'), ['controller' => 'ExecutiveMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Executive Member'), ['controller' => 'ExecutiveMembers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="executiveCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($executiveCategory) ?>
    <fieldset>
        <legend><?= __('Add Executive Category') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $initiativeCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $initiativeCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Initiative Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Initiatives'), ['controller' => 'Initiatives', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Initiative'), ['controller' => 'Initiatives', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="initiativeCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($initiativeCategory) ?>
    <fieldset>
        <legend><?= __('Edit Initiative Category') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

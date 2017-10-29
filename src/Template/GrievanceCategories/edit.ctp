<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $grievanceCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $grievanceCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Grievance Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Industrial Grievances'), ['controller' => 'IndustrialGrievances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Industrial Grievance'), ['controller' => 'IndustrialGrievances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grievanceCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($grievanceCategory) ?>
    <fieldset>
        <legend><?= __('Edit Grievance Category') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Grievance Issue Relateds'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Grievance Issues'), ['controller' => 'GrievanceIssues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grievance Issue'), ['controller' => 'GrievanceIssues', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Industrial Grievances'), ['controller' => 'IndustrialGrievances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Industrial Grievance'), ['controller' => 'IndustrialGrievances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grievanceIssueRelateds form large-9 medium-8 columns content">
    <?= $this->Form->create($grievanceIssueRelated) ?>
    <fieldset>
        <legend><?= __('Add Grievance Issue Related') ?></legend>
        <?php
            echo $this->Form->input('grievance_issue_id', ['options' => $grievanceIssues]);
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

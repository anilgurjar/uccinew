<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Grievance Issue Related'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grievance Issues'), ['controller' => 'GrievanceIssues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grievance Issue'), ['controller' => 'GrievanceIssues', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Industrial Grievances'), ['controller' => 'IndustrialGrievances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Industrial Grievance'), ['controller' => 'IndustrialGrievances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grievanceIssueRelateds index large-9 medium-8 columns content">
    <h3><?= __('Grievance Issue Relateds') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grievance_issue_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grievanceIssueRelateds as $grievanceIssueRelated): ?>
            <tr>
                <td><?= $this->Number->format($grievanceIssueRelated->id) ?></td>
                <td><?= $grievanceIssueRelated->has('grievance_issue') ? $this->Html->link($grievanceIssueRelated->grievance_issue->name, ['controller' => 'GrievanceIssues', 'action' => 'view', $grievanceIssueRelated->grievance_issue->id]) : '' ?></td>
                <td><?= h($grievanceIssueRelated->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $grievanceIssueRelated->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $grievanceIssueRelated->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $grievanceIssueRelated->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grievanceIssueRelated->id)]) ?>
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

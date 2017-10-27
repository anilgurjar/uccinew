<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Grievance Issue'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grievance Issue Relateds'), ['controller' => 'GrievanceIssueRelateds', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grievance Issue Related'), ['controller' => 'GrievanceIssueRelateds', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Industrial Grievances'), ['controller' => 'IndustrialGrievances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Industrial Grievance'), ['controller' => 'IndustrialGrievances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grievanceIssues index large-9 medium-8 columns content">
    <h3><?= __('Grievance Issues') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grievanceIssues as $grievanceIssue): ?>
            <tr>
                <td><?= $this->Number->format($grievanceIssue->id) ?></td>
                <td><?= h($grievanceIssue->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $grievanceIssue->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $grievanceIssue->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $grievanceIssue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grievanceIssue->id)]) ?>
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

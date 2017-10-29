<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Grievance Category'), ['action' => 'edit', $grievanceCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Grievance Category'), ['action' => 'delete', $grievanceCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grievanceCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Grievance Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grievance Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Industrial Grievances'), ['controller' => 'IndustrialGrievances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Industrial Grievance'), ['controller' => 'IndustrialGrievances', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="grievanceCategories view large-9 medium-8 columns content">
    <h3><?= h($grievanceCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($grievanceCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($grievanceCategory->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Industrial Grievances') ?></h4>
        <?php if (!empty($grievanceCategory->industrial_grievances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Grievance Category Id') ?></th>
                <th scope="col"><?= __('Industrial Department Id') ?></th>
                <th scope="col"><?= __('Grievance Issue Id') ?></th>
                <th scope="col"><?= __('Lodge Same Grievance') ?></th>
                <th scope="col"><?= __('Grievance Period') ?></th>
                <th scope="col"><?= __('Grievance Age') ?></th>
                <th scope="col"><?= __('Document') ?></th>
                <th scope="col"><?= __('Grievance Issue Related Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Mail Status') ?></th>
                <th scope="col"><?= __('Complete Status') ?></th>
                <th scope="col"><?= __('Feedback') ?></th>
                <th scope="col"><?= __('Close Date') ?></th>
                <th scope="col"><?= __('Reopen Reason') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($grievanceCategory->industrial_grievances as $industrialGrievances): ?>
            <tr>
                <td><?= h($industrialGrievances->id) ?></td>
                <td><?= h($industrialGrievances->grievance_category_id) ?></td>
                <td><?= h($industrialGrievances->industrial_department_id) ?></td>
                <td><?= h($industrialGrievances->grievance_issue_id) ?></td>
                <td><?= h($industrialGrievances->lodge_same_grievance) ?></td>
                <td><?= h($industrialGrievances->grievance_period) ?></td>
                <td><?= h($industrialGrievances->grievance_age) ?></td>
                <td><?= h($industrialGrievances->document) ?></td>
                <td><?= h($industrialGrievances->grievance_issue_related_id) ?></td>
                <td><?= h($industrialGrievances->description) ?></td>
                <td><?= h($industrialGrievances->location) ?></td>
                <td><?= h($industrialGrievances->created_on) ?></td>
                <td><?= h($industrialGrievances->created_by) ?></td>
                <td><?= h($industrialGrievances->mail_status) ?></td>
                <td><?= h($industrialGrievances->complete_status) ?></td>
                <td><?= h($industrialGrievances->feedback) ?></td>
                <td><?= h($industrialGrievances->close_date) ?></td>
                <td><?= h($industrialGrievances->reopen_reason) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'IndustrialGrievances', 'action' => 'view', $industrialGrievances->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'IndustrialGrievances', 'action' => 'edit', $industrialGrievances->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'IndustrialGrievances', 'action' => 'delete', $industrialGrievances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $industrialGrievances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

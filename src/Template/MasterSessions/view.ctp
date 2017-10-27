<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Master Session'), ['action' => 'edit', $masterSession->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Master Session'), ['action' => 'delete', $masterSession->id], ['confirm' => __('Are you sure you want to delete # {0}?', $masterSession->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Master Sessions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Session'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Executive Members'), ['controller' => 'ExecutiveMembers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Executive Member'), ['controller' => 'ExecutiveMembers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="masterSessions view large-9 medium-8 columns content">
    <h3><?= h($masterSession->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Session') ?></th>
            <td><?= h($masterSession->session) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($masterSession->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($masterSession->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Executive Members') ?></h4>
        <?php if (!empty($masterSession->executive_members)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Master Session Id') ?></th>
                <th scope="col"><?= __('Executive Category Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Designation') ?></th>
                <th scope="col"><?= __('Company Name') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($masterSession->executive_members as $executiveMembers): ?>
            <tr>
                <td><?= h($executiveMembers->id) ?></td>
                <td><?= h($executiveMembers->master_session_id) ?></td>
                <td><?= h($executiveMembers->executive_category_id) ?></td>
                <td><?= h($executiveMembers->name) ?></td>
                <td><?= h($executiveMembers->designation) ?></td>
                <td><?= h($executiveMembers->company_name) ?></td>
                <td><?= h($executiveMembers->image) ?></td>
                <td><?= h($executiveMembers->email) ?></td>
                <td><?= h($executiveMembers->mobile) ?></td>
                <td><?= h($executiveMembers->status) ?></td>
                <td><?= h($executiveMembers->created_by) ?></td>
                <td><?= h($executiveMembers->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ExecutiveMembers', 'action' => 'view', $executiveMembers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ExecutiveMembers', 'action' => 'edit', $executiveMembers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ExecutiveMembers', 'action' => 'delete', $executiveMembers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $executiveMembers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

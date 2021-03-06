<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Master Session'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Executive Members'), ['controller' => 'ExecutiveMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Executive Member'), ['controller' => 'ExecutiveMembers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="masterSessions index large-9 medium-8 columns content">
    <h3><?= __('Master Sessions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('session') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($masterSessions as $masterSession): ?>
            <tr>
                <td><?= $this->Number->format($masterSession->id) ?></td>
                <td><?= h($masterSession->session) ?></td>
                <td><?= h($masterSession->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $masterSession->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $masterSession->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $masterSession->id], ['confirm' => __('Are you sure you want to delete # {0}?', $masterSession->id)]) ?>
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

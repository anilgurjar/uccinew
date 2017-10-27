<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Initiative Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Initiatives'), ['controller' => 'Initiatives', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Initiative'), ['controller' => 'Initiatives', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="initiativeCategories index large-9 medium-8 columns content">
    <h3><?= __('Initiative Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($initiativeCategories as $initiativeCategory): ?>
            <tr>
                <td><?= $this->Number->format($initiativeCategory->id) ?></td>
                <td><?= h($initiativeCategory->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $initiativeCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $initiativeCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $initiativeCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $initiativeCategory->id)]) ?>
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

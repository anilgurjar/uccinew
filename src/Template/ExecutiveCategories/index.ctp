<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Executive Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Executive Members'), ['controller' => 'ExecutiveMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Executive Member'), ['controller' => 'ExecutiveMembers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="executiveCategories index large-9 medium-8 columns content">
    <h3><?= __('Executive Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($executiveCategories as $executiveCategory): ?>
            <tr>
                <td><?= $this->Number->format($executiveCategory->id) ?></td>
                <td><?= h($executiveCategory->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $executiveCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $executiveCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $executiveCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $executiveCategory->id)]) ?>
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

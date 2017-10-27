<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Event Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Event Histories'), ['controller' => 'EventHistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event History'), ['controller' => 'EventHistories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventCategories index large-9 medium-8 columns content">
    <h3><?= __('Event Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventCategories as $eventCategory): ?>
            <tr>
                <td><?= $this->Number->format($eventCategory->id) ?></td>
                <td><?= h($eventCategory->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $eventCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventCategory->id)]) ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Event Guet'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventGuets index large-9 medium-8 columns content">
    <h3><?= __('Event Guets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventGuets as $eventGuet): ?>
            <tr>
                <td><?= $this->Number->format($eventGuet->id) ?></td>
                <td><?= $eventGuet->has('event') ? $this->Html->link($eventGuet->event->name, ['controller' => 'Events', 'action' => 'view', $eventGuet->event->id]) : '' ?></td>
                <td><?= h($eventGuet->name) ?></td>
                <td><?= h($eventGuet->created_on) ?></td>
                <td><?= $this->Number->format($eventGuet->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $eventGuet->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventGuet->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventGuet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventGuet->id)]) ?>
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

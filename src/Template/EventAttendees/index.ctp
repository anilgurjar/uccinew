<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Event Attendee'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventAttendees index large-9 medium-8 columns content">
    <h3><?= __('Event Attendees') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('answer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventAttendees as $eventAttendee): ?>
            <tr>
                <td><?= $this->Number->format($eventAttendee->id) ?></td>
                <td><?= $eventAttendee->has('event') ? $this->Html->link($eventAttendee->event->name, ['controller' => 'Events', 'action' => 'view', $eventAttendee->event->id]) : '' ?></td>
                <td><?= $eventAttendee->has('user') ? $this->Html->link($eventAttendee->user->id, ['controller' => 'Users', 'action' => 'view', $eventAttendee->user->id]) : '' ?></td>
                <td><?= h($eventAttendee->answer) ?></td>
                <td><?= h($eventAttendee->created_on) ?></td>
                <td><?= $this->Number->format($eventAttendee->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $eventAttendee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventAttendee->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventAttendee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventAttendee->id)]) ?>
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

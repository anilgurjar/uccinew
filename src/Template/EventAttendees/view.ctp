<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Event Attendee'), ['action' => 'edit', $eventAttendee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event Attendee'), ['action' => 'delete', $eventAttendee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventAttendee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Event Attendees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Attendee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventAttendees view large-9 medium-8 columns content">
    <h3><?= h($eventAttendee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $eventAttendee->has('event') ? $this->Html->link($eventAttendee->event->name, ['controller' => 'Events', 'action' => 'view', $eventAttendee->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $eventAttendee->has('user') ? $this->Html->link($eventAttendee->user->id, ['controller' => 'Users', 'action' => 'view', $eventAttendee->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Answer') ?></th>
            <td><?= h($eventAttendee->answer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eventAttendee->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($eventAttendee->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($eventAttendee->created_on) ?></td>
        </tr>
    </table>
</div>

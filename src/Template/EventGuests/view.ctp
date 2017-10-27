<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Event Guet'), ['action' => 'edit', $eventGuet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event Guet'), ['action' => 'delete', $eventGuet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventGuet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Event Guets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Guet'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventGuets view large-9 medium-8 columns content">
    <h3><?= h($eventGuet->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $eventGuet->has('event') ? $this->Html->link($eventGuet->event->name, ['controller' => 'Events', 'action' => 'view', $eventGuet->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($eventGuet->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eventGuet->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($eventGuet->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($eventGuet->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Photo') ?></h4>
        <?= $this->Text->autoParagraph(h($eventGuet->photo)); ?>
    </div>
</div>

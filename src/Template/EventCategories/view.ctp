<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Event Category'), ['action' => 'edit', $eventCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event Category'), ['action' => 'delete', $eventCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Event Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Event Histories'), ['controller' => 'EventHistories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event History'), ['controller' => 'EventHistories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventCategories view large-9 medium-8 columns content">
    <h3><?= h($eventCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($eventCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eventCategory->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Event Histories') ?></h4>
        <?php if (!empty($eventCategory->event_histories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Time') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Cover Image') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Published On') ?></th>
                <th scope="col"><?= __('Published By') ?></th>
                <th scope="col"><?= __('Event Category Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventCategory->event_histories as $eventHistories): ?>
            <tr>
                <td><?= h($eventHistories->id) ?></td>
                <td><?= h($eventHistories->event_id) ?></td>
                <td><?= h($eventHistories->name) ?></td>
                <td><?= h($eventHistories->date) ?></td>
                <td><?= h($eventHistories->time) ?></td>
                <td><?= h($eventHistories->location) ?></td>
                <td><?= h($eventHistories->latitude) ?></td>
                <td><?= h($eventHistories->longitude) ?></td>
                <td><?= h($eventHistories->description) ?></td>
                <td><?= h($eventHistories->status) ?></td>
                <td><?= h($eventHistories->cover_image) ?></td>
                <td><?= h($eventHistories->edited_on) ?></td>
                <td><?= h($eventHistories->edited_by) ?></td>
                <td><?= h($eventHistories->published_on) ?></td>
                <td><?= h($eventHistories->published_by) ?></td>
                <td><?= h($eventHistories->event_category_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EventHistories', 'action' => 'view', $eventHistories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EventHistories', 'action' => 'edit', $eventHistories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventHistories', 'action' => 'delete', $eventHistories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventHistories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Events') ?></h4>
        <?php if (!empty($eventCategory->events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Time') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Cover Image') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Published On') ?></th>
                <th scope="col"><?= __('Published By') ?></th>
                <th scope="col"><?= __('Event Category Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventCategory->events as $events): ?>
            <tr>
                <td><?= h($events->id) ?></td>
                <td><?= h($events->name) ?></td>
                <td><?= h($events->date) ?></td>
                <td><?= h($events->time) ?></td>
                <td><?= h($events->location) ?></td>
                <td><?= h($events->latitude) ?></td>
                <td><?= h($events->longitude) ?></td>
                <td><?= h($events->description) ?></td>
                <td><?= h($events->status) ?></td>
                <td><?= h($events->cover_image) ?></td>
                <td><?= h($events->created_on) ?></td>
                <td><?= h($events->created_by) ?></td>
                <td><?= h($events->edited_on) ?></td>
                <td><?= h($events->edited_by) ?></td>
                <td><?= h($events->published_on) ?></td>
                <td><?= h($events->published_by) ?></td>
                <td><?= h($events->event_category_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

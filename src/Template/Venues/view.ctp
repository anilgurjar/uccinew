<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Venue'), ['action' => 'edit', $venue->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Venue'), ['action' => 'delete', $venue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $venue->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Venues'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venue'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Facility Bookings'), ['controller' => 'FacilityBookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Facility Booking'), ['controller' => 'FacilityBookings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="venues view large-9 medium-8 columns content">
    <h3><?= h($venue->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($venue->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($venue->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($venue->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flag') ?></th>
            <td><?= $this->Number->format($venue->flag) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Facility Bookings') ?></h4>
        <?php if (!empty($venue->facility_bookings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Expected Person') ?></th>
                <th scope="col"><?= __('Date From') ?></th>
                <th scope="col"><?= __('Date To') ?></th>
                <th scope="col"><?= __('Venue Id') ?></th>
                <th scope="col"><?= __('Total Amount') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($venue->facility_bookings as $facilityBookings): ?>
            <tr>
                <td><?= h($facilityBookings->id) ?></td>
                <td><?= h($facilityBookings->name) ?></td>
                <td><?= h($facilityBookings->description) ?></td>
                <td><?= h($facilityBookings->expected_person) ?></td>
                <td><?= h($facilityBookings->date_from) ?></td>
                <td><?= h($facilityBookings->date_to) ?></td>
                <td><?= h($facilityBookings->venue_id) ?></td>
                <td><?= h($facilityBookings->total_amount) ?></td>
                <td><?= h($facilityBookings->created_on) ?></td>
                <td><?= h($facilityBookings->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FacilityBookings', 'action' => 'view', $facilityBookings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FacilityBookings', 'action' => 'edit', $facilityBookings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FacilityBookings', 'action' => 'delete', $facilityBookings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facilityBookings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

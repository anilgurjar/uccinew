<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $facilityBooking->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $facilityBooking->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Facility Bookings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Venues'), ['controller' => 'Venues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Venue'), ['controller' => 'Venues', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facilityBookings form large-9 medium-8 columns content">
    <?= $this->Form->create($facilityBooking) ?>
    <fieldset>
        <legend><?= __('Edit Facility Booking') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('expected_person');
            echo $this->Form->input('date_from');
            echo $this->Form->input('date_to');
            echo $this->Form->input('venue_id', ['options' => $venues]);
            echo $this->Form->input('total_amount');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

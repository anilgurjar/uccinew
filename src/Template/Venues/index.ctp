<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Venue'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Facility Bookings'), ['controller' => 'FacilityBookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Facility Booking'), ['controller' => 'FacilityBookings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="venues index large-9 medium-8 columns content">
    <h3><?= __('Venues') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($venues as $venue): ?>
            <tr>
                <td><?= $this->Number->format($venue->id) ?></td>
                <td><?= h($venue->name) ?></td>
                <td><?= $this->Number->format($venue->amount) ?></td>
                <td><?= $this->Number->format($venue->flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $venue->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $venue->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $venue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $venue->id)]) ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Affilation Registration'), ['action' => 'edit', $affilationRegistration->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Affilation Registration'), ['action' => 'delete', $affilationRegistration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $affilationRegistration->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Affilation Registrations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Affilation Registration'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="affilationRegistrations view large-9 medium-8 columns content">
    <h3><?= h($affilationRegistration->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Logo') ?></th>
            <td><?= h($affilationRegistration->logo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($affilationRegistration->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($affilationRegistration->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($affilationRegistration->created_on) ?></td>
        </tr>
    </table>
</div>

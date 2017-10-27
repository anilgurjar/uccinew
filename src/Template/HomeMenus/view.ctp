<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Home Menu'), ['action' => 'edit', $homeMenu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Home Menu'), ['action' => 'delete', $homeMenu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $homeMenu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Home Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Home Menu'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="homeMenus view large-9 medium-8 columns content">
    <h3><?= h($homeMenu->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($homeMenu->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($homeMenu->id) ?></td>
        </tr>
    </table>
</div>

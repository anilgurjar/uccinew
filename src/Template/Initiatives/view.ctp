<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Initiative'), ['action' => 'edit', $initiative->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Initiative'), ['action' => 'delete', $initiative->id], ['confirm' => __('Are you sure you want to delete # {0}?', $initiative->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Initiatives'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Initiative'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="initiatives view large-9 medium-8 columns content">
    <h3><?= h($initiative->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($initiative->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($initiative->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($initiative->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($initiative->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($initiative->description)); ?>
    </div>
</div>

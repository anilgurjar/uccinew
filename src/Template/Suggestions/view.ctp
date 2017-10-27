<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Suggestion'), ['action' => 'edit', $suggestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Suggestion'), ['action' => 'delete', $suggestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $suggestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Suggestions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Suggestion'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="suggestions view large-9 medium-8 columns content">
    <h3><?= h($suggestion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Comments') ?></th>
            <td><?= h($suggestion->comments) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Frequency') ?></th>
            <td><?= h($suggestion->frequency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attachment') ?></th>
            <td><?= h($suggestion->attachment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($suggestion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($suggestion->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Create On') ?></th>
            <td><?= h($suggestion->create_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($suggestion->description)); ?>
    </div>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Demopdf'), ['action' => 'edit', $demopdf->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Demopdf'), ['action' => 'delete', $demopdf->id], ['confirm' => __('Are you sure you want to delete # {0}?', $demopdf->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Demopdfs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Demopdf'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="demopdfs view large-9 medium-8 columns content">
    <h3><?= h($demopdf->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($demopdf->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Attachment') ?></th>
            <td><?= h($demopdf->file_attachment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($demopdf->id) ?></td>
        </tr>
    </table>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notice Category'), ['action' => 'edit', $noticeCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notice Category'), ['action' => 'delete', $noticeCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noticeCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notice Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notice Category'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="noticeCategories view large-9 medium-8 columns content">
    <h3><?= h($noticeCategory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category Name') ?></th>
            <td><?= h($noticeCategory->category_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($noticeCategory->id) ?></td>
        </tr>
    </table>
</div>

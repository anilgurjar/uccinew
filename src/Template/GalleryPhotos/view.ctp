<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Gallery Photo'), ['action' => 'edit', $galleryPhoto->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Gallery Photo'), ['action' => 'delete', $galleryPhoto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $galleryPhoto->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Gallery Photos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gallery Photo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Galleries'), ['controller' => 'Galleries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gallery'), ['controller' => 'Galleries', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="galleryPhotos view large-9 medium-8 columns content">
    <h3><?= h($galleryPhoto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Gallery') ?></th>
            <td><?= $galleryPhoto->has('gallery') ? $this->Html->link($galleryPhoto->gallery->name, ['controller' => 'Galleries', 'action' => 'view', $galleryPhoto->gallery->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($galleryPhoto->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($galleryPhoto->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($galleryPhoto->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($galleryPhoto->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($galleryPhoto->description)); ?>
    </div>
</div>

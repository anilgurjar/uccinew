<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Gallery Photo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Galleries'), ['controller' => 'Galleries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gallery'), ['controller' => 'Galleries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="galleryPhotos index large-9 medium-8 columns content">
    <h3><?= __('Gallery Photos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gallery_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($galleryPhotos as $galleryPhoto): ?>
            <tr>
                <td><?= $this->Number->format($galleryPhoto->id) ?></td>
                <td><?= $galleryPhoto->has('gallery') ? $this->Html->link($galleryPhoto->gallery->name, ['controller' => 'Galleries', 'action' => 'view', $galleryPhoto->gallery->id]) : '' ?></td>
                <td><?= h($galleryPhoto->image) ?></td>
                <td><?= h($galleryPhoto->created_on) ?></td>
                <td><?= $this->Number->format($galleryPhoto->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $galleryPhoto->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $galleryPhoto->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $galleryPhoto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $galleryPhoto->id)]) ?>
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

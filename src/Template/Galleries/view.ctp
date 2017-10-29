<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Gallery'), ['action' => 'edit', $gallery->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Gallery'), ['action' => 'delete', $gallery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gallery->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Galleries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gallery'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Blogs'), ['controller' => 'Blogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blog'), ['controller' => 'Blogs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Gallery Photos'), ['controller' => 'GalleryPhotos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gallery Photo'), ['controller' => 'GalleryPhotos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="galleries view large-9 medium-8 columns content">
    <h3><?= h($gallery->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $gallery->has('event') ? $this->Html->link($gallery->event->name, ['controller' => 'Events', 'action' => 'view', $gallery->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Blog') ?></th>
            <td><?= $gallery->has('blog') ? $this->Html->link($gallery->blog->title, ['controller' => 'Blogs', 'action' => 'view', $gallery->blog->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($gallery->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cover Image') ?></th>
            <td><?= h($gallery->cover_image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($gallery->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($gallery->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($gallery->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Gallery Photos') ?></h4>
        <?php if (!empty($gallery->gallery_photos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Gallery Id') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($gallery->gallery_photos as $galleryPhotos): ?>
            <tr>
                <td><?= h($galleryPhotos->id) ?></td>
                <td><?= h($galleryPhotos->gallery_id) ?></td>
                <td><?= h($galleryPhotos->image) ?></td>
                <td><?= h($galleryPhotos->description) ?></td>
                <td><?= h($galleryPhotos->created_on) ?></td>
                <td><?= h($galleryPhotos->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'GalleryPhotos', 'action' => 'view', $galleryPhotos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'GalleryPhotos', 'action' => 'edit', $galleryPhotos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'GalleryPhotos', 'action' => 'delete', $galleryPhotos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $galleryPhotos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

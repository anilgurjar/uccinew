<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Blog'), ['action' => 'edit', $blog->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Blog'), ['action' => 'delete', $blog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Blogs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blog'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Blog Likes'), ['controller' => 'BlogLikes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blog Like'), ['controller' => 'BlogLikes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Galleries'), ['controller' => 'Galleries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gallery'), ['controller' => 'Galleries', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="blogs view large-9 medium-8 columns content">
    <h3><?= h($blog->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($blog->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cover Image') ?></th>
            <td><?= h($blog->cover_image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($blog->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($blog->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Published By') ?></th>
            <td><?= $this->Number->format($blog->published_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($blog->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($blog->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Published On') ?></th>
            <td><?= h($blog->published_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($blog->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($blog->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($blog->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Blog Likes') ?></h4>
        <?php if (!empty($blog->blog_likes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Blog Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($blog->blog_likes as $blogLikes): ?>
            <tr>
                <td><?= h($blogLikes->id) ?></td>
                <td><?= h($blogLikes->blog_id) ?></td>
                <td><?= h($blogLikes->user_id) ?></td>
                <td><?= h($blogLikes->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'BlogLikes', 'action' => 'view', $blogLikes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'BlogLikes', 'action' => 'edit', $blogLikes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'BlogLikes', 'action' => 'delete', $blogLikes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blogLikes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Galleries') ?></h4>
        <?php if (!empty($blog->galleries)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('Blog Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Cover Image') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($blog->galleries as $galleries): ?>
            <tr>
                <td><?= h($galleries->id) ?></td>
                <td><?= h($galleries->event_id) ?></td>
                <td><?= h($galleries->blog_id) ?></td>
                <td><?= h($galleries->name) ?></td>
                <td><?= h($galleries->cover_image) ?></td>
                <td><?= h($galleries->created_on) ?></td>
                <td><?= h($galleries->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Galleries', 'action' => 'view', $galleries->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Galleries', 'action' => 'edit', $galleries->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Galleries', 'action' => 'delete', $galleries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $galleries->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

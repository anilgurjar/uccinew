<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Blog Like'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Blogs'), ['controller' => 'Blogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Blog'), ['controller' => 'Blogs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="blogLikes index large-9 medium-8 columns content">
    <h3><?= __('Blog Likes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('blog_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogLikes as $blogLike): ?>
            <tr>
                <td><?= $this->Number->format($blogLike->id) ?></td>
                <td><?= $blogLike->has('blog') ? $this->Html->link($blogLike->blog->title, ['controller' => 'Blogs', 'action' => 'view', $blogLike->blog->id]) : '' ?></td>
                <td><?= $blogLike->has('user') ? $this->Html->link($blogLike->user->id, ['controller' => 'Users', 'action' => 'view', $blogLike->user->id]) : '' ?></td>
                <td><?= h($blogLike->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $blogLike->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $blogLike->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $blogLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blogLike->id)]) ?>
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

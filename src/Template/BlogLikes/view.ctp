<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Blog Like'), ['action' => 'edit', $blogLike->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Blog Like'), ['action' => 'delete', $blogLike->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blogLike->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Blog Likes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blog Like'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Blogs'), ['controller' => 'Blogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Blog'), ['controller' => 'Blogs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="blogLikes view large-9 medium-8 columns content">
    <h3><?= h($blogLike->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Blog') ?></th>
            <td><?= $blogLike->has('blog') ? $this->Html->link($blogLike->blog->title, ['controller' => 'Blogs', 'action' => 'view', $blogLike->blog->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $blogLike->has('user') ? $this->Html->link($blogLike->user->id, ['controller' => 'Users', 'action' => 'view', $blogLike->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($blogLike->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($blogLike->created_on) ?></td>
        </tr>
    </table>
</div>

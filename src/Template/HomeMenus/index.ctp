<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Home Menu'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="homeMenus index large-9 medium-8 columns content">
    <h3><?= __('Home Menus') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($homeMenus as $homeMenu): ?>
            <tr>
                <td><?= $this->Number->format($homeMenu->id) ?></td>
                <td><?= h($homeMenu->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $homeMenu->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $homeMenu->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $homeMenu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $homeMenu->id)]) ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Initiative Category'), ['action' => 'edit', $initiativeCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Initiative Category'), ['action' => 'delete', $initiativeCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $initiativeCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Initiative Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Initiative Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Initiatives'), ['controller' => 'Initiatives', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Initiative'), ['controller' => 'Initiatives', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="initiativeCategories view large-9 medium-8 columns content">
    <h3><?= h($initiativeCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($initiativeCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($initiativeCategory->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Initiatives') ?></h4>
        <?php if (!empty($initiativeCategory->initiatives)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Initiative Category Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Edited By') ?></th>
                <th scope="col"><?= __('Photo') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($initiativeCategory->initiatives as $initiatives): ?>
            <tr>
                <td><?= h($initiatives->id) ?></td>
                <td><?= h($initiatives->title) ?></td>
                <td><?= h($initiatives->initiative_category_id) ?></td>
                <td><?= h($initiatives->description) ?></td>
                <td><?= h($initiatives->created_on) ?></td>
                <td><?= h($initiatives->created_by) ?></td>
                <td><?= h($initiatives->edited_on) ?></td>
                <td><?= h($initiatives->edited_by) ?></td>
                <td><?= h($initiatives->photo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Initiatives', 'action' => 'view', $initiatives->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Initiatives', 'action' => 'edit', $initiatives->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Initiatives', 'action' => 'delete', $initiatives->id], ['confirm' => __('Are you sure you want to delete # {0}?', $initiatives->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

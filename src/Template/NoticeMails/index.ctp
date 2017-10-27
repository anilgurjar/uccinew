<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Notice Mail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Notices'), ['controller' => 'Notices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notice'), ['controller' => 'Notices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="noticeMails index large-9 medium-8 columns content">
    <h3><?= __('Notice Mails') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('notice_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('notice_mail') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($noticeMails as $noticeMail): ?>
            <tr>
                <td><?= $this->Number->format($noticeMail->id) ?></td>
                <td><?= $noticeMail->has('notice') ? $this->Html->link($noticeMail->notice->title, ['controller' => 'Notices', 'action' => 'view', $noticeMail->notice->id]) : '' ?></td>
                <td><?= h($noticeMail->notice_mail) ?></td>
                <td><?= $this->Number->format($noticeMail->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $noticeMail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $noticeMail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $noticeMail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noticeMail->id)]) ?>
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

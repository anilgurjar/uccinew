<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notice Mail'), ['action' => 'edit', $noticeMail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notice Mail'), ['action' => 'delete', $noticeMail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noticeMail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notice Mails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notice Mail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notices'), ['controller' => 'Notices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notice'), ['controller' => 'Notices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="noticeMails view large-9 medium-8 columns content">
    <h3><?= h($noticeMail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Notice') ?></th>
            <td><?= $noticeMail->has('notice') ? $this->Html->link($noticeMail->notice->title, ['controller' => 'Notices', 'action' => 'view', $noticeMail->notice->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Notice Mail') ?></th>
            <td><?= h($noticeMail->notice_mail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($noticeMail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($noticeMail->status) ?></td>
        </tr>
    </table>
</div>

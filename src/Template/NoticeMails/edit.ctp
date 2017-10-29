<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $noticeMail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $noticeMail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Notice Mails'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Notices'), ['controller' => 'Notices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notice'), ['controller' => 'Notices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="noticeMails form large-9 medium-8 columns content">
    <?= $this->Form->create($noticeMail) ?>
    <fieldset>
        <legend><?= __('Edit Notice Mail') ?></legend>
        <?php
            echo $this->Form->input('notice_id', ['options' => $notices]);
            echo $this->Form->input('notice_mail');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

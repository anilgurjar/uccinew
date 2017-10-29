<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $advertisement->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $advertisement->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Advertisements'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="advertisements form large-9 medium-8 columns content">
    <?= $this->Form->create($advertisement) ?>
    <fieldset>
        <legend><?= __('Edit Advertisement') ?></legend>
        <?php
            echo $this->Form->input('image');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

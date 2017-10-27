<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Suggestions'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="suggestions form large-9 medium-8 columns content">
    <?= $this->Form->create($suggestion) ?>
    <fieldset>
        <legend><?= __('Add Suggestion') ?></legend>
        <?php
            echo $this->Form->input('comments');
            echo $this->Form->input('frequency');
            echo $this->Form->input('description');
            echo $this->Form->input('attachment');
            echo $this->Form->input('create_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

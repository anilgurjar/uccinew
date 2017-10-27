<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $affilationRegistration->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $affilationRegistration->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Affilation Registrations'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="affilationRegistrations form large-9 medium-8 columns content">
    <?= $this->Form->create($affilationRegistration) ?>
    <fieldset>
        <legend><?= __('Edit Affilation Registration') ?></legend>
        <?php
            echo $this->Form->input('logo');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

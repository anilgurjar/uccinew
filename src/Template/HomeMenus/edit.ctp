<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $homeMenu->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $homeMenu->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Home Menus'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="homeMenus form large-9 medium-8 columns content">
    <?= $this->Form->create($homeMenu) ?>
    <fieldset>
        <legend><?= __('Edit Home Menu') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

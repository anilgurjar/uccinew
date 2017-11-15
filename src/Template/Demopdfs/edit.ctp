<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $demopdf->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $demopdf->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Demopdfs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="demopdfs form large-9 medium-8 columns content">
    <?= $this->Form->create($demopdf) ?>
    <fieldset>
        <legend><?= __('Edit Demopdf') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('file_attachment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

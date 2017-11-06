<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Coo Coupons'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cooCoupons form large-9 medium-8 columns content">
    <?= $this->Form->create($cooCoupon) ?>
    <fieldset>
        <legend><?= __('Add Coo Coupon') ?></legend>
        <?php
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('valid_from');
            echo $this->Form->input('valid_to');
            echo $this->Form->input('coupon_code');
            echo $this->Form->input('coupon_number');
            echo $this->Form->input('flag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

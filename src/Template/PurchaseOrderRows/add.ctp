<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Purchase Order Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Orders'), ['controller' => 'PurchaseOrders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Order'), ['controller' => 'PurchaseOrders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseOrderRows form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseOrderRow) ?>
    <fieldset>
        <legend><?= __('Add Purchase Order Row') ?></legend>
        <?php
            echo $this->Form->input('purchase_order_id', ['options' => $purchaseOrders]);
            echo $this->Form->input('item_name');
            echo $this->Form->input('quty');
            echo $this->Form->input('rate');
            echo $this->Form->input('amount');
            echo $this->Form->input('date');
            echo $this->Form->input('time');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

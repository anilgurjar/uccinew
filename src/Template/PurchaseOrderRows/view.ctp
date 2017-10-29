<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchase Order Row'), ['action' => 'edit', $purchaseOrderRow->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchase Order Row'), ['action' => 'delete', $purchaseOrderRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrderRow->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Order Rows'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Order Row'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Purchase Orders'), ['controller' => 'PurchaseOrders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchase Order'), ['controller' => 'PurchaseOrders', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchaseOrderRows view large-9 medium-8 columns content">
    <h3><?= h($purchaseOrderRow->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Purchase Order') ?></th>
            <td><?= $purchaseOrderRow->has('purchase_order') ? $this->Html->link($purchaseOrderRow->purchase_order->id, ['controller' => 'PurchaseOrders', 'action' => 'view', $purchaseOrderRow->purchase_order->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quty') ?></th>
            <td><?= h($purchaseOrderRow->quty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rate') ?></th>
            <td><?= h($purchaseOrderRow->rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= h($purchaseOrderRow->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Time') ?></th>
            <td><?= h($purchaseOrderRow->time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchaseOrderRow->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($purchaseOrderRow->date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Item Name') ?></h4>
        <?= $this->Text->autoParagraph(h($purchaseOrderRow->item_name)); ?>
    </div>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchase Order Row'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Orders'), ['controller' => 'PurchaseOrders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Order'), ['controller' => 'PurchaseOrders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseOrderRows index large-9 medium-8 columns content">
    <h3><?= __('Purchase Order Rows') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('purchase_order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchaseOrderRows as $purchaseOrderRow): ?>
            <tr>
                <td><?= $this->Number->format($purchaseOrderRow->id) ?></td>
                <td><?= $purchaseOrderRow->has('purchase_order') ? $this->Html->link($purchaseOrderRow->purchase_order->id, ['controller' => 'PurchaseOrders', 'action' => 'view', $purchaseOrderRow->purchase_order->id]) : '' ?></td>
                <td><?= h($purchaseOrderRow->quty) ?></td>
                <td><?= h($purchaseOrderRow->rate) ?></td>
                <td><?= h($purchaseOrderRow->amount) ?></td>
                <td><?= h($purchaseOrderRow->date) ?></td>
                <td><?= h($purchaseOrderRow->time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchaseOrderRow->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchaseOrderRow->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseOrderRow->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseOrderRow->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

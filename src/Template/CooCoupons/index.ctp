<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Coo Coupon'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cooCoupons index large-9 medium-8 columns content">
    <h3><?= __('Coo Coupons') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valid_from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valid_to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coupon_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coupon_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cooCoupons as $cooCoupon): ?>
            <tr>
                <td><?= $this->Number->format($cooCoupon->id) ?></td>
                <td><?= $cooCoupon->has('company') ? $this->Html->link($cooCoupon->company->id, ['controller' => 'Companies', 'action' => 'view', $cooCoupon->company->id]) : '' ?></td>
                <td><?= h($cooCoupon->valid_from) ?></td>
                <td><?= h($cooCoupon->valid_to) ?></td>
                <td><?= h($cooCoupon->coupon_code) ?></td>
                <td><?= h($cooCoupon->coupon_number) ?></td>
                <td><?= $this->Number->format($cooCoupon->flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cooCoupon->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cooCoupon->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cooCoupon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cooCoupon->id)]) ?>
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

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Coo Coupon'), ['action' => 'edit', $cooCoupon->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Coo Coupon'), ['action' => 'delete', $cooCoupon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cooCoupon->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Coo Coupons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Coo Coupon'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cooCoupons view large-9 medium-8 columns content">
    <h3><?= h($cooCoupon->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $cooCoupon->has('company') ? $this->Html->link($cooCoupon->company->id, ['controller' => 'Companies', 'action' => 'view', $cooCoupon->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coupon Code') ?></th>
            <td><?= h($cooCoupon->coupon_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coupon Number') ?></th>
            <td><?= h($cooCoupon->coupon_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cooCoupon->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flag') ?></th>
            <td><?= $this->Number->format($cooCoupon->flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid From') ?></th>
            <td><?= h($cooCoupon->valid_from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid To') ?></th>
            <td><?= h($cooCoupon->valid_to) ?></td>
        </tr>
    </table>
</div>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Invoice Attestation'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invoiceAttestations index large-9 medium-8 columns content">
    <h3><?= __('Invoice Attestations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('origin_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('exporter') ?></th>
                <th scope="col"><?= $this->Paginator->sort('consignee') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manufacturer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('despatched_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_current') ?></th>
                <th scope="col"><?= $this->Paginator->sort('approve') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('approved_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('approve_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_tax_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('show_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_attachment') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_unit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_before_discount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('freight_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('coo_mail') ?></th>
                <th scope="col"><?= $this->Paginator->sort('verify_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('verify_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('authorised_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('authorised_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoiceAttestations as $invoiceAttestation): ?>
            <tr>
                <td><?= $this->Number->format($invoiceAttestation->id) ?></td>
                <td><?= $invoiceAttestation->has('company') ? $this->Html->link($invoiceAttestation->company->id, ['controller' => 'Companies', 'action' => 'view', $invoiceAttestation->company->id]) : '' ?></td>
                <td><?= $this->Number->format($invoiceAttestation->origin_no) ?></td>
                <td><?= h($invoiceAttestation->exporter) ?></td>
                <td><?= h($invoiceAttestation->consignee) ?></td>
                <td><?= h($invoiceAttestation->invoice_no) ?></td>
                <td><?= h($invoiceAttestation->invoice_date) ?></td>
                <td><?= h($invoiceAttestation->manufacturer) ?></td>
                <td><?= h($invoiceAttestation->despatched_by) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->unit_id) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->currency_id) ?></td>
                <td><?= h($invoiceAttestation->date_current) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->approve) ?></td>
                <td><?= h($invoiceAttestation->transaction_id) ?></td>
                <td><?= h($invoiceAttestation->payment_status) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->approved_by) ?></td>
                <td><?= h($invoiceAttestation->approve_on) ?></td>
                <td><?= h($invoiceAttestation->payment_amount) ?></td>
                <td><?= h($invoiceAttestation->payment_tax_amount) ?></td>
                <td><?= h($invoiceAttestation->show_amount) ?></td>
                <td><?= h($invoiceAttestation->invoice_attachment) ?></td>
                <td><?= h($invoiceAttestation->currency) ?></td>
                <td><?= h($invoiceAttestation->currency_unit) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->total_before_discount) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->discount) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->freight_amount) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->total_amount) ?></td>
                <td><?= h($invoiceAttestation->status) ?></td>
                <td><?= h($invoiceAttestation->coo_mail) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->verify_by) ?></td>
                <td><?= h($invoiceAttestation->verify_on) ?></td>
                <td><?= $this->Number->format($invoiceAttestation->authorised_by) ?></td>
                <td><?= h($invoiceAttestation->authorised_on) ?></td>
                <td><?= h($invoiceAttestation->payment_type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $invoiceAttestation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoiceAttestation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoiceAttestation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceAttestation->id)]) ?>
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

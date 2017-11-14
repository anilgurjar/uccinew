<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invoice Attestation'), ['action' => 'edit', $invoiceAttestation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invoice Attestation'), ['action' => 'delete', $invoiceAttestation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceAttestation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Invoice Attestations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice Attestation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invoiceAttestations view large-9 medium-8 columns content">
    <h3><?= h($invoiceAttestation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $invoiceAttestation->has('company') ? $this->Html->link($invoiceAttestation->company->id, ['controller' => 'Companies', 'action' => 'view', $invoiceAttestation->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Exporter') ?></th>
            <td><?= h($invoiceAttestation->exporter) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Consignee') ?></th>
            <td><?= h($invoiceAttestation->consignee) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice No') ?></th>
            <td><?= h($invoiceAttestation->invoice_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manufacturer') ?></th>
            <td><?= h($invoiceAttestation->manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Despatched By') ?></th>
            <td><?= h($invoiceAttestation->despatched_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Id') ?></th>
            <td><?= h($invoiceAttestation->transaction_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Status') ?></th>
            <td><?= h($invoiceAttestation->payment_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Amount') ?></th>
            <td><?= h($invoiceAttestation->payment_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Tax Amount') ?></th>
            <td><?= h($invoiceAttestation->payment_tax_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Show Amount') ?></th>
            <td><?= h($invoiceAttestation->show_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Attachment') ?></th>
            <td><?= h($invoiceAttestation->invoice_attachment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($invoiceAttestation->currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Unit') ?></th>
            <td><?= h($invoiceAttestation->currency_unit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($invoiceAttestation->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coo Mail') ?></th>
            <td><?= h($invoiceAttestation->coo_mail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Type') ?></th>
            <td><?= h($invoiceAttestation->payment_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Origin No') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->origin_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Id') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->unit_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Id') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->currency_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Approve') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->approve) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Approved By') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->approved_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Before Discount') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->total_before_discount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->discount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Freight Amount') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->freight_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Amount') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->total_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Verify By') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->verify_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Authorised By') ?></th>
            <td><?= $this->Number->format($invoiceAttestation->authorised_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Date') ?></th>
            <td><?= h($invoiceAttestation->invoice_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Current') ?></th>
            <td><?= h($invoiceAttestation->date_current) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Approve On') ?></th>
            <td><?= h($invoiceAttestation->approve_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Verify On') ?></th>
            <td><?= h($invoiceAttestation->verify_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Authorised On') ?></th>
            <td><?= h($invoiceAttestation->authorised_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Port Of Loading') ?></h4>
        <?= $this->Text->autoParagraph(h($invoiceAttestation->port_of_loading)); ?>
    </div>
    <div class="row">
        <h4><?= __('Final Destination') ?></h4>
        <?= $this->Text->autoParagraph(h($invoiceAttestation->final_destination)); ?>
    </div>
    <div class="row">
        <h4><?= __('Port Of Discharge') ?></h4>
        <?= $this->Text->autoParagraph(h($invoiceAttestation->port_of_discharge)); ?>
    </div>
    <div class="row">
        <h4><?= __('Other Info') ?></h4>
        <?= $this->Text->autoParagraph(h($invoiceAttestation->other_info)); ?>
    </div>
    <div class="row">
        <h4><?= __('Verify Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($invoiceAttestation->verify_remarks)); ?>
    </div>
    <div class="row">
        <h4><?= __('Authorised Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($invoiceAttestation->authorised_remarks)); ?>
    </div>
</div>

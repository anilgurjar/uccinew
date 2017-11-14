<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $invoiceAttestation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceAttestation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Invoice Attestations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invoiceAttestations form large-9 medium-8 columns content">
    <?= $this->Form->create($invoiceAttestation) ?>
    <fieldset>
        <legend><?= __('Edit Invoice Attestation') ?></legend>
        <?php
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('origin_no');
            echo $this->Form->input('exporter');
            echo $this->Form->input('consignee');
            echo $this->Form->input('invoice_no');
            echo $this->Form->input('invoice_date');
            echo $this->Form->input('manufacturer');
            echo $this->Form->input('despatched_by');
            echo $this->Form->input('port_of_loading');
            echo $this->Form->input('final_destination');
            echo $this->Form->input('port_of_discharge');
            echo $this->Form->input('unit_id');
            echo $this->Form->input('currency_id');
            echo $this->Form->input('date_current');
            echo $this->Form->input('approve');
            echo $this->Form->input('transaction_id');
            echo $this->Form->input('payment_status');
            echo $this->Form->input('approved_by');
            echo $this->Form->input('approve_on');
            echo $this->Form->input('payment_amount');
            echo $this->Form->input('payment_tax_amount');
            echo $this->Form->input('show_amount');
            echo $this->Form->input('invoice_attachment');
            echo $this->Form->input('currency');
            echo $this->Form->input('currency_unit');
            echo $this->Form->input('other_info');
            echo $this->Form->input('total_before_discount');
            echo $this->Form->input('discount');
            echo $this->Form->input('freight_amount');
            echo $this->Form->input('total_amount');
            echo $this->Form->input('status');
            echo $this->Form->input('coo_mail');
            echo $this->Form->input('verify_by');
            echo $this->Form->input('verify_on');
            echo $this->Form->input('verify_remarks');
            echo $this->Form->input('authorised_remarks');
            echo $this->Form->input('authorised_by');
            echo $this->Form->input('authorised_on');
            echo $this->Form->input('payment_type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

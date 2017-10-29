<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Business Visas'), ['controller' => 'BusinessVisas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Business Visa'), ['controller' => 'BusinessVisas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Certificate Origins'), ['controller' => 'CertificateOrigins', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Certificate Origin'), ['controller' => 'CertificateOrigins', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Company Member Types'), ['controller' => 'CompanyMemberTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company Member Type'), ['controller' => 'CompanyMemberTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Member Fees'), ['controller' => 'MemberFees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member Fee'), ['controller' => 'MemberFees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Member Receipts'), ['controller' => 'MemberReceipts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member Receipt'), ['controller' => 'MemberReceipts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companies form large-9 medium-8 columns content">
    <?= $this->Form->create($company) ?>
    <fieldset>
        <legend><?= __('Add Company') ?></legend>
        <?php
            echo $this->Form->input('role_id', ['options' => $roles]);
            echo $this->Form->input('gst_number');
            echo $this->Form->input('id_card_no');
            echo $this->Form->input('company_organisation');
            echo $this->Form->input('address');
            echo $this->Form->input('city');
            echo $this->Form->input('pincode');
            echo $this->Form->input('end_products_item_dealing_in');
            echo $this->Form->input('office_telephone');
            echo $this->Form->input('residential_telephone');
            echo $this->Form->input('company_email_id');
            echo $this->Form->input('grade');
            echo $this->Form->input('category');
            echo $this->Form->input('classification');
            echo $this->Form->input('year_of_joining');
            echo $this->Form->input('member_type_id');
            echo $this->Form->input('turn_over_id');
            echo $this->Form->input('due_amount');
            echo $this->Form->input('member_flag');
            echo $this->Form->input('website');
            echo $this->Form->input('tag');
            echo $this->Form->input('infrastructure');
            echo $this->Form->input('brief_description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

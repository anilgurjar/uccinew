
<!--<div class="suppliers index large-9 medium-8 columns content">
    <h3><?= __('Suppliers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gst_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?= $this->Number->format($supplier->id) ?></td>
                <td><?= h($supplier->name) ?></td>
                <td><?= h($supplier->company) ?></td>
                <td><?= h($supplier->email) ?></td>
                <td><?= h($supplier->mobile) ?></td>
                <td><?= h($supplier->gst_number) ?></td>
                <td><?= $this->Number->format($supplier->flag) ?></td>
                <td><?= h($supplier->created_on) ?></td>
                <td><?= $this->Number->format($supplier->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $supplier->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplier->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplier->id)]) ?>
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
</div>-->


<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title"><?= __('Suppliers') ?></h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
           
               <tr>
                <th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th> 
				<th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gst_number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
           
            </tr>
        </thead>
        <tbody> 
             <?php foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?= $this->Number->format($supplier->id) ?></td>
                <td><?= h($supplier->name) ?></td>
                <td><?= h($supplier->company) ?></td>
                <td><?= h($supplier->email) ?></td>
                <td><?= h($supplier->mobile) ?></td>
				 <td><?= $this->Text->autoParagraph($supplier->address) ?></td>
              
                <td><?= h($supplier->gst_number) ?></td>
                <td>
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('action' => 'edit',$supplier->id),['class' => 'btn btn-sm btn-warning btn-flat', 'target' => '_self','escape'=>false]); ?>
				</td>
				
				</tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
  
  </div>
 </div>



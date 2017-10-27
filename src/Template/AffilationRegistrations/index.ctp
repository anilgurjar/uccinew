<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Affilation Registration'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="affilationRegistrations index large-9 medium-8 columns content">
    <h3><?= __('Affilation Registrations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('logo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($affilationRegistrations as $affilationRegistration): ?>
            <tr>
                <td><?= $this->Number->format($affilationRegistration->id) ?></td>
                <td><?= h($affilationRegistration->logo) ?></td>
                <td><?= h($affilationRegistration->created_on) ?></td>
                <td><?= $this->Number->format($affilationRegistration->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $affilationRegistration->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $affilationRegistration->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $affilationRegistration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $affilationRegistration->id)]) ?>
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
	  <h3 class="box-title">Affilation view</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
               <tr>
                <th scope="col">Sr no.</th>
                <th scope="col">Logo</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach ($affilationRegistrations as $affilationRegistration): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
               
                <td><?php echo $this->Html->Image('/'.$affilationRegistration->logo,['width'=>'200px','height'=>'80px']); ?>
								
				</td>
             <td>  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $affilationRegistration->id], ['confirm' => __('Are you sure you want to delete this photo '),'class'=>'btn btn-primary btn-sm']) ?>
			 </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
  </div>
 </div>

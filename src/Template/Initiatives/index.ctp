<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Initiatives</h3>
	</div>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
				 <th scope="col"><?= $this->Paginator->sort('Category') ?></th>
              
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
               
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $z=1; foreach ($initiatives as $initiative): ?>
            <tr>
                <td><?= $z++ ?></td>
                <td><?= h($initiative->title) ?></td>
				<td><?= h($initiative->initiative_category->name) ?></td>
              
                <td><?= h(date("d-m-Y",strtotime($initiative->created_on))) ?></td>
                
                <td class="actions">
                   <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $initiative->id]) ?>-->
				    
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $initiative->id],['class' => 'btn btn-warning btn-sm','escape'=>false]) ?>
                   <!-- <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $initiative->id], ['confirm' => __('Are you sure you want to delete # {0}?', $initiative->id)]) ?> -->
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  
  
  </div>
 </div>
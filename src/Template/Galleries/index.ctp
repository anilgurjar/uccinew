<!--<div class="galleries index large-9 medium-8 columns content">
    <h3><?= __('Galleries') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event') ?></th>
                <th scope="col"><?= $this->Paginator->sort('blog') ?></th>
               
                <th scope="col"><?= $this->Paginator->sort('cover_image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created on') ?></th>
               
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($galleries as $gallery): ?>
            <tr>
                <td><?= $this->Number->format($gallery->id) ?></td>
                <td><?= $gallery->has('event') ? $this->Html->link($gallery->event->name, ['controller' => 'Events', 'action' => 'view', $gallery->event->id]) : '' ?></td>
                <td><?= $gallery->has('blog') ? $this->Html->link($gallery->blog->title, ['controller' => 'Blogs', 'action' => 'view', $gallery->blog->id]) : '' ?></td>
                <td><?= h($gallery->name) ?></td>
                <td><?= h($gallery->cover_image) ?></td>
                <td><?= h($gallery->created_on) ?></td>
                <td><?= $this->Number->format($gallery->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $gallery->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $gallery->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $gallery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gallery->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
</div>-->


<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Galleries</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
           
               <tr>
					<th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
					<th scope="col"><?= $this->Paginator->sort('Name') ?></th>
					<th scope="col"><?= $this->Paginator->sort('cover_image') ?></th>
					<th scope="col"><?= $this->Paginator->sort('created on') ?></th>
					<th scope="col" class="actions"><?= __('Actions') ?></th>
			   
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach ($galleries as $gallery): $i++; ?>
            <tr>
				<td><?= $i ?></td>
				<td> <?= h($gallery->name) ?> </td>
				<td><?php echo $this->Html->Image('/'.$gallery->cover_image,['width'=>'30px','height'=>'30px']); ?></td>
				<td><?= h(date("d-m-Y",strtotime($gallery->created_on))) ?></td>
				<td class="actions">
					<?= $this->Html->link(__('Add Image'), ['controller'=>'GalleryPhotos','action' => 'add', $gallery->id],['class'=>'btn btn-primary btn-sm']) ?>
				</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
  </div>
 </div>

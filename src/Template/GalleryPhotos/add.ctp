<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Gallery Photos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Galleries'), ['controller' => 'Galleries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gallery'), ['controller' => 'Galleries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="galleryPhotos form large-9 medium-8 columns content">
    <?= $this->Form->create($galleryPhoto) ?>
    <fieldset>
        <legend><?= __('Add Gallery Photo') ?></legend>
        <?php
            echo $this->Form->input('gallery_id', ['options' => $galleries]);
            echo $this->Form->input('image');
            echo $this->Form->input('description');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>-->


<div class="col-md-12">

		<div class="box box-primary">
			<div class="box-header with-border">
					
			<h3 class="box-title">Add Gallery Photo</h3>
			</div>
			<?php echo $this->Form->create($galleryPhoto, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							
							<div class="col-md-6">
									<table id="file_table" style="line-height:2.5">
									<tr>
										<td>
										<label class="control-label">Gallery photo</label>
										<?= $this->Form->file('photo',['multiple'=>'multiple']); ?>
										</td>
										<td></td>
										<td></td>
									</tr>
								</table>
							</div>	
							
							 <div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Description</label>
									<?php echo $this->Form->input('description', ['label' => false,'placeholder'=>'Description','class'=>'form-control']); ?>
								</div>
								<input type="hidden" name="gallery_id" value="<?php echo $id ; ?>">
							</div>
					</div>
					
					
					
			
				</div>
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button(__('Add Gallery Photo') . $this->Html->tag('i', ''),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
					
					<?= $this->Html->link('Skip', ['controller'=>'Galleries','action' => 'index'],['escape' => false,'class'=>'btn btn-info']) ?>
					
					</center>
					
				</div>
				<?php echo $this->Form->end(); ?>
				
				
<div class="box-header with-border">
	  <h3 class="box-title">Gallery Photo View</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
              
                <th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
				
                <th scope="col"><?= $this->Paginator->sort('Gallery photo') ?></th>
				<th scope="col"><?= $this->Paginator->sort('Description') ?></th>
            
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach ($GalleryPhoto_lists as $GalleryPhoto_list): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
					<td>
					
						<?php echo $this->html->image('/'.$GalleryPhoto_list->image,['width'=>'50px','height'=>'50px']); ?>
					</td>
                 <td>
					<?= h($GalleryPhoto_list->description) ?>
				 </td>
                 
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
				
				
		</div>
			
</div>




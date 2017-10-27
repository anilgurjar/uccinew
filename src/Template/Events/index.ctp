<div class="col-md-12" style="padding-bottom: 8px;">
	<div class="pull-right" >
	<?php if($status=="draft"){ $class1="btn btn-primary"; }else{ $class1="btn btn-default"; }
			if(empty($status)){  $class1="btn btn-primary"; }
	if($status=="published"){ $class2="btn btn-primary"; }else{ $class2="btn btn-default"; } ?>
		<?= $this->Html->link('Draft','/Events/index/draft',['class' => $class1]); ?> 
		<?= $this->Html->link('Published','/Events/index/published',['class' => $class2]) ?>

	</div>
</div>



<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Events</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
              
                <th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th> 
           
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach ($events as $event): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
                <td><?= h($event->name) ?></td>
                <td><?= h($event->date) ?></td>
                <td><?= h(date("h:i A",strtotime($event->time))) ?></td>
                <td><?= h($event->event_category->name) ?></td>
                <td><?= h($event->location) ?></td>
                 <td class="actions">
                  <?= $this->Html->link(__('View'), ['action' => 'view', $event->id],['class'=>'btn btn-success btn-sm']) ?>              
                   <!--   <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>-->
					 <?php if($status!="published"){  
					 
						echo $this->Html->link(__('Edit'), ['action' => 'edit', $event->id],['class' => 'btn btn-warning btn-sm','escape'=>false]) ;  
						echo' '. $this->Html->link(__('Publish') ,['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#published'.$event->id,'class' => 'btn btn-primary btn-sm re_open',
							'escape' => false]) ;

					 } ?>
					 
							
							
							<?php  echo $this->Form->create($event_datas, ['type' => 'post','id'=>'validationForm2'.$event->id,'enctype' => 'multipart/form-data']); ?>					
								<div class="modal fade" id="published<?php echo $event->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel" style="color:black;">Are you sure you want to publish this events ?</h4>
										<input type="hidden" name="event_id" value="<?php echo $event->id ; ?>">								
									  </div>
									 
									  <div class="modal-footer">
										
											<?= $this->Form->button(__('Yes') . $this->Html->tag('i', ''),['class'=>'btn btn-success publish','type'=>'submit','event_id'=>$event->id]);
											?>
											<button type="button" class="btn btn-default cls" data-dismiss="modal">No</button>
											
									  </div>
									</div>
								  </div>
								</div>
							 <?= $this->Form->end() ?>	

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
  </div>
 </div>

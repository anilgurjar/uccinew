<div class="col-md-12" style="padding-bottom: 8px;">
	<div class="pull-right" >
	<?php if($status=="draft"){ $class1="btn btn-primary"; }else{ $class1="btn btn-default"; }
 if(empty($status)){  $class1="btn btn-primary"; }
	if($status=="published"){ $class2="btn btn-primary"; }else{ $class2="btn btn-default"; } ?>
		<?= $this->Html->link('Draft','/Blogs/index/draft',['class' => $class1]); ?>
<?php if($role_id==1){ ?>		
		<?= $this->Html->link('Published','/Blogs/index/published',['class' => $class2]) ?>
<?php } ?>

	</div>
</div>

<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Blogs</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
               <tr>
               <th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cover_image') ?></th>
				 <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
               <?php if($status!="published"){ ?>  <th scope="col" class="actions"><?= __('Actions') ?></th> <?php } ?>
            </tr>
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach ($blogs as $blog): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
                  <td><?= h($blog->title) ?></td>
                <td> <?= $this->html->image('/'.$blog->cover_image,['width'=>'30px','height'=>'30px']) ?></td>
                 <td><?= h(date("d-m-Y",strtotime($blog->created_on))) ?></td>
                 <td class="actions">
                  <!--  <?= $this->Html->link(__('View'), ['action' => 'view', $blog->id]) ?>              
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $blog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id)]) ?>-->
					 <?php if($status!="published"){  
					 
						echo $this->Html->link(__('Edit'), ['action' => 'edit', $blog->id],['class' => 'btn btn-warning btn-sm','escape'=>false]) ; 
							 if($role_id==1){ 
						echo' '. $this->Html->link(__('Publish') ,['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#published'.$blog->id,'class' => 'btn btn-primary btn-sm re_open',
							'escape' => false]) ;
							 }
					 } ?>
					 
							
							
							<?php  echo $this->Form->create($Blogs, ['type' => 'post','id'=>'validationForm2'.$blog->id,'enctype' => 'multipart/form-data']); ?>					
								<div class="modal fade" id="published<?php echo $blog->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel" style="color:black;">Are you sure you want to publish this blog ?</h4>
										<input type="hidden" name="event_id" value="<?php echo $blog->id ; ?>">								
									  </div>
									 
									  <div class="modal-footer">
										
											<?= $this->Form->button(__('Yes') . $this->Html->tag('i', ''),['class'=>'btn btn-success publish','type'=>'submit','event_id'=>$blog->id]);
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


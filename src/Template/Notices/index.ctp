<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Notice View </h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Sr.no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('notice_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_type_id') ?></th>
                <th scope="col" width="50%"><?= $this->Paginator->sort('Subject') ?></th>
				<th scope="col"><?= $this->Paginator->sort('Status') ?></th>
				<th scope="col"><?= $this->Paginator->sort('Created on') ?></th>
				
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody> 
            <?php  $i=0; foreach ($notices as $notice): 
				$notice_mails=$notice->notice_mails ;
				foreach($notice_mails as $notice_mail){
					$status=$notice_mail->status;
				
				}
				
				
				
			$i++; ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= h($notice->notice_category->category_name) ?></td>
                <td><?= @$notice->master_member_type->member_type ?></td>
                <td><?= h($notice->title) ?></td>
				
				 <td><?php  if($status==2){echo" <strong style='color:#dd4b39;'> Unsend </strong>"; }elseif($status==0){ echo"<strong style='color:#f39c12;'>Pending </strong>"; }else{ echo"<strong style='color:#00a65a;'>Sent </strong>"; } ?></td>
				
				<td><?= h(date("d-m-Y",strtotime($notice->created_on))) ?></td>
                <td class="actions">
                  
					
					<?php echo $this->Html->link(' view', array('action' => 'view',$notice->id),['class' => 'btn btn-sm btn-primary btn-flat  hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
				
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('action' => 'edit',$notice->id),['class' => 'btn btn-sm btn-warning btn-flat', 'target' => '_self','escape'=>false]); ?>
                   
					
                   
                    <!--s<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notice->id)]) ?>-->
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
  </div>
 </div>





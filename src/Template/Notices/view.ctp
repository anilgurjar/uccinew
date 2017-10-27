<div class="col-md-12">
<div class="box box-primary">
	<div class="col-md-12">
		<h4> Notice View </h4>
	</div>
    <table class="table" >
        <tr>
            <th scope="row"><?= __('Notice Category') ?></th>
            <td><?= h($notice->notice_category->category_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= h($notice->title) ?></td>
        </tr>
		<?php if($notice->file=="true"){ ?>
        <tr>
            <th scope="row"><?= __('Attachment') ?></th>
            <td><?php
					foreach($files as $data){
						
						echo $data."<br/>" ;
					}
			
			   ?></td>
        </tr>
		<?php } ?>
    </table>
	
	
    <div class="col-md-12">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph($notice->description); ?>
    </div>
	<br/>
    <div class="related">
	 <div class="col-md-12">
        <h4><?= __('Notice Mail Reports') ?></h4>
		 </div>
        <?php if (!empty($notice->notice_mails)): ?>
        <table cellpadding="0" cellspacing="0" class="table table-bordered">
            <tr style="background-color:#3C8DBC; color:#fff">
                <th scope="col"><?= __('Id') ?></th>
				<th scope="col"><?= __('Member Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <!--<th scope="col" class="actions"><?= __('Actions') ?></th>-->
            </tr>
            <?php $i=0;  foreach ($notice->notice_mails as $noticeMails): $i++;
					$alternate=$noticeMails->alternate;
					
						$member_name=$noticeMails->user->member_name;
						$email=$noticeMails->user->email;
					
					
			?>
            <tr>
                <td><?= h($i) ?></td>
				 <td><?= h($member_name) ?></td>
                <td><?= h($email) ?></td>
                <td><?php $status=h($noticeMails->status); if($status==2){echo" <strong style='color:#dd4b39;'> Unsend </strong>"; }elseif($status==0){ echo"<strong style='color:#f39c12;'>Pending </strong>"; }else{ echo"<strong style='color:#00a65a;'>Sent </strong>"; } ?></td>
               <!--<td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'NoticeMails', 'action' => 'view', $noticeMails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'NoticeMails', 'action' => 'edit', $noticeMails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'NoticeMails', 'action' => 'delete', $noticeMails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $noticeMails->id)]) ?>
                </td>-->
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>
<div>
	 <?php $i=0; foreach ($purchaseOrders as $purchaseOrder): $i++; 
	    ?>
	<tr>
		<td><?= $i ?></td>
		<td><?= sprintf("%04d", $purchaseOrder['purchase_order_no'])  ?></td>
		<td><?= $purchaseOrder['supplier']['name'] ?></td>
		<td><?= h($purchaseOrder['delivery']) ?></td>
		<td><?= h($purchaseOrder['payment_type']) ?></td>
		<td><?= h(date("d-m-Y",strtotime($purchaseOrder['date']))) ?></td>
		<td><?= h($purchaseOrder['time']) ?></td>
		<td><?= h($purchaseOrder['tin_no']) ?></td>
		<td><?= h($purchaseOrder['freight']) ?></td>
		<td class="actions">
		
		<?php 
			echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('action' => 'view',$purchaseOrder['id']),['class' => 'btn btn-sm btn-primary btn-flat  hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
		
		<?php echo $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('action' => 'edit',$purchaseOrder['id']),['class' => 'btn btn-sm btn-warning btn-flat', 'target' => '_self','escape'=>false]); ?>
		   
		  
			<?php  $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseOrder['id']], ['confirm' => __('Are you sure you want to delete ?', $purchaseOrder->id),'class' => 'btn btn-danger btn-sm btn-flat']) ?>
			
		</td>
	</tr>
	<?php endforeach; ?>
</div>
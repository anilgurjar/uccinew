<div class="col-md-12">
  <!-- Horizontal Form -->

  <div class="box box-primary">  
		<center>
	<?php if($role_id==1 or $role_id==4 ){  ?>
	<div class="box-header with-border no-print ">
		<div class="col-sm-2">
			<?php echo $this->Form->input('purchase_order_no',['label'=>false,'class'=>'form-control purchase_order_no','name'=>'purchase_order_no','type'=>'text','placeholder'=>'Purchase Order No']);  ?>
		</div>
		<div class="col-sm-2">
			<?php	 echo $this->Form->input('supplier',['label'=>false,'class'=>'form-control supplier','name'=>'supplier','type'=>'text','placeholder'=>'Supplier Name']);  ?>
		</div>	
		<div class=" col-sm-3  ">
			<div class=" input-group input-large  input-daterange date-picker" data-date-format="dd-mm-yyyy">	
				<?php  echo $this->Form->input('from', ['label' => false,'class'=>'form-control from ', 'placeholder'=>'Date From']); ?>
				<span class="input-group-addon" style="background-color:e5e5e5 !important;">
				To </span>
				<?php    echo $this->Form->input('to', ['label' => false,'class'=>'form-control to ','format'=>"yyyy/mm/dd",'placeholder'=>'Date To']); ?>
			</div>	
		</div>
		<div class="col-sm-2">
			<input type="button"  class="go  btn btn-info btn-sm" value="GO">
		</div>
		
	</div>
	
	 <?php   }   ?>
	</center>
		<div class="box-header with-border">
		  <h3 class="box-title"><?= __('Purchase Orders') ?></h3>
		</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
             <tr>
                <th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Purchase order no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Supplier name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Delivery') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Payment Type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Time') ?></th>
                
                <th scope="col"><?= $this->Paginator->sort('Tin_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Freight') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody class="show_div"> 
             <?php $i=0; foreach ($purchaseOrders as $purchaseOrder): $i++; 
			 
			 ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= sprintf("%04d", $purchaseOrder->purchase_order_no)  ?></td>
                <td><?= $purchaseOrder->supplier->name ?></td>
                <td><?= h($purchaseOrder->delivery) ?></td>
                <td><?= h($purchaseOrder->payment_type) ?></td>
                <td><?= h(date("d-m-Y",strtotime($purchaseOrder->date))) ?></td>
				<td><?= h($purchaseOrder->time) ?></td>
                <td><?= h($purchaseOrder->tin_no) ?></td>
                <td><?= h($purchaseOrder->freight) ?></td>
                <td class="actions">
				
				<?php 
					echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('action' => 'view',$purchaseOrder->id),['class' => 'btn btn-sm btn-primary btn-flat  hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
				
				<?php echo $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('action' => 'edit',$purchaseOrder->id),['class' => 'btn btn-sm btn-warning btn-flat', 'target' => '_self','escape'=>false]); ?>
                   
                  
                    <?php  $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchaseOrder->id], ['confirm' => __('Are you sure you want to delete ?', $purchaseOrder->id),'class' => 'btn btn-danger btn-sm btn-flat']) ?>
					
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
  
  </div>
  <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
 </div>
 
 
 
 
 <?php
echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js');

?>
<script>
$(document).ready(function(){ 

	
	$('.go').click(function(){
		var supplier = $('.supplier').val();
		var purchase_order_no = $('.purchase_order_no').val();
		var datefrom = $('.from').val();
		var dateto = $('.to').val();
		
		if(supplier !=''  || purchase_order_no!='' || datefrom!='' || dateto!=''){
			var url="<?php echo $this->Url->build(['controller'=>'PurchaseOrders','action'=>'filterdata']);?>";
			url=url+'?supplier='+supplier+'&purchase_order_no='+purchase_order_no+'&datefrom='+datefrom+'&dateto='+dateto;
			
			$.ajax({ 
					url:url,
					type:"GET",
				}).done(function(response){
					
					$('.show_div').html(response);
					
				});
				
		}
	
	});	
		
	
	
});
</script>

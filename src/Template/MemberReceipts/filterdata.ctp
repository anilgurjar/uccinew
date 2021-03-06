<?php
if(!empty($member_receipt)){
	$member_receipt = $member_receipt->toArray();
}if(!empty($general_receipt)){
	
	$general_receipt = $general_receipt->toArray();
}


if(!empty($member_receipt) || !empty($general_receipt))
{ 

	?>
<div class="table-responsive no-padding">
	<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
		<thead>
			 <tr>
				<th>S.No.</th>
				<th>Date</th>
				<?php
				if(!empty($member_receipt)){
					?>
					<th>Invoice No.</th>
					<?php
				}
				?>
				<th>Receipt No.</th>
				<th>Company</th>
				<th>Mode of Payment</th>
				<th>Amount</th>
				<th>Status</th>
				<th><center>Send Mail/SMS</center><center>
			<?php echo $this->Form->checkbox('accc', ['hiddenField' => false,'class'=>'mail_check_all']);  ?>	
			</center></th>
				<th style="text-align:center">View</th>
				<th style="text-align:center">Edit</th>
				<!--<th style="text-align:center">Delete</th>-->
			</tr>
		</thead>
		<tbody class="show_div">
		<?php
		$sr_no=0;
		$grand_total=0;
		if(!empty($member_receipt)){
			//pr($member_receipt);
		foreach($member_receipt as $data){
			$member_fee_member_receipts=$data->member_fee_member_receipts;
			foreach($member_fee_member_receipts as $member_fee_member_receipt){
			$status=$data->mail_send;
				$total=0;
				$sr_no++;
				?>
				<tr>
				<td><?php echo $sr_no; ?></td>
				<td><?php echo date('d-m-Y', strtotime($data->date_current)); ?></td>
				<td><?php echo sprintf("%04d", $member_fee_member_receipt->member_fee->invoice_no); ?></td>
				<td><?php echo sprintf("%04d", $data->receipt_no); ?></td>
				<td><?php echo $data->company->company_organisation; ?></td>
				<td><?php echo $data->amount_type; ?></td>
				<td><?php echo $total=$data->amount; ?></td>
				<td width="100px"> <?php if($status==0){echo" <strong style='color:#dd4b39;'> Unsend </strong>"; }elseif($status==1){ echo"<strong style='color:#f39c12;'>Pending </strong>"; }else{ echo"<strong style='color:#00a65a;'>Sent </strong>"; } ?> </td>
				<td><center>
			
			<?php  echo $this->Form->checkbox('published', ['hiddenField' => false,'class'=>'mail_check','name'=>'mail[]','value'=>$data->receipt_id]);  ?>
				
				</center>
				</td>
				
				<td><center>
			
				<?php 
				echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'MemberReceipts', 'action' => 'member_receipt_pdf',$data->receipt_id,$member_fee_member_receipt->member_fee_id),['class' => 'btn btn-sm btn-primary btn-flat pull-right hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
				
				</center>
				</td>
				<td><center>
				<?= $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('controller' => 'MemberReceipts', 'action' => 'EditMemberReceipt',$member_fee_member_receipt->member_fee->invoice_no,$data->receipt_id),['class' => 'btn btn-sm btn-warning btn-flat', 'target' => '_self','escape'=>false]) ?>
				</center></td>
				<!--<td><center><?= $this->Form->postLink(__('<i class="fa fa-trash-o"></i> Delete'),
						['action' => 'delete_member_receipt', $data->receipt_id],
						[
							'block' => true,
							'class' => 'btn btn-danger btn-sm btn-flat',
							'escape' => false,
							'confirm' => __('Are you sure you want to delete?')
						]
					)
				?>
				</center></td>-->
				</tr>
				<?php
				$grand_total+=$total;
			
			
		} 
		}
		}
		
		if(!empty($general_receipt)){
		foreach($general_receipt as $general_data)
		{
			
			$status=$general_data->mail_send;
				$total=0;
				$sr_no++;
			
				?>
				<tr>
				<td><?php echo $sr_no; ?></td>
				<td><?php echo date('d-m-Y', strtotime($general_data->date_current)); ?></td>
				<td><?php echo sprintf("%04d", $general_data->receipt_no); ?></td>
				<td><?php echo $general_data->company->company_organisation; ?></td>
				<td><?php echo $general_data->amount_type; ?></td>
				<td><?php echo $total=$general_data->amount; ?></td>
				<td width="100px"> <?php if($status==0){echo" <strong style='color:#dd4b39;'> Unsend </strong>"; }elseif($status==1){ echo"<strong style='color:#f39c12;'>Pending </strong>"; }else{ echo"<strong style='color:#00a65a;'>Sent </strong>"; } ?> </td>
				<td><center>
				<?php  echo $this->Form->checkbox('published', ['hiddenField' => false,'class'=>'mail_check','name'=>'mail[]','value'=>$general_data->receipt_id]);  ?>
				</center></td>
				<td><center>
				<?php 
				echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'MemberReceipts', 'action' => 'general_receipt_pdf',$general_data->receipt_id),['class' => 'btn btn-sm btn-primary btn-flat pull-right hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
				</center></td>
				<td><center>
				<?= $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('controller' => 'MemberReceipts', 'action' => 'EditGeneralReceipt',$general_data->receipt_id),['class' => 'btn btn-sm btn-warning btn-flat', 'target' => '_self','escape'=>false]) ?>
				</center></td>
				<!--<td><center><?= $this->Form->postLink(__('<i class="fa fa-trash-o"></i> Delete'),
						['action' => 'delete_member_receipt', $general_data->receipt_id],
						[
							'block' => true,
							'class' => 'btn btn-danger btn-sm btn-flat',
							'escape' => false,
							'confirm' => __('Are you sure you want to delete?')
						]
					)
				?>
				</center></td>-->
				</tr>
				<?php
				$grand_total+=$total;
			
		}  }
		?>
		<tfoot>
			<tr>
			<th colspan="5" style="text-align:right;"><strong>Sub Total</strong></th>
			<th colspan="4"><strong><?php echo $grand_total; ?></strong></th>
			</tr>
			<tr>
			<td colspan="9">
			<center>
				<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-mail-forward']) . ' Send Mail',['class'=>'btn btn-success btn-flat','type'=>'submit','name'=>'invoice_receipt_send']); ?>
			</center>
			</td>
			</tr>
		</tbody>
	</table>
</div>
<?php
}
//echo $this->fetch('postLink');
?>
</div>

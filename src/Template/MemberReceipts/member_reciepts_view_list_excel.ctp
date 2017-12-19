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
					<th>Reciept Type</th>
					<th>Mode of Payment</th>
					<th>Amount</th>
					<th>Narration</th>
					<th>Status</th>
				
					
				</tr>
			</thead>
			<tbody>
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
							<td><?php echo $data->receipt_type; ?></td>
							<td><?php echo $data->amount_type; ?></td>
							<td><?php echo $total=$data->amount; ?></td>
							<td><?php echo $total=$data->narration; ?></td>
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
					<td><?php echo $general_data->receipt_type; ?></td>
					<td><?php echo $general_data->amount_type; ?></td>
					<td><?php echo $total=$general_data->amount; ?></td>
					<td><?php echo $total=$general_data->narration; ?></td>
					
					
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
<?php  }  ?>	
<div class="col-md-12">
  <!-- Horizontal Form -->
	<div class="box box-primary">
		<div class="box-header with-border no-print">
			<center>
			<h3 class="box-title"><strong>Coo Coupons</strong></h3>
			</center>
		</div>
	<div class="box-body">
	  <div class="col-sm-12 no-print">
			<div class="table-responsive no-padding">
			<table class="table table-bordered" id="parant_table" style="width:100%;">
				<thead>
					<tr>
						<th>Sr.No.</th><th>Company Name</th><th>Valid From</th><th>Valid To</th><th>Coupon Code</th><th>Status</th>
					</tr>
				</thead>
				<tbody class="show_div">
				<?php $sr=0;  foreach ($cooCoupons as $cooCoupon): ?>
				<tr>
					<td><?= ++$sr ?></td>
					<td><?= $cooCoupon->company->company_organisation ?></td>
					<td><?= h($cooCoupon->valid_from) ?></td>
					<td><?= h($cooCoupon->valid_to) ?></td>
					<td><?= h($cooCoupon->coupon_code) ?></td>
					<td ><?php  
						if($cooCoupon->flag==0){
							echo "<strong style='color:#dd4b39;'>Unused</strong>";
						}else{
							echo "<strong style='color:#00a65a;'>Used</strong>";
						}
					?></td>
					
				</tr>
				<?php 		endforeach; ?>
				
			
					
				
				
				</tbody>
			</table>
			</div>
		</div>
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
</div>
	
	
 
				
				
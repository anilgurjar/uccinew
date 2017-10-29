<div class="col-md-12">

		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Sub Committee Member <?php echo $MasterFinancialYears->financial_year; ?></h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
					
					<?php   foreach($subCommittees as $subCommittee){ 
							
					?>
						
							
						
							<div class="col-md-3" style="height:200px;">
								<div class="form-group">
									<center><div style="height:100px"><?= $this->Html->Image('/images/member_user/user_profile_'.$subCommittee->user->id.'.jpg',['width'=>'100px','height'=>'100px'])  ?> </div> <br/>
									<strong style="color: #990000;"><?= $subCommittee->user->member_name ?></strong> <br/>
									<?php 
									if(!empty($subCommittee->designation->name)){ echo $subCommittee->designation->name; echo"<br/>"; } ?> 
									<span style="font: normal 12px verdana; color: #000000;"><?= $subCommittee->user->company_organisation ?> </span>
									</center>									
								</div>
							</div>
						
						
					<?php } ?>
					</div>	
					
					
					
				</div>
			</div>
				
		</div>
			
</div>





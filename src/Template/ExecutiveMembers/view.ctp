<div class="col-md-12">

		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Executive Member <?php echo $MasterFinancialYears->financial_year; ?></h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					
					
					<?php  foreach($executiveMember as $executive){ 
							$executive_members=$executive->executive_members;
					?>
						<div class="col-md-12 pad">
							<div class="form-group" style="background-color: #3887b7;padding: 4px;color:#fff;">
								<label class="control-label" style="margin-left:10px"><?php echo $executive->name; ?></label>
							</div>
						<?php  
						foreach($executive_members as $executive_member){  ?>
							<div class="col-md-3" style="height:200px;">
								<div class="form-group">
									<center><div style="height:100px"><?= $this->Html->Image('/images/member_user/user_profile_'.$executive_member->user->id.'.jpg',['width'=>'100px','height'=>'100px'])  ?> </div><br/>
									<strong style="color: #990000;"><?= $executive_member->user->member_name ?></strong> <br/>
									<?php 
									if(!empty($executive_member->designation->name)){ echo $executive_member->designation->name; echo"<br/>"; } ?> 
									<span style="font: normal 12px verdana; color: #000000;"><?= $executive_member->user->company_organisation ?> </span>
									</center>									
								</div>
							</div>
						<?php  } ?>	
						</div>	
					<?php } ?>
					
					
					
					
				</div>
			</div>
				
		</div>
			
</div>


					<?php 
				
					$x=0; foreach($executiveCategoryall as $executive){ 
					
							 $member_limits= $executive->member_limit;
					
					?>
						<div class="col-md-12 pad">
							<div class="form-group" style="background-color: #3887b7;padding: 4px;color:#fff;">
								<label class="control-label" style="margin-left:10px"><?php echo $executive->name; ?></label>
							</div>
						<?php  
						for($i=0;$i<$member_limits; $i++){  ?>
							<div class="col-md-4">
								<div class="form-group">
									
									<?=  $this->Form->input('executive_members['.$x.'][user_id]', ['empty'=> '--Select--','data-placeholder'=>'Select a Executive-Members','label' => false,'class'=>'select2 form-control','options'=>$users,'required'=>'required']);
									
									?>
									<br/>
									<?=  $this->Form->input('executive_members['.$x.'][designation_id]', ['empty'=> '--Select--','data-placeholder'=>'Select a designation','label' => false,'class'=>'select2 form-control','options'=>$designations]);
									
									?>
									
									 <?php echo $this->Form->input('executive_members['.$x.'][executive_category_id]', ['type' => 'hidden' , 'value'=>''.$executive->id.'','label' => false , 'class'=>'']); ?>
									
									 <?php echo $this->Form->input('executive_members['.$x.'][master_financial_year_id]', ['type' => 'hidden' , 'value'=>'','label' => false , 'class'=>'financial_year','value'=>''.$finacial_id.'']); ?>
									 
									  <?php echo $this->Form->input('executive_members['.$x.'][created_by]', ['type' => 'hidden' , 'value'=>''.$user_id.'','label' => false , 'class'=>'']); ?>
																		
								</div>
							</div>
						<?php $x++; } ?>	
						</div>	
					<?php } ?>
					
					
					
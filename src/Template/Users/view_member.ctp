<style>
.pad{
	padding-right: 0px;
padding-left: 0px;
}
.form-group
{
	margin-bottom: 0px;
}

fieldset {
 padding: 10px;
 border: 1px solid #D2D3D5;
 margin: 12px;
}
legend{
margin-left: 20px;	
color:#144277; 
//color:#144277c9; 
font-size: 14px;
margin-bottom: 0px;
}

label{
	color:#848688;
	font-size:15px;
}

.span{
	color:#373435;
	font-size:15px;
}


@font-face{
	font-family: 'Montserrat';
	src:url('/assets/Montserrat/Montserrat-Bold.ttf') format('ttf');
}
body{
	font-family: 'Montserrat';

}


</style>


<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title" style="color:#4B4B4D">Member Registration View</h3>
			<div style="text-align:right">
				<?php echo $this->Html->link('<i class="fa fa-book"></i> Edit',array('controller' => 'Users', 'action' => 'member_view_detail',$auto_id),['class' => 'btn-info btn-sm btn-flat','escape'=>false]); ?>
			</div>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
				<fieldset border="1" >
					<legend><b>COMPANY INFORMATION </b></legend>
					<div class="col-md-12 pad">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Company/Organisation</label><br>
								<span class="span"><?php echo $update->company_organisation;		?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">End Products / Items Dealing in</label><br>
								<span class="span"><?php echo $update->end_products_item_dealing_in;		?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">PAN No.</label><br>
								<span class="span"><?php echo $update->pan_no;?></span>
							</div>
						</div>
					</div>
					<div class="col-md-12 pad">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Date of Joining</label><br>
								<span class="span"><?php    $date_of_joining=date('d-m-Y',strtotime($update->year_of_joining));     
								if($date_of_joining=='01-01-1970'){ echo '';}
										else{   echo  $date_of_joining;    }?></span>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label">Member Type</label><br/>
								<span class="span"><?php  $i=1; foreach($update->company_member_types as  $company_member_type){
									echo $i.'.&nbsp;';echo $company_member_type->master_member_type->member_type.'&nbsp;';
									$i++;
								}  ?></span>
							</div>
						</div>
					</div>
					<div class="col-md-12 pad">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Gst Number </label><br/>
								<span class="span"><?php echo $update->gst_number;	?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Grade</label><br/>
								<span class="span"><?php echo $update->master_grade->grade_name;		?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Category</label><br/>
								<span class="span"><?php echo $update->master_category->category_name;?></span>
							</div>
						</div>
					</div>
					<div class="col-md-12 pad">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Classification</label><br/>
								<span class="span"><?php echo $update->master_classification->classification_name;?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Member Turn Over</label><br/>
								<span class="span"><?php echo $update->master_turn_over->component;	?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Office-Telephone</label><br/>
								<span class="span"><?php echo $update->office_telephone;	?></span>
							</div>
						</div>
					</div>
					<div class="col-md-12 pad">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Residential-Telephone</label><br/>
								<span class="span"><?php echo $update->residential_telephone;	?></span>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label">Address</label><br/>
								<span class="span"><?php echo $update->address;	?></span>
							</div>
						</div>
					</div>
					<div class="col-md-12 pad">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">City</label><br/>
								<span class="span"><?php echo $update->city;	?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">State</label><br/>
								<span class="span"><?php echo $update->master_state->name;	?></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Pincode</label><br/>
								<span class="span"><?php echo $update->pincode;	?></span>
							</div>
						</div>
					</div>
				</fieldset>	
				<fieldset>	
					<legend ><b>PERSON INFORMATION</b></legend>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6 pad">
								<label class="control-label" style="color:#66CAD5">FIRST NOMINEE</label><br/>
								<div class="col-md-4">
									<div class="form-group"> 
									<?php 
										if (file_exists(WWW_ROOT . ''.$update->users[0]->image.'')){ 
										$html_img= $this->Html->image('/'.$update->users[0]->image.'',['width'=>'100px','height'=>'100px']); 
										}
										else{ 
											$html_img= $this->Html->image('/img/tab2.png',['width'=>'100px','height'=>'100px']); 
										}
										echo $html_img;
										//pr($users);
									?>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label"><b>Name</b></label>
										<span class="span"><?php echo $update->users[0]['member_name'];	?></span>
									</div>
									<div class="form-group">
										<label class="control-label">Designation</label><br/>
										<span class="span"><?php echo $update->users[0]['member_designation'];	?></span>
									</div>
									<div class="form-group">
										<label class="control-label">E-mail</label><br/>
										<span class="span"><?php echo $update->users[0]['email'];	?></span>
									</div>
									<div class="form-group">
										<label class="control-label">Mobile No.</label><br/>
										<span class="span"><?php echo $update->users[0]['mobile_no'];	?></span>
									</div>
								</div>
							</div>
							<?php if(!empty(@$update->users[1]['member_name'])){  ?>
							<div class="col-md-6 pad">
								<label class="control-label" style="color:#66CAD5"><b>SECOND NOMINEE </b></label>
								<div class="col-md-4">
									<div class="form-group">
										<?php 
											if (file_exists(WWW_ROOT . ''.@$update->users[1]->image.'')){ 
											$html_img= $this->Html->image('/'.@$update->users[1]->image.'',['width'=>'100px','height'=>'100px']); 
											}
											else{ 
												$html_img= $this->Html->image('/img/tab2.png',['width'=>'100px','height'=>'100px']); 
											}
											echo $html_img;
											//pr($users);
										?>
									</div>
								</div>
								<div class="col-md-8"> 
									<div class="form-group">
										<label class="control-label">Name</label><br/>
										<span class="span"><?php echo @$update->users[1]['member_name'];	?></span>
									</div>
									<div class="form-group">
										<label class="control-label">Designation</label><br/>
										<span class="span"><?php echo @$update->users[1]['member_designation'];	?></span>
									</div>
									<div class="form-group">
										<label class="control-label">E-mail</label><br/>
										<span class="span"><?php echo @$update->users[1]['email'];	?></span>
									</div>
									<div class="form-group">
										<label class="control-label">Mobile No.</label><br/>
										<span class="span"><?php echo @$update->users[1]['mobile_no'];	?></span>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>	
				</fieldset>		
			</div>
		</div>
	</div>
</div>
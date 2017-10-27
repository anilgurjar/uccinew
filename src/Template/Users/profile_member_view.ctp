<link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
<style>
table th{
	font-family:Open Sans;
	
} 
table td{
	font-family:Open Sans;
} 
</style>

<div class="col-md-12">
<div class="box box-primary">
	<div class="col-md-12">
		<h4 style="text-align:center; margin-top:30px"> Profile View </h4>
	</div>
    
	<?php 

foreach($UserProfiles_new as $UserProfiles){  ?>
<div class="portlet light bordered">
<div class="portlet-body">
	<div class="table-scrollable ">
		<table class="table table-bordered form-group table-striped" style="align:center;margin-left:20%;margin-right:20%;margin-top:7%;width:60%;font-family:Open Sans;">
		
			<tr style="width:70%">
				<th scope="row" style="width:30%; "><?= __('Company') ?></th>
				<td style="width:30%"><?= h($UserProfiles->company_organisation) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Member Name') ?></th>
				<td><?= h($UserProfiles->users[0]->member_name) ?></td>
			</tr>
			 <tr>
				<th scope="row"><?= __('Email') ?></th>
				<td><?= h($UserProfiles->users[0]->email) ?></td>
			</tr>
			 <tr>
				<th scope="row"><?= __('Mobile') ?></th>
				<td><?= h($UserProfiles->users[0]->mobile) ?></td>
			</tr>
			
			 <tr>
				<th scope="row"><?= __('Alternate member') ?></th>
				<td><?= h(@$UserProfiles->users[1]->member_name) ?></td>
			</tr>
			 <tr>
				<th scope="row"><?= __('Alternate email') ?></th>
				<td><?= h(@$UserProfiles->users[1]->email) ?></td>
			</tr>
			 <tr>
				<th scope="row"><?= __('Alternate mobile') ?></th>
				<td><?= h(@$UserProfiles->users[1]->mobile) ?></td>
			</tr>
			
			
			 <tr>
				<th scope="row"><?= __('Address') ?></th>
				<td><?= h($UserProfiles->address) ?></td>
			</tr>
			 <tr>
				<th scope="row"><?= __('City') ?></th>
				<td><?= h($UserProfiles->city) ?></td>
			</tr>
			 <tr>
				<th scope="row"><?= __('Pincode') ?></th>
				<td><?= h($UserProfiles->pincode) ?></td>
			</tr>
		  
			 <tr>
				<th scope="row"><?= __('End Products / Items Dealing in') ?></th>
				<td><?= h($UserProfiles->end_products_item_dealing_in) ?></td>
			</tr>
			 <tr>
				<th scope="row"><?= __('Office telephone') ?></th>
				<td><?= h($UserProfiles->office_telephone) ?></td>
			</tr>
			 <tr>
				<th scope="row"><?= __('Residential telephone') ?></th>
				<td><?= h($UserProfiles->residential_telephone) ?></td>
			</tr>
			
			 <tr>
				<th scope="row"><?= __('Gst number') ?></th>
				<td><?= h($UserProfiles->gst_number) ?></td>
			</tr>
			<!-- <tr>
				<th scope="row"><?= __('Grade') ?></th>
				<td><?= h($UserProfiles->master_grade->grade_name) ?></td>
			</tr>
			
			<tr>
				<th scope="row"><?= __('Category') ?></th>
				<td><?= h($UserProfiles->master_category->category_name) ?></td>
			</tr>
			 <tr>
				<th scope="row"><?= __('Classification') ?></th>
				<td><?= h($UserProfiles->master_classification->classification_name) ?></td>
			</tr>
			 
			 
			 <tr>
				<th scope="row"><?= __('Turn over') ?></th>
				<td><?= h($UserProfiles->master_turn_over->component) ?></td>
			</tr>
			 
			 <tr>
				<th scope="row"><?= __('Year of joining') ?></th>
				<td><?= h($UserProfiles->year_of_joining) ?></td>
			</tr>
			
			 <tr>
				<th scope="row"><?= __('Member Image') ?></th>
				<td><?= $this->Html->image('/'.$UserProfiles->users[0]->image.'',['width'=>'50px','height'=>'50px'])  ?></td>
			</tr>
			
			 <tr>
				<th scope="row"><?= __('Alternate Member Image') ?></th>
				<td> <?=  $this->Html->image('/'.$UserProfiles->users[1]->image.'',['width'=>'50px','height'=>'50px'])  ?></td>
			</tr>-->
			
			
		</table>
	</div>	
</div>
 </div>		
<?php  }

 ?>
</div>
</div>

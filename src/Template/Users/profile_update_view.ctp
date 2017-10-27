<div class="col-md-12">
<div class="box box-primary">
	<div class="col-md-12">
		<h4> Profile View </h4>
	</div>
    
	<?php 
echo $this->Form->create($UserProfiles_form) ;
foreach($UserProfiles_new as $UserProfiles){   ?>
<table class="table" >
		<tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= h($UserProfiles->company_organisation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member Name') ?></th>
            <td><?= h($UserProfiles->member_name) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($UserProfiles->email) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($UserProfiles->mobile) ?></td>
        </tr>
		
		 <tr>
            <th scope="row"><?= __('Alternate member') ?></th>
            <td><?= h($UserProfiles->alternate_member) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('Alternate email') ?></th>
            <td><?= h($UserProfiles->alternate_email) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('Alternate mobile') ?></th>
            <td><?= h($UserProfiles->alternate_mobile) ?></td>
        </tr>
		
		
		 <tr>
            <th scope="row"><?= __('address') ?></th>
            <td><?= h($UserProfiles->address) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('city') ?></th>
            <td><?= h($UserProfiles->city) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('pincode') ?></th>
            <td><?= h($UserProfiles->pincode) ?></td>
        </tr>
      
		 <tr>
            <th scope="row"><?= __('End Products / Items Dealing in') ?></th>
            <td><?= h($UserProfiles->end_products_item_dealing_in) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('office telephone') ?></th>
            <td><?= h($UserProfiles->office_telephone) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('residential telephone') ?></th>
            <td><?= h($UserProfiles->residential_telephone) ?></td>
        </tr>
        
		 <tr>
            <th scope="row"><?= __('gst number') ?></th>
            <td><?= h($UserProfiles->gst_number) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('grade') ?></th>
            <td><?= h($UserProfiles->master_grade->grade_name) ?></td>
        </tr>
		
		<tr>
            <th scope="row"><?= __('category') ?></th>
            <td><?= h($UserProfiles->master_category->category_name) ?></td>
        </tr>
		 <tr>
            <th scope="row"><?= __('classification') ?></th>
            <td><?= h($UserProfiles->master_classification->classification_name) ?></td>
        </tr>
		 
		 
		 <tr>
            <th scope="row"><?= __('turn over') ?></th>
            <td><?= h($UserProfiles->master_turn_over->component) ?></td>
        </tr>
		 
		 <tr>
            <th scope="row"><?= __('year of joining') ?></th>
            <td><?= h($UserProfiles->year_of_joining) ?></td>
        </tr>
		
		 <tr>
            <th scope="row"><?= __('Member Image') ?></th>
            <td><?= $this->Html->image('/'.$UserProfiles->image.'',['width'=>'50px','height'=>'50px'])  ?></td>
        </tr>
		
		 <tr>
            <th scope="row"><?= __('Alternate Member Image') ?></th>
            <td> <?=  $this->Html->image('/'.$UserProfiles->alternate_image.'',['width'=>'50px','height'=>'50px'])  ?></td>
        </tr>
		
    </table>
		<center>
		<?php if($role_id==1){
			echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Approve') ,['class'=>'btn btn-success','type'=>'Submit','name'=>'profile_approval','value'=>$UserProfiles->id]);
			
			echo" ". $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Reject') ,['class'=>'btn btn-danger','type'=>'Submit','name'=>'profile_reject','value'=>$UserProfiles->id]);	
		} 
		?>
       </center>
<?php  }
echo $this->Form->end();
 ?>

	<br/>
	<br/>

	<br/>
    
</div>
</div>
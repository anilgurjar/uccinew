<style>
@media print {
  body * {
    visibility: hidden;
  }
  .print{
	  display:none;
  }
  #fee_data, #fee_data * {
    visibility: visible;
  }
  #fee_data{
	margin-left: auto;
	margin-right: auto;
	left: 0;
	right: 0;
  }
}
</style>
<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border no-print">
			<h3 class="box-title">Facility Booking View  </h3>
			<div class="pull-right"><?= $this->Html->link('Calendar','/facilityBookings/facilityBokingCalender',['class' => "btn btn-primary",'target'=>'_btn']); ?>
			</div>
		</div>
		<div class="box-body">
		
		<div class="col-sm-12 no-print">
	<div class="table-responsive no-padding">
		<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
			<thead>
				 <tr>
					<th scope="col">S.No.</th>
					<th scope="col"><?= $this->Paginator->sort('name') ?></th>
					<th scope="col"><?= $this->Paginator->sort('expected_person') ?></th>
					<th scope="col"><?= $this->Paginator->sort('date_from') ?></th>
					<th scope="col"><?= $this->Paginator->sort('date_to') ?></th>
					<th scope="col"><?= $this->Paginator->sort('venue_id') ?></th>
					<th scope="col"><?= $this->Paginator->sort('Status') ?></th> 
					<th scope="col"><?= $this->Paginator->sort('Action') ?></th> 
				</tr>
			</thead>
			<tbody>
				<?php $i=0; foreach ($facilityBookings as $facilityBooking): 
				$i++; ?>
					<tr>
						<td><?= $i ?></td>
						<td><?= h($facilityBooking->name) ?></td>
						<td><?= h($facilityBooking->expected_person) ?></td>
						<td><?= h(date('d-m-Y ', strtotime($facilityBooking->date_from))) ?></td>
						<td><?= h(date('d-m-Y ', strtotime($facilityBooking->date_to))) ?></td>
						<td><?= h($facilityBooking->venue->name) ?></td>
						<td><strong style="color:#dd4b39;" class="app"><?= h($facilityBooking->status) ?> </strong></td> 
						<td> 
						 <?= $this->Html->link(__('View'), ['action' => 'view', $facilityBooking->id],['class'=>'btn-success btn-sm']) ?> 
						  
						<?php 
						if($facilityBooking->status=='pending'){
						echo $this->Html->link(' <i class="fa fa-thumbs-o-up"></i> Approve ',['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#cancel'.$facilityBooking->id,'class' => 'orange hold btn-primary btn-sm',
						'escape' => false]);
						}
						?>
						 
					<?php  echo $this->Form->create($facilityBooking_new, ['type' => 'post','id'=>'validationForm1'.$facilityBooking->id,'enctype' => 'multipart/form-data']); ?>					
								<div class="modal fade" id="cancel<?php echo $facilityBooking->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel" style="color:black;">Are you sure you want to approve this request ?</h4>
										<input type="hidden" name="facility_boking_id" value="<?php echo $facilityBooking->id ; ?>">
									  </div>
									  
									  <div class="modal-footer">
										<div class="related_issue1"> </div>
											<?= $this->Form->button(__('Yes') . $this->Html->tag('i', ''),['class'=>'btn btn-success cancel','type'=>'submit','g_id'=>$facilityBooking->id]);
											?>
											<button type="button" class="btn btn-default cls" data-dismiss="modal">No</button>
											
									  </div>
									</div>
								  </div>
								</div>
							 <?= $this->Form->end() ?>	



						</td> 
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		
		</div>
	</div>
	
	    </div>
	</div>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).on('click', '.cancel', function(e)
	{ 
		e.preventDefault();
		var facility_id=$(this).attr('g_id');
		var cl=$(this).closest('tr');
		$(".related_issue1").html('<div align="center"><?php echo $this->Html->Image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		
		 //$(this).closest('tr').find('.font_cl').css({"color":"white"});
				$.ajax({
				   type: "POST",
				   url: "<?php echo $this->Url->build(['controller'=>'FacilityBookings','action'=>'facility_booking_approve']); ?>",
				   data: $("#validationForm1"+facility_id).serialize(), 
				   success: function(data){
					  cl.find('.hold').remove();
					  cl.find('.app').html("Approved");
					  $(".cls").click();
					  $(".related_issue1").html('');
				   }  
			   });  
	});

</script>


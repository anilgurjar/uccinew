<style>
.clor{
	color:#005b9e;
	
}
</style>
<?php //pr($event); ?> 
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
		<center> <h3> <?= h($event->name) ?> </h3> </center>
	</div>
	
		<div class="row">
							
			<div class="col-md-12 pad">
				
					
					 <div class="col-md-4">
						<div class="form-group">
						<label class="control-label clor">Category :-  </label> <label> <?= h($event->event_category->name) ?> </label>
							
						</div>
					</div>
					
					 <div class="col-md-4">
						<div class="form-group">
						<label class="control-label clor">Location :- </label><label>  <?= h($event->location) ?> </label>
							

						</div>
					</div>	
					
					<div class="col-md-4">
						<div class="form-group">
						<label class="control-label clor">Date & Time :-</label><label>  <?= h($event->date) ?>  <?=h(date("h:i A",strtotime($event->time)))  ?> </label>
							

						</div>
					</div>	
					
			</div>
		
		<div class="col-md-12 pad">
				
					
					 <div class="col-md-12">
						<div class="form-group">
						<label class="control-label clor">Cover Image </label> <br/>
						
							<?php echo $this->Html->Image('/'.$event->cover_image,['height'=>'400px','width'=>'100%']); ?>
						</div>
					</div>
									
		</div>
		
		<div class="col-md-12 pad">
				
					
					 <div class="col-md-12">
						<div class="form-group">
						<label class="control-label clor">Description </label> <br/>
						
							 <?= $this->Text->autoParagraph($event->description); ?>
						</div>
					</div>
					
					
					
		</div>
		
		<div class="col-md-12 pad">
				
				
					 <div class="col-md-12">
					  <h4 class="clor"><?= __('Related Event Guests') ?></h4>	
						
					</div>
					
					
					
		</div>
		
			<div class="col-md-12 pad">
					
					<?php foreach ($event->event_guests as $eventGuests): ?>
						 <div class="col-md-3">
						 <?php echo $this->Html->Image('/'.$eventGuests->photo,['height'=>'100px','width'=>'100px']); ?><br/>
						<label> <?= h($eventGuests->name) ?> </label>
							
						</div>
						
					 <?php endforeach; ?>	
						
						
			</div>
			<br/>
			<div class="col-md-12 pad">
					
					
						<div class="col-md-6">
							<label class="clor"> <h4>Attendees Member </h4> </label>
							<table cellpadding="0" cellspacing="0" class="table">
								<tr>
									<td>Sr.no</td>
									<td>Member</td>
								</tr>
								<?php $i=0; 
								foreach ($event->event_attendees as $eventattendees):
									if($eventattendees->answer=='yes'){ $i++;
										
									?>
									<tr>
									<td> <?= h($i) ?> </td>
									<td><?= h($eventattendees->user->member_name) ?></td>
									</tr>
									<?php } endforeach; ?>
							</table>
							
						</div>
						
						<div class="col-md-6">
						<label class="clor"> <h4> Not Attendees Member </h4> </label>
							<table cellpadding="0" cellspacing="0" class="table">
								<tr>
									<td>Sr.no</td>
									<td>Member</td>
								</tr>
								<?php $i=0; 
								foreach ($event->event_attendees as $eventattendees):
									if($eventattendees->answer=='no'){ $i++;
										
									?>
									<tr>
									<td> <?= h($i) ?> </td>
									<td><?= h($eventattendees->user->member_name) ?></td>
									</tr>
									<?php } endforeach; ?>
							</table>
							
						</div>
						
			</div>
		
		</div>
	
  </div>
 </div>


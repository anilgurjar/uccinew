
<?php //pr($event); ?> 
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
		<center> <h3> <?= h($facilityBooking->name) ?> </h3> </center>
	</div>
	
		<div class="row">
							
			<div class="col-md-12 pad">
				
					
					 <div class="col-md-4">
						<div class="form-group">
						<label class="control-label clor">Expected Person :-  </label> <label> <?= h($facilityBooking->expected_person) ?> </label>
							
						</div>
					</div>
					
					 <div class="col-md-4">
						<div class="form-group">
						<label class="control-label clor">Venue :- </label><label>  <?= $facilityBooking->has('venue') ? $this->Html->link($facilityBooking->venue->name, ['controller' => 'Venues', 'action' => 'view', $facilityBooking->venue->id]) : ''  ?> </label>
							

						</div>
					</div>	
					
					<div class="col-md-4">
						<div class="form-group">
						<label class="control-label clor">Date  :-</label><label>  <?= h(date("d-m-Y",strtotime($facilityBooking->date_from))) ?> to <?= h(date("d-m-Y",strtotime($facilityBooking->date_to))) ?>  </label>
							

						</div>
					</div>	
					
			</div>
		
		<div class="col-md-12 pad">
				
					
					 <div class="col-md-12">
						<div class="form-group">
						<label class="control-label clor">Description </label> <br/>
						
							<?= $this->Text->autoParagraph(h($facilityBooking->description)); ?>
						</div>
					</div>
									
		</div>
		
			<br/>
			
		
		</div>
	
  </div>
 </div>





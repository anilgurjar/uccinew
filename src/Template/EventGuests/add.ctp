<div class="col-md-12">

		<div class="box box-primary">
			<div class="box-header with-border">
			<center> <h3><?php echo $events_data->name; ?> </h3> </center>
			
			<h3 class="box-title">Add Event Guest</h3>
			</div>
			<?php echo $this->Form->create($eventGuet, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							 <div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Guest Name</label>
									<?php echo $this->Form->input('name', ['label' => false,'placeholder'=>'Name','class'=>'form-control']); ?>
								</div>
								<input type="hidden" name="event_id" value="<?php echo $id ; ?>">
							</div>
							<div class="col-md-6">
									<table id="file_table" style="line-height:2.5">
									<tr>
										<td>
										<label class="control-label">Guest photo</label>
										<?= $this->Form->file('photo[]',['multiple'=>'multiple']); ?>
										</td>
										<td></td>
										<td></td>
									</tr>
								</table>
							</div>	
					</div>
					
					
					
			
				</div>
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button(__('Add Guest') . $this->Html->tag('i', ''),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
					
					<?= $this->Html->link('Skip', ['controller'=>'Events','action' => 'index'],['escape' => false,'class'=>'btn btn-info']) ?>
					
					</center>
					
				</div>
				<?php echo $this->Form->end(); ?>
				
				
<div class="box-header with-border">
	  <h3 class="box-title">Event Guest View</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
               <tr>
                <th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
				
                <th scope="col"><?= $this->Paginator->sort('Guest name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Guest photo') ?></th>
            </tr>
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach ($eventGuetlists as $eventGuetlist): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
				
                 <td>
					<?= h($eventGuetlist->name) ?>
				 </td>
                 <td>
					
					<?php echo $this->html->image('/'.$eventGuetlist->photo,['width'=>'30px','height'=>'30px']); ?>
				 </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
				
				
		</div>
			
</div>



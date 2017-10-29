<div class="col-sm-12">
	<div class="box box-info">
	<?php $this->Form->templates([
				'inputContainer' => '{{content}}'
			]); 
		?>
	<?php 
	if(isset($table_data))
	{
		
		?>
		<div class="box-body table-responsive no-padding">
			<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
				<thead>
					 <tr>
						<th style="text-align:center">S. No.</th>
						<th>Name</th>
						
						<th>Member Type</th>
						<th>Amount</th>
						<th style="text-align:center">Create Invoice<br/>
						<?php 
				echo $this->Form->input('check_all', array(
                                  'type'=>'checkbox', 
								  'label' => false,
								  'hiddenField' => false
						)); ?>
						</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
			
				<?php  foreach($table_data as $data)	{ ?>	
						
						
						<tr>
				<td style="text-align:center"><?php echo $data[0]; ?></td>
				<td><?php echo $data[1]; ?></td>
				<td><?php echo $data[4]; ?></td>
				<td><?php echo $data[3]; ?></td>
				
				<td style="text-align:center">
				<?php 
				echo $this->Form->input('member_id['.$data[5].']', array(
                                  'type'=>'checkbox', 
								  'label' => false,
								  'hiddenField' => false,
								  'value'=>$data[2]
						)); ?>
				</td>
				<td>
				
				<?php 
				
				echo $this->Html->link('<i class="fa fa-plus"></i> View', array('controller' => 'Users', 'action' => 'member_performa_invoice_view',$data[2],$data[5]),['class' => 'btn btn-xs btn-primary', 'target' => '_blank','escape'=>false]);
				?>
				
				</td>
				</tr>
				<?php } ?>
				</tbody>
				<thead>
				<tr>
					<th colspan="4" style="text-align:center">
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']). __(' Generate'),['class'=>'btn btn-success','type'=>'Submit','name'=>'generate_submit']) ?>
					</th>
				</tr>
				</thead>
			</table>
		</div>
		<?php
	}
	else
	{
		echo '<h4 style="text-align:center;">Invoice already generated.</h4>';
	} ?>
	</div>
</div>
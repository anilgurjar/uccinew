<div class="col-md-12">

		<div class="box box-primary">
			<div class="box-header with-border">
			
			<h3 class="box-title">Add Advertisement </h3>
			</div>
			<?php echo $this->Form->create($advertisement, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							
							<div class="col-md-6">
									<table id="file_table" style="line-height:2.5">
									<tr>
										<td>
										<label class="control-label">Advertisement photo</label>
										<?= $this->Form->file('image',['multiple'=>'multiple']); ?>
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
					
					
					<?= $this->Form->button(__('Add Advertisement') . $this->Html->tag('i', ''),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
					
					<!--<?= $this->Html->link('Skip', ['controller'=>'Events','action' => 'index'],['escape' => false,'class'=>'btn btn-info']) ?>-->
					
					
					
				</div>
				<?php echo $this->Form->end(); ?>
		

</div>

  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Advertisement view</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
               <tr>
                <th scope="col">Sr no.</th>
                <th scope="col">Photo</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach ($advertisements as $advertisement): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
               
                <td><?php echo $this->Html->Image('/'.$advertisement->photo,['width'=>'100px','height'=>'100px']); ?>
								
				</td>
             <td>  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $advertisement->id], ['confirm' => __('Are you sure you want to delete this photo '),'class'=>'btn btn-primary btn-sm']) ?>
			 </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
  
 

</div>

</div>


<!--<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Affilation Registrations'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="affilationRegistrations form large-9 medium-8 columns content">
    <?= $this->Form->create($affilationRegistration) ?>
    <fieldset>
        <legend><?= __('Add Affilation Registration') ?></legend>
        <?php
            echo $this->Form->input('logo');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>-->


<div class="col-md-12">

		<div class="box box-primary">
			<div class="box-header with-border">
			
			<h3 class="box-title">Add Affilation </h3>
			</div>
			<?php echo $this->Form->create($affilationRegistration, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							
							<div class="col-md-6">
									<table id="file_table" style="line-height:2.5">
									<tr>
										<td>
										<label class="control-label">Logo</label>
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
					
					
					<?= $this->Form->button(__('Add Affilation') . $this->Html->tag('i', ''),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
					
					
					
				</div>
				<?php echo $this->Form->end(); ?>
		
</div>



  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Affilation view</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
               <tr>
                <th scope="col">Sr no.</th>
                <th scope="col">Logo</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach ($affilationRegistrations as $affilationRegistration): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
               
                <td><?php echo $this->Html->Image('/'.$affilationRegistration->logo,['width'=>'200px','height'=>'80px']); ?>
								
				</td>
             <td>  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $affilationRegistration->id], ['confirm' => __('Are you sure you want to delete this logo '),'class'=>'btn btn-primary btn-sm']) ?>
			 </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   

 </div>



</div>


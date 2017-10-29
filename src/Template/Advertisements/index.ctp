<div class="col-md-12">
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

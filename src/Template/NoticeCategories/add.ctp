



<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Master Category</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?= $this->Form->create($noticeCategory,['id'=>'purposeForm','class'=>'form-horizontal cmxform','method'=>'post']) ?>
	  <div class="box-body">
		<div class="form-group">
		  <label class="col-sm-2 control-label">Category Name</label>
		  <div class="col-sm-4">
			<?php
			 echo $this->Form->input('category_name',['label'=>false,'class'=>'form-control capitalize','type'=>'text','placeholder'=>'category Name']);
			?>
		  </div>
		</div>
		
		
	  </div>
	  			
	  <!-- /.box-body -->
	  <div class="box-footer">
	   <div class="col-sm-6">
		<center>
		<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit'),['class'=>'btn btn-success']); ?>
		</center>
		 </div>
	  </div>
	  <!-- /.box-footer -->
	<?php echo $this->Form->end(); ?>
	
  </div>
 </div>
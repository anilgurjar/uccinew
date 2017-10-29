<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Notice Category View </h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table width="100%" class=" table table-responsive table-bordered" style="border:1px solid #3C8DBC;">
	<tr style="background-color:#3C8DBC; color:#fff">
	<th>#</th>
	<th>Category Name</th>
	</tr>
	
  <?php $i=0;  foreach ($noticeCategories as $noticeCategory): 
	$i++;
	?>
	<tr>
	<td><?= $i ?> </td>
    <td><?= h($noticeCategory->category_name) ?></td>
	 
	</tr>
 <?php endforeach; ?>
	</table>	
  </div>
 </div>

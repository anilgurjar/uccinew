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
			<h3 class="box-title">News Letter View</h3>
		</div>
		<div class="box-body">
		
		<div class="col-sm-12 no-print">
	<div class="table-responsive no-padding">
	<?php  
					/*echo $this->Html->link('<i class="fa fa-download"></i> Export',
						['controller' => 'Users', 'action' => 'MemberExport'],
						['class' => 'btn btn-primary btn-sm btn-flat pull-right',
							'escape' => false]
					);*/
					?>
		<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
			<thead>
				 <tr>
					<th>S.No.</th>
					<th>Title</th>
					<th>Cover Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			//pr($newsLetters); exit;
			$sr_no=0; foreach($newsLetters as $newsLetter) { ?>
 				<tr>
					<td><?php echo ++$sr_no; ?></td>
					<td><?php echo $newsLetter->title; ?></td>
					<td width="20%">
					<?php
                        if(!empty($newsLetter->cover_image)){
							echo $this->Html->image('/'.$newsLetter->cover_image, ['style'=>'width:21%']); }?>
					</td>
					<td>
					
					<?= $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('controller' => 'NewsLetters', 'action' => 'edit',$newsLetter->id),['class' => 'btn btn-sm btn-warning btn-flat','escape'=>false]) ?>
					<?php  if(!empty($newsLetter->pdf_attachment)){ echo $this->Html->link('<i class="fa fa-download"></i> PDF','/'.$newsLetter->pdf_attachment,['class' => 'btn btn-sm btn-primary btn-flat','escape'=>false,'target'=>'_blank']); } ?>
					
					
					</td>
				</tr>
				
		<?php } ?>
			</tbody>
		</table>
		
		
		</div>
	</div>
	
	    </div>
	</div>
</div>
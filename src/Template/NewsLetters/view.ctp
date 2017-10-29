
<div class="newsLetters view large-9 medium-8 columns content">
    <h3><?= h($newsLetter->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($newsLetter->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cover Image') ?></th>
            <td><?= h($newsLetter->cover_image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($newsLetter->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($newsLetter->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited By') ?></th>
            <td><?= $this->Number->format($newsLetter->edited_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($newsLetter->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($newsLetter->edited_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($newsLetter->description)); ?>
    </div>
</div>
<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">View News Letter</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							 <div class="col-md-8">
								<div class="form-group">
									<label class="control-label">Title</label>
									<?php echo $this->Form->input('title', ['label' => false,'placeholder'=>'News Letter Title','class'=>'form-control']); ?>
								</div>
							</div>
							
							 <div class="col-md-4">
								<table id="file_table">
									<tr>
										<td>
											<label class="control-label">Coverage Image</label>
												<?= $this->Form->file('cover_image[]',['multiple'=>'multiple']); ?>
										</td>
										<td></td>
										<td></td>
									</tr>
								</table>
							</div>	
					</div>
					
					<textarea id="description" name="description" hidden=""></textarea>
						<div class="col-md-12 ">
						
								<div class="box-body  pad">
									<label class="control-label">Description</label>
									<textarea class="txtEditor"></textarea>
									
								</div>
							
						</div>
					
			
				</div>
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button(__('Save as draft') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-success','type'=>'Submit','id'=>'create_notice']) ?>
					</center>
					
				</div>
		</div>
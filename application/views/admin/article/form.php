<a href="<?php echo site_url('admin/article/index'); ?>"
	class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Article'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/article/save/'.$article['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
	<div class="card-body">
		<div class="form-group">
			<label for="Subject" class="col-md-4 control-label">Subject</label>
			<div class="col-md-8">
				<input type="text" name="subject"
					value="<?php echo ($this->input->post('subject') ? $this->input->post('subject') : $article['subject']); ?>"
					class="form-control" id="subject" />
			</div>
		</div>
		<div class="form-group">
			<label for="Description" class="col-md-4 control-label">Description</label>
			<div class="col-md-8">
				<textarea name="description" id="description" class="form-control"
					rows="4" /><?php echo ($this->input->post('description') ? $this->input->post('description') : $article['description']); ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="File Picture 1" class="col-md-4 control-label">File
				Picture 1</label>
			<div class="col-md-8">
				<input type="file" name="file_picture_1" id="file_picture_1"
					value="<?php echo ($this->input->post('file_picture_1') ? $this->input->post('file_picture_1') : $article['file_picture_1']); ?>"
					class="form-control-file" />
			</div>
		</div>
		<div class="form-group">
			<label for="File Picture 2" class="col-md-4 control-label">File
				Picture 2</label>
			<div class="col-md-8">
				<input type="file" name="file_picture_2" id="file_picture_2"
					value="<?php echo ($this->input->post('file_picture_2') ? $this->input->post('file_picture_2') : $article['file_picture_2']); ?>"
					class="form-control-file" />
			</div>
		</div>

	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-4 col-sm-8">
		<button type="submit" class="btn btn-success"><?php if(empty($article['id'])){?>Save<?php }else{?>Update<?php } ?></button>
	</div>
</div>
<?php echo form_close(); ?>
<!--End of Form to save data//-->
<!--JQuery-->
<script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '<?php echo base_url(); ?>public/datepicker/images/calendar.gif',
	});
</script>

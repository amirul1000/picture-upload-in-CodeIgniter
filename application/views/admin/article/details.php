<a href="<?php echo site_url('admin/article/index'); ?>"
	class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Article'); ?></h5>
<!--Data display of article with id-->
<?php
$c = $article;
?>
<table class="table table-striped table-bordered">
	<tr>
		<td>Subject</td>
		<td><?php echo $c['subject']; ?></td>
	</tr>

	<tr>
		<td>Description</td>
		<td><?php echo $c['description']; ?></td>
	</tr>

	<tr>
		<td>File Picture 1</td>
		<td><?php
if (is_file(APPPATH . '../public/' . $c['file_picture_1']) && file_exists(APPPATH . '../public/' . $c['file_picture_1'])) {
    ?>
										  <img
			src="<?php echo base_url().'public/'.$c['file_picture_1']?>"
			class="picture_50x50">
										  <?php
} else {
    ?>
										<img src="<?php echo base_url()?>public/uploads/no_image.jpg"
			class="picture_50x50">
										<?php
}
?>	
										</td>
	</tr>

	<tr>
		<td>File Picture 2</td>
		<td><?php
if (is_file(APPPATH . '../public/' . $c['file_picture_2']) && file_exists(APPPATH . '../public/' . $c['file_picture_2'])) {
    ?>
										  <img
			src="<?php echo base_url().'public/'.$c['file_picture_2']?>"
			class="picture_50x50">
										  <?php
} else {
    ?>
										<img src="<?php echo base_url()?>public/uploads/no_image.jpg"
			class="picture_50x50">
										<?php
}
?>	
										</td>
	</tr>

	<tr>
		<td>Created At</td>
		<td><?php echo $c['created_at']; ?></td>
	</tr>

	<tr>
		<td>Updated At</td>
		<td><?php echo $c['updated_at']; ?></td>
	</tr>


</table>
<!--End of Data display of article with id//-->

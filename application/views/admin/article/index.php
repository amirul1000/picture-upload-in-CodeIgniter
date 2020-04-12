<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Article'); ?></h5>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/article/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type"
			class="select"
			onChange="window.location='<?php echo site_url('admin/article/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/article/search/',array("class"=>"form-horizontal")); ?>
                    <input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
				<button type="submit" class="mr-0">
					<i class="fa fa-search"></i>
				</button>
                <?php echo form_close(); ?>
            </li>
		</ul>
	</div>
</div>
<!--End of Action//-->

<!--Data display of article-->
<table class="table table-striped table-bordered">
	<tr>
		<th>Subject</th>
		<th>Description</th>
		<th>File Picture 1</th>
		<th>File Picture 2</th>

		<th>Actions</th>
	</tr>
	<?php foreach($article as $c){ ?>
    <tr>
		<td><?php echo $c['subject']; ?></td>
		<td><?php echo $c['description']; ?></td>
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

		<td><a
			href="<?php echo site_url('admin/article/details/'.$c['id']); ?>"
			class="action-icon"> <i class="zmdi zmdi-eye"></i></a> <a
			href="<?php echo site_url('admin/article/save/'.$c['id']); ?>"
			class="action-icon"> <i class="zmdi zmdi-edit"></i></a> <a
			href="<?php echo site_url('admin/article/remove/'.$c['id']); ?>"
			onClick="return confirm('Are you sure to delete this item?');"
			class="action-icon"> <i class="zmdi zmdi-delete"></i></a></td>
	</tr>
	<?php } ?>
</table>
<!--End of Data display of article//-->

<!--No data-->
<?php
if (count($article) == 0) {
    ?>
<div align="center">
	<h3>Data is not exists</h3>
</div>
<?php
}
?>
<!--End of No data//-->

<!--Pagination-->
<?php
echo $link;
?>
<!--End of Pagination//-->

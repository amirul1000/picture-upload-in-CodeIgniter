<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css">
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Article'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide"> </htmlpageheader>

<htmlpageheader name="otherpages" class="hide"> <span class="float_left"></span>
<span class="padding_5"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
<span class="float_right"></span> </htmlpageheader>
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" />

<htmlpagefooter name="myfooter" class="hide">
<div align="center">
	<br>
	<span class="padding_10">Page {PAGENO} of {nbpg}</span>
</div>
</htmlpagefooter>

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of article-->
<table cellspacing="3" cellpadding="3" class="table" align="center">
	<tr>
		<th>Subject</th>
		<th>Description</th>
		<th>File Picture 1</th>
		<th>File Picture 2</th>

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

	</tr>
	<?php } ?>
</table>
<!--End of Data display of article//-->

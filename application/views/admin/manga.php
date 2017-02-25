<?php
	$this->load->view('menu/menu');
?>

<div class="container">
	<h1>This is a Admin manga page!</h1>
	<div class="btn-group btn-group-justified btn-group-lg">
		<a href="<?php echo site_url('admin/add_manga');?>" class="btn btn-primary">Add a new Manga</a>
		<a href="<?php echo site_url('admin/remove_manga');?>" class="btn btn-primary">Remove a Manga</a>
		<a href="<?php echo site_url('admin/update_manga');?>" class="btn btn-primary">Update a Manga</a>
	</div>
</div>

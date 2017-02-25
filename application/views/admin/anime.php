<?php
	$this->load->view('menu/menu');
?>

<div class="container">
	<h1>This is a Admin anime page!</h1>

	<div class="btn-group btn-group-justified btn-group-lg">
		<a href="<?php echo site_url('admin/add_anime');?>" class="btn btn-primary">Add a new Anime</a>
		<a href="<?php echo site_url('admin/remove_anime');?>" class="btn btn-primary">Remove a Anime</a>
		<a href="<?php echo site_url('admin/update_anime');?>" class="btn btn-primary">Update a Anime</a>
	</div>
</div>
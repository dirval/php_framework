<?php
	$this->load->view('menu/menu');
	
?>
<div class="container">
	<h1>This is a Admin add manga page!</h1>
	<div class='formRegister'>
	<?php
		if (isset($error)) {
			echo "<p style='color : red;'>".$error."</p>";
		}
		elseif (isset($result)) {
			echo "<p style='color : lightgreen;'>".$success."</p>";
		}
	?>
		<form enctype="multipart/form-data" method="POST" action="<?php echo site_url('admin/add_manga');?>">
			<label for="title">Title</label>
			<input type="text" name="title" required />
			<label for="author">Author</label>
			<input type="text" name="author" required/>
			<label for="genre">Genre</label>
			<input type="text" name="genre" required />
			<label for="years">Years (xxxx or xxxx/xxxx)</label>
			<input type="text" name="years" required />
			<label for="in_anime">In Anime (no/0 yes/1)</label>
			<input type="number" value="0" min="0" max="1" name="in_anime" required />
			<label for="description">Description</label>
			<textarea name="description" required></textarea>
			<label for="image">Image</label>
			<input type="file" name="image_pres" required />
			<input type="submit" name="save" value="Save">
		</form>
	</div>
</div>
<?php
	$this->load->view('menu/menu');
?>

<div class="container">
	<h1>This is a Admin update anime page!</h1>
	<div class="formRegister">
		<?php
			if (isset($found)) {
				echo "<p style='color: green;'>".$found."</p>";
			}
			elseif (isset($error)) {
				echo "<p style='color: red;'>".$error."</p>";
			}
			elseif (isset($success)) {
				echo "<p style='color: green;'>".$success."</p>"; //success to update the Anime
			}
		?>
		<form method="POST" action="<?php echo site_url('admin/update_anime'); ?>">
			<label for="title">Title</label>
			<input type="text" name="title" />
			<input type="submit" name="search">
		</form>
	</div>

	<?php
		// If i found the Anime, i can show the form for update
		if (isset($found)) { 
	?>
	<div class="formRegister">
	<form enctype="multipart/form-data" method="POST" action="<?php echo site_url('admin/update_anime');?>">
		<label for="title">Title</label>
		<input type="text" name="title" value="<?php echo $_SESSION['anime_found']['title'] ?>" />
		<label for="author">Author</label>
		<input type="text" name="author" value="<?php echo $_SESSION['anime_found']['author'] ?>"/>
		<label for="genre">Genre</label>
		<input type="text" name="genre" value="<?php echo $_SESSION['anime_found']['genre'] ?>"/>
		<label for="years">Years (xxxx or xxxx/xxxx)</label>
		<input type="text" name="years" value="<?php echo $_SESSION['anime_found']['year'] ?>"/>
		<label for="Studio">Studio</label>
		<input type="text" name="studio" value="<?php echo $_SESSION['anime_found']['studio'] ?>"/>
		<label for="description">Description</label>
		<textarea name="description"><?php echo $_SESSION['anime_found']['description'] ?></textarea>
		<label for="image">Image</label>
		<input type="file" name="image_pres"/>
		<input type="submit" name="update" value="Update">
	</form>	
	</div>
	<?php
		}
	?>
</div>

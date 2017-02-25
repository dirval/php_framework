<?php
	$this->load->view('menu/menu');
?>

<div class="container">
	<h1>This is a Admin remove manga page!</h1>
	<div class="formRegister">
		<?php
			if (isset($found)) {
				echo "<p style='color: green;'>".$found."</p>";
			}
			elseif (isset($error)) {
				echo "<p style='color: red;'>".$error."</p>";
			}
			elseif (isset($yesDelete)) {
				echo "<p style='color: green;'>".$yesDelete."</p>";
			}
			elseif (isset($noDelete)) {
				echo "<p style='color: red;'>".$noDelete."</p>";
			}
		?>
		<form method="POST" action="<?php echo site_url('admin/remove_manga'); ?>">
			<label for="title">Title</label>
			<input type="text" name="title" />
			<input type="submit" name="search">
		</form>
	</div>

	<?php if (isset($found)) { ?>
		<div class="card">
			<div class="head_pres">
				<img class="card-img-top img-thumbnail" src="<?php echo base_url($_SESSION['manga_found']['image']); ?>"/>
				<div>
					<h4 class="card-title"><?php echo $_SESSION['manga_found']['title']; ?></h4>
					<p><span>Author:</span> 	<?php echo $_SESSION['manga_found']['author']; ?></p>
					<p><span>Genre:</span>  	<?php echo $_SESSION['manga_found']['genre']; ?></p>
					<p><span>Years:</span>	<?php echo $_SESSION['manga_found']['year']; ?></p>
				</div>
			</div>
			<div class="card-block">
				<h4 class="card-title">Description</h4>
				<p class="card-text"><?php echo $_SESSION['manga_found']['description']; ?></p>
			</div>
		</div>
		<div class="formRegister">
			<form method="POST" action="<?php echo site_url('admin/remove_manga'); ?>">
				<p>Do you realy want delete this Manga?</p>
				<input type="submit" name="yes" value="Yes" />
				<input type="submit" name="no" value="No" />
			</form>
		</div>
	<?php	} ?>
</div>
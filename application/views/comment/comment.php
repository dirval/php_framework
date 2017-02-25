<?php
	if (!isset($_SESSION)) {
		$data['page'] = 'main/login';
		$this->load->view('menu/content', $data);
	}
	$this->load->view('menu/menu');
?>
<div class="container">
	<div class="card">
		<div class="head_pres">
			<img class="card-img-top img-thumbnail" src="<?php echo base_url($_SESSION['mangaComment']['image']); ?>"/>
			<div>
				<h4 class="card-title"><?php echo $_SESSION['mangaComment']['title']; ?></h4>
				<p><span>Author:</span> <?php echo $_SESSION['mangaComment']['author']; ?></p>
				<p><span>Genre:</span>  <?php echo $_SESSION['mangaComment']['genre']; ?></p>
				<p><span>Years:</span>	<?php echo $_SESSION['mangaComment']['year']; ?></p>
			</div>
			<div class="card-block">
				<h4 class="card-title">Description</h4>
				<p class="card-text"><?php echo $_SESSION['mangaComment']['description']; ?></p>
			</div>
		</div>
	</div>

	<?php
		if (isset($usersComment)) {
			$nb_comment = count($usersComment);
			for ($i=0; $i < $nb_comment; $i++) { 
	?>
	<div id="showComment" class="card">
		<div class="card-block">
			<img class="img-circle" src="<?php echo base_url($usersComment[$i]['img_profile']); ?>" />
			<h4 class="card-title"><?php echo $usersComment[$i]['username']; ?></h4>
			<hr />
			<p class="card-text"><?php echo $usersComment[$i]['comment']; ?></p>
		</div>
	</div>
	<?php
			}
		}
	?>


	<div id="formComment">
		<?php
			if (isset($error)) {
				echo "<p style='color: red;'>".$error."</p>";
			}
		?>
		<form method="POST" action="<?php echo site_url('comment/add_comment'); ?>">
			<input type="hidden" name="userId" value="<?php echo $_SESSION['user']['id']; ?>">
			<input type="hidden" name="mediaId" value="<?php echo $_SESSION['mangaComment']['id']; ?>">
			<textarea name="comment" id="textComment" placeholder="Put your comment" required></textarea>
			<fieldset class="rating">
    			<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    			<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    			<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    			<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    			<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
			</fieldset>
			<input type="submit" name="addcomment" value="Add a comment">
		</form>
	</div>
</div>
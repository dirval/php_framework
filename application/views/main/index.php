<?php
	$this->load->view('menu/menu');
?>
<div class="container">
	<div id="mainPres">
		<h1>Hello <?php echo '<tr><td>'.$_SESSION['user']['username'].'</td>'; ?> and welcome !</h1>
		<hr />
		<p>Thank you for come on my website !</p>
		<br/>
		<p>Here you can see all information about one Manga or Anime, (depend what do you like). You can navigate using the menu bar on the top of the screen. You can choose between Manga or Anime, when you go on the page you can see all manga/anime that we have and make a research by alphabet order. Moreover you can add a new comment and see the comments of the other users.</p>
		<br/>
		<p>Of course you are also your own profile page where you can update your profile like change password, description, email and profile picture.</p>
		<br/>
		<p>Thank you for the visit and enjoy your day !</p>
	</div>
</div>
<?php
	$this->load->view('menu/menu');
?>
<div class="container">
	<div id="profile">
		<h2><?php echo $_SESSION['user']['username']; ?></h2>
		<hr />
		<div class='row'>
			<div class="col col-md-6">
				<img class="img-circle" src="<?php echo base_url($_SESSION['user']['img_profile']); ?>" />
			</div>
			<div class='col col-md-6 info'>
				<label for="email">Email:</label>
				<p><?php echo $_SESSION['user']['email']; ?></p>
				<label for="description">Description :</label>
				<p><?php echo $_SESSION['user']['description']; ?></p>
			</div>
		</div>
		<a href="<?php echo site_url('user/updateProfile') ?>"><button class="btn">Update Profile</button></a>
	</div>
</div>

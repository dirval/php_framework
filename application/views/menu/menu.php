<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
      		<a class="navbar-brand" href="<?php echo site_url('main/index');?>" role="presentation">MangaFan</a>
    	</div>
		<ul class="nav navbar-nav nav-custom">
			<li><a href="<?php echo site_url('user/profile');?>" role="presentation">My Profile</a></li>
			<li><a href="<?php echo site_url('media/show_manga');?>" role="presentation">Manga</a></li>
			<li><a href="<?php echo site_url('media/show_anime');?>" role="presentation">Anime</a></li>
			<?php
				if ($_SESSION['user']['username'] == 'admin') {
					echo '<li><a href="#" role="presentation">Administration</a>
							<ul>
							<li><a href="';
					echo site_url('admin/manga'); 
					echo '" role="presentation">Manga</a></li>
							<li><a href="';
					echo site_url('admin/anime'); 
					echo '" role="presentation">Anime</a></li>
							<li><a href="';
					echo site_url('admin/user'); 
					echo '" role="presentation">Users</a></li></ul></li>';
				}

			?>
			<div id="logoutButton">
				<a href="<?php echo site_url('user/logout');?>"><button class="btn btn-danger navbar-btn"><img src="<?php echo base_url('images/autre/logout.png');?>" /> Log out</button></a>
			</div>
		</ul>
	</div>
</nav>
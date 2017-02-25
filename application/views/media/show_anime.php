<?php
	session_start();
	$this->load->view('menu/menu');
?>

<div class="container">
	<?php
		echo "<div class='searchAlpha'>";
		foreach(range('A','Z') as $i) {
    		echo "<a href=";
    		echo site_url('media/search_anime/'.$i);
    		echo ">".$i."</a>	 ";
		}
		echo "</div>";

		if (isset($error)) {
			echo "<p style='color: red;'>".$error."</p>";
		}
		if (!isset($anime_search) && !isset($error)) {
			$nb_anime = count($anime);
			for ($i=0; $i < $nb_anime; $i++) { 
	?>
	<div class="card">
		<div class="head_pres">
			<img class="card-img-top img-thumbnail" src="<?php echo base_url($anime[$i]['image']); ?>"/>
			<div>
				<h4 class="card-title"><?php echo $anime[$i]['title']; ?></h4>
				<p><span>Author:</span> <?php echo $anime[$i]['author']; ?></p>
				<p><span>Genre:</span>  <?php echo $anime[$i]['genre']; ?></p>
				<p><span>Years:</span>	<?php echo $anime[$i]['year']; ?></p>
				<p><span>Studio:</span>	<?php echo $anime[$i]['studio']; ?></p>
				<div class="buttonComment">
					<a href="<?php echo site_url('comment/media_comment/'.$anime[$i]['id']); ?>"><button>Comment</button></a>
				</div>
			</div>
			<div class="card-block">
				<h4 class="card-title">Description</h4>
				<p class="card-text"><?php echo $anime[$i]['description']; ?></p>
			</div>
		</div>
	</div>
	<?php } }?>

	<?php 
		if (isset($anime_search)) {
			$nb_anime = count($anime_search);
			for ($i=0; $i < $nb_anime ; $i++) { 
	?>		
	<div class="card">
		<div class="head_pres">
			<img class="card-img-top img-thumbnail" src="<?php echo base_url($anime_search[$i]['image']); ?>"/>
			<div>
				<h4 class="card-title"><?php echo $anime_search[$i]['title']; ?></h4>
				<p><span>Author:</span> <?php echo $anime_search[$i]['author']; ?></p>
				<p><span>Genre:</span>  <?php echo $anime_search[$i]['genre']; ?></p>
				<p><span>Years:</span>	<?php echo $anime_search[$i]['year']; ?></p>
				<p><span>Studio:</span>	<?php echo $anime_search[$i]['studio']; ?></p>
				<div class="buttonComment">
					<a href="<?php echo site_url('comment/media_comment/'.$anime_search[$i]['id']); ?>"><button>Comment</button></a>
				</div>
			</div>
			<div class="card-block">
				<h4 class="card-title">Description</h4>
				<p class="card-text"><?php echo $anime_search[$i]['description']; ?></p>
			</div>
		</div>
	</div>
	<?php
			}
		}
	?>
</div>
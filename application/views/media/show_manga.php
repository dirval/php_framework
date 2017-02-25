<?php
	session_start();
	$this->load->view('menu/menu');
?>
<div class="container">
	<?php
		echo "<div class='searchAlpha'>";
		foreach(range('A','Z') as $i) {
    		echo "<a href=";
    		echo site_url('media/search_manga/'.$i);
    		echo ">".$i."</a>	 ";
		}
		echo "</div>";

		if (isset($error)) {
			echo "<p style='color: red;'>".$error."</p>";
		}
		if (!isset($manga_search) && !isset($error)) {
			$nb_manga = count($manga);
			for ($i=0; $i < $nb_manga; $i++) { 
	?>
	<div class="card">
		<div class="head_pres">
			<img class="card-img-top img-thumbnail" src="<?php echo base_url($manga[$i]['image']); ?>"/>
			<div>
				<h4 class="card-title"><?php echo $manga[$i]['title']; ?></h4>
				<p><span>Author:</span> <?php echo $manga[$i]['author']; ?></p>
				<p><span>Genre:</span>  <?php echo $manga[$i]['genre']; ?></p>
				<p><span>Years:</span>	<?php echo $manga[$i]['year']; ?></p>
				<div class="buttonComment">
					<a href="<?php echo site_url('comment/media_comment/'.$manga[$i]['id']); ?>"><button>Comment</button></a>
				</div>
			</div>
			<div class="card-block">
				<h4 class="card-title">Description</h4>
				<p class="card-text"><?php echo $manga[$i]['description']; ?></p>
			</div>
		</div>
	</div>
	<?php } }?>

	<?php 
		if (isset($manga_search)) {
			//print_r($manga_search);
			$nb_manga = count($manga_search);
			for ($i=0; $i < $nb_manga ; $i++) { 
	?>		
	<div class="card">
		<div class="head_pres">
			<img class="card-img-top img-thumbnail" src="<?php echo base_url($manga_search[$i]['image']); ?>"/>
			<div>
				<h4 class="card-title"><?php echo $manga_search[$i]['title']; ?></h4>
				<p><span>Author:</span> <?php echo $manga_search[$i]['author']; ?></p>
				<p><span>Genre:</span>  <?php echo $manga_search[$i]['genre']; ?></p>
				<p><span>Years:</span>	<?php echo $manga_search[$i]['year']; ?></p>
				<div class="buttonComment">
					<a href="<?php echo site_url('comment/media_comment/'.$manga_search[$i]['id']); ?>"><button>Comment</button></a>
				</div>
			</div>
			<div class="card-block">
				<h4 class="card-title">Description</h4>
				<p class="card-text"><?php echo $manga_search[$i]['description']; ?></p>
			</div>
		</div>
	</div>
	<?php
			}
		}
	?>
</div>
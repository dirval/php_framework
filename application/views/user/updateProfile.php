<?php
	$this->load->view('menu/menu');
?>
<div class="container">
	<div class="formRegister">
		<?php
			if (isset($error)) {
				echo "<p style='color: red;'>".$error."</p>";
			}
			elseif (isset($success)) {
				echo "<p style='color: green;'>".$success."</p>";
			}
			elseif (isset($errorUp)) {
				echo "<p style='color: red;'>".$errorUp."</p>";
			}

		?>
		<form enctype="multipart/form-data" method="POST" action="<?php echo site_url('user/updateProfile'); ?>">
			<label for="pass">Password:</label>
			<input type="password" name="pass" placeholder="Password"/>

			<label for="confpass">Confirm Password:</label>
			<input type="password" name="confpass" placeholder="Confirm Password"/>

			<label for="email">Email:</label>
			<input type="text" name="email" value="<?php echo $_SESSION['user']['email']; ?>" />

			<label for="description">Description:	</label>
			<textarea type="text" name="description"><?php echo $_SESSION['user']['description']; ?></textarea>

			<label for="email">Image Profile:</label>
			<input type="file" name="img_profile" />

			<input type="submit" name="btnUpdateProfile" value="Update Profile">
		</form>
	</div>
</div>
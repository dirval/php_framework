<div class="container">
	<div class="formLogin formRegister">
		<form method="POST" action="<?php echo site_url('user/validate_login'); ?>">
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<input type="submit" name="btnLogin" value="Login">
		</form>
		<p>You don't have a accont ! click to <a href="<?php echo site_url('user/register');?>">Register</a></p>
		<?php
			if (isset($error)) {
				echo '<p style="color: red;">'.$error.'</p>';
			}
		?>
	</div>
</div>
<div class="container">
	<div class="formRegister">
		<?php
			if (isset($error)) {
				echo '<p style="color: red;">'.$error.'</p>';
			}

			if (isset($success)) {
				echo '<p style="color: green;">'.$success.'</p>';
			}
		?>
		<div id="returnLogin">
			<a href="<?php echo site_url('user/logout')?>"><button>Login page!</button></a>
		</div>
		<form method="POST" action="<?php echo site_url('user/register'); ?>">
			<label for="username">Username:</label>
			<input type="text" name="username" placeholder="Username" required />

			<label for="pass">Password:</label>
			<input type="password" name="pass" placeholder="Password" required/>

			<label for="confpass">Confirm Password:</label>
			<input type="password" name="confpass" placeholder="Confirm Password" required/>

			<label for="email">Email:</label>
			<input type="text" name="email" placeholder="Email" required/>

			<label for="description">Description (not mandatory):	</label>
			<textarea type="text" name="description" placeholder="description" ></textarea>

			<input type="submit" name="btnRegister" value="Register">
		</form>
	</div>
</div>
<?php
	$this->load->view('menu/menu');
?>
<div class="container">
	<h1>This is a Admin user page!</h1>

	<?php
		if (isset($error)) {
			echo "<p style='color: red;'>".$error."</p>";
		}
		elseif (isset($success)) {
			echo "<p style='color: green;'>".$success."</p>";
		}
		elseif (isset($cancel)) {
			echo "<p style='color: red;'>".$cancel."</p>";
		}
	?>
	<table id="tableau" summary="Classement Blogspot par Wikio - Mai 2010">
  		<thead>
    	<tr>
      		<th scope="col">Id</th>
      		<th scope="col">Username</th>
      		<th scope="col">Email</th>
      		<th scope="col">Description</th>
      		<th scope="col">Remove</th>
    	</tr>
  		</thead>
  		<tfoot>
  			<tr>
    		  <td colspan="5">All Users in the data base</td>
    		</tr>
  		</tfoot>
  		<tbody>
	<?php 
		if (isset($users)) {
			$nb_users = count($users);	
			for ($i=0; $i < $nb_users; $i++) {
				if ($users[$i]['username'] != 'admin') {
	?>
		<tr>
			<td><?php echo $users[$i]['id']; ?></td>
			<td><?php echo $users[$i]['username']; ?></td>
			<td><?php echo $users[$i]['email']; ?></td>
			<td><?php echo $users[$i]['description']; ?></td>
			<td><a href="<?php echo site_url('admin/remove_user/'.$users[$i]['id'].'/null'); ?>"><button class="btn btn-small btn-warning">Delete</button></a><?php if (isset($id) && $id == $users[$i]['id']) {
				echo "<a href='";
				echo site_url('admin/remove_user/'.$users[$i]['id'].'/yes');
				echo "'><button class='btn btn-small btn-warning'>Yes</button><a href='";
				echo site_url('admin/remove_user/'.$users[$i]['id'].'/no');
				echo "'><button class='btn btn-small btn-warning'>No</button>";
			} ?></td>
		</tr>
	<?php
				}
			}
		}
	?>
		</tbody>
	</table>
</div>

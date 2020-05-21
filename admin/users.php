<?php 
	
	# Update user profile
	if (isset($_POST['edit']) && $_POST['_action_'] == 'TRUE') {
		$query  = "UPDATE users SET firstname='" . $_POST['firstname'] . "', lastname='" . $_POST['lastname'] . "', email='" . $_POST['email'] . "', username='" . $_POST['username'] . "', country='" . $_POST['country'] . "', archive='" . $_POST['archive'] . "'";
        $query .= " WHERE id=" . (int)$_POST['edit'];
        $query .= " LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
		# Close MySQL connection
		@mysqli_close($MySQL);
		
		$_SESSION['message'] = '<p>Uspješno ste promjenili podatke korisnika!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=1");
	}
	# End update user profile
	
	# Delete user profile
	if (isset($_GET['delete']) && $_GET['delete'] != '') {
	
		$query  = "DELETE FROM users";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>Uspješno ste obrisali korisnika!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=1");
	}
	# End delete user profile
	
	
	#Show user info
	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['id'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		print '
		<h2>User profile</h2>
		<p><b>Ime:</b> ' . $row['firstname'] . '</p>
		<p><b>Prezime:</b> ' . $row['lastname'] . '</p>
		<p><b>Username:</b> ' . $row['username'] . '</p>';
		$_query  = "SELECT * FROM countries";
		$_query .= " WHERE country_code='" . $row['country'] . "'";
		$_result = @mysqli_query($MySQL, $_query);
		$_row = @mysqli_fetch_array($_result);
		print '
		<p><b>Country:</b> ' .$_row['country_name'] . '</p>
		<p><b>Date:</b> ' . pickerDateToMysql($row['date']) . '</p>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Natrag</a></p>';
	}
	#Edit user profile
	else if (isset($_GET['edit']) && $_GET['edit'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['edit'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		$checked_archive = false;
		
		print '
		<h2>Promijeni podatke korisnika</h2>
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<input type="hidden" id="edit" name="edit" value="' . $_GET['edit'] . '">
			
			<label for="fname">Ime *</label>
			<input type="text" id="fname" name="firstname" value="' . $row['firstname'] . '" placeholder="Vaše ime.." required>

			<label for="lname">Prezime *</label>
			<input type="text" id="lname" name="lastname" value="' . $row['lastname'] . '" placeholder="Vaše prezime.." required>
				
			<label for="email">E-mail *</label>
			<input type="email" id="email" name="email"  value="' . $row['email'] . '" placeholder="Vaš e-mail.." required>
			
			<label for="username">Korisničko ime *<small>(Korisničko ime mora imati najmanje 5 i najviše 10 znakova)</small></label>
			<input type="text" id="username" name="username" value="' . $row['username'] . '" pattern=".{5,10}" placeholder="Username.." required><br>
			
			<label for="country">Država</label>
			<select name="country" id="country">
				<option value="">molimo odaberite</option>';
				#Select all countries from database webprog, table countries
				$_query  = "SELECT * FROM countries";
				$_result = @mysqli_query($MySQL, $_query);
				while($_row = @mysqli_fetch_array($_result)) {
					print '<option value="' . $_row['country_code'] . '"';
					if ($row['country'] == $_row['country_code']) { print ' selected'; }
					print '>' . $_row['country_name'] . '</option>';
				}
			print '
			</select>
			
			<label for="archive">Arhiva:</label><br />
            <input type="radio" name="archive" value="Y"'; if($row['archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo ' /> DA &nbsp;&nbsp;
			<input type="radio" name="archive" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> NE
			
			<hr>
			
			<input type="submit" value="Potvrdi">
		</form>
		<p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Natrag</a></p>';
	}
	else {
		print '
		<h2>Lista korisnika</h2>
		<div id="users">
			<table>
				<thead>
					<tr>
						<th width="16"></th>
						<th width="16"></th>
						<th width="16"></th>
						<th>Ime</th>
						<th>Prezime</th>
						<th>E mail</th>
						<th>Država</th>
						<th width="16"></th>
					</tr>
				</thead>
				<tbody>';
				$query  = "SELECT * FROM users";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;id=' .$row['id']. '"><img src="img/user.png" alt="user"></a></td>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img src="img/edit.png" alt="edit"></a></td>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="delete"></a></td>
						<td><strong>' . $row['firstname'] . '</strong></td>
						<td><strong>' . $row['lastname'] . '</strong></td>
						<td>' . $row['email'] . '</td>
						<td>';
							$_query  = "SELECT * FROM countries";
							$_query .= " WHERE country_code='" . $row['country'] . "'";
							$_result = @mysqli_query($MySQL, $_query);
							$_row = @mysqli_fetch_array($_result, MYSQLI_ASSOC);
							print $_row['country_name'] . '
						</td>
						<td>';
							if ($row['archive'] == 'Y') { print '<img src="img/inactive.png" alt="archive" title="" />'; }
                            else if ($row['archive'] == 'N') { print '<img src="img/active.png" alt="active" title="" />'; }
						print '
						</td>
					</tr>';
				}
			print '
				</tbody>
			</table>
		</div>';
	}
	
	# Close MySQL connection
	@mysqli_close($MySQL);
?>
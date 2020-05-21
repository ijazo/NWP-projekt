<?php 
	if ($_SESSION['user']['valid'] == 'true') {
		if (!isset($action)) { $action = 1; }
		print '
		<h1>Administrator</h1>
		<div id="admin">
			<ul>
				<li><a href="index.php?menu=7&amp;action=1">Korisnici</a></li>
				<li><a href="index.php?menu=7&amp;action=2">Novosti</a></li>
			</ul>';
			# Admin Users
			if ($action == 1) { include("admin/users.php"); }
			# Admin News
			else if ($action == 2) { include("admin/news.php"); }
			# Admin HNB XML
			else if ($action == 3) { include("admin/hnb-xml.php"); }
			# Admin HNB JSON
			else if ($action == 4) { include("admin/hnb-json.php"); }
		print '
		</div>';
	}
	else {
		$_SESSION['message'] = '<p>Molimo registrirajte se ili ulogirajte!</p>';
		header("Location: index.php?menu=6");
	}
?>
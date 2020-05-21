<?php 
	print '
	<ul>
		<li><a href="index.php?menu=1">Naslovnica</a></li>
		<li><a href="index.php?menu=2">Novosti</a></li>
		<li><a href="index.php?menu=3">Kontakt</a></li>
		<li><a href="index.php?menu=4">O gradu</a></li>';
		if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
			print '
			<li style="float:right;"><a href="index.php?menu=6">Prijava</a></li>
			<li style="float:right;"><a href="index.php?menu=5">Registracija</a></li>';
		}
		else if ($_SESSION['user']['valid'] == 'true') {
			print '
			<li style="float:right;"><a href="signout.php">Odjava</a></li>
			<li style="float:right;"><a href="index.php?menu=7">Admin</a></li>';
		}
		print '
		<li><a href="index.php?menu=10">Vremenska prognoza</a></li>

	</ul>';
?>
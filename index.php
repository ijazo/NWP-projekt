<?php 
	# Stop Hacking attempt
	define('__APP__', TRUE);
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	# Start session
    session_start();
	
	# Database connection
	include ("dbconn.php");
	
	# Variables MUST BE INTEGERS
    if(isset($_GET['menu'])) { $menu   = (int)$_GET['menu']; }
	if(isset($_GET['action'])) { $action   = (int)$_GET['action']; }
	
	# Variables MUST BE STRINGS A-Z
    if(!isset($_POST['_action_']))  { $_POST['_action_'] = FALSE;  }
	
	if (!isset($menu)) { $menu = 1; }
	
	# Classes & Functions
    include_once("functions.php");
	
print '
<!DOCTYPE html>
<html>
	<head>
		
		<!-- CSS -->
		<link rel="stylesheet" href="style.css">
		<!-- End CSS -->
		<!-- meta elements -->
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="description" content="some description">
        <meta name="keywords" content="keyword 1, keyword 2, keyword 3, keyword 4, ...">
		
		<!-- Schema.org markup for Google+ -->
		<meta itemprop="name" content="Grad Nova Gradiška">
		<meta itemprop="description" content="Some description">
		<meta itemprop="image" content="Your URL"> 
		
		<!-- Open Graph data -->
		<meta property="og:title" content="Grad Nova Gradiška">
		<meta property="og:type" content="article">
		<meta property="og:url" content="Your URL">
		<meta property="og:image" content="Your URL">
		<meta property="og:description" content="Some description">
		<meta property="article:tag" content="keyword 1, keyword 2, keyword 3, keyword 4, ...">
		
		<!-- Twitter Card data -->
		<meta name="twitter:title" content="Grad Nova Gradiška">
		<meta name="twitter:description" content="Some description">
		
        <meta name="author" content="jazo.ivann@gmail.com">
		<!-- favicon meta -->
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
		<!-- end favicon meta -->
		<!-- end meta elements -->
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Cabin Condensed" rel="stylesheet"> 
		<!-- End Google Fonts -->
		<title>Grad Nova Gradiška</title>
	</head>
<body>
	<header>
	<nav>';
			include("menu.php");
		print '</nav>
		<div class="hero-image"></div>
		
	</header>
	<main>';
		if (isset($_SESSION['message'])) {
			print $_SESSION['message'];
			unset($_SESSION['message']);
		}
	
	# Naslovnica
	if (!isset($menu) || $menu == 1) { include("home.php"); }
	
	# Novosti
	else if ($menu == 2) { include("news.php"); }
	
	# Kontakt
	else if ($menu == 3) { include("contact.php"); }
	
	# O gradu
	else if ($menu == 4) { include("about-us.php"); }
	
	# Registracija
	else if ($menu == 5) { include("register.php"); }
	
	# Prijava
	else if ($menu == 6) { include("signin.php"); }
	
	# Admin 
	else if ($menu == 7) { include("admin.php"); }
	
	# API OMDB
	else if ($menu == 10) { include("omdb.php"); }
	
	
	
	print '
	</main>
	<footer>
		<p>Copyright &copy; ' . date("Y") . ' Ivan Jažo. <a href="https://github.com/asimec1/project-php-api" style="color:#fff">GITHub</a></p>
	</footer>
</body>
</html>';
?>

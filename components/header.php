<?php
	session_start();
	# need login
	if(!isset($_SESSION['id'])){
		include(__DIR__.'/start.php');
		die;
	}
	$id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Warzone">
    <meta name="author" content="root_kjh">
    <link rel="icon" href="../assets/img/favicon.ico">
    <title>Warzone</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/cover.css" rel="stylesheet">
	<link href="../assets/css/footer.css" rel="stylesheet">
  </head>
  <body>
  	<ul class="nav nav-tabs">
  		<li role="presentation" id="home"><a href="/">Home</a></li>
  		<li role="presentation" id="chall"><a href="/chall">Challenge</a></li>
  		<li role="presentation" id="rank"><a href="/rank">Rank</a></li>
		<li role="presentation" id="status"><a href="/status">Status</a></li>
		<li role="presentation" id="profile"><a href="/profile">Profile</a></li>
		<?php if($_SESSION['id']=="root"){
			?>
			<li role="presentation" id="admin"><a href="/admin">Admin</a></li>
			<?php
		}?>
		<li role="presentation" id="logout"><a href="/logout">Logout</a></li>
	</ul>

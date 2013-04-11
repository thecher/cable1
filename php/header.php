<?php

session_start();

?>

<!doctype html>
<head>
	<meta charset="utf-8">
	<title>Index</title>
</head>

<body>

<div id="container">

	<div id="header">
		<?php 
			echo($_SERVER['REQUEST_URI']);
			if (isset($_SESSION["author"]["id"])) {
				include "loggedinheader.php";
			}else{
				include "loggedoutheader.php";
			}
		?>
	</div>
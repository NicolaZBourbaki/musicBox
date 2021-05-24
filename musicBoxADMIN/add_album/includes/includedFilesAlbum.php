<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	include("add_album/includes/configArtist.php");
	include("add_album/includes/classes/User.php");

	if(isset($_GET['userLoggedIn'])) {
		$userLoggedIn = new User($con, $_GET['userLoggedIn']);
	}
	else {
		echo "Username variable was not passed into page. Check the openPage JS function";
		exit();
	}
	include("add_album/includes/header.php");
}
?>
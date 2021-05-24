<?php
include("../../config.php");

if(!isset($_POST['username'])) {
	echo "ERROR: Could not set username";
	exit();
}

if(!isset($_POST['name']) || !isset($_POST['newName'])) {
	echo "Не всі поля заповнені";
	exit();
}	

    $Name = $_POST['name'];
    $username = $_POST['username'];
	$newName = $_POST['newName'];
	
	$PlNameCheck = mysqli_query($con, "SELECT * FROM playlists WHERE name = '$Name' AND owner = '$username'");
	if(mysqli_num_rows($PlNameCheck) != 1) {
		echo "У вас немає плейлиста з такою назвою";
		exit();
	}


	$updateQuery = mysqli_query($con, "UPDATE playlists SET name = '$newName' WHERE name = '$Name'");
	echo "Успішно обновлено";

?>
<?php
include("../../config.php");

if(!isset($_POST['username'])) {
	echo "ERROR: Could not set username";
	exit();
}
	
	$username = $_POST['username'];
	$songId = $_POST['songId'];
	$UsersQuery = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
	$user = mysqli_fetch_array($UsersQuery);
	$userId = $user['id'];
	$SongsQuery = mysqli_query($con, " SELECT * FROM Songs WHERE id = '$songId'");
	$songs = mysqli_fetch_array($SongsQuery);
	$artistId = $songs['artist'];
	$SongAddCheck = mysqli_query($con, "SELECT * FROM likedSongs WHERE songId = '$songId' AND userId = '$userId'");
	if(mysqli_num_rows($SongAddCheck) == 1) {	
		$query = mysqli_query($con, "DELETE FROM likedSongs WHERE songId='$songId' AND userId = '$userId'");
		exit();
	}
	$query = mysqli_query($con, "INSERT INTO likedSongs VALUES('', '$songId', '$userId', '$artistId')");
?>
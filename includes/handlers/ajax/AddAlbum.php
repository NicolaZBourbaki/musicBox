<?php
include("../../config.php");

if(!isset($_POST['username'])) {
	echo "ERROR: Could not set username";
	exit();
}
	
	$username = $_POST['username'];
	$albumId = $_POST['albumId'];
	$UsersQuery = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
	$user = mysqli_fetch_array($UsersQuery);
	$userId = $user['id'];
	$AddAlbumCheck = mysqli_query($con, "SELECT * FROM AddedAlbums WHERE albumId = '$albumId' AND userId = '$userId'");
	if(mysqli_num_rows($AddAlbumCheck) == 1) {	
		
		$query = mysqli_query($con, "DELETE FROM AddedAlbums WHERE albumId='$albumId' AND userId = '$userId'");
		exit();
	}
	$Albums = mysqli_query($con, "SELECT * FROM albums WHERE id = '$albumId'");
	$Album = mysqli_fetch_array($Albums);
	$artistId = $Album['artist'];
	$query = mysqli_query($con, "INSERT INTO AddedAlbums VALUES('', '$albumId', '$userId', '$artistId')");
?>
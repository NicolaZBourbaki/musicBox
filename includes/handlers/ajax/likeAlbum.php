<?php
include("../../config.php");

if(!isset($_POST['username'])) {
	echo "ERROR: Could not set username";
	exit();
}
	
	$username = $_POST['username'];
	$artistId = $_POST['artistId'];
	$UsersQuery = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
	$user = mysqli_fetch_array($UsersQuery);
	$userId = $user['id'];
	$ArtistsQuery = mysqli_query($con, " SELECT * FROM artists WHERE id = '$artistId'");
	$follows = mysqli_fetch_array($ArtistsQuery);
	$follow = $follows['name'];
	$followers = $follows['followers'];
	$FollowCheck = mysqli_query($con, "SELECT * FROM follows WHERE artistId = '$artistId' AND userId = '$userId'");
	if(mysqli_num_rows($FollowCheck) == 1) {	
		$followers = $followers - 1;
		$query = mysqli_query($con, "UPDATE artists SET followers = '$followers' WHERE id = '$artistId'");
		$query = mysqli_query($con, "DELETE FROM follows WHERE artistId='$artistId' AND userId = '$userId'");
		exit();
	}
	
	$query = mysqli_query($con, "INSERT INTO follows VALUES('', '$artistId', '$userId')");
	$followers = $followers + 1;
	$query = mysqli_query($con, "UPDATE artists SET followers = '$followers' WHERE id = '$artistId'");
	

?>
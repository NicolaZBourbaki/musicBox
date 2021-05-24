<?php
include("../../config.php");


if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
	$playlistId = $_POST['playlistId']; 
	$songId = $_POST['songId'];

	$orderIdQuery = mysqli_query($con, "SELECT MAX(playlistOrder) + 1 as playlistOrder FROM playlistSongs WHERE playlistId='$playlistId'");
    $songArtist = mysqli_query($con, " SELECT artist FROM Songs WHERE id = '$songId'");
    $songAlbum = mysqli_query($con, " SELECT album FROM Songs WHERE id = '$songId'");
    $rowAr = mysqli_fetch_array($songArtist);
    $rowAl = mysqli_fetch_array($songAlbum);
	$row = mysqli_fetch_array($orderIdQuery);
    $artist = $rowAr['artist'];
    $album = $rowAl['album'];
	$order = $row['playlistOrder'];

	$query = mysqli_query($con, "INSERT INTO playlistSongs VALUES('', '$songId', '$artist', '$album', '$playlistId', '$order')");

}
else {
	echo "PlaylistId or songId was not passed into addToPlaylist.php";
}



?>
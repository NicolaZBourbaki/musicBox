<?php
include("../../config.php");

if(isset($_POST['name']) && isset($_POST['username'])) {

	$name = $_POST['name'];

	if($name == '')
	{
		echo 'Ви не ввели назву ';
		exit();
	}
	$username = $_POST['username'];
	$date = date("Y-m-d H:i:s");

	$query = mysqli_query($con, "INSERT INTO playlists VALUES('', '$name','$username', 'assets/images/icons/playlistStandart.jpg', '$date')");
	
}
else {
	echo "Name or username parameters not passed into file";
}

?>
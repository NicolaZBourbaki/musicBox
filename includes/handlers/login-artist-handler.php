<?php
if(isset($_POST['loginButton'])) {
	//Login button was pressed
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPassword'];

	$result = $account->loginArtist($username, $password);

	if($result == true) {
		$_SESSION['userLoggedIn'] = $username;
		header("Location: musicBoxADMIN/indexArtist.php");
	}

}
?>
<?php
include("../../config.php");

if(!isset($_POST['username'])) {
	echo "ERROR: Could not set username";
	exit();
}

if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1'])  || !isset($_POST['newPassword2'])) {
	echo "Не всі паролі були вписані";
	exit();
}

if($_POST['oldPassword'] == "" || $_POST['newPassword1'] == ""  || $_POST['newPassword2'] == "") {
	echo "Будь ласка, заповніть поля";
	exit();
}

$username = $_POST['username'];
$oldPassword = $_POST['oldPassword'];
$newPassword1 = $_POST['newPassword1'];
$newPassword2 = $_POST['newPassword2'];

$oldMd5 = md5($oldPassword);

$passwordCheck = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$oldMd5'");
if(mysqli_num_rows($passwordCheck) != 1) {
	echo "Некоректний пароль";
	exit();
}

if($newPassword1 != $newPassword2) {
	echo "Паролі не однакові";
	exit();
}

if(preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
	echo "Ваш пароль має складатися з цифр та букв";
	exit();
}

if(strlen($newPassword1) > 30 || strlen($newPassword1) < 5) {
	echo "Ваш пароль має містити від 5 до 30 символів";
	exit();
}

$newMd5 = md5($newPassword1);

$query = mysqli_query($con, "UPDATE users SET password='$newMd5' WHERE username='$username'");
echo "Успішно обновлено";

?>
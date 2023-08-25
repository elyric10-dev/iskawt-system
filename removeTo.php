<?php
session_start();
include('db.php');
$email = $_POST['email'];

if (isset($_POST['email'])) {
	$apps = $_POST['app'];


	$getId_query = mysqli_query($conn, "SELECT email FROM user_accounts WHERE email = '$email'");
	$getId = $getId_query->fetch_array();
	$id = $getId['email'];


	foreach ($apps as $app) {
		if ($app === '1') $query = mysqli_query($conn, "UPDATE allowed_apps SET ggmail = '0' WHERE email = '$id'");
		if ($app === '2') $query = mysqli_query($conn, "UPDATE allowed_apps SET gdrive = '0' WHERE email = '$id'");
		if ($app === '3') $query = mysqli_query($conn, "UPDATE allowed_apps SET gform = '0' WHERE email = '$id'");
		if ($app === '4') $query = mysqli_query($conn, "UPDATE allowed_apps SET ghangout = '0' WHERE email = '$id'");
		if ($app === '5') $query = mysqli_query($conn, "UPDATE allowed_apps SET gdocument = '0' WHERE email = '$id'");
		if ($app === '6') $query = mysqli_query($conn, "UPDATE allowed_apps SET gspreadsheet = '0' WHERE email = '$id'");
		if ($app === '7') $query = mysqli_query($conn, "UPDATE allowed_apps SET gpresentation = '0' WHERE email = '$id'");
		if ($app === '8') $query = mysqli_query($conn, "UPDATE allowed_apps SET gclassroom = '0' WHERE email = '$id'");
		if ($app === '9') $query = mysqli_query($conn, "UPDATE allowed_apps SET gmeet = '0' WHERE email = '$id'");
		if ($app === '10') $query = mysqli_query($conn, "UPDATE allowed_apps SET gcalendar = '0' WHERE email = '$id'");
	}
	header('Location: admin.php');
	$_SESSION['deleted_message'] = 'Application Deleted Successfully';
}

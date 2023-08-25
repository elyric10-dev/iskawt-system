<?php
require('db.php');
include("auth.php");

if(!isset($_SESSION)){ 
    session_start(); 
} 

$getEmail = $_SESSION['admin'];

//FETCH ADMIN DETAILS FROM DATABASE
$adminData = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$getEmail'");
$getAdmin = $adminData->fetch_array();
$id = $getAdmin['id'];

if(!isset($_POST['pincode_mfa'])){
	//ENABLE BUTTON
	echo 'DISABLED';

//ENABLED QR LOGIN
	$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('Admin','$getEmail','Disabled MFA OTP')");

	$MFA_PINCODE = mysqli_query($conn, "UPDATE admin SET mfa_pincode_enabled = '0' WHERE id = '$id'");
	header('Location: admin.php');
}else{
	echo 'NO NO NO';
}



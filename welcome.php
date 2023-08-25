<?php
session_start();
require_once 'config.php';


// authenticate code from Google OAuth Flow

if (isset($_GET['code'])) {
	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	$client->setAccessToken($token['access_token']);

	// get profile info
	$google_oauth = new Google_Service_Oauth2($client);
	$google_account_info = $google_oauth->userinfo->get();
	$userinfo = [
		'email' => $google_account_info['email'],
		'first_name' => $google_account_info['givenName'],
		'last_name' => $google_account_info['familyName'],
		'full_name' => $google_account_info['name'],
		'picture' => $google_account_info['picture'],
		'verifiedEmail' => $google_account_info['verifiedEmail'],
		'token' => $google_account_info['id'],
	];



	$_SESSION['profile'] = $userinfo['picture'];
	$_SESSION['user_token'] = $token;
	$_SESSION['email'] = $userinfo['email'];
	$_SESSION['first_name'] = $userinfo['first_name'];
	$_SESSION['last_name'] = $userinfo['last_name'];
	$_SESSION['full_name'] = $userinfo['full_name'];
	$_SESSION['verified_email'] = $userinfo['verifiedEmail'];
	$_SESSION['gtoken'] = $userinfo['token'];



	// checking if user is already exists in database
	$sql = "SELECT * FROM user_accounts WHERE email ='{$userinfo['email']}'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		// user is EXISTED
		$userinfo = mysqli_fetch_array($result);

		//FETCH ADMIN DETAILS FROM DATABASE
		$adminData = mysqli_query($conn,"SELECT * FROM admin WHERE id = '1'");
		$getAdmin = $adminData->fetch_array();


		
		$check_new_email = "SELECT * FROM user_accounts WHERE email = '{$_SESSION['email']}'";
		$check_new_email_query = mysqli_query($conn, $check_new_email);
		
		//CHECK IF NEW EMAIL
		if (mysqli_num_rows($check_new_email_query) > 0) {
			
			$_SESSION['user_token'] = $token;
			$_SESSION['user_id'] = $userinfo['id'];
			$get_check_account = $check_new_email_query->fetch_array();

			//ACTIVITY LOG
			$email_row = $_SESSION['email'];
			$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User','$email_row','Logged in with Google')");

			//REDIRECT NEW EMAIL TO NEW_USER.PHP
			if ($get_check_account['check_new_account'] === '0') {
				header('Location: new_user.php');
			}
			//IF EMAIL ALREADY EXISTED
			//CHECK IF OTP IS ENABLED BY THE ADMIN
			else if ($getAdmin['mfa_pincode_enabled'] === '1') {
			//CHECK IF OTP IS ENABLED BY THE USER
				if($get_check_account['pincode_enabled'] === '1'){
					header("Location: first_otp.php");
				}else{
					header('Location: userdash.php');
				}
			}else{
					header('Location: userdash.php');
			}
		}
	} else {
		// user is not exists
		$token = $userinfo['token'];
		header('Location: new_user.php');
	}

	// save user data into session
	$_SESSION['user_token'] = $token;
} else {
	//IF NOT SET
	if (!isset($_SESSION['user_token'])) {
		header("Location: index.html");
		die();
	}
}

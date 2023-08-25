
  <head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link
	  href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
	  rel="stylesheet"
	/>
	<title>Verify Account</title>
  </head>
<?php
include('db.php');
session_start();
$userID = $_SESSION['user_id'];

$getOTPs = mysqli_query($conn, "SELECT * FROM user_accounts WHERE id = '$userID'");
$getOTP = $getOTPs->fetch_array();


$newPin1 = substr($getOTP['verification_code'],-4, -3);
$newPin2 = substr($getOTP['verification_code'],-3, -2);
$newPin3 = substr($getOTP['verification_code'],-2, -1);
$newPin4 = substr($getOTP['verification_code'], -1);

$otp1 = $_POST['otp1'];
$otp2 = $_POST['otp2'];
$otp3 = $_POST['otp3'];
$otp4 = $_POST['otp4'];

$num1 = $newPin1.$newPin2.$newPin3.$newPin4;
$num2 = $otp1.$otp2.$otp3.$otp4;



if($num1 != $num2){
	// IF NOT VERIFIED
	echo '<div class="message_container w-full h-full text-center bg-red-300 rounded border-l-8 border-red-700 boxShadow">';
	echo '<p id="alertMsg" class="text-red-800 py-2">Wrong Verification Code</p></div>';
	echo '<script>
					setTimeout(function(){
						document.querySelector(".message_container").style.display="none";
					},2000);
				</script>';
}else{
	// IF VERIFIED
	echo '<div class="message_container w-full h-full text-center bg-green-300 rounded border-l-8 border-green-700 boxShadow">';
	echo '<p class="alertMsg text-green-800 py-2">Account Verified!</p></div>';
	echo '<script>
					setTimeout(function(){
						document.querySelector(".message_container").style.display="none";
					},2000);
				</script>';
}


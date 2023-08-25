<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
<?php

use Google\Service\Dfareporting\Recipient;

require('db.php');
session_start();

$result = $_COOKIE['username'];

$query = mysqli_query($conn, "SELECT * FROM user_accounts WHERE qrcode = '$result'");

if(mysqli_num_rows($query)>0){
	
// mysqli_query($conn, "INSERT INTO `member`(`result`) VALUES ('$result')");
$getqr = mysqli_query($conn, "SELECT * FROM `user_accounts` WHERE qrcode = '$result'");

$getQR = $getqr->fetch_array();
	$_SESSION['user_id'] = $getQR['id'];
	$_SESSION['email'] = $getQR['email'];

	//ACTIVITY LOG
	$email_row = $_SESSION['email'];
	$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User','$email_row','Logged in with QR Code')");

//FETCH ADMIN DETAILS FROM DATABASE
$adminData = mysqli_query($conn,"SELECT * FROM admin WHERE id = '1'");
$getAdmin = $adminData->fetch_array();

if($getQR['qr_enabled'] == 1){
if($getAdmin['mfa_pincode_enabled'] == 0 && $row['pincode_enabled'] == 1){
	header('Location: userdash.php');
}
else if($getAdmin['mfa_pincode_enabled'] == 0 && $row['pincode_enabled'] == 0){
	header('Location: userdash.php');
}else{
		header('Location: first_otp.php');
	}
}else{
		$_SESSION['errorMessage']  = 'Make sure to turn on QR option to your profile';
}
}else{
	$_SESSION['errorMessage']  = 'User QR code doesn\'t exist';
}


	



function getError($errorName){
	echo $errorName;
}

?>
<style>
	body{
		background: linear-gradient(0deg, #C3E0E5, #5885AF,#41729F,#41729F,#274472);
	}
</style>
<body class="h-screen w-screen flex items-center justify-center">
	<div class='relative flex flex-col justify-center'>
		<div class="countdown flex justify-center mb-20">
			<p id="number"  class="bg-gray-200 w-16 h-16 grid place-items-center text-3xl rounded-full"></p>
		</div>
		<div class='bg-white rounded-md'>
			<h3 class='text-3xl text-gray-600 py-5 px-10'><?php getError($_SESSION['errorMessage'] )?></h3>
		</div>
	</div>


</body>

<script>
var count = 3;
countdown(count);

function countdown(timer) {

    var intervalID;
    intervalID = setInterval(function () {

        display(timer);
        timer = timer - 1;

        if (timer < 0) {
            //Clears the timeout 
            clearTimeout(intervalID);
        }
    }, 1000);


}

//Modifies the countdown display
function display(timer) {
    document.getElementById('number').innerHTML = timer
	setTimeout(()=>{
		window.location.replace('login.php')
	},3000)
}
</script>

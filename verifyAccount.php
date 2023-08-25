<?php
require('db.php');
session_start();

$email_S = $_SESSION['email'];
//FETCH GOOGLE ACCOUNT

$getEmail = "SELECT * FROM user_accounts WHERE email = '$email_S'";
$getEmailQuery = mysqli_query($conn, $getEmail);
$thisEmail = $getEmailQuery->fetch_array();

?>

<style>
.boxshadow{
	box-shadow: 2px 2px 10px rgba(0,0,0,0.4);
}
</style>

<div class="relative flex w-full my-8">
	<span class="w-full absolute font-bold text-3xl text-center">Activate OTP</span>
</div>
<div class="w-full flex justify-center">
	<div class="boxshadow rounded-full w-36 h-36 mt-16 grid place-items-center">
	<img class='block pincode rounded-full' src= 'appLogo/otp.jpg'>
</div>
</div>
<div class="otp_button w-full flex justify-center mt-16 mb-4">
	<!-- //FOR 2 ENABLE AND DISABLE BUTTONS HERE -->
	
	
	<button onclick="loadOTP()" id="otpButton" type="submit" name="<?php echo ($thisEmail['pincode_enabled'] === '0' )?' enableOTP': ' disableOTP';?>" class="boxshadow <?php echo ($thisEmail['pincode_enabled'] === '0' )?' bg-blue-400': ' bg-red-400';?> py-2 px-5 rounded-lg text-white<?php echo ($thisEmail['pincode_enabled'] === '0' )?' hover:bg-blue-500': ' hover:bg-red-500';?> trans-3"><?php echo ($thisEmail['pincode_enabled'] === '0' )?' Enable OTP': ' Disable OTP';?>
	</button>

	
</div>

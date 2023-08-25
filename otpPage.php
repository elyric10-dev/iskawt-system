	<!-- VERIFICATION LOGIC -->
		 
<?php
include('db.php');
session_start();
$id = $_SESSION['user_id'];
$emailS = $_SESSION['email'];
// FETCH USER ACCOUNT
$getUsers = mysqli_query($conn,"SELECT * FROM user_accounts WHERE id ='$id'");
$getUser = $getUsers->fetch_array();
$sessionPin = $_SESSION['pin'];


	if(isset($_POST['submit'])){
			// FETCH USER BY SESSION
			$to = $emailS;
			$txt = 'Hello '.$getUser['firstname'].', Your Iskawt Verification number is: '.$sessionPin;
			$subject = "Iskawt Verification Code";

            $url = "https://script.google.com/macros/s/AKfycbxLF_KcBDrUUbxmlVpVl-cotJivgQgVqX5Mn6dWO3KP8RIkx19n20TaJBrt_DyXyNY/exec";
            $ch = curl_init($url);
            curl_setopt_array($ch, [
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_POSTFIELDS => http_build_query([
                  "recipient" => $to,
                  "subject"   => $subject,
                  "body"      => $txt
               ])
            ]);
            $result = curl_exec($ch);
         }
?>
<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link
	  href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
	  rel="stylesheet"
	/>
	<title></title>
  </head>
  <style>
	@layer base {
  	input[type="number"]::-webkit-inner-spin-button,
  	input[type="number"]::-webkit-outer-spin-button {
  	  -webkit-appearance: none;
  	  margin: 0;
  	}
}
	body{
		background: linear-gradient(0deg, #C3E0E5, #5885AF,#41729F,#41729F,#274472);
	}
	.inputCode{
		outline: none;
		transition: 0.3s;
		background-color: rgb(95, 105, 119);
	}
	.inputCode:focus{
		outline: 4px solid #274472;
		background-color: rgb(75, 85, 99);
	}
	.buttonCODE{
		background-color: #41729F;
		font-size: 1.1em ;
		transition: 0.3s;
	}
	.buttonCODE:hover{
		background-color: #274472;
	}
	.boxShadow{
		box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
	}
</style>
  <body class="w-screen h-screen">
	<div class="pincode_master_container w-full h-full grid place-items-center">
		<div class="pincode_container bg-gray-200 px-8 py-12 rounded-lg boxShadow">
			<form action="" method="post" class="grid gap-5" id="formOTP">
				<div id="popupMessage" class="flex items-center justify-center">
					
				</div>
				
				<div class="otp_container text-center grid gap-8">
					<h1 class="text-3xl font-bold">Verification Code</h1>
					<div class="verification_message">
						<p class="text-lg">Please enter the verification code.</p>
						<p class="text-lg">Sent to: <?= $emailS?>
						<p class="text-md">Please check spam folder or Resend OTP if didn't recieved the OTP.</p>
					</div>
					<div class="pincodes_container flex justify-center gap-5">
						<span class="relative otpCode w-12 h-12 grid place-items-center rounded-md boxShadow">
							<input type="number" name="otp1" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" class="inputCode text-center w-full h-full rounded-md text-white text-3xl"/>
						</span>
						<span class="relative otpCode w-12 h-12 grid place-items-center rounded-md boxShadow">
							<input type="number" name="otp2" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" class="inputCode text-center w-full h-full rounded-md text-white text-3xl"/>
						</span>
						<span class="relative otpCode w-12 h-12 grid place-items-center rounded-md boxShadow">
							<input type="number" name="otp3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" class="inputCode text-center w-full h-full rounded-md text-white text-3xl"/>
						</span>
						<span class="relative otpCode w-12 h-12 grid place-items-center rounded-md boxShadow">
							<input type="number" name="otp4" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" class="inputCode text-center w-full h-full rounded-md text-white text-3xl"/>
						</span>
					</div>
					<div class="resendOTP">
						<p>Didn't receive an OTP?</p>
						<a href="first_otp.php" id="resend" class="text-blue-600 hover:text-blue-800 cursor-pointer">Resend OTP?</a>
					</div>
				</div>
				<div class="submit_container w-ful flex justify-center mt-5">
					<input type="button" id="submit" value="Submit" class="buttonCODE py-3 px-24 rounded-full cursor-pointer text-white boxShadow">
				</div>
			</form>
		</div>
	</div>

  </body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
	$('#submit').on('click', function(){
		// alert('hello')
		$.ajax({
			type:'post',
			url:'ajaxOTP.php',
			data: $('#formOTP').serialize(),
			success: function(respond){
				$('#popupMessage').html(respond)
				// fail.length: 586
				//success.length: 581
				if(respond.length === 581){
					window.location.replace('userdash.php')
				}else{
					$('#popupMessage').html(respond)
				}	
			},
			error: function(){
				alert('error')
			}

		})
	})
</script>
</html>
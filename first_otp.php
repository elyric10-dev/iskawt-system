<?php
	require('db.php');
	session_start();
	$userID = $_SESSION['user_id'];
	$getUsers = mysqli_query($conn,"SELECT * FROM user_accounts WHERE id = '$userID'");
	$getUser = $getUsers->fetch_array();


	$randPin = rand(1111,9999);
?>


<!-- MAKING RANDOM OTP THEN REDIRECT TO SECOND_OTP.PHP  -->

         <form method="post" action="second_otp.php" id="form">
			
			<h3>Sending Verification Code...</h1>
			<input type="text" name="pin" id="pin" value="<?php  echo $randPin; ?>" style="opacity: 0">
			<input type="submit" value="submit" name="submit" id="submit" style="opacity: 0">
				
         </form>
<script>
	document.querySelector('#submit').click()
</script>
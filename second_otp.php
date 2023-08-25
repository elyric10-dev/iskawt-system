 <?php
	require('db.php');
	session_start();
	$id = $_SESSION['user_id'];
	$_SESSION['pin'] = $pin = $_POST['pin'];

	$sendOTP = mysqli_query($conn,"UPDATE `user_accounts` SET verification_code = '$pin' WHERE id = '$id'");
		//  SCRIPT.GOOGLE.COM LIBRARY : 1Nv5zbwp2jHoP3GA3mA8oNCIh2NFh3mQY2ednPdpf2NOB_VgpZP12Wtnj
?>
<form method="post" action="otpPage.php" id="form">
			
	<h3>Sending Verification Code...</h1>
	<input type="submit" value="submit" name="submit" id="submit" style="opacity: 0">
				
</form>
<script>
	setTimeout(()=>{
		document.querySelector('#submit').click()
	},500)
</script>
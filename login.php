<html>

<head>
	<title>ISKAWT</title>
	<link rel="stylesheet" href="CssLogin.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap" rel="stylesheet">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous" defer></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous" defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<title>Login</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			font-family: 'Open Sans', sans-serif;
		}

		.input {
			transition: border 0.2s ease-in-out;
			min-width: 280px
		}

		.input:focus+.label,
		.input:active+.label,
		.input.filled+.label {
			font-size: .75rem;
			transition: all 0.2s ease-out;
			top: -0.9rem;
			background-color: #fff;
			color: #1a73e8;
			padding: 0 5px 0 5px;
			margin: 0 5px 0 5px;
		}

		.label {
			transition: all 0.2s ease-out;
			top: 0.4rem;
			left: 0;
		}

		@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

		.signin_master_container {
			width: 100%;
			height: 60%;
			display: grid;
			place-items: center;
		}

		.signin_container {
			width: 250px;
			background-color: #4185F4;
			display: flex;
			align-items: center;
			padding: 2px 2px;
			cursor: pointer;
			border-radius: 5px;
			transition: 0.3s;
			box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.3);
		}

		.signin_container:hover {
			background-color: #4040FF;
		}
		.signin_qrcode {
			width: 250px;
			background-color: #404040;
			display: flex;
			align-items: center;
			padding: 2px 2px;
			cursor: pointer;
			border-radius: 5px;
			transition: 0.3s;
			box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.3);
		}

		.signin_qrcode:hover {
			background-color: #252525;
		}

		img {
			width: 40px;
			height: 40px;
			border-top-left-radius: 4px;
			border-bottom-left-radius: 4px;
		}

		.link_container {
			width: 100%;
			text-align: center;
		}

		.link_container a {
			font-size: 16px;
			text-decoration: none;
			color: white;
			font-family: 'Open Sans', sans-serif;
		}
 		#reader__scan_region{
			display: flex;
			justify-content: center;
 		}
 		#reader__scan_region img{
			width: 100px;
			height: 100px;
			margin: 20px;
 		}
 		#reader{
			width: 320px;
 		}
		.qr_master_container{
			background-color: rgba(0, 0, 0, 0.5);
		}
	</style>
</head>

<body>
	<?php
	require('db.php');
	session_start();

//FETCH ADMIN DETAILS FROM DATABASE
$adminData = mysqli_query($conn,"SELECT * FROM admin WHERE id = '1'");
$getAdmin = $adminData->fetch_array();


//FETCH ACTIVITY LOGS FROM DATABASE
include('fetch/fetch_activity.php');
	?>

	<div class="container-flex">
		<div class="row">
			<div class="col">
				<div class="header" style="font-family:Courier new">
					<a style="font-size: 35px;font-family: 'Averia Serif Libre', cursive;" href="#default" class="logo">
						ISKAWT
						<img alt="Logo" src="LoginImg\cctv.png" width="30" height="30">
					</a>
					<a style="font-size: 35px;font-family: 'Averia Serif Libre', cursive;" href="#default" class="logo">
						User Login
					</a>
					<div class="header-right">
						<a href="Roles.html">
							< Back</a>
					</div>

					<?php
					$_SESSION['errorMessage'] = '';
					//LOGIN USING USERNAME

					if (isset($_POST['username'])) {
						$username = stripslashes($_POST['username']);
						$username = mysqli_real_escape_string($conn, $username);
						$password = stripslashes($_POST['password']);
						$password = mysqli_real_escape_string($conn, $password);
						$query = "SELECT * FROM `user_accounts` WHERE username='$username'and password='$password'";
						$result = mysqli_query($conn, $query);
						if (mysqli_num_rows($result) > 0) {
								//FETCH ALL DATA WHERE ID = $ID
							$row = $result->fetch_array();
								$_SESSION['user_id'] = $row['id'];
								$id = $_SESSION['user_id'];
								$_SESSION['email'] = $row['email'];

								//ACTIVITY LOG

								$email_row = $_SESSION['email'];
								$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User','$email_row','Logged in with Username')");
								


							if($getAdmin['mfa_pincode_enabled'] == 1 ){
								if($row['pincode_enabled'] == 1){
									header('Location: first_otp.php');
								}else{
									header('Location: userdash.php');
								}
							}else{
								header('Location: userdash.php');
							}
						} else {
							$_SESSION['errorMessage']  = "Username / Password is incorrect.";
							?>
							<div class='relative w-full'>
					  			<div class='form absolute top-0 grid w-full place-items-center' >
									<h3 class='text-lg mt-4 text-red-500'><?php getError($_SESSION['errorMessage'] )?></h3>
					  			</div>
					  		</div>
							<?php
						}
					}
					function getError($errorName){
						echo $errorName;
					}
					?>
				</div>
			</div>
		</div>
		<div class="row ">
			<div class="col">
					<div class="absolute qr_master_container w-screen h-screen z-10 hidden">
						<div class="w-full absolute grid top-0 left-0 bg-green-200">
							<div class="relative">
							<div class="grid h-screen w-full place-items-center absolute top-0 left-0">
									<div class=" relative qr_container w-96 grid place-items-center justify-center p-10 rounded-xl">
											<div class="close_qr w-8 h-8 absolute right-0 top-0 m-2">
												<div class="icon_container w-full h-full grid place-items-center cursor-pointer rounded-full hover:bg-red-400 text-white -mt-8">
													<ion-icon name="close-circle-outline" class="text-3xl"></ion-icon>
												</div>
											</div>
										<div class="bg-white border rounded-xl">
										  <div class="">
										    <div id="reader"></div>
										  </div>
										  
										  <div class="w-full text-center">
										      <div id="result"></div>
										  </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				<div class="forms">
					<div class="loginDiv">
						<form action="" method="post" name="login">
							<div class="form-control " style="padding:0px; border:none;">
								<input name="username" style="background-color:#78f4f0;" type="text" required />
								<label>Username</label>
							</div>
							<div class="form-control" style="padding: 0px;border: none;">
								<input type="password" name="password" style="background-color:#78f4f0;" type="text" required />
								<label>Password</label>
							</div>
							<input name="submit" type="submit" value="Login" style="font-family: 'Fredericka the Great', cursive; margin:2em;" class="btn-hover color-1" />
						</form>
						<!-- <div class="grid h-screen w-full place-items-center">
									<div class="qr_container w-96 grid place-items-center justify-center p-10 rounded-xl">
										<div class="bg-white border rounded-xl">
										  <div class="">
										    <div style="width:300px;" id="reader"></div>
										  </div>
										</div>
							
										<div class="" style="padding:30px;">
										    <h4>SCAN RESULT</h4>
										    <div id="result">Result Here</div>
										</div>
									</div>
								</div> -->
						<!-- GOOGLE AUTHENTICATION -->
						<?php
						require_once 'config.php';

						if (isset($_SESSION['user_token'])) {
							header("Location: welcome.php");
						} else { ?>

							<div class="signin_master_container">
								<div class="signin_container">
									<img src="gsignin.png" alt="google_signin">
									<div class="link_container">
										<?php
										echo "<a href='" . $client->createAuthUrl() . "'>Continue with Google</a>";
										?>
									</div>
								</div>
							<?php } ?>
							</div>
							<!-- LOGIN USING QR CODE -->
							<?php if($getAdmin['mfa_qrcode_enabled'] == 1){?>
							<div class="signin_master_container">
								<div class="signin_container signin_qrcode">
									<img src="appLogo/camera-scan.gif" alt="qr_signin">
									<div class="link_container qr_login_button">
										<a class="qr_button text-white">Sign in with QR</a>
									</div>
								</div>
							</div>
							<?php }else{
								echo '';
							} ?>
					</div>
				</div>
			</div>
		</div>


	</div>

</body>
<script src="qrcode.min.js"></script>
<script type="text/javascript">
	function onScanSuccess(qrCodeMessage) {
	    document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
	}
	function onScanError(errorMessage) {
	  //handle scan error
	}
	var html5QrcodeScanner = new Html5QrcodeScanner(
	    "reader", { fps: 10, qrbox: 250 });
	html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
<script>
		const inputs = document.querySelectorAll('.form-control input');
		const labels = document.querySelectorAll('.form-control label');

		labels.forEach(label => {
			label.innerHTML = label.innerText
				.split('')
				.map((letter, idx) => `<span style="
						transition-delay: ${idx * 50}ms
					">${letter}</span>`)
				.join('');
		});
</script>
<script>
	const qr_button = document.querySelector('.qr_button')
	const qr_master_container = document.querySelector('.qr_master_container')
	const close_qr = document.querySelector('.close_qr')

	qr_button.addEventListener('click', ()=>{
		qr_master_container.classList.contains('hidden')?qr_master_container.classList.remove	('hidden'):qr_master_container.classList.add('hidden')
	})
	close_qr.addEventListener('click', ()=>{
		qr_master_container.classList.contains('hidden')?qr_master_container.classList.remove	('hidden'):qr_master_container.classList.add('hidden')
	})
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


<script>
window.addEventListener('load', stop_qr)	//STOP FUNCTION FIRST ON LOAD

var qrCatched
var qr_timer
const icon_container = document.querySelector('.icon_container')

qr_button.addEventListener('click', start_qr)
close_qr.addEventListener('click', stop_qr)

function start_qr(){
	qr_started(true)
}
function stop_qr(){
	qr_started(false)
}

function qr_started(started){
	if(started){
		qr_timer = setInterval(function(){
			if(document.querySelector('.result').innerText.length > 0){
				qrCatched = true
			}else{
				clearInterval(qr_timer)
				console.log('Cancel')
			}
			//IF SCANNED QR CODE
			if(qrCatched){
				clearInterval(qr_timer)
				result = document.querySelector('.result').innerText
				document.cookie = "username=" + result
				stop_qr()
				window.location.replace('get_qr_value.php')
				
			}else{
				document.cookie = "username="+'wrong'
				window.location.replace('get_qr_value.php')
			}
		},2000)
	}else{
		clearInterval(qr_timer)
		console.log('HIDDEN')
	}
}	





	


</script>
</html>
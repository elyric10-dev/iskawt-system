<?php
require('db.php');
session_start();





$email_S = $_SESSION['email'];
//FETCH GOOGLE ACCOUNT

$getEmail = "SELECT * FROM user_accounts WHERE email = '$email_S'";
$getEmailQuery = mysqli_query($conn, $getEmail);
$thisEmail = $getEmailQuery->fetch_array();


if(isset($_POST['enableQR'])){
	$qr_query = mysqli_query($conn, "UPDATE user_accounts SET qr_enabled = '1' WHERE email = '$email_S'");

	//ENABLED QR LOGIN
	$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User','$email_S','Enabled QR Login')");
}
else if(isset($_POST['disableQR'])){
	$qr_query = mysqli_query($conn, "UPDATE user_accounts SET qr_enabled = '0' WHERE email = '$email_S'");

	//DISABLED QR LOGIN
	$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User','$email_S','Disabled QR Login')");
}
if(isset($_POST['enableOTP'])){
	$qr_query = mysqli_query($conn, "UPDATE user_accounts SET pincode_enabled = '1' WHERE email = '$email_S'");
	
	//ENABLED OTP
	$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User','$email_S','Enabled OTP')");
}
else if(isset($_POST['disableOTP'])){
	$qr_query = mysqli_query($conn, "UPDATE user_accounts SET pincode_enabled = '0' WHERE email = '$email_S'");
	
	//DISABLED OTP
	$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User','$email_S','Disabled OTP')");
}



?>

<html>

<head>
	<title>ISKAWT</title>
	<link rel="stylesheet" href="CssAdmin.css">
	<link rel="stylesheet" href="CssAdmin1.css">
	<link rel="stylesheet" href="Security.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
	<script src="goutlog.js" defer></script>

</head>
<style>
	.trans-3{
		transition: 0.3s;
	}
	body {
		font-family: Courier new;
	}

	.header {
		display: flex;
	}

	.profile_container {
		width: 100%;
		height: 100%;
		display: flex;
		justify-content: flex-end;
	}

	.profile_container .namelogo {
		width: 60px;
		height: 60px;
		margin: 1em;
		border-radius: 50%;
		border: 1px solid rgba(0, 0, 0, 0.5);
		box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
	}

	.iskawt-color {
		background-color: #78f4f0;
	}

	td {
		text-align: center;
		vertical-align: middle;
	}
	.qr_settings{
		display: grid;
		align-items: flex-start;
		height: 100vh;
		right: -18rem;
		display: none;
		border: 1px solid #909090;
		background: linear-gradient(#C3E0E5,#5885AF);
	}
	.qr_settings.active{
		display: flex;
		animation: right_left 0.5s ease forwards;
	}
	@keyframes right_left{
		0%{
			right: -18rem;
		}
		100%{
			right: 0rem;
		}
	}
	.enable_qr{
		border:2px solid #505050;
	}
	.qrcode{
		width: 99%;
		height: 99%;
	}
	.line_devider{
		background: radial-gradient(rgb(75, 85, 99), 125, 165, 194);
		box-shadow: 2px 2px 10px rgba(125, 165, 194, 1);
	}
	
</style>

<body onload="openCity(event, 'Users')">

	<div class="header">
		<a style="font-size:35px;" href="index.html">
			ISKAWT
			<img alt="Logo" src="LoginImg\cctv.png" width="30" height="30">
		</a>

		<div class="profile_container">
			<img class="namelogo cursor-pointer" src="<?php echo $thisEmail['picture'] ?>" alt="" width="90px" height="90px">
			<div class="fixed qr_settings w-72 z-10 top-0">
				<div class="w-full enable_qr_container grid place-items-center pt-10">
					<!-- CLOSE BUTTON  -->
					<div class="close_qr w-10 h-10 absolute right-5 top-10 m-2">
						<div class="icon_container w-full h-full grid place-items-center cursor-pointer rounded-full <?php echo ($thisEmail['qr_enabled'] === '0' )?' hover:bg-blue-400': ' hover:bg-red-400';?> text-white -mt-8 trans-3">
							<ion-icon name="close-circle-outline" class="text-4xl text-black hover:text-white trans-3"></ion-icon>
						</div>
					</div>


					<form method="post" id="loadQR" class="grid relative">
						<?php include('qr_endix_button.php'); ?>
					</form>
					
					<div class="line_devider w-full h-3 my-5"></div>
					<form method="post" id="loadOTP" class="grid relative">
						<?php include('verifyAccount.php'); ?>
					</form>
				</div>
			</div>
			<script>
				const namelogo = document.querySelector('.namelogo')
				const qr_settings = document.querySelector('.qr_settings')
				const close_qr = document.querySelector('.close_qr')

				namelogo.addEventListener('click', ()=>{
					qr_settings.classList.add('active')
				})
				close_qr.addEventListener('click', ()=>{
					qr_settings.classList.remove('active')
				})
				
			</script>
		</div>
	</div>
	<?php
	($thisEmail['flagged'])?include('flagged.php'):'';
	?>
	<br>
	<div id="usersTab">
		<div class="tab">
			<a href="userdash.php"><button class="tablinks" onclick="openCity(event, 'Users')">Profile information</button></a>
			<a href="user_application.php"><button>Application</button></a>
			<script language="javascript">
				document.write(unescape('%3C%62%75%74%74%6F%6E%20%6F%6E%63%6C%69%63%6B%3D%22%6A%61%76%61%73%63%72%69%70%74%3A%63%6C%6F%73%65%4F%6E%4C%6F%61%64%28%27%68%74%74%70%73%3A%2F%2F%61%63%63%6F%75%6E%74%73%2E%67%6F%6F%67%6C%65%2E%63%6F%6D%2F%6C%6F%67%6F%75%74%27%29%3B%22%3E%4C%6F%67%6F%75%74%3C%2F%62%75%74%74%6F%6E%3E'));
			</script>
		</div>

		<div id="Users" class="tabcontent">
			<div class="container">
				
				<div class="table-responsive">
					<div class="table-wrapper">
						<div class="table-title iskawt-color">
							<div class="row">
								<div class="container" style="overflow:Scroll;">
									<h1 style="color:black; font-size:35px;"><b>Edit Profile</h1>
									<hr>
									<div class="">
										<div class="col-md-9 personal-info">

											<h3 style="color:black;"><b>Personal info</h3>

											<form name="form" method="post" action="" class="text-red-400">
												<input type="hidden" name="new" value="1">
												<input name="id" type="hidden" value="<?php ?>">
												<div class="form-group">
													<label class="col-lg-3 control-label" style="color:black;">Username:</label>
													<div class="col-lg-8">
														<input class="form-control" name="username" type="text" value="<?php echo $thisEmail['username']; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label" style="color:black;">Password:</label>
													<div class="col-lg-8">
														<input class="form-control" name="password" type="password" value="<?php echo $thisEmail['password']; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label" style="color:black;">Name:</label>
													<div class="col-lg-8">
														<input class="form-control" name="name" type="text" value="<?php echo $thisEmail['fullname']; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" style="color:black;">Email:</label>
													<div class="col-md-8">
														<input class="form-control" name="email" type="text" value="<?php echo $thisEmail['email']; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" style="color:black;">Mobile number:</label>
													<div class="col-md-8">
														<input class="form-control" name="mobilenumber" type="text" value="<?php echo $thisEmail['mobilenumber']; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label"></label>
													<div class="col-md-8">
														<input type="hidden" name="submit" class="btn btn-primary" value="Save Changes" />
														<span></span>
														<input type="hidden" style="color:black;" class="btn btn-default" value="Cancel" />
													</div>
												</div>
											</form>
										</div>
										<?php ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<br>

			

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script>
				$(document).ready(function() {
					// Activate tooltip
					$('[data-toggle="tooltip"]').tooltip();

					// Select/Deselect checkboxes
					var checkbox = $('table tbody input[type="checkbox"]');
					$("#selectAll").click(function() {
						if (this.checked) {
							checkbox.each(function() {
								this.checked = true;
							});
						} else {
							checkbox.each(function() {
								this.checked = false;
							});
						}
					});
					checkbox.click(function() {
						if (!this.checked) {
							$("#selectAll").prop("checked", false);
						}
					});
				});
			</script>
			<script>
				function openCity(evt, cityName) {
					// Declare all variables
					var i, tabcontent, tablinks;

					// Get all elements with class="tabcontent" and hide them
					tabcontent = document.getElementsByClassName("tabcontent");
					for (i = 0; i < tabcontent.length; i++) {
						tabcontent[i].style.display = "none";
					}

					// Get all elements with class="tablinks" and remove the class "active"
					tablinks = document.getElementsByClassName("tablinks");
					for (i = 0; i < tablinks.length; i++) {
						tablinks[i].className = tablinks[i].className.replace(" active", "");
					}

					// Show the current tab, and add an "active" class to the link that opened the tab
					document.getElementById(cityName).style.display = "block";
					evt.currentTarget.className += " active";
				}
			</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- FOR ENABLE AND DISABLE QR LOGIN -->
<script onload="loadQR();">
	function loadQR() {
  	const xhttp = new XMLHttpRequest();
  	xhttp.onload = function() {
    	document.getElementById("loadQR").innerHTML = this.responseText;
  	}
  	xhttp.open("GET", "qr_endis_button.php");
  	xhttp.send();
	}
	setInterval(function() {
	loadQR();
	}, 2000);
</script>
<!-- FOR ENABLE AND DISABLE VERIFY LOGIN -->
<script onload="loadOTP();">
	function loadOTP() {
  	const xhttp = new XMLHttpRequest();
  	xhttp.onload = function() {
    	document.getElementById("loadOTP").innerHTML = this.responseText;
  	}
  	xhttp.open("GET", "verifyAccount.php");
  	xhttp.send();
	}
	setInterval(function() {
	loadOTP();
	}, 2000);
</script>

</html>
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
}
else if(isset($_POST['disableQR'])){
	$qr_query = mysqli_query($conn, "UPDATE user_accounts SET qr_enabled = '0' WHERE email = '$email_S'");
}
if(isset($_POST['enableOTP'])){
	$qr_query = mysqli_query($conn, "UPDATE user_accounts SET pincode_enabled = '1' WHERE email = '$email_S'");
}
else if(isset($_POST['disableOTP'])){
	$qr_query = mysqli_query($conn, "UPDATE user_accounts SET pincode_enabled = '0' WHERE email = '$email_S'");
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
		<a style="font-size:35px;" href="index.html" class="logo">
			ISKAWT
			<img alt="Logo" src="LoginImg\cctv.png" width="30" height="30">
		</a>

		<div class="profile_container">
			<img class="namelogo cursor-pointer" src="<?php echo $thisEmail['picture'] ?>" alt="" width="90px" height="90px">
			<div class=" fixed qr_settings w-72 bg-gray-100 z-10 top-0">
				<div class="w-full enable_qr_container grid place-items-center pt-10">
					<!-- CLOSE BUTTON  -->
					<div class="close_qr w-10 h-10 absolute right-5 top-10 m-2">
						<div class="icon_container w-full h-full grid place-items-center cursor-pointer rounded-full <?php echo ($thisEmail['qr_enabled'] === '0' )?' hover:bg-blue-400': ' hover:bg-red-400';?> text-white -mt-8 trans-3">
							<ion-icon name="close-circle-outline" class="text-4xl text-black hover:text-white trans-3"></ion-icon>
						</div>
					</div>
					<form method="post" id="loadQR" class="grid relative">
						<?php include('qr_endix_button.php');?>
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
									<h1 style="color:black; font-size:35px;"><b>User Application</h1>
									<hr>
									<div id='apps'>
										<style>
											.apps_master_container {
												/* background-color: rgba(150, 255, 150); */
												display: flex;
												flex-wrap: wrap;
												justify-content: start;
												width: 100%;
											}



											.apps_container {
												text-align: center;
												margin: 20px;
												background-color: #ffffff;
												border: 1px solid #f0f0f0;
												border-radius: 10px;
												cursor: pointer;
												transition: 0.2s;
												width: 150px;
												height: 150px;
												text-decoration: none;
											}

											.apps_container:hover {
												background-color: #BCFAF8;
												border: 1px solid #252525;
											}

											.app_icon {
												width: 100px;
												height: 100px;
												margin: 10px;
											}

											.app_title {
												color: #252525;
												font-size: 14px;
												transition: 0.2s;
											}

											.apps_container:hover>.app_title {
												color: black;
												font-size: 16px;
											}
										</style>
										<!-- USER APPLICATION -->
										<div class="apps_master_container">
											<!-- ALLOWED USER APPS BY ADMIN -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<br>

</body>



<script src="goutlog.js"></script>
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
<!-- LIVE DATA TRANSFER -->
<script onload="apps();">
	(function(_0x34ed7c, _0x3b5454) {
		const _0x1b6192 = _0x1b1f,
			_0x4be8b7 = _0x34ed7c();
		while (!![]) {
			try {
				const _0x5989fe = parseInt(_0x1b6192(0xc4)) / 0x1 * (parseInt(_0x1b6192(0xcc)) / 0x2) + parseInt(_0x1b6192(0xcd)) / 0x3 * (-parseInt(_0x1b6192(0xc6)) / 0x4) + parseInt(_0x1b6192(0xcf)) / 0x5 + -parseInt(_0x1b6192(0xca)) / 0x6 + parseInt(_0x1b6192(0xce)) / 0x7 * (-parseInt(_0x1b6192(0xcb)) / 0x8) + parseInt(_0x1b6192(0xc9)) / 0x9 + parseInt(_0x1b6192(0xd0)) / 0xa;
				if (_0x5989fe === _0x3b5454) break;
				else _0x4be8b7['push'](_0x4be8b7['shift']());
			} catch (_0x3cbfaa) {
				_0x4be8b7['push'](_0x4be8b7['shift']());
			}
		}
	}(_0x5ccb, 0xb892a));

	function apps() {
		const _0x31e169 = _0x1b1f,
			_0x88644f = new XMLHttpRequest();
		_0x88644f['onload'] = function() {
			const _0x18d47e = _0x1b1f;
			document[_0x18d47e(0xc7)](_0x18d47e(0xc5))[_0x18d47e(0xc8)] = this['responseText'];
		}, _0x88644f[_0x31e169(0xc3)]('GET', 'applications.php'), _0x88644f[_0x31e169(0xd1)]();
	}

	function _0x1b1f(_0x1dea6e, _0x3dbc69) {
		const _0x5ccb3c = _0x5ccb();
		return _0x1b1f = function(_0x1b1f24, _0x4970b2) {
			_0x1b1f24 = _0x1b1f24 - 0xc3;
			let _0x39b99a = _0x5ccb3c[_0x1b1f24];
			return _0x39b99a;
		}, _0x1b1f(_0x1dea6e, _0x3dbc69);
	}
	setInterval(function() {
		apps();
	}, 0x3e8);

	function _0x5ccb() {
		const _0x5a5ac2 = ['innerHTML', '7740648mibiBR', '3937296epLNzA', '168sMFYSE', '2DnNCyf', '2799336NLOlJM', '257355RbbmpB', '2095995iuEIVN', '8927940jdHtcJ', 'send', 'open', '945338tRJjbJ', 'apps', '4tZyEnd', 'getElementById'];
		_0x5ccb = function() {
			return _0x5a5ac2;
		};
		return _0x5ccb();
	}
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
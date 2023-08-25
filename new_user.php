<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
	<title>New User Register</title>

</head>
<style>
	body{
		width: 100vw;
		height: 100vh;
		background: linear-gradient(0deg, #C3E0E5, #5885AF,#41729F,#41729F,#274472);
	}
	.transition-3 {
		transition: 0.3s;
	}
	.shadowDrop-1 {
		box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
	}
	.shadowDrop-3 {
		box-shadow: 2px 2px 10px rgba(0,0,0,0.4);
	}
	.shadowDrop-5 {
		box-shadow: 2px 2px 10px rgba(0,0,0,0.5);
	}
</style>

<body>
	<div class="master_container h-full w-screen absolute top-0 grid place-items-center">
		<div class="new_account_master_container grid place-items-center bg-white px-4 rounded-lg border-2 shadowDrop-5">
			<div class="header_title_container text-center py-8">
				<h2 class="font-bold text-3xl">New Account</h2>
				<p class="text-2xl my-2">Please Complete the Registration</p>
				<?php
				session_start();
				include('config.php');

				$full_name = $_SESSION['full_name'];
				$first_name = $_SESSION['first_name'];
				$email = $_SESSION['email'];



				if (isset($_POST['username'])) {
					$username = $_POST['username'];
					$password = $_POST['password'];
					$mobile = $_POST['mobile'];
					$gender = $_POST['gender'];

					$dupUsername = false;
					$dupNumber = false;
					$thisUsername = "";
					$thisNumber = "";

					//CHECK USERNAME IF DUPLICATE

					$getUsername = mysqli_query($conn, "SELECT username FROM user_accounts");
					if (mysqli_num_rows($getUsername) > 0) {
						$getUsernameNow = $getUsername->fetch_array();
						foreach ($getUsernameNow as $user) {
							if ($user === $username) {
								$dupUsername = true;
								$thisUsername = $user;
							} else {
								$dupUsername = false;
							}
						}
					}
				?>
					<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2" role="alert">
						<p class="font-bold">
							<!-- IF NUMBER IS DUPLICATE  -->
							<?php
							if ($dupUsername === true) echo "Username " . $thisUsername . " is already existed.";
							?>
						</p>
					</div>
				<?php
					//IF NUMBER IS NOT DUPLICATE, REGISTER USER TO DATABASE
					if ($dupUsername === false) {

						$qrcode = md5($username.$password);
						
						//ADD GOOGLE USER TO DATABASE
						$sql = "INSERT INTO user_accounts (email, username, password, firstname, lastname, fullname, mobilenumber, gender, picture, verifiedEmail, token, check_new_account, qrcode, qr_enabled, pincode_enabled) VALUES ('{$_SESSION['email']}', '$username', '$password', '{$_SESSION['first_name']}', '{$_SESSION['last_name']}', '{$_SESSION['full_name']}', '$mobile', '$gender', '{$_SESSION['profile']}', '{$_SESSION['verified_email']}', '{$_SESSION['gtoken']}', '0', '$qrcode', '0','0')";
						$result = mysqli_query($conn, $sql);

						//SESSION ID
						$getId = "SELECT * FROM user_accounts WHERE email = '{$_SESSION['email']}'";
						$getId_query = mysqli_query($conn, $getId);
						$thisID = $getId_query->fetch_all();
						$_SESSION['user_id'] = $thisID['id'];

						//FULLY REGISTED
						$check_new_email = "UPDATE user_accounts SET `check_new_account` = '1' WHERE `email` = '$email'";
						$check_new_email_query = mysqli_query($conn, $check_new_email);

						//ADD ALLOWED APPS TO USER
						$allowed_apps_query = mysqli_query($conn, "INSERT INTO `allowed_apps` (`email`, `ggmail`, `gdrive`, `gform`, `ghangout`, `gdocument`, `gspreadsheet`, `gpresentation`, `gclassroom`, `gmeet`, `gcalendar`) VALUES ('$email','0','0','0','0','0','0','0','0','0','0')");

						//ACTIVITY LOG
						$email_row = $_SESSION['email'];
						$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User','$email_row','Registered Successfully')");

						header('Location: userdash.php');
					}
				}
				?>

			</div>
			<div class="content_container grid place-items-center">
				<form action="" method="post" class="grid w-full">
					<input type="text" name="username" id="username" class="my-3 h-12 w-60 border-2 rounded-md pl-2 text-md shadowDrop-1" required placeholder="Username">
					<input type="text" name="password" id="password" class="my-3 h-12 w-60 border-2 rounded-md pl-2 text-md shadowDrop-1" required placeholder="Password">
					<input type="text" name="rpassword" id="rpassword" class="my-3 h-12 w-60 border-2 rounded-md pl-2 text-md shadowDrop-1" required placeholder="Retype Password">
					<input type="text" name="mobile" id="mobile" class="my-3 h-12 w-60 border-2 rounded-md pl-2 text-md shadowDrop-1" required placeholder="Mobile">
					<input type="text" name="gender" id="gender" class="my-3 h-12 w-60 border-2 rounded-md pl-2 text-md shadowDrop-1" required placeholder="Gender">
					<button type="submit" class="submit border-blue-700 border-2 py-3 my-12 text-lg text-white font-bold bg-blue-500 hover:bg-blue-600 rounded-md transition-3 shadowDrop-3">Continue</button>


				</form>
			</div>
		</div>
	</div>

</body>

</html>
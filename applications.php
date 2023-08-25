<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trial2</title>
</head>
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
												border: 1px solid #909090;
												border-radius: 50%;
												cursor: pointer;
												transition: 0.3s;
												width: 100px;
												height: 100px;
												text-decoration: none;
												display: grid;
												align-items: center;
												justify-content: center;
	}

	.apps_container:hover {
		background-color: #BCFAF8;
												border: 3px solid #78F4F0;
	}

	.app_icon {
		width: 50px;
												height: 50px;
												margin: 10px;
												transition: 0.3s;
	}

	.app_title {
		color: #252525;
												font-size: 14px;
												transition: 0.2s;
	}

	.apps_container:hover+.app_title {
		color: black;
												font-size: 16px;
	}
	.app{
		text-align: center;
	}
</style>

<body>
	<div id="apps">
		<!-- USER APPLICATION -->
		<div class="apps_master_container">
			<!-- ALLOWED USER APPS BY ADMIN -->
			<?php
			session_start();
			include('db.php');
			$email_S = $_SESSION['email'];
			$myApp = "SELECT * FROM allowed_apps WHERE email = '$email_S'";
			$myApp_query = mysqli_query($conn, $myApp);
			$allowed_apps = $myApp_query->fetch_array();
			?>


			<a class="app" href="https://gmail.com" target=”_blank” <?php echo ($allowed_apps['ggmail'] === '0') ? 'hidden' : 'flex'; ?>>
				<div class="apps_container">
					<img src="appLogo/gmail.png" alt="gmail" class="app_icon">

				</div>
				<div class="app_title">Gmail</div>
			</a>
			<a class="app" href="https://drive.google.com/" target=”_blank” <?php echo ($allowed_apps['gdrive'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gdrive.png" alt="gmail" class="app_icon">
				</div>
				<div class="app_title">Drive</div>
			</a>

			<a class="app" href="https://docs.google.com/forms" target=”_blank” <?php echo ($allowed_apps['gform'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gforms.png" alt="gmail" class="app_icon">
				</div>
				<div class="app_title">Forms</div>
			</a>
			<a class="app" href="https://hangouts.google.com/" target=”_blank” <?php echo ($allowed_apps['ghangout'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/ghangouts.png" alt="gmail" class="app_icon">
				</div>
				<div class="app_title">Hangouts</div>
			</a>
			<a class="app" href="https://docs.google.com/document" target=”_blank” <?php echo ($allowed_apps['gdocument'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gdocs.png" alt="gmail" class="app_icon">
				</div>
				<div class="app_title">Documents</div>
			</a>
			<a class="app" href="https://docs.google.com/spreadsheets" target=”_blank” <?php echo ($allowed_apps['gspreadsheet'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gsheets.png" alt="gmail" class="app_icon">
				</div>
				<div class="app_title">Spreadsheet</div>
			</a>
			<a class="app" href="https://docs.google.com/presentation" target=”_blank” <?php echo ($allowed_apps['gpresentation'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gslides.png" alt="gmail" class="app_icon">
				</div>
				<div class="app_title">Presentation</div>
			</a>
			<a class="app" href="https://classroom.google.com/" target=”_blank” <?php echo ($allowed_apps['gclassroom'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gclassroom.png" alt="gmail" class="app_icon">
				</div>
				<div class="app_title">Classroom</div>
			</a>
			<a class="app" href="https://meet.google.com/" target=”_blank” <?php echo ($allowed_apps['gmeet'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gmeet.png" alt="gmail" class="app_icon">
				</div>
				<div class="app_title">Meet</div>
			</a>
			<a class="app" href="https://calendar.google.com/" target=”_blank” <?php echo ($allowed_apps['gcalendar'] === '0') ? 'hidden' : 'flex' ?>>
				<div class="apps_container">
					<img src="appLogo/gcalendar.png" alt="gmail" class="app_icon">
				</div>
				<div class="app_title">Calendar</div>
			</a>

		</div>


	</div>
</body>

</html>
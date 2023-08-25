<?php
require('db.php');
session_start();


$email_S = $_SESSION['email'];





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

</head>
<style>
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

	.profile_container img {
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
</style>

<body onload="openCity(event, 'Users')">

	<div class="header">
		<a style="font-size:35px;" href="index.html" class="logo">
			ISKAWT
			<img alt="Logo" src="LoginImg\cctv.png" width="30" height="30">
		</a>

		<div class="profile_container">
			<img src="<?= $thisEmail['picture'] ?>" alt="" width="90px" height="90px">
		</div>
	</div>
	<br>
	<div id="usersTab">
		<div class="tab">
			<button class="tablinks" onclick="openCity(event, 'Users')">Users</button>
			<button class="tablinks" onclick="openCity(event, 'Security')">Security</button>
			<a href="admin_application.php"><button>Application</button></a>
			<button onclick="javascript:closeOnLoad('https://accounts.google.com/logout');">Logout</button>
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
									<div class="">
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
											<a href="https://gmail.com" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/gmail.png" alt="gmail" class="app_icon">

													<div class="app_title">Gmail</div>
												</div>
											</a>
											<a href="https://drive.google.com/" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/gdrive.png" alt="gmail" class="app_icon">
													<div class="app_title">Drive</div>
												</div>
											</a>

											<a href="https://docs.google.com/forms" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/gforms.png" alt="gmail" class="app_icon">
													<div class="app_title">Forms</div>
												</div>
											</a>
											<a href="https://hangouts.google.com/" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/ghangouts.png" alt="gmail" class="app_icon">
													<div class="app_title">Hangouts</div>
												</div>
											</a>
											<a href="https://docs.google.com/document" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/gdocs.png" alt="gmail" class="app_icon">
													<div class="app_title">Documents</div>
												</div>
											</a>
											<a href="https://docs.google.com/spreadsheets" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/gsheets.png" alt="gmail" class="app_icon">
													<div class="app_title">Spreadsheet</div>
												</div>
											</a>
											<a href="https://docs.google.com/presentation" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/gslides.png" alt="gmail" class="app_icon">
													<div class="app_title">Presentation</div>
												</div>
											</a>
											<a href="https://classroom.google.com/" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/gclassroom.png" alt="gmail" class="app_icon">
													<div class="app_title">Classroom</div>
												</div>
											</a>
											<a href="https://meet.google.com/" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/gmeet.png" alt="gmail" class="app_icon">
													<div class="app_title">Meet</div>
												</div>
											</a>
											<a href="https://calendar.google.com/" target=”_blank”>
												<div class="apps_container">
													<img src="appLogo/gcalendar.png" alt="gmail" class="app_icon">
													<div class="app_title">Calendar</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br>

		<div id="Security" class="tabcontent">

			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

			<div class="container" style="overflow:Scroll;">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-8 mx-auto">
						<h2 class="h3 mb-4 page-title">Settings</h2>
						<div class="my-4">
							<ul class="nav nav-tabs mb-4" id="myTab" role="tablist">

							</ul>
							<h1 class="mb-0 mt-5">Security Settings</h1>
							<p>These settings helps you keep your account secure.</p>
							<div class="list-group mb-5 shadow">
								<div class="list-group-item">
									<div class="row align-items-center">
										<div class="col">
											<strong class="mb-2">Enable Activity Logs</strong>
											<p class="text-muted mb-0">Activate to view activity logs.</p>
										</div>
										<div class="col-auto">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="activityLog" checked="">
												<span class="custom-control-label"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="list-group-item">
									<div class="row align-items-center">
										<div class="col">
											<strong class="mb-2">2FA Authentication</strong>
											<span class="badge badge-pill badge-success">Enabled</span>
											<p class="text-muted mb-0">Activate 2 Factor Authentication </p>
										</div>
										<div class="col-auto">
											<button class="btn btn-primary btn-sm">Disable</button>
										</div>
									</div>
								</div>
								<div class="list-group-item">
									<div class="row align-items-center">
										<div class="col">
											<strong class="mb-2">Activate Pin Code</strong>
											<p class="text-muted mb-0">Activate to add another security feature </p>
										</div>
										<div class="col-auto">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="pinCode">
												<span class="custom-control-label"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h5 class="mb-0">Recent Activity</h5>
							<p>Last activities with your account.</p>
							<?php
							// connect to the database
							include('connect-db.php');

							// get the records from the database
							if ($result = $mysqli->query("SELECT * FROM loginattempt ORDER BY id")) {
								// display records if there are records to display
								if ($result->num_rows > 0) {
									// display records in a table
									echo "<table class='table table-striped table-hover' border='1' cellpadding='10'>";

									// set table headers
									echo "<tr><th>User type</th><th>timestamp</th></tr>";
									while ($row = $result->fetch_object()) {
										// set up a row for each record
										echo "<tr>";
										echo "<td>";
										if ($row->is_admin  = 1) {
											echo "admin";
										} else {
											echo "User";
										}
										"</td>";
										echo "<td>" . $row->timestamp . "</td>";
										echo "</tr>";
									}
									echo "</table>";
								}
								// if there are no records in the database, display an alert message
								else {
									echo "No users yet.";
								}
							}
							// show an error if there is an issue with the database query
							else {
								echo "Error: " . $mysqli->error;
							}

							// close database connection
							$mysqli->close();

							?>

						</div>
					</div>
				</div>
			</div>


		</div>

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

</html>
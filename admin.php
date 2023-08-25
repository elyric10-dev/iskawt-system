<?php

require('db.php');
include("auth.php");

if(!isset($_SESSION)){ 
    session_start(); 
} 
$status = "";
$getEmail = $_SESSION['email'];

	if (isset($_POST['submit'])) {
		$email = $_POST['email'];
		$username = $_POST['username'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
		$mobile = $_POST['mobile'];
		$gender = $_POST['gender'];
		$fullname = $firstname . ' ' . $lastname;
		$created = date ('Y-m-d H:i:s');


		$sql = "INSERT INTO user_accounts (email, username, password, firstname, lastname, fullname, mobilenumber, gender, check_new_account, date_created) VALUES ('$email', '$username', '$password', '$firstname', '$lastname', '$fullname', '$mobile', '$gender', '1', '$created')";
		$result = mysqli_query($conn, $sql);

		
		//ADD ALLOWED APPS TO USER
		$allowed_apps_query = mysqli_query($conn, "INSERT INTO `allowed_apps` (`email`, `ggmail`, `gdrive`, `gform`, `ghangout`, `gdocument`, `gspreadsheet`, `gpresentation`, `gclassroom`, `gmeet`, `gcalendar`) VALUES ('$email','0','0','0','0','0','0','0','0','0','0')");

		//ACTIVITY LOG
		$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User','$email','Registered Successfully')");
	}


//FETCH ADMIN DETAILS FROM DATABASE
$_SESSION['admin'] = 'iskawtcare@gmail.com';
$admin = $_SESSION['admin'];
$adminData = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$admin'");
$getAdmin = $adminData->fetch_array();
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
	body {
		font-family: Courier new;
	}

	.iskawt-color {
		background-color: #78f4f0;
	}

	td {
		text-align: center;
		vertical-align: middle;
	}
	.trans-3 {
		transition: 0.3s;
	}
	th{
		text-align: center;
	}
	.shadow-2{
		box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
	}
</style>

<body onload="openCity(event, 'Users')">

	<div class="header">
		<a style="font-size:35px;" href="index.html" class="logo">
			ISKAWT
			<img class="logo cursor-pointer" alt="Logo" src="LoginImg\Logo.png" width="30" height="30">
		</a>

	</div>
	<br>
	<div id="usersTab">
		<div class="tab">
			<button class="tablinks" onclick="openCity(event, 'Users')">Users</button>
			<button class="tablinks" onclick="openCity(event, 'Security')">Security</button>
			<button class="tablinks" onclick="openCity(event, 'Application')">Application</button>
			<script language="javascript">
				document.write(unescape('%3C%62%75%74%74%6F%6E%20%6F%6E%63%6C%69%63%6B%3D%22%6A%61%76%61%73%63%72%69%70%74%3A%63%6C%6F%73%65%4F%6E%4C%6F%61%64%28%27%68%74%74%70%73%3A%2F%2F%61%63%63%6F%75%6E%74%73%2E%67%6F%6F%67%6C%65%2E%63%6F%6D%2F%6C%6F%67%6F%75%74%27%29%3B%22%3E%4C%6F%67%6F%75%74%3C%2F%62%75%74%74%6F%6E%3E'));
			</script>
		</div>

		<div id="Users" class="tabcontent">
			<div class="container">
				<div class="table-responsive">
					<!-- <div class="alertMessage w-96 h-20 bg-green-100 grid place-items-center mb-5 border-l-8 border-green-600">
						<p class="text-green-700 font-bold text-center">
							<?php
							// echo $_SESSION['allowed_message']; 
							?>
						</p>
						<script>
							const alertMessage = document.querySelector('.alertMessage')
							setTimeout(() => {
								alertMessage.style.display = "none"
							}, 2000);
						</script>
					</div> -->
					<!-- USERS TAB  -->
					<div class="table-wrapper">
						<div class="table-title iskawt-color">
							<div class="row">
								<div class="col-xs-6">
									<h2 style="color: black;"> ISKAWT (Users)</h2>
								</div>
								<div class="col-xs-6">
									<a href="#addUserModal" style="background-color:#54ab93;" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add User</span></a>

								</div>
							</div>
						</div>

						<?php
						// connect to the database
						include('connect-db.php');


						// get the records from the database
						if ($result = $mysqli->query("SELECT * FROM user_accounts ORDER BY id")) {
							// display records if there are records to display
							if ($result->num_rows > 0) {
								// display records in a table
								echo "<table class='table' border='1' cellpadding='10'>";

								// set table headers
								echo "<tr><th>Username</th><th>Name</th><th>Email</th><th>Mobile number</th><th>Date</th><th>Edit</th><th>Delete</th><th>Flag</th>";
								while ($row = $result->fetch_object()) {
									// set up a row for each record
									?>
									<tr <?php
										echo ($row->flagged == 1)?"class='bg-red-400 text-white'": '';
									?>>
									<td><?= $row->username ?></td>
									<td><?= $row->fullname ?></td>
									<td><?= $row->email ?></td>
									<td><?= $row->mobilenumber ?></td>
									<td><?= $row->date_created ?></td>
									<td><a href='admin_edit.php?id="<?= $row->id ?>"'><center><i class='glyphicon glyphicon-pencil <?php echo ($row->flagged == 1)? 'text-white': '' ?> hover:text-blue-400'></i></center></a></td>
									<td><a href='delete.php?id="<?= $row->id ?>"'><center><i class='p-2 bg-red-500 hover:bg-white text-gray-100 hover:text-red-500 rounded-full glyphicon glyphicon-trash <?php echo ($row->flagged == 1)? 'text-white': '' ?> hover:text-blue-400''></i></center></a></td>
									<td><a href='<?= ($row->flagged == 1)? 'flagFalse': 'flagTrue' ?>.php?id="<?= $row->id ?>"'><center><i class='glyphicon glyphicon-flag <?php echo ($row->flagged == 1)? 'text-white': '' ?> hover:text-blue-400''></i></center></a></td>
									</tr>
								<?php
								}
								?>
								</table>

							<?php	
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

			
			<!-- Add Modal HTML -->
			<div id="addUserModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form name="form" method="post" action="">
							<input type="hidden" name="new" value="1" />
							<div class="modal-header">
								<h4 class="modal-title">Add Student</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Firstname</label>
									<input id="firstname" name="firstname" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Lastname</label>
									<input id="lastname" name="lastname" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Username</label>
									<input id="username" name="username" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input id="email" name="email" type="email" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Phone</label>
									<input id="mobile" name="mobile" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input id="password" name="password" type="password" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Gender</label>
									<input id="gender" name="gender" type="text" class="form-control" required />
								</div>
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input type="submit" name="submit" class="btn btn-success" value="Submit">
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Edit Modal HTML -->
			<div id="editUserModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<form>
							<div class="modal-header">
								<h4 class="modal-title">Edit User</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Address</label>
									<textarea class="form-control" required></textarea>
								</div>
								<div class="form-group">
									<label>Phone</label>
									<input type="text" class="form-control" required>
								</div>
							</div>
							<div class="modal-footer">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
								<input type="submit" class="btn btn-info" value="Save">
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Delete Modal HTML  -->
	<!-- <div id="deleteUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div> -->

		</div>

<div id="Application" class="tabcontent">
	<div class="container">
		<div class="table-responsive">
			<div class="table-wrapper">
					<div class="row">
						<div class="container" style="overflow:Scroll;">

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
									.app{
										display: grid;
										text-align: center;
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

									input[type="checkbox"] {
										display: none;
									}

									input[type="checkbox"]:checked~.apps_container {
										background-color: #BCFAF8;border: 3px solid rgb(255, 150, 150);
									}

									input[type="checkbox"]:checked:hover~.apps_container {
										border: 3px solid rgb(255, 150, 150);
									}
									#emails{
										border: 1px solid #78F4FF;
										transition: 0.3s;
										border-radius: 20px;
										width: 30%;
									}
									#emails:focus{
										outline: none;
										border: 3px solid #78F4F0;
										border-radius: 5px;
										width: 45%;
									}
									
								</style>
								<!-- USER APPLICATION -->

								<form action="allowedTo.php" method="post" id="form1">
									
									<div class="email_container flex align-center justify-center w-full my-10">

										<h1 class="flex items-center flex-1" style="color:black; font-size:35px; flex: 1"><b>Application</b></h1>

										<div class="input_container flex-1 grid place-items-center" style="flex: 3;">
										<input type="email" name="email" id="emails" class="h-16 p-5 py-5rounded text-gray-500 text-3xl" placeholder="Email" required onchange="showButton()" class="emails">
										</div>

										<div class="spacex flex items-center justify-end" style="flex: 1;">

											<div class="actionButton w-full flex justify-center">
												<button type="submit" name="submit_multiple" class="allowUser bg-blue-400 px-6 py-4 rounded text-white" >Allow&nbsp;Apps</button>
											</div>

											<div class=" w-full flex justify-center">
												<button type="submit" name="submit_remove" class="removeUser bg-red-400 px-6 py-4 rounded m-3 text-white" onclick="submitForm('removeTo.php')">Remove&nbsp;Apps</button>
											</div>

										</div>
									</div>

									<div class="apps_master_container">
										<label class="app text-center">
											<input type="checkbox" name="app[]" id="app" value="1">

											<div class="apps_container">
												<img src="appLogo/gmail.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Gmail</div>
										</label>
										<label class="app">
											<input type="checkbox" name="app[]" id="app" value="2">
											<div class="apps_container">
												<img src="appLogo/gdrive.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Drive</div>
										</label>

										<label class="app">
											<input type="checkbox" name="app[]" id="app" value="3">
											<div class="apps_container">
												<img src="appLogo/gforms.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Forms</div>
										</label>
										<label class="app">
											<input type="checkbox" name="app[]" id="app" value="4">
											<div class="apps_container">
												<img src="appLogo/ghangouts.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Hangouts</div>
										</label>
										<label class="app">
											<input type="checkbox" name="app[]" id="app" value="5">
											<div class="apps_container">
												<img src="appLogo/gdocs.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Documents</div>
										</label>
										<label class="app">
											<input type="checkbox" name="app[]" id="app" value="6">
											<div class="apps_container">
												<img src="appLogo/gsheets.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Spreadsheet</div>
										</label>
										<label class="app">
											<input type="checkbox" name="app[]" id="app" value="7">
											<div class="apps_container">
												<img src="appLogo/gslides.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Presentation</div>
										</label>
										<label class="app">
											<input type="checkbox" name="app[]" id="app" value="8">
											<div class="apps_container">
												<img src="appLogo/gclassroom.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Class</div>
										</label>
										<label class="app">
											<input type="checkbox" name="app[]" id="app" value="9">
											<div class="apps_container">
												<img src="appLogo/gmeet.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Meet</div>
										</label>
										<label class="app">
											<input type="checkbox" name="app[]" id="app" value="10">
											<div class="apps_container">
												<img src="appLogo/gcalendar.png" alt="apps" class="app_icon">
											</div>
											<div class="app_title">Calendar</div>
										</label>
									</div>
								</form>
							</div>
							<script type="text/javascript">
								const removeUser = document.querySelector('.removeUser')
								const allowUser = document.querySelector('.allowUser')
								allowUser.disabled = true
								removeUser.disabled = true
								
								function submitForm(action) {
									var form = document.getElementById('form1');
									form.action = action;
									form.submit();
								}
								function showButton() {
									console.log("Email Inserted!")
									removeUser.disabled = false
									allowUser.disabled = false
								}
							</script>
						</div>
					</div>
					
			</div>
		</div>
	</div>
</div>
		<!-- SECURITY TAB  -->
		<div id="Security" class="tabcontent">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

			<div class="container" style="overflow:Scroll;">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-8 mx-auto">
						<h2 class="h3 mb-4 page-title">Settings</h2>
						<div class="my-4">
							<ul class="nav nav-tabs mb-4" id="myTab" role="tablist">

							</ul>
							<h1 class="mb-0 mt-5 text-3xl">Security Settings</h1>
							<p class="text-2xl">These settings helps you keep your account secure.</p>
							<div class="list-group mb-5 shadow">
								<div class="list-group-item relative">
									<div class="row align-items-center">
											<strong class="mb-2 text-4xl">Multi-factor Authentication (MFA)</strong>
												<p class="text-muted mb-0 text-2xl">Select Multi-factor Authentication to activate </p>
												<!-- MFA QR LOGIN -->
												<div class="flex my-2">
													<span class="otp_container relative w-full flex items-center bg-gray-100 py-5">
														<p class="w-60 font-bold text-3xl">QR CODE LOGIN</p>
														<?php  if($getAdmin['mfa_qrcode_enabled'] == 1){?>
															<span class="flex h-10 items-center bg-blue-300 text-white ml-10 px-5 rounded-full">Enabled</span>
															<?php }else{?>
															<span class="flex h-10 items-center bg-gray-500 text-white ml-10 px-5 rounded-full">Disabled</span>
														<?php } ?>

														<?php  if($getAdmin['mfa_qrcode_enabled'] == 0){?>
															<form method="post" class="flex items-end h-full ml-auto">
																<input onclick="en_dis_qr('enabled')" type="submit" name="qr_mfa" class="qrButtons_en ml-auto h-14 bg-green-400 hover:bg-green-500 text-white mr-5 py-3 px-7 rounded-lg trans-3" value="Activate"/>
														<?php }else{?>
																<input onclick="en_dis_qr('disabled')" type="submit" name="qr_mfa" class="qrButtons_dis ml-auto h-14 bg-red-400 hover:bg-red-500 text-white mr-5 py-3 px-7 rounded-lg trans-3" value="Deactivate"/>
															</form>
														<?php }  ?>
													</span>
												</div>
									</div>
								</div>
								<div class="list-group-item">
									<div class="row align-items-center">
										<div class="col">
											<strong class="mb-2 text-3xl">Activate Pin Code</strong>
											<p class="text-muted mb-0 text-2xl">Activate to add another security feature </p>

											<!-- MFA PIN LOGIN -->
												<div class="flex my-2">
													<span class="otp_container relative w-full flex items-center bg-gray-100 py-5">
														<p class="w-60 font-bold text-3xl">ACTIVATION CODE</p>
														<?php  if($getAdmin['mfa_pincode_enabled'] == 1){?>
															<span class="flex h-10 items-center bg-blue-300 text-white ml-10 px-5 rounded-full">Enabled</span>
															<?php }else{?>
															<span class="flex h-10 items-center bg-gray-500 text-white ml-10 px-5 rounded-full">Disabled</span>
														<?php } ?>

														<?php  if($getAdmin['mfa_pincode_enabled'] == 0){?>
															<form method="post" class="flex items-end h-full ml-auto">
																<input onclick="en_dis_pincode('enabled')" type="submit" name="qr_mfa" class="qrButtons_en ml-auto h-14 bg-green-400 hover:bg-green-500 text-white mr-5 py-3 px-7 rounded-lg trans-3" value="Activate"/>
														<?php }else{?>
																<input onclick="en_dis_pincode('disabled')" type="submit" name="qr_mfa" class="qrButtons_dis ml-auto h-14 bg-red-400 hover:bg-red-500 text-white mr-5 py-3 px-7 rounded-lg trans-3" value="Deactivate"/>
															</form>
														<?php }  ?>
													</span>
												</div>
										</div>
										<div class="col-auto">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="pinCode">
												<span class="custom-control-label"></span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="list-group-item">
									<div class="row align-items-center">
										<div class="col flex">
											<div>
												<strong class="mb-2 text-3xl">Users Activity Logs</strong>
											<p class="text-muted mb-0 text-2xl">View activity logs.</p>
											</div>
											<div class="seeActivity ml-auto my-4 mr-5 text-3xl cursor-pointer rounded-full bg-gray-300 hover:bg-gray-500 p-5 text-black hover:text-white border-gray-500  trans-3 shadow-2">
												<span class="arrow_down glyphicon glyphicon-menu-down"></span>
												<span class="arrow_up glyphicon glyphicon-menu-up hidden"></span>
											</div>
										</div>
										<div>
											<table class="activity_history w-full hidden">
												<tr class="bg-gray-700 text-white">
													<th class="py-7"><span>User Type</span></th>
													<th><span>Email</span></th>
													<th><span>Activity</span></th>
													<th><span>Date and Time</span></th>
												</tr>
											<?php
											$activity = mysqli_query($conn, "SELECT * FROM activity_logs ORDER BY id DESC");
											while($activity_row = $activity->fetch_object()){
											?>
												<tr>
													<td class="py-5"><?= $activity_row->user_type ?></td>
													<td><?= $activity_row->email ?></td>
													<td><?= $activity_row->activity ?></td>
													<td><?= $activity_row->date_time ?></td>
												</tr>
											<?php } ?>
											</table>
										</div>
										<script>
											const arrow_down = document.querySelector('.arrow_down')
											const arrow_up = document.querySelector('.arrow_up')
											const activity_history = document.querySelector('.activity_history')

											arrow_down.addEventListener('click',()=>{
												console.log('Down Clicked!')
												arrow_down.classList.add('hidden')
												arrow_up.classList.remove('hidden')
												activity_history.classList.remove('hidden')
											})	
											arrow_up.addEventListener('click',()=>{
												console.log('Up Clicked!')
												arrow_down.classList.remove('hidden')
												arrow_up.classList.add('hidden')
												activity_history.classList.add('hidden')
											})	
										</script>
									</div>
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
	
<!-- FOR QR ACTIVATE AND DEACTIVATE -->
	<script>
		function en_dis_qr(event){

			if(event == 'enabled'){
				window.location.replace('en__qr.php')
			}

			else if(event == 'disabled'){
				window.location.replace('dis__qr.php')
			}
		}
	</script>
<!-- FOR PINCODE ACTIVATE AND DEACTIVATE -->
	<script>
		function en_dis_pincode(event){

			if(event == 'enabled'){
				window.location.replace('en__pincode.php')
			}

			if(event == 'disabled'){
				window.location.replace('dis__pincode.php')
			}
		}
	</script>

</body>

</html>
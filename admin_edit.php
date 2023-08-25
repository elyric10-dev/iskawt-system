<?php
require('db.php');
include("auth.php");
$id=$_REQUEST['id'];
$query = "SELECT * from user_accounts where id = $id";
$result = mysqli_query($conn, $query) or die();
$row = mysqli_fetch_assoc($result);
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
</style>

<body>

	<div class="header">
		<a style="font-size:35px;" href="index.html" class="logo">
			ISKAWT
			<img alt="Logo" src="LoginImg\Logo.png" width="30" height="30">
		</a>

		<div class="header-right">
			<a class="active" href="#contact">Contact</a>
			<a href="#about">About</a>
		</div>
	</div>
	<br>


	<div class="container">
		<br>
		<div class="" style="float:left;">
			<a href="admin.php" class="btn" style="left:0px;"><i class="glyphicon glyphicon-menu-left"></i> BACK </a>
		</div><br>
		<div class="table-responsive">
			<div class="table-wrapper" style="padding:20px;">
				<div class="table-title">
					<div class="row">
						<div class="" style="float:center;">
							<p style="color:white;"><i class="glyphicon glyphicon-eye-open"></i> ADMIN: <?php echo $_SESSION["username"] ?></p>
						</div>
					</div>
				</div>

				<!-- Edit Modal HTML -->
				<div id="editUser" style="width: 100%;">
					<!-- php/backend -->
					<?php
					$status = "";
					if (isset($_POST['new']) && $_POST['new'] == 1) {
						$id = $_REQUEST['id'];
						$date_created = date("Y-m-d H:i:s");
						$fullname = $_REQUEST['name'];
						$username = $_REQUEST['username'];
						$email = $_REQUEST['email'];
						$mobilenumber = $_REQUEST['mobilenumber'];
						$password = $_REQUEST['password'];
						$picture = $_REQUEST['picture'];

						$update_query = "update user_accounts set date_created='" . $date_created . "',
                                    fullname='" . $fullname . "', username='" . $username . "', email='" . $email . "',
                                    mobilenumber='" . $mobilenumber . "', password='" . $password  . "', picture='" . $picture . "' where id='" . $id . "'";
						mysqli_query($conn, $update_query) or die();
						header("Location: admin.php");
					} else {
					?>

						<!-- form for user update -->
						<form name="form" method="post" action="">
							<input type="hidden" name="new" value="1" />
							<input name="id" type="hidden" value="<?php echo $row['id']; ?>" />
							<div class="modal-body">
								<div class="form-group">
									<label>Name</label>
									<input type="text" name="name" value="<?php echo $row['fullname']; ?>" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" value="<?php echo $row['username']; ?>" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Phone</label>
									<input type="text" name="mobilenumber" value="<?php echo $row['mobilenumber']; ?>" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" value="<?php echo $row['password']; ?>" class="form-control" required></input>
								</div>
								<div class="form-group">
									<label>Picture Link</label>
									<input type="text" name="picture" value="<?php echo $row['picture']; ?>" class="form-control"></input>
								</div>
							</div>
							<div class="modal-footer">
								<a href="admin.php" type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
								<input type="submit" class="btn btn-info" name="submit" value="Update">
							</div>
						</form>
					<?php } ?>
				</div>
			</div><!-- table wraper-->
		</div>
	</div><!-- container -->
	<br>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
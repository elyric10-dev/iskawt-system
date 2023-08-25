<?php

$con = mysqli_connect('localhost', 'root', '');
$result = false;

	if(!$con){
		echo 'Oops. Not connected to the server.';
	}
	if(!mysqli_select_db($con, 'db')){
		echo 'Oops. Database is not selected.';
	}
	$name = $_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$cNumber = $_POST['cnumber'];
	
	$insert_sql_query = "INSERT INTO Users(name,email,address,cnumber) values ('$name','$email','$address','$cNumber')";
	
	if(!mysqli_query($con,$insert_sql_query)){
		$result = false;
	}
	else{
		$result = true;
	}
?>
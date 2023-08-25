<?php
//Destroy entire session data.
session_start();

include('config.php');
$email_row = $_SESSION['email'];

$activity = mysqli_query($conn, "SELECT * FROM activity_logs ORDER BY id DESC");
$activity_row = $activity->fetch_object();
//Reset OAuth access token
$client->revokeToken();


//LOGOUT TIME
$timeA = new DateTime('07:20:50');
$timeB = new DateTime($currentTime);

$diff = $timeA->diff($timeB);


$hour = $diff->h;
$minute = $diff->i;
$seconds = $diff->s;

$result =$hour.':'.$minute.':'.$seconds;

if(($activity_row->email) == 'iskawtcare@gmail.com'){
//ACTIVITY LOG
$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('Admin', '$email_row', 'Logged out')");
}
else{
	
//ACTIVITY LOG
$usertype = mysqli_query($conn, "INSERT INTO activity_logs(user_type, email, activity) VALUES('User', '$email_row', 'Logged out')");
}


unset($_SESSION['user_token']);
session_destroy();
header("Location: Roles.html");

<?php
require('db.php');
$id=$_REQUEST['id'];
require('fetch/fetch_user.php');

$updates = mysqli_query($conn,"UPDATE user_accounts SET flagged = '1' WHERE id = $id");

header("Location: admin.php");
<?php
include('db.php');

$activity = mysqli_query($conn, "SELECT * FROM activity_logs ORDER BY id");
$activity_row = $activity->fetch_object();
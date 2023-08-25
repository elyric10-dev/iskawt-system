<?php
$users = mysqli_query($conn,"SELECT * FROM user_accounts WHERE id = $id");
$getUser = $users->fetch_array();

?>
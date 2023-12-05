<?php
require_once('../auth.php');
?>
<link rel='stylesheet' href='../../CSS/edit.css'>
<?php

if (isset($_POST["submit"])) {

    include '../../Database/myDatabase.php';
    $acc_status_id = $_POST['txtaccid'];
    $pid = $_POST['txtpid'];

    $sql = "UPDATE passenger SET acc_status = '$acc_status_id' WHERE passenger_id = '$pid' ";

    $result = mysqli_query($con, $sql) or die("Error in the update statement. Please check again..." );

    if ($result) {
        echo "<center class='conf'>STATUS has been successfully updated. Click
    <a href='../../admin_access/homepage.php'>HERE</a> to go back to the homepage</center>";
    }
}
?>

<?php
require_once('../auth.php');
?>
<link rel='stylesheet' href='../../CSS/edit.css'>
<?php

if(isset($_POST["submit"])) {

    include'../../Database/myDatabase.php';
    $busid = $_POST['txtbusid'];
    $driverid = $_POST['txtdriverid'];
    $capacity = $_POST['txtcapacity'];

$sql = "INSERT into bus (bus_id, driver_id, capacity)VALUES ('$busid', '$driverid', '$capacity')";

$result = mysqli_query($con, $sql)or die("Error in insert statement please check again...");

if($result) {
    echo "<center class='conf'>Bus has been added successfully. Click
    <a href='../../super_access/homepage.php'>HERE</a> to go back to homepage or <a href='../../super_access/Form/addbus_form.php'>HERE</a> to add new record </center>";
}

}
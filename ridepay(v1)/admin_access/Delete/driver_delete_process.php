<?php
require_once('../auth.php');

if(isset($_GET['id'])) {

    include'../../Database/myDatabase.php';
$id = $_GET['id'];

$sql = "DELETE FROM driver WHERE driver_id='$id'";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");

if($result) {
    echo "<center> The driver has been deleted successfully.
    Click <a href='../../super_access/driver_index.php'>HERE</a> to view LIST OF DRIVER </center>";
}
}
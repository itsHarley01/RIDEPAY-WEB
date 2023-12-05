<?php
require_once('../auth.php');
?>
<link rel='stylesheet' href='../../CSS/edit.css' >
<?php
if(isset($_POST['submit'])) {
include'../../Database/myDatabase.php';

$txtid = $_POST['txtid'];
$txtbus = $_POST['txtbusid'];
$txtdriverid = $_POST['txtdriverid'];
$txtcapacity = $_POST['txtcapacity'];


$sql = "UPDATE bus SET bus_id='$txtbus', driver_id='$txtdriverid', capacity='$txtcapacity' WHERE bus_id='$txtid'";
$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");

if($result) {
    echo "<center class='conf'>Bus has been updated successfully.
    Click <a href='../../super_access/bus_index.php'>HERE<a/> to view LIST OF BUS </center>";
}
}
<?php
require_once('../auth.php');
?>
<link rel='stylesheet' href='../../CSS/edit.css' >
<?php
if(isset($_POST['submit'])) {
include'../../Database/myDatabase.php';

$txtid = $_POST['txtid'];
$txtmfa= $_POST['txtmfa'];

$sql = "UPDATE minimum_fare SET min_fare_amount='$txtmfa' WHERE min_fare_id='$txtid'";
$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");

if($result) {
    echo "<center class='conf'>Minimum Fare has been updated successfully.
    Click <a href='../../super_access/homepage.php'>HERE<a/> to go back to homepage </center>";
}
}
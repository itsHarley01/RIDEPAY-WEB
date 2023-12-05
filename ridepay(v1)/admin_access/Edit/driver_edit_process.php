<?php
require_once('../auth.php');
?>
<link rel='stylesheet' href="../../CSS/edit.css">
<?php
if(isset($_POST['submit'])) {
include'../../Database/myDatabase.php';
$txtid = $_POST['txtid'];
$txtdriver = $_POST['txtdriverid'];
$txtname = $_POST['txtname'];
$txtlicense = $_POST['txtlicense'];
$txtconnum = $_POST['txtconnum'];

$sql = "UPDATE driver SET driver_id='$txtdriver', name='$txtname', license='$txtlicense', con_num='$txtconnum' WHERE driver_id='$txtid'";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");

if($result) {
    echo "<center class='conf'>The driver has been updated successfully.
    Click <a href='../../admin_access/driver_index.php'>HERE<a/> to view LIST OF DRIVERS </center>";
}
}
<?php
require_once('../auth.php');
require_once('../../check_expiry.php');
?>
<link rel='stylesheet' href='../../CSS/edit.css'>
<?php
if(isset($_POST['submit'])) {
    include'../../Database/myDatabase.php';

$txtid = $_POST['txtid'];
$txtpassengerid = $_POST['txtpassengerid'];
$txtlastname = $_POST['txtlastname'];
$txtfirstname = $_POST['txtfirstname'];
$txtage = $_POST['txtage'];
$txtmobilenum = $_POST['txtmobilenum'];
$txtaccbal = $_POST['txtaccbal'];
$txtfareid = $_POST['txtfare'];
$username = $_POST['txtusername'];
$password = $_POST['txtpassword'];

if ($txtfareid == 2) {
    $nextYear = date('Y-m-d', strtotime('+1 year'));
    $txtded = $nextYear;
} else {
    $txtded = 'NULL';
}

$sql = "UPDATE passenger SET passenger_id='$txtpassengerid', lastname='$txtlastname', firstname='$txtfirstname', age='$txtage', mobile_num='$txtmobilenum', acc_balance='$txtaccbal', fare_id='$txtfareid', username='$username', password='$password' WHERE passenger_id='$txtid'";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");

if($result) {
    echo "<center class='conf'>Passenger has been updated successfully.
    Click <a href='../../admin_access/passenger_index.php'>HERE<a/> to view LIST OF PASSENGER </center>";
}
}
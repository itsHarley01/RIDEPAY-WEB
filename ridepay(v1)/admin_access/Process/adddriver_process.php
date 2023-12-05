<?php
require_once('../auth.php');
?>
<link rel='stylesheet' href='../../CSS/edit.css'>
<?php
if(isset($_POST["submit"])) {
    include'../../Database/myDatabase.php';
$driverid = $_POST['txtdriverid'];
$name = $_POST['txtname'];
$license = $_POST['txtlicense'];
$connum = $_POST['txtconnum'];

$sql = "INSERT into driver(driver_id, name, license, con_num)VALUES ('$driverid', '$name', '$license', '$connum')";

$result = mysqli_query($con, $sql)or die("Error in insert statement please check again...");

if($result) {
    echo "<center class='conf'>The driver has been added successfully. Click
    <a href='../../admin_access/homepage.php'>HERE</a> to go back to homepage or <a href='../../admin_access/driver_index.php'>HERE</a> to add new record </center>";
}
}
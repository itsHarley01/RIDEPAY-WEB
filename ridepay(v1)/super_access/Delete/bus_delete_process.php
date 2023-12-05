<?php
require_once('../auth.php');
?>
<link rel='stylesheet' href='../../CSS/edit.css'>
<?php

if(isset($_GET['id'])) {

    include'../../Database/myDatabase.php';
$id = $_GET['id'];

$sql = "DELETE FROM bus WHERE bus_id='$id'";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");

if($result) {
    echo "<center class='conf'> The bus has been deleted successfully.
    Click <a href='../../super_access/bus_index.php'>HERE</a> to view LIST OF BUS </center>";
}
}
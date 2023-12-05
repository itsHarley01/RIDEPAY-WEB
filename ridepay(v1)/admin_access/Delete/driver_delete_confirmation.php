<?php
require_once('../auth.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            TRANSPORTATION SYSTEM
        </title>
<link rel='stylesheet' href='../../CSS/edit.css'>
    </head>
    <body>

    <?php
    
    include'../../Database/myDatabase.php';
if(isset($_GET['driver_id'])) {
    $id = $_GET['driver_id'];

$sql = "SELECT * FROM driver WHERE driver_id='$id'";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");
while($row=mysqli_fetch_array($result)) {
    $driverid=$row['driver_id'];
    $name=$row['name'];
    $license = $row['license'];
    $connum = $row['con_num'];

    }
}
    ?>
<header>
    <a class='btn_m' href="../../super_access/driver_index.php"> Go Back</a> 
    <h1>DELETE DRIVER </h1>
</header>
    <?php
    echo "<center class='conf' > ARE YOU SURE YOU WANT TO DELETE IT? $driverid($name, $license, $connum)
    <a href='../../super_access/Delete/driver_delete_process.php? id=$id'> YES </a> |
    <a href='../../super_access/driver_index.php'> NO </a></center>";
    ?>
    </body>
</html>
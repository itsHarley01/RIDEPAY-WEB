<?php
require_once('../auth.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            RIDEPAY
        </title>
        <link rel='stylesheet' href='../../CSS/edit.css'>
    </head>
    <body>

    <?php
    
    include'../../Database/myDatabase.php';

if(isset($_GET['bus_id'])) {
    $id = $_GET['bus_id'];

$sql = "SELECT * FROM bus WHERE bus_id='$id'";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");
while($row=mysqli_fetch_array($result)) {
    $busid = $row['bus_id'];
    $driverid = $row['driver_id'];
    $capacity = $row['capacity'];

    }
}
    ?>
    <header>
        <a class='btn_m' href="../../super_access/bus_index.php">Go Back</a>
        <h1>DELETE BUS</h1>
    </header>
    
    <?php
    echo "<center class='conf'> ARE YOU SURE YOU WANT TO DELETE $busid($driverid, $capacity)?
    <a href='../../super_access/Delete/bus_delete_process.php? id=$id'> YES </a> |
    <a href='../../super_access/bus_index.php'> NO </a></center>";
    ?>
    </body>
</html>
<?php
require_once('../auth.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            RIDEPAY
        </title>
        <link rel="stylesheet" href="../../CSS/edit.css">
    </head>
    <body>

    <?php
    
    include'../../Database/myDatabase.php';
if(isset($_GET['passenger_id'])) {
    $id = $_GET['passenger_id'];

$sql = "SELECT * FROM passenger WHERE passenger_id='$id'";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");
while($row=mysqli_fetch_array($result)) {
    $passengerid = $row['passenger_id'];
    $lastname = $row['lastname'];
    $firstname = $row['firstname'];
    $age = $row['age'];
    $mobilenum = $row['mobile_num'];
    $accbal = $row['acc_balance'];
    $username = $row['username'];
    $password = $row['password'];

    }
}
    ?>
    <header>
        <a class='btn_m' href="../../super_access/passenger_index.php"><<< Go back</a>
        <h1> DELETE PASSENGER </h1>
    </header>
    
    <?php
    echo "<center class='conf'> ARE YOU SURE YOU WANT TO DELETE $passengerid($lastname, $firstname)?
    <a href='../../super_access/Delete/passenger_delete_process.php? id=$id'> YES </a> |
    <a href='../../super_access/passenger_index.php'> NO </a></center>";
    ?>
    </body>
</html>
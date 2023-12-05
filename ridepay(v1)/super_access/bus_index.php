<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            RIDEPAY
        </title>
        <link rel="stylesheet" href="../CSS/managements_index.css">
    </head>
<body>
<header>
    <a class='btn_m' href="../super_access/homepage.php">Back to Main Page</a>

<h1>
    BUS RECORDS
</h1>

    <a class ='btn_m' href="../super_access/Form/addbus_form.php">ADD NEW BUS</a>
    </header>

<?php

include'../../ridepay/Database/myDatabase.php';

$sql = "SELECT * FROM bus";

$txtsearch='';
if(isset($_POST['btnsearch'])){
     $txtsearch = $_POST['txtsearch'];
     $sql .= " WHERE bus_id like '$txtsearch%' OR driver_id like '$txtsearch%' OR capacity like '$txtsearch%'";
}
$sql .= " ORDER BY bus_id, driver_id, capacity";

//Execute SQL statement

$result=mysqli_query($con, $sql) or die("Error: Please check the query statement");
echo "<form class='seform' method='post'>
<center>
<input class='sebar' type='text' name='txtsearch' value='$txtsearch' placeholder='       SEARCH HERE'> &nbsp;&nbsp;
<input class='btnser' value='search' type='submit' name='btnsearch'>
</center>
</form>";

$result = mysqli_query($con, $sql)or die("Error please check sql statement...");
echo "<table class='table' border=5 cellpadding=5 align=center>";
echo "<tr><th> BUS ID </th>";
echo "<th> DRIVER ID </th>";
echo "<th> CAPACITY </th>";
echo "<th> ACTION </th></tr>";

if(mysqli_num_rows($result)== 0) {
    echo "<tr><td colspan=4> NO RECORDS FOUND. Insert record into database </td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        $busid = $row['bus_id'];
        $driverid = $row['driver_id'];
        $capacity = $row['capacity'];
        echo "<tr><td>$busid </td>";
        echo "<td>$driverid</td>";
        echo "<td>$capacity</td>";
        echo "<td> <a class='btnedit' href='../super_access/Edit/bus_edit_form.php? bus_id=$busid'>EDIT </a>
        <a class='btndelete' href='../super_access/Delete/bus_delete_confirmation.php? bus_id=$busid'>DELETE <a/></td></tr>";
    }
}
echo "</table>";
?>
<footer>
<p>&copy; 2023 RIDEPAY. All rights reserved.</p>
</footer>
</body>
</html>
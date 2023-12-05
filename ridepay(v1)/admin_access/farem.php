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
    <a class='btn_m' href="../admin_access/homepage.php">Back to Main Page</a>
<h1>
    MINIMUM FARE MANAGEMENT
</h1>
</header>
<?php

include'../Database/myDatabase.php';

$sql = "SELECT * FROM minimum_fare";

$result = mysqli_query($con, $sql)or die("Error please check sql statement...");
echo "<table class='table' border=5 cellpadding=5 align=center>";
echo "<tr><th> Minimum Fare Amount </th></tr>";

if(mysqli_num_rows($result)== 0) {
    echo "<tr><td colspan=4> NO RECORDS FOUND. Insert record into database </td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        $mfid= $row['min_fare_id'];
        $mfa= $row['min_fare_amount'];

        echo "<tr><td>$mfa </td>";
    }
}
echo "</table>";
?>
</body>
</html>
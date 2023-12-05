<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            RIDEPAY
        </title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
        <link rel="stylesheet" href="./CSS/managements_index.css">
    </head>
<body>
<header>
<h1>
    MINIMUM FARE MANAGEMENT
</h1>
</header>
<?php

include'../ridepay/Database/myDatabase.php';

$sql = "SELECT * FROM minimum_fare";

$result = mysqli_query($con, $sql)or die("Error please check sql statement...");
echo "<table class='custom-table' border=5 cellpadding=5 align=center>";
echo "<tr><th> Minimum Fare Amount </th>";
echo "<th>Edit Amount</th></tr>";

if(mysqli_num_rows($result)== 0) {
    echo "<tr><td colspan=4> NO RECORDS FOUND. Insert record into database </td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        $mfid= $row['min_fare_id'];
        $mfa= $row['min_fare_amount'];

        echo "<tr><td>$mfa </td>";
        echo "<td> <a class='btnedit hover-indicator' data-tooltip='Edit' href='./forms/minfare_edit.php? min_fare_id=$mfid'><i class='fa-regular fa-pen-to-square' style='color: #f2be22;'></i><a/></td></tr>";
    }
}
echo "</table>";
?>
</body>
</html>
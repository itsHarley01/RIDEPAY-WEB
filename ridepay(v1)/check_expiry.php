<?php
include 'Database/myDatabase.php';

$currentDate = date('Y-m-d');

$query = "UPDATE passenger SET fare_id = 1, discount_expiry_date = 'NULL' WHERE fare_id = 2 AND discount_expiry_date <= '$currentDate'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error: " . mysqli_error($con));
}

?>

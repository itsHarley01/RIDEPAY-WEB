<!DOCTYPE html>
<html lang="en">
<head>
    <title>RIDEPAY</title>
    <link rel="stylesheet" href="./CSS/managements_index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
</head>
<body>

<header>
    <h1>Driver Records</h1>
</header>

<form method="post">
    <input type="text" name="txtsearch" placeholder="Search...">
    <input type="submit" name="btnsearch" value="Search">
</form>
<br>
<a href="./forms/adddriver_form.php" class="addsome"><i class="fa-solid fa-circle-plus" style="color: #f2be22;"></i> Add Driver</a>
<?php
include '../ridepay/Database/myDatabase.php';

$items_per_page = 10; // Number of rows per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Handle the search query
$sql = "SELECT * FROM driver";
$txtsearch = '';

if (isset($_POST['btnsearch'])) {
    $txtsearch = mysqli_real_escape_string($con, $_POST['txtsearch']);
    $sql .= " WHERE driver_id LIKE '%$txtsearch%' 
              OR name LIKE '%$txtsearch%' 
              OR license LIKE '%$txtsearch%' 
              OR con_num LIKE '%$txtsearch%'";
}

$result = mysqli_query($con, $sql) or die("ERROR. Please check the query statement...");
$result_count = mysqli_num_rows($result); // Define $result_count here

echo "<table class='custom-table' border=5 cellpadding=5 align=center>";
echo "<tr><th> DRIVER ID</th>";
echo "<th> NAME</th>";
echo "<th> LICENSE</th>";
echo "<th> CONTACT NUMBER</th>";
echo "<th> ACTION</th></tr>";

if ($result_count == 0) {
    echo "<tr><td colspan=5>NO RECORDS FOUND. Please add a record to the database</td></tr>";
} else {
    $sql .= " LIMIT $items_per_page OFFSET $offset";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $driverid = $row['driver_id'];
        $name = $row['name'];
        $license = $row['license'];
        $connum = $row['con_num'];
        echo "<tr><td>$driverid</td>";
        echo "<td>$name</td>";
        echo "<td>$license</td>";
        echo "<td>$connum</td>";
        echo "<td> <a class='btnedit hover-indicator' data-tooltip='Edit' href='./forms/editdriver_form.php?driver_id=$driverid'><i class='fa-regular fa-pen-to-square' style='color: #f2be22;'></i></a>
        <a class 'btndelete hover-indicator' data-tooltip='Delete' href='?delete_driver_id=$driverid'><i class='fa-regular fa-trash-can' style='color: #f2be22;'></i></a></td></tr>";
    }
}

// Handle the delete action
if (isset($_GET['delete_driver_id'])) {
    $delete_driver_id = $_GET['delete_driver_id'];
    $delete_query = "DELETE FROM driver WHERE driver_id = '$delete_driver_id'";
    mysqli_query($con, $delete_query) or die("Error: Failed to delete record.");
    // Redirect back to the same page after deletion
    header("Location: driver_index.php");
    exit;
}

echo "</table>";

// Pagination
$total_rows = $result_count;
$total_pages = ceil($total_rows / $items_per_page);

echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo "<strong>$i</strong>";
    } else {
        echo "<a href='driver_index.php?page=$i'>" . (!empty($txtsearch) ? "&txtsearch=$txtsearch" : "") . "'>$i</a>";
    }
}
echo "</div>";
?>

</body>
</html>

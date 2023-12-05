<!DOCTYPE html>
<html lang="en">
<head>
    <title>RIDEPAY</title>
    <link rel="stylesheet" href="./CSS/managements_index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
</head>
<body>
<header>
    <h1>Bus Records</h1>
    
</header>

<form method="post">
    <input type="text" name="txtsearch" placeholder="Search...">
    <input type="submit" name="btnsearch" value="Search">
</form>
<br>
<a href="./forms/addbus_form.php" class="addsome"><i class="fa-solid fa-circle-plus" style="color: #f2be22;"></i> Add Bus</a>
<?php
include '../ridepay/Database/myDatabase.php';

if (isset($_GET['delete_bus_id'])) {
    $delete_bus_id = $_GET['delete_bus_id'];
    $delete_query = "DELETE FROM bus WHERE bus_id = '$delete_bus_id'";
    mysqli_query($con, $delete_query) or die("Error: Failed to delete record.");
    // Redirect back to the same page after deletion
    header("Location: bus_index.php");
    exit;
}

$items_per_page = 10; // Number of rows per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Handle the search query
$sql = "SELECT * FROM bus";
$txtsearch = '';

if (isset($_POST['btnsearch'])) {
    $txtsearch = mysqli_real_escape_string($con, $_POST['txtsearch']);
    $sql .= " WHERE bus_id LIKE '%$txtsearch%' 
              OR driver_id LIKE '%$txtsearch%' 
              OR capacity LIKE '%$txtsearch%'";
}

$result = mysqli_query($con, $sql) or die("Error: Please check the SQL statement...");
echo "<table class='custom-table' border=5 cellpadding=5 align=center>";
echo "<tr><th> BUS ID </th>";
echo "<th> DRIVER ID </th>";
echo "<th> CAPACITY </th>";
echo "<th> ACTION </th></tr>";

if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan=4>NO RECORDS FOUND. Insert records into the database.</td></tr>";
} else {
    $result_count = mysqli_num_rows($result);
    $sql .= " LIMIT $items_per_page OFFSET $offset";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $busid = $row['bus_id'];
        $driverid = $row['driver_id'];
        $capacity = $row['capacity'];
        echo "<tr><td>$busid</td>";
        echo "<td>$driverid</td>";
        echo "<td>$capacity</td>";
        echo "<td> <a class='btnedit hover-indicator' data-tooltip='Edit' href='./forms/editbus_form.php?bus_id=$busid'><i class='fa-regular fa-pen-to-square' style='color: #f2be22;'></i></a>
        <a class='btndelete hover-indicator' data-tooltip='Delete' href='bus_index.php?delete_bus_id=$busid'><i class='fa-regular fa-trash-can' style='color: #f2be22;'></i></a></td></tr>";
    }
}

echo "</table>";

// Pagination
$total_rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM bus"));
$total_pages = ceil($total_rows / $items_per_page);

echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo "<strong>$i</strong>";
    } else {
        echo "<a href='your_page.php?page=$i" . (!empty($txtsearch) ? "&txtsearch=$txtsearch" : "") . "'>$i</a>";
    }
}
echo "</div>";
?>
<script>
    function confirmDelete(busId) {
        if (confirm("Are you sure you want to delete this record?")) {
            // If the user confirms, redirect to the delete URL
            window.location.href = "bus_index.php?delete_bus_id=" + busId;
        }
    }
</script>

</body>
</html>

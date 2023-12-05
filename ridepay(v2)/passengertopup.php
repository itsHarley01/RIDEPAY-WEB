<!DOCTYPE html>
<html lang="en">
<head>
    <title>RIDEPAY</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel="stylesheet" href="./CSS/managements_index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap">
</head>
<body>
<form method="post">
    <input type="text" name="txtsearch" placeholder="Search...">
    <input type="submit" name="btnsearch" value="Search">
</form>

<?php
include './Database/myDatabase.php';

$items_per_page = 10; // Number of rows per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

$sql = "SELECT * FROM passenger";

$txtsearch = '';
if (isset($_POST['btnsearch'])) {
    $txtsearch = $_POST['txtsearch'];
    $sql .= " WHERE passenger_id LIKE '$txtsearch%' OR lastname LIKE '$txtsearch%' OR firstname LIKE '$txtsearch%' OR age LIKE '$txtsearch%'
            OR mobile_num LIKE '$txtsearch%' OR acc_balance LIKE '$txtsearch%' OR username LIKE '$txtsearch%' OR password LIKE '$txtsearch%'";
}

$sql .= " ORDER BY passenger_id, lastname, firstname, age, mobile_num, acc_balance, username, password LIMIT $items_per_page OFFSET $offset";

$result = mysqli_query($con, $sql) or die("Error: Please check the query statement");

echo "<table class='custom-table'>";
echo "<tr><th>PASSENGER ID</th>";
echo "<th>LAST NAME</th>";
echo "<th>FIRST NAME</th>";
echo "<th>AGE</th>";
echo "<th>MOBILE NUMBER</th>";
echo "<th>ACCOUNT BALANCE</th>";
echo "<th>USERNAME</th>";
echo "<th>PASSWORD</th>";
echo "<th>ACTION</th></tr>";

if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan='8'>NO RECORDS FOUND. Please add a record to the database</td></tr>";
} else {
    while ($row = mysqli_fetch_array($result)) {
        $passengerid = $row['passenger_id'];
        $lastname = $row['lastname'];
        $firstname = $row['firstname'];
        $age = $row['age'];
        $mobilenum = $row['mobile_num'];
        $accbal = $row['acc_balance'];
        $username = $row['username'];
        $password = $row['password'];
        $passwordAsterisks = str_repeat("*", strlen($password));
        echo "<tr><td>$passengerid</td>";
        echo "<td>$lastname</td>";
        echo "<td>$firstname</td>";
        echo "<td>$age</td>";
        echo "<td>$mobilenum</td>";
        echo "<td>$accbal</td>";
        echo "<td>$username</td>";
        echo "<td>$passwordAsterisks</td>";
        echo "<td> <a class='btnedit hover-indicator' data-tooltip='deposit' href='./forms/topup_amount.php?passenger_id=$passengerid' style='background-color: #F2BE22;
        color: white;
        padding: 5px;
        text-decoration: none;
        font-size: 15px;
        border-radius: 5px;'>Top up</a>";
    }
}

// Handle the delete action
if (isset($_GET['delete_passenger_id'])) {
    $delete_passenger_id = $_GET['delete_passenger_id'];
    $delete_query = "DELETE FROM passenger WHERE passenger_id = '$delete_passenger_id'";
    mysqli_query($con, $delete_query) or die("Error: Failed to delete record.");
    // Redirect back to the same page after deletion
    header("Location: passenger_index.php");
    exit;
}

echo "</table>";

// Pagination
$total_rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM passenger"));

$total_pages = ceil($total_rows / $items_per_page);

echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo "<strong>$i</strong>";
    } else {
        echo "<a href='passenger_index.php?page=$i" . (!empty($txtsearch) ? "&txtsearch=$txtsearch" : "") . "'>$i</a>";
    }
}

echo "</div>";
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>RIDEPAY</title>
    <link rel="stylesheet" href="./CSS/managements_index.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <style>
        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
        }
        .pagination a, .pagination strong {
            margin: 0 5px;
            text-decoration: none;
            border: 1px solid #ccc;
            padding: 3px 6px;
            color: #333;
            background-color: #fff;
        }
        .pagination a:hover {
            background-color: #007bff;
            color: #fff;
        }
        .pagination strong {
            background-color: #007bff;
            color: #fff;
        }

        /* Search bar and button styles */
        .search-container {
            text-align: center;
            margin: 20px 0;
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }
        input[type="text"]:focus {
            border-color: #007bff; /* Highlight on focus */
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
</head>
<body>
<header>
    <h1>PAYMENT HISTORY</h1>
</header>
<script>
    function togglePopup(){
        document.getElementById("popup-1").classList.toggle("active");
    }
</script>

<div class="search-container">
    <form method="post">
        <input type="text" name="txtsearch" placeholder="Search...">
        <input type="submit" name="btnsearch" value="Search">
    </form>
</div>

<?php
include '../ridepay/Database/myDatabase.php';

$items_per_page = 10; // Number of rows per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

$sql = "SELECT * FROM payment_history";

// Handle the search query
$txtsearch = '';
if (isset($_POST['btnsearch'])) {
    $txtsearch = mysqli_real_escape_string($con, $_POST['txtsearch']);
    $sql .= " WHERE sales_id LIKE '%$txtsearch%' 
              OR passenger_id LIKE '%$txtsearch%' 
              OR name LIKE '%$txtsearch%' 
              OR transc_date LIKE '%$txtsearch%' 
              OR bus_id LIKE '%$txtsearch%' 
              OR amount LIKE '%$txtsearch%'";
}

$result = mysqli_query($con, $sql) or die("ERROR. Please check query statement...");
echo "<table class='custom-table' border=5 cellpadding=10 align=center>";
echo "<tr><th>SALES_ID</th>";
echo "<th>PASSENGER ID</th>";
echo "<th>NAME</th>";
echo "<th>DATE OF TRANSACTION</th>";
echo "<th>BUS ID</th>";
echo "<th>AMOUNT PAID</th>";

if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan=5> NO RECORDS FOUND. Please add record into the database</td></tr>";
} else {
    while ($row = mysqli_fetch_array($result)) {
        $sales_id = $row['sales_id'];
        $passenger_id = $row['passenger_id'];
        $name = $row['name'];
        $transc_date = $row['transc_date'];
        $bus = $row['bus_id'];
        $amount = $row['amount'];
        echo "<tr><td>$sales_id</td>";
        echo "<td>$passenger_id</td>";
        echo "<td>$name</td>";
        echo "<td>$transc_date</td>";
        echo "<td>$bus</td>";
        echo "<td>$amount</td></tr>";
    }
}
echo "</table>";

// Pagination
$total_rows = mysqli_num_rows(mysqli_query($con, $sql));
$total_pages = ceil($total_rows / $items_per_page);

echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo "<strong>$i</strong>";
    } else {
        echo "<a href='payment_history_index.php?page=$i'>$i</a>";
    }
}
echo "</div>";
?>
<h2 class="boxheader">Total Sales Per Bus</h2>
<?php
$sql = "SELECT bus_id, SUM(amount) as total_amount FROM payment_history GROUP BY bus_id";
$result = mysqli_query($con, $sql) or die("Error: Please check the query statement");
if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan=5> NO RECORDS FOUND. Please add record into the database</td></tr>";
} else {
    while ($row = mysqli_fetch_array($result)) {
        echo '<p style="font-size: 25px; font-family: Roboto; color: #333; font-weight: bold;">' . $row["bus_id"] . ': &#8369;' . $row["total_amount"];
    }
}
?>
<h2 class="boxheader">Total Sales All Bus</h2>
<?php
$sql = "SELECT SUM(amount) as total_amount FROM payment_history";
$result = mysqli_query($con, $sql) or die("Error: Please check the query statement");
if (mysqli_num_rows($result) == 0) {
    echo "<tr><td colspan=5> NO RECORDS FOUND. Please add record into the database</td></tr>";
} else {
    while ($row = mysqli_fetch_array($result)) {
        echo '<p style="font-size: 25px; font-family: Roboto; color: blue; font-weight: bold;">' . "Total Amount: &#8369;" . $row["total_amount"] . "<br>";
    }
}
?>
</div>
</div>
</body>
</html>

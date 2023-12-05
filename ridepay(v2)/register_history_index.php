<!DOCTYPE html>
<html lang="en">
<head>
    <title>RIDEPAY</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins|Quicksand:300,400,500,600,700&display=swap">
    <link rel="stylesheet" href="./CSS/managements_index.css">
    <style>
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

        /* Search table styles */
        table.custom-table {
            border-collapse: collapse;
            width: 100%;
            margin: 0 auto;
        }
        table.custom-table th, table.custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table.custom-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table.custom-table th {
            background-color: #007bff;
            color: white;
        }

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
    </style>
</head>
<body>
<script>
    function togglePopup() {
        document.getElementById("popup-1").classList.toggle("active");
    }
</script>
<header>
    <h1>REGISTRATION HISTORY</h1>
</header>

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

$sql = "SELECT * FROM register_history";
$txtsearch = '';

// Handle the search query
if (isset($_POST['btnsearch'])) {
    $txtsearch = mysqli_real_escape_string($con, $_POST['txtsearch']);
    $sql .= " WHERE sales_id LIKE '%$txtsearch%' 
              OR passenger_id LIKE '%$txtsearch%' 
              OR reg_date LIKE '%$txtsearch%' 
              OR amount LIKE '%$txtsearch%'";
}

// Count total rows before applying the limit
$total_rows = mysqli_num_rows(mysqli_query($con, $sql));

// Add the LIMIT and OFFSET to the SQL query
$sql .= " LIMIT $items_per_page OFFSET $offset";

$result = mysqli_query($con, $sql) or die("Error: Please check the query statement...");
echo "<table class='custom-table' border=5 cellpadding=5 align=center>";
echo "<tr><th> SALES ID </th>";
echo "<th> PASSENGER ID </th>";
echo "<th> REGISTRATION DATE </th>";
echo "<th> AMOUNT </th></tr>";

if ($total_rows == 0) {
    echo "<tr><td colspan=4> NO RECORDS FOUND. Insert record into the database </td></tr>";
} else {
    while ($row = mysqli_fetch_array($result)) {
        $sid = $row['sales_id'];
        $pid = $row['passenger_id'];
        $reg = $row['reg_date'];
        $amount = $row['amount'];
        echo "<tr><td>$sid </td>";
        echo "<td>$pid</td>";
        echo "<td>$reg</td>";
        echo "<td>$amount</td>";
    }
}
echo "</table>";

// Pagination
$total_pages = ceil($total_rows / $items_per_page);

echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo "<strong>$i</strong>";
    } else {
        echo "<a href='register_history_index.php?page=$i'>$i</a>";
    }
}
echo "</div>";
?>
</div>
</body>
</html>

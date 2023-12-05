<!DOCTYPE html>
<html lang="en">
<head>
    <title>RIDEPAY</title>
    <link rel="stylesheet" href="./CSS/managements_index.css">
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            border: 1px solid #ccc;
            padding: 3px 6px;
        }
    </style>
</head>
<body>
    <script>
        function togglePopup() {
            document.getElementById("popup-1").classList.toggle("active");
        }
    </script>
    <form method="post">
        <input type="text" name="txtsearch" placeholder="Search...">
        <input type="submit" name="btnsearch" value="Search">
    </form>

    <?php
    include '../ridepay/Database/myDatabase.php';

    $items_per_page = 10; // Number of rows per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $items_per_page;

    // Handle the search query
    $sql = "SELECT * FROM topup_history";
    $txtsearch = '';

    if (isset($_POST['btnsearch'])) {
        $txtsearch = mysqli_real_escape_string($con, $_POST['txtsearch']);
        $sql .= " WHERE sales_id LIKE '%$txtsearch%' 
                  OR passenger_id LIKE '%$txtsearch%' 
                  OR topup_date LIKE '%$txtsearch%' 
                  OR amount LIKE '%$txtsearch%'";
    }

    $sql .= " LIMIT $items_per_page OFFSET $offset";
    $result = mysqli_query($con, $sql) or die("Error: Please check the query statement.");

    echo "<table class='custom-table' border=5 cellpadding=5 align=center>";
    echo "<tr><th>SALES ID</th>";
    echo "<th>PASSENGER ID</th>";
    echo "<th>TOPUP DATE</th>";
    echo "<th>AMOUNT</th></tr>";

    if (mysqli_num_rows($result) == 0) {
        echo "<tr><td colspan=4>NO RECORDS FOUND. Insert records into the database.</td></tr>";
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $sid = $row['sales_id'];
            $pid = $row['passenger_id'];
            $topup = $row['topup_date'];
            $amount = $row['amount'];
            echo "<tr><td>$sid</td>";
            echo "<td>$pid</td>";
            echo "<td>$topup</td>";
            echo "<td>$amount</td></tr>";
        }
    }
    echo "</table>";

    // Pagination
    $total_rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM topup_history"));
    $total_pages = ceil($total_rows / $items_per_page);
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo "<strong>$i</strong>";
        } else {
            echo "<a href='topup_history_index.php?page=$i" . (!empty($txtsearch) ? "&txtsearch=$txtsearch" : "") . "'>$i</a>";
        }
    }
    echo "</div>";
    ?>
</body>
</html>

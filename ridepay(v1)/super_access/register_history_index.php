<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            RIDEPAY
        </title>
        <link rel="stylesheet" href="../../ridepay/CSS/managements_index.css">
    </head>
<body>
<script>
    function togglePopup(){
        document.getElementById("popup-1").classList.toggle("active");
    }
</script>
<header>
    <a class='btn_m' href="../super_access/homepage.php">Back to Main Page</a>

<h1>
    REGISTRATION HISTORY
</h1>
    </header>

<?php

include'../../ridepay/Database/myDatabase.php';

$sql = "SELECT * FROM register_history";

$txtsearch='';
if(isset($_POST['btnsearch'])){
     $txtsearch = $_POST['txtsearch'];
     $sql .= " WHERE sales_id like '$txtsearch%' OR passenger_id like '$txtsearch%' OR reg_date like '$txtsearch%' OR amount like '$txtsearch%' OR commission like '$txtsearch%' OR balance like '$txtsearch%'";
}
$sql .= " ORDER BY sales_id, passenger_id, reg_date, amount, commission, balance";

$result=mysqli_query($con, $sql) or die("Error: Please check the query statement");
echo "<form class='seform' method='post'>
<center>
<input class='sebar' type='text' name='txtsearch' value='$txtsearch' placeholder='       SEARCH HERE'> &nbsp;&nbsp;
<input class='btnser' value='search' type='submit' name='btnsearch'>
</center>
</form>";

$result = mysqli_query($con, $sql)or die("Error please check sql statement...");
echo "<table class='table' border=5 cellpadding=5 align=center>";
echo "<tr><th> SALES ID </th>";
echo "<th> PASSENGER ID </th>";
echo "<th> REGISTRATION DATE </th>";
echo "<th> REGISTERED AMOUNT </th>";
echo "<th> COMMISSION SALES </th>";
echo "<th> BALANCE </th></tr>";

if(mysqli_num_rows($result)== 0) {
    echo "<tr><td colspan=4> NO RECORDS FOUND. Insert record into database </td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        $sid = $row['sales_id'];
        $pid = $row['passenger_id'];
        $reg = $row['reg_date'];
        $amount = $row['amount'];
        $com = $row['commission'];

        $com = $amount * 0.05;
        $newamount = $amount - $com;

        echo "<tr><td>$sid </td>";
        echo "<td>$pid</td>";
        echo "<td>$reg</td>";
        echo "<td>$amount</td>";
        echo "<td>$com</td>";
        echo "<td>$newamount</td>";
        
    }
}
echo "</table>";
?>
<button class="btn_m" style="border-radius: 50px;" onclick="togglePopup()">Total Sales</button>
   <div class="popup" id="popup-1">
<div class="overlay"><div class="close-btn" onclick="togglePopup()">&times; </div></div>
<div class="content">
<h2 class="boxheader">Total Registration Sales</h2>
<?php
$sql = "SELECT SUM(amount) as total_amount FROM register_history";
$result=mysqli_query($con, $sql) or die("Error: Please check the query statement");
if(mysqli_num_rows($result) == 0) {
    echo"<tr><td colspan=5> NO RECORDS FOUND. Please add record into the database</td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        echo '<p style="font-size: 25px; font-family: Roboto; color: blue; font-weight: bold;">'. "Total Amount: &#8369;" . $row["total_amount"]. "<br>";
    }
}
?>
</div>
</div>
<footer>
<p>&copy; 2023 RIDEPAY. All rights reserved.</p>
</footer>
</body>
</html>
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
    <a class='btn_m' href="../admin_access/homepage.php">Back to Main Page</a>
    <h1>PAYMENT HISTORY</h1>
    </header>
<script>
    function togglePopup(){
        document.getElementById("popup-1").classList.toggle("active");
    }
</script>
<?php

include'../../ridepay/Database/myDatabase.php';

$sql = "SELECT * FROM payment_history";

$txtsearch='';
if(isset($_POST['btnsearch'])){
     $txtsearch = $_POST['txtsearch'];
     $sql .= " WHERE sales_id like '$txtsearch%' OR passenger_id like '$txtsearch%' OR name like '$txtsearch%' OR transc_date like '$txtsearch%' OR bus_id like '$txtsearch%' OR amount like '$txtsearch%' OR commission like '$txtsearch%'";
}
$sql .= " ORDER BY sales_id, passenger_id, name, transc_date, bus_id, amount, commission";

$result=mysqli_query($con, $sql) or die("Error: Please check the query statement");
echo "<form class='seform' method='post'>
<center>
<input class='sebar' type='text' name='txtsearch' value='$txtsearch' placeholder='       SEARCH HERE'> &nbsp;&nbsp;
<input class='btnser' value='search' type='submit' name='btnsearch'>
</center>
</form>";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement...");
echo "<table class='table' border=5 cellpadding=10 align=center>";
echo "<tr><th>SALES_ID</th>";
echo "<th>PASSENGER ID</th>";
echo "<th>NAME</th>";
echo "<th>DATE OF TRANSACTION</th>";
echo "<th>BUS ID</th>";
echo "<th>AMOUNT PAID</th>";
echo "<th>COMMISSION</th><tr>";

if(mysqli_num_rows($result) == 0) {
      echo"<tr><td colspan=5> NO RECORDS FOUND. Please add record into the database</td></tr>";
  } else {
      while($row=mysqli_fetch_array($result)) {
          $sales_id = $row['sales_id'];
          $passenger_id = $row['passenger_id'];
          $name = $row['name'];
          $transc_date= $row['transc_date'];
          $bus= $row['bus_id'];
          $amount = $row['amount'];
          $commission = $row['commission'];
          $sales = $amount * 0.02;
          echo "<tr><td>$sales_id</td>";
          echo "<td>$passenger_id</td>";
          echo "<td>$name</td>";
          echo "<td>$transc_date</td>";
          echo "<td>$bus</td>";
          echo "<td>$amount</td>";
          echo "<td>$sales</td></tr>";
      }
  }
  echo "</table>";
  ?>
   <button class="btn_m" style="border-radius: 50px;" onclick="togglePopup()">Total Sales</button>
   <div class="popup" id="popup-1">
<div class="overlay"><div class="close-btn" onclick="togglePopup()">&times; </div></div>
<div class="content">

<h2 class="boxheader">Total Sales Per Bus</h2>
<?php
$sql = "SELECT bus_id, SUM(amount) as total_amount FROM payment_history GROUP BY bus_id";
$result=mysqli_query($con, $sql) or die("Error: Please check the query statement");
if(mysqli_num_rows($result) == 0) {
    echo"<tr><td colspan=7> NO RECORDS FOUND. Please add record into the database</td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        echo '<p style="font-size: 25px; font-family: Roboto; color: #333; font-weight: bold;">' . $row["bus_id"]. ': &#8369;'.$row["total_amount"];
    }
}
?>
<h2 class="boxheader">Total Sales All Bus</h2>
<?php
$sql = "SELECT SUM(amount) as total_amount FROM payment_history";
$result=mysqli_query($con, $sql) or die("Error: Please check the query statement");
if(mysqli_num_rows($result) == 0) {
    echo"<tr><td colspan=7> NO RECORDS FOUND. Please add record into the database</td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        echo '<p style="font-size: 25px; font-family: Roboto; color: blue; font-weight: bold;">'. "Total Amount: &#8369;" . $row["total_amount"]. "<br>";
    }
}
?>

<h2 class="boxheader">Commission Sales Per Bus</h2>
<?php
$sql = "SELECT bus_id, SUM(amount * 0.20) as total_commission FROM payment_history GROUP BY bus_id";
$result = mysqli_query($con, $sql) or die("Error: Please check query statement");
if(mysqli_num_rows($result) == 0) {
    echo"<tr><td colspan=7> NO RECORDS FOUND. Please add record into the database</td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        echo '<p style="font-size: 25px; font-family: Roboto; color: blue; font-weight: bold;">'. $row["bus_id"]. ': &#8369;'.$row["total_commission"];
    }
}
?>
</div>
</div>
  
  </body>
  </html>
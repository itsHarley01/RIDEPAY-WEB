<?php
require_once('auth.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        RIDEPAY
    </title>
    <link rel="stylesheet" href="../../ridepay/CSS/home_styles.css">
</head>
<body>
    <header>
        <h1> RIDEPAY  <br>MANAGEMENT SYSTEM</h1>
    </header> 
<nav class="nav">
    <a class="btnlink" href="passenger_index.php">VIEW PASSENGER</a> 
    <a class="btnlink" href="bus_index.php">BUS</a> 
    <a class="btnlink" href="driver_index.php">DRIVER</a> 
    <div class="dropdown">
        <button class="btnlink">RECORDS</button>
        <div class="dropdown-content">
            <a class='btnlink' href="payment_history_index.php">Bus Sales Record</a><br><br>
            <a class='btnlink' href="register_history_index.php">Register Record</a><br><br>
            <a class='btnlink' href="topup_history_index.php">Topup Record</a>
        </div>
    </div>
    <a class="btnlink" href="farem.php">FARE</a> 
    <a class="btnlink" href="newregistration_index.php">REGISTER NEW PASSENGER</a> 
    <a class="btnlink" href="passengerTopup.php">TOPUP</a> 
</nav>

    <main>
        
    </main>

    <footer>
        <p>&copy; 2023 RIDEPAY. All rights reserved.</p> <a href="../admin_access/adminlogout.php" >Logout</a>
    </footer>
</body>
</html>
  
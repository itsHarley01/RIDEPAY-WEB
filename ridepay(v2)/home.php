<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ridepay | Home</title>
    <link rel="stylesheet" href="./CSS/hometab.css">
    <link rel="stylesheet" href="./CSS/preloader.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins|Quicksand:300,400,500,600,700&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
</head>
<body>
<div id="content-wrapper">

<?php
include "./Database/myDatabase.php";

// Initialize variables to store sums
$pliteTotal = 0;
$registerTotal = 0;
$topupTotal = 0;

// Query to fetch data from the payment_history table
$pliteQuery = "SELECT amount FROM payment_history";
$pliteResult = mysqli_query($con, $pliteQuery);
if ($pliteResult) {
    while ($row = mysqli_fetch_assoc($pliteResult)) {
        $pliteTotal += $row['amount'];
    }
}   

// Query to fetch data from the register_history table
$registerQuery = "SELECT amount FROM register_history";
$registerResult = mysqli_query($con, $registerQuery);

if ($registerResult) {
    while ($row = mysqli_fetch_assoc($registerResult)) {
        $registerTotal += $row['amount'];
    }
}

// Query to fetch data from the topup_history table
$topupQuery = "SELECT amount FROM topup_history";
$topupResult = mysqli_query($con, $topupQuery);

if ($topupResult) {
    while ($row = mysqli_fetch_assoc($topupResult)) {
        $topupTotal += $row['amount'];
    }
}

// Function to format numbers with commas and shorten large numbers
function formatNumber($number) {
    if ($number >= 1000000) {
        return number_format($number / 1000000, 1) . 'm';
    } elseif ($number >= 100000) {
        return number_format($number / 1000, 0) . 'k';
    } else {
        return number_format($number, 0);
    }
}



// Output the totals in the desired format
$pliteTotalFormatted = formatNumber($pliteTotal);
$registerTotalFormatted = formatNumber($registerTotal);
$topupTotalFormatted = formatNumber($topupTotal);
$revenue = $topupTotal + $registerTotal;
$revenueFormatted = formatNumber($revenue);

$passengerQ = "SELECT COUNT(*) as total_rows FROM passenger";

$passengerResult = $con->query($passengerQ);

if ($passengerResult) {
    $row = $passengerResult->fetch_assoc();
    $totalpassenger = $row['total_rows'];
}
$totalpformat = formatNumber($totalpassenger);

$fareQuery = "SELECT min_fare_amount FROM minimum_fare";
$fareResult = mysqli_query($con, $fareQuery);

if ($fareResult) {
    // Check if the query executed successfully
    $row = mysqli_fetch_assoc($fareResult);
    if ($row) {
        // Fetch the data from the result set
        $fare = $row['min_fare_amount'];

        // Now, $fare contains the 'min_fare_amount' value from the query result
    } else {
        // Handle the case where no rows were returned
        echo "No data found.";
    }

    // Don't forget to free the result set when you're done with it
    mysqli_free_result($fareResult);
} else {
    // Handle the case where the query failed
    echo "Query failed: " . mysqli_error($con);
}

?>


    <h1>Home</h1>
    <hr>
    <p class="section">Sales</p>
    <div class="container">
        <div class="sales" style="background-color: #3876BF;">
        <center>
            <i class="fa-solid fa-van-shuttle icons" style="color: #ffffff;"></i>
            <p class="card"> Bus Sales </p>
            <p class="price">&#8369;<?php echo $pliteTotalFormatted; ?></p>
        </center>
        </div>
        <div class="sales" style="background-color: #F1C93B;">
        <center>
        <i class="fa-solid fa-hand-holding-dollar icons" style="color: #ffffff;"></i>
        <p class="card">Top-up Sales </p>
        <p class="price">&#8369;<?php echo $topupTotalFormatted; ?></p>
        </center>
        </div>
        <div class="sales" style="background-color: #D83F31;">
        <center>
        <i class="fa-solid fa-computer icons" style="color: #ffffff;"></i>
        <p class="card">Registration Sales </p>
        <p class="price">&#8369;<?php echo $registerTotalFormatted; ?></p>
        </center>
        </div>
    </div>
    <center><p class="woah" style="margin-top: 10px;">Ridepay Revenue: </p><div class="rev"><p class="kwarta">&#8369;</p><p class="money"><?php echo $revenueFormatted; ?></p></div></center>
    <div style="display: flex; justify-content:center; gap:20px;">
    <div class="lowest"><center><p style="margin-bottom: 0px;">Total passengers: <p style="margin-top: 0px; font-size: 30px;"><?php echo $totalpformat?></p></p></div></center>
    <div class="lowest"><center><p style="margin-bottom: 0px;">Current Fare: <p style="margin-top: 0px; font-size: 30px;">&#8369;<?php echo $fare?></p></p></div></center>
</div>
</div>
<div id="preloader">
    <img src="loadingicon.svg" alt="Loading...">
</div>
<script src="preloader.js"></script>
</body>
</html>
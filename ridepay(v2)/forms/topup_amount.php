<!DOCTYPE html>
<html lang="en">
<head>
    <title>RIDEPAY - Top Up</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel="stylesheet" href="../CSS/edit.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap">
</head>
<body>

<?php
if (isset($_GET['passenger_id'])) {
    $passenger_id = $_GET['passenger_id'];
    // Retrieve passenger information to display here if needed
    echo "<form class='form' method='post' action='../process/topup_process.php'>
            <input type='hidden' name='txtpid' value='$passenger_id'>
            <input type='hidden' name='txtdate' value='" . date('Y-m-d') . "'>
            <label for='txtamount'>Enter Amount: </label>
            <input type='number' name='txtamount' required>
            <input class='btn_save' type='submit' name='submit' value='Top Up'>
        </form>";
} else {
    echo "Invalid passenger ID.";
}
?>

</body>
</html>

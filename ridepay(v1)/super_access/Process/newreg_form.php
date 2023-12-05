<?php
require_once('../auth.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>RIDEPAY</title>
    </head>
    <link rel="stylesheet" href="../../CSS/edit.css">
<body class="regbody">
    <header>
        <a class='btn_m' href="../../super_access/homepage.php"> Back to homepage</a>
        <h1>PASSENGER QR</h1>
    </header>

    <?php
        
        function generateUQR($length = 50) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $UQRID = '';
        
            for ($i = 0; $i < $length; $i++) {
                $UQRID .= $characters[rand(0, strlen($characters) - 1)];
            }
        
            return $UQRID;
        }


    if(isset($_POST["submit"])) {

        include '../../Database/myDatabase.php';
        $Genqrid = generateUQR();
      
        $passid = $_POST['txtpassid'];
        $regdate = $_POST['txtregdate'];
        $lastname = $_POST['txtlastname'];
        $firstname = $_POST['txtfirstname'];
        $age = $_POST['txtage'];
        $connum = $_POST['txtconnum'];
        $balance = $_POST['txtbalance'];
        $ftype=$_POST['txtfare'];

        
        if ($ftype == 2) {
            $nextYear = date('Y-m-d', strtotime('+1 year'));
            $discount_expiry_date = $nextYear;
        } else {
            $discount_expiry_date = 'NULL';
        }

        $sql = "INSERT into passenger (passenger_id, registration_date, lastname, firstname, age, mobile_num, acc_balance,fare_id, discount_expiry_date, username, password,acc_status,QRID) 
VALUES ('$passid', '$regdate','$lastname', '$firstname', '$age', '$connum', '$balance','$ftype','$discount_expiry_date', '$firstname','$lastname','1','$Genqrid')";
        $result = mysqli_query($con, $sql) or die("Error in insert statement please check again...");

$sql22 = "INSERT into register_history (passenger_id, reg_date, amount) VALUES ('$passid', '$regdate', '$balance')";
mysqli_query($con, $sql22) or die("Error in insert statement, please check again...");


    }
    ?>

    <?php 

    $sql = "SELECT * FROM passenger WHERE passenger_id='$passid'";

    $result = mysqli_query($con, $sql) or die("ERROR. Please check query statement...");
    while($row=mysqli_fetch_array($result)) {
        $passengerid = $row['passenger_id'];
        $lastname = $row['lastname'];
        $firstname = $row['firstname'];
        $age = $row['age'];
        $mobilenum = $row['mobile_num'];
        $accbal = $row['acc_balance'];
        $username = $row['username'];
        $password = $row['password'];
        $qrid = $row['QRID'];

        echo "<div class='info-container'>
        <div class='infotable'>
        <table  >
        <br><br>
            <tr>
                <td><b>Passenger ID:</b> $passengerid</td>
            </tr>
            <tr>
                <td><b>Name:</b> $firstname $lastname</td>
            </tr>
            <tr>
             <td><b>Age:</b> $age</td>
            </tr>
            <tr>
                <td><b>Contact Number:</b> $mobilenum</td>
            </tr>
            <tr>
                <td><b>Balance:</b> $accbal</td>
            </tr>
            <tr>
                <td><b>Default Username:</b> $username</td>
            </tr>
            <tr>
                <td><b>Default password:</b> $password</td>
            <tr>
            </table>
            </div>
        ";

    }
    ?>

<?php

require "../../vendor/autoload.php";

use Endroid\QrCode\Qrcode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

$text = $qrid;

$qr_code = QrCode::create($text)
                ->setSize(200)
                ->setMargin(30)
                ->setForegroundColor(new Color(0, 0, 0))
                ->setBackgroundColor(new Color(255, 255, 255))
                ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh);

$writer = new PngWriter;

$result = $writer->write($qr_code);

echo '<img src="data:image/png;base64,' . base64_encode($result->getString()) . '" alt="QR Code">  ';
echo'</div>';
?>

<div class='cont2'>
    <a class='btn_m2' href="../newregistration_index.php">New Registration</a>
</div>

</body>
</html>

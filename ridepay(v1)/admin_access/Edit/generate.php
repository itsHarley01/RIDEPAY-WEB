<?php
require_once('../auth.php');
?>
<link rel='stylesheet' href='../../CSS/edit.css'>
<header>
<header>
        <a class='btn_m' href="../../admin_access/passenger_index.php">Go back</a>
        <h1>PASSENGER QR</h1>
    </header>
</header>
<?php 
include'../../Database/myDatabase.php';
    $sql = "SELECT * FROM passenger";
    $result = mysqli_query($con, $sql)or die("Error. Please check query statement");
    $id = '';
    if(isset($_GET['passenger_id'])) {
        $id=$_GET['passenger_id'];

    $sql = "SELECT * FROM passenger WHERE passenger_id='$id'";
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
    }
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
                <td><b>Username:</b> $username</td>
            </tr>
            <tr>
                <td><b>Password:</b> $password</td>
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

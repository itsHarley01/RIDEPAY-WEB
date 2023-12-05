<?php
require_once('../auth.php');
?>
<link rel='stylesheet' href='../../CSS/edit.css'>
<?php
require_once '../../Database/myDatabase.php';

$newBalance = '';

if (isset($_POST["submit"])) {
    $pid = $_POST['txtpid'];
    $tudate=$_POST['txtdate'];
    $bal = floatval($_POST['txttopamount']);

    

    $sql = "SELECT acc_balance FROM passenger WHERE passenger_id = '$pid'";
    $sql_result = mysqli_query($con, $sql);

$sql11 = "INSERT INTO topup_history (passenger_id, topup_date, amount) VALUES ('$pid', '$tudate', '$bal')";
mysqli_query($con, $sql11);

    if ($sql_result) {
        $row = mysqli_fetch_assoc($sql_result);
        $accbal = $row['acc_balance'];


        $newBalance = $accbal + $bal;
        
        $sql1 = "UPDATE passenger SET acc_balance = $newBalance WHERE passenger_id = '$pid'";
        $sql_result1 = mysqli_query($con, $sql1);

        if ($sql_result1) {
            echo "<center class='conf'>Top up has been successful.
            Click here <a href='../../admin_access/homepage.php'>HERE</a> to go back to homepage </center>";
        } else {
            echo "Error" . mysqli_error($con);
        }
    } else {
        echo "Error" . mysqli_error($con);
    }
} else {
    echo "Error";
}
?>
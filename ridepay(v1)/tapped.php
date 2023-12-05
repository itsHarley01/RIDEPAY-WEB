<?php

$new_balance = '';
$dis = '';
$min_fare = '';
$paid = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $qrid1 = $_POST['uid'];
    $ambatubus = $_POST['ambatubus'];

    require_once '../ridepay/Database/myDatabase.php';

    $sql_select3 = "SELECT * FROM minimum_fare WHERE min_fare_id= '1'";
    $query_result3 = mysqli_query($con, $sql_select3);

    if ($query_result3) {
        $row = mysqli_fetch_assoc($query_result3);
        $min_fare = $row['min_fare_amount'];
    }

    $sql_select = "SELECT * FROM passenger WHERE QRID = '$qrid1'";
    $query_result = mysqli_query($con, $sql_select);

    if ($query_result) {
        if ($row = mysqli_fetch_assoc($query_result)) {
            $puid = $row['passenger_id'];
            $current_balance = $row['acc_balance'];
            $fname = $row['firstname'];
            $lname = $row['lastname'];
            $discount = $row['fare_id'];
            $acc_status = $row['acc_status'];

            if ($acc_status == 2) {
                $result['Success'] = "1";
                $result['Message'] = "Deactivated";
                echo json_encode($result);
            } else {
                if ($current_balance >= $min_fare) {
                    if ($discount == 2) {
                        $dis = ($min_fare * 20) / 100;
                        $new_balance = $current_balance - ($min_fare - $dis);
                        $paid = $min_fare - $dis;
                    } else {
                        $new_balance = $current_balance - $min_fare;
                        $paid = $min_fare;
                    }
                    $sql_update = "UPDATE passenger SET acc_balance = '$new_balance' WHERE passenger_id = '$puid'";
                    $update_result = mysqli_query($con, $sql_update);

                    $sql_payment_history = "INSERT INTO payment_history (passenger_id, name, transc_date, bus_id, amount ) VALUES('$puid', '$fname  $lname ', NOW(), '$ambatubus', '$paid')";
                    $update_payment_history_result = mysqli_query($con, $sql_payment_history);

                    if ($update_result && $update_payment_history_result) {
                        $result['Success'] = "1";
                        $result['Message'] = "Successfully Paid!";
                        echo json_encode($result);
                    } else {
                        $result['Success'] = "0";
                        $result['Message'] = "Connection Error!";
                        echo json_encode($result);
                    }
                } else {
                    $result['Success'] = "0";
                    $result['Message'] = "Insufficient Funds!";
                    echo json_encode($result);
                }
            }
        } else {
            $result['Success'] = "0";
            $result['Message'] = "No records found for the given UID ";
            echo json_encode($result);
        }
    }
}

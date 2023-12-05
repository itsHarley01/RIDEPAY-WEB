<?php
$pid = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pid = $_POST['Pid'];

    require_once '../ridepay/Database/myDatabase.php';

    // Retrieve passenger_id based on pid
    $sql_select = "SELECT * FROM passenger WHERE passenger_id = '$pid'";
    $query_result = mysqli_query($con, $sql_select);

    if ($query_result) {
        if (mysqli_num_rows($query_result) > 0) {
            $row = mysqli_fetch_assoc($query_result);
            $bal = $row['acc_balance'];
            $acc_status = $row['acc_status'];

            $result['Success'] = "1";
            $result['Message'] = "Successful";
            $result['Balance'] = $bal;
            $result['acstat'] = $acc_status;
            echo json_encode($result);
        } else {
            $result['Success'] = "0";
            $result['Message'] = "No records found";
            echo json_encode($result);
        }
    } else {
        $result['Success'] = "0";
        $result['Message'] = "Database Error: " . mysqli_error($con);
        echo json_encode($result);
    }
} else {
    $result['Success'] = "0";
    $result['Message'] = "Invalid Request";
    echo json_encode($result);
}

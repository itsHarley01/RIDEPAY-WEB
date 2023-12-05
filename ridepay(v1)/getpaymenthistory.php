<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid1 = $_POST['Pid'];

    require_once '../ridepay/Database/myDatabase.php';

    $sql1 = "SELECT transc_date, amount FROM payment_history WHERE passenger_id = '$uid1'";
    $sql2 = "SELECT topup_date, amount FROM topup_history WHERE passenger_id = '$uid1'";

    $myquery1 = mysqli_query($con, $sql1);
    $myquery2 = mysqli_query($con, $sql2);

    $history_list = array();

    if ($myquery1) {
        while ($row1 = mysqli_fetch_assoc($myquery1)) {
            $history_list[] = array(
                'date' => $row1['transc_date'],
                'amount' => $row1['amount'],
                'type' => 'Payment'
            );
        }
    }

    if ($myquery2) {
        while ($row2 = mysqli_fetch_assoc($myquery2)) {
            $history_list[] = array(
                'date' => $row2['topup_date'],
                'amount' => $row2['amount'],
                'type' => 'Top-Up'
            );
        }
    }

    if (!empty($history_list)) {
        $result['Success'] = "1";
        $result['Message'] = "Successfully retrieve!";
        $result['history'] = $history_list;
        echo json_encode($result);
    } else {
        $result['Success'] = "0";
        $result['Message'] = "No history found for this user.";
        echo json_encode($result);
    }
}
?>

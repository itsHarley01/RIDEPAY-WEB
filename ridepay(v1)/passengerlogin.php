<?php
$pid='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enteredUsername = $_POST['enteredUsername'];
    $enteredPassword = $_POST['enteredPassword'];

    require_once '../ridepay/Database/myDatabase.php';

    // Retrieve passenger_id based on the entered username and password
    $sql_select = "SELECT passenger_id FROM passenger WHERE username = '$enteredUsername' AND password = '$enteredPassword'";
    $query_result = mysqli_query($con, $sql_select);

    if ($query_result) {
        if (mysqli_num_rows($query_result) > 0) {
            $row = mysqli_fetch_assoc($query_result);
            $pid = $row['passenger_id'];
            
            $sql_select2 = "SELECT * FROM passenger WHERE passenger_id='$pid' ";
            $query_result2 = mysqli_query($con, $sql_select2);

            if ($query_result2 && mysqli_num_rows($query_result2) > 0) {
                $row2 = mysqli_fetch_assoc($query_result2);
                $fname = $row2['firstname'];
                $lname = $row2['lastname'];
                $usname = $row2['username'];
                $paword = $row2['password'];
                $bal= $row2['acc_balance'];
                $acc_status= $row2['acc_status'];
                $qrid = $row2['QRID'];

                $result['Success'] = "1";
                $result['Message'] = "Successfully logged in";
                $result['Pid'] = $pid;
                $result['UserUsername'] = $usname;
                $result['UserPassword'] = $paword;
                $result['fName'] = $fname;
                $result['lName'] = $lname;
                $result['Balance'] = $bal;
                $result['Pqrid'] = $qrid;
                $result['acstat'] = $acc_status;
                echo json_encode($result);
            } else {
                $result['Success'] = "0";
                $result['Message'] = "No records found";
                echo json_encode($result);
            }
        } else {
            $result['Success'] = "0";
            $result['Message'] = "Username and password do not match";
            echo json_encode($result);
        }
    } else {
        $result['Success'] = "0";
        $result['Message'] = "Connection Error!";
        echo json_encode($result);
    }
}
 
?>

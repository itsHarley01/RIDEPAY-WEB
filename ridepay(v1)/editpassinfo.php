<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Pid=$_POST['Pid'];
    $editUsername=$_POST['editUsername'];
    $editPassword=$_POST['editPassword'];

    require_once '../ridepay/Database/myDatabase.php';
                   
    $sql_update = "UPDATE passenger SET password = '$editPassword', username = '$editUsername' WHERE passenger_id = '$Pid'";
    $update_result = mysqli_query($con, $sql_update);

    if ($update_result) {
        $result['Success'] = "1";
        $result['Message'] = "Successfully Updated!";
        echo json_encode($result);
    } else {
        $result['Success'] = "0";
        $result['Message'] = "Update Unsuccessful! Please try again later";
        echo json_encode($result);
    }
}

?>
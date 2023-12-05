<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Pid = $_POST['Pid'];
    $dateText = $_POST['dateText'];
    $reasonText = $_POST['reasonText'];

    require_once '../ridepay/Database/myDatabase.php';

    $select_sql = "SELECT firstname, lastname, mobile_num FROM passenger WHERE passenger_id = '$Pid'";
    $select_result = mysqli_query($con, $select_sql);

   $update_sql = "UPDATE passenger SET acc_status = '2' WHERE passenger_id = '$Pid'";
   $update_result = mysqli_query($con, $update_sql);

    if ($select_result && mysqli_num_rows($select_result) > 0) {
        $row = mysqli_fetch_assoc($select_result);
     
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $contact_number = $row['mobile_num'];

        $insert_sql = "INSERT INTO user_deactivation_records (passenger_id, date, firstname, lastname, contact_number, reason)
                      VALUES ('$Pid', '$dateText', '$firstname', '$lastname', '$contact_number', '$reasonText')";
        $insert_result = mysqli_query($con, $insert_sql);

        if ($insert_result) {
            $response['Success'] = "1";
            $response['Message'] = "Successfully submitted!";
            echo json_encode($response);
        } else {
            $response['Success'] = "0";
            $response['Message'] = "Insertion Unsuccessful! Please try again later";
            echo json_encode($response);
        }
    } else {
        $response['Success'] = "0";
        $response['Message'] = "Record not found in the passenger table";
        echo json_encode($response);
    }
}
?>

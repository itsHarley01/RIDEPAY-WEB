<?php
require_once '../ridepay/Database/myDatabase.php';

$sql_select_bus = "SELECT bus_id FROM Bus";
$query_result_bus = mysqli_query($con, $sql_select_bus);

$bus_id_list = array();

if ($query_result_bus) {
    while ($row_bus = mysqli_fetch_assoc($query_result_bus)) {
        $bus_id_list[] = $row_bus['bus_id'];
    }
}

$response = array(
    'bus' => $bus_id_list
);

echo json_encode($response);
?>
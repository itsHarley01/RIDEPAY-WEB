<?php
require_once('../auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        RIDEPAY
    </title>
    <link rel="stylesheet" href="../../CSS/managements_index.css">
</head>
<body>
    <header>
        <a class='btn_m' href="../../admin_access/bus_index.php">Go back</a>
    <h1>
        ADD New Bus
    </h1>
    </header>
    
<form class="form" method="post" action="../../admin_access/Process/addbus_process.php">
<table>
    <tr>
        <td><label for="txtbusid">ENTER BUS ID: </label></td>
        <td><input type="text" name="txtbusid" required></td>
    </tr>

    <tr>
        <td><lable for="txtdriverid">SELECT DRIVER ID: </lable></td>
        <td><select name="txtdriverid" required>
            <option value="">Select Driver ID:</option>
            <?php
                include'../../Database/myDatabase.php';
                $sql1 ="SELECT * FROM driver";
                $result=mysqli_query($con,$sql1);
                while($row=mysqli_fetch_array($result)){
                    $driver_id=$row["driver_id"];
                    $drivername=$row["name"];
                    echo"<option value='$driver_id'>$driver_id, $drivername</option>";
                }
            ?>
            </select></td>
    </tr>

    <tr>
        <td><label for="txtcapacity">ENTER CAPACITY: </label></td>
        <td><input type="number" name="txtcapacity" required></td>
    </tr>

    <tr>
        <td><input type="submit" value="SAVE" name="submit"></td>
    </tr>
</table>
</form>
</body>
</html>
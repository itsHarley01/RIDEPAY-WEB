<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            RIDEPAY
        </title>
        <link rel="stylesheet" href="../CSS/edit.css">
    </head>
    <body>

    <?php
    
    include'../Database/myDatabase.php';

if(isset($_GET['passenger_id'])) {
    $id = $_GET['passenger_id'];

$sql = "SELECT * FROM passenger WHERE passenger_id='$id'";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");
while($row=mysqli_fetch_array($result)) {
    $passengerid = $row['passenger_id'];
    $lastname = $row['lastname'];
    $firstname = $row['firstname'];
    $acc_status = $row['acc_status'];

    }
}
    ?>
    <div class='addsom'>

        <h1> UPDATE STATUS </h1>
    <form class="form" method="POST" action="../process/acc_status_process.php">
<table>
   <tr>
         <td><label for="txtpid">PUID: </label></td>
         <td><input type="text" name="txtpid" value="<?php echo $passengerid;?>" readonly></td>
   </tr>
  <tr>
         <td><label for="txtname">NAME: </label></td>
         <td><input type="text" name="txtname" value="<?php echo $firstname . ' '. $lastname;?>" readonly></td>
   </tr>
    <tr>
        <td><lable for="txtaccid">ACCOUNT STATUS: </lable></td>
<td>
    <select name="txtaccid" required>
        <?php
        $sql1 = "SELECT * FROM acc_status";
        $result2 = mysqli_query($con, $sql1);

        while ($row2 = mysqli_fetch_array($result2)) {
            $acc_status_id2 = $row2["acc_status_id"];
            $acc_status2 = $row2["acc_status"];

            $selected = ($acc_status2 == $acc_status) ? 'selected' : '';

            echo "<option value='$acc_status_id2' $selected>$acc_status_id2, $acc_status2</option>";
        }
        ?>
    </select>
</td>

    </tr>

    <tr>
        <td><input type="submit" value="SAVE" name="submit">
 <a class='redirect' href="../passenger_index.php">Go back</a></td>
    </tr>
</table>
</form>
</div>
    </body>
</html>
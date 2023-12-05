<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>RIDEPAY</title>
        <link rel="stylesheet" href="../../ridepay/CSS/edit.css">
    </head>
    <body>
        <header>
        <a class='btn_m' href="../super_access/homepage.php"> Back to homepage</a>
        <h1>TOPUP</h1>

        </header>
        
        <form class='form' method="post" action="../super_access/Process/topup_process.php">
            <table>

                <tr>
                    <td><label for="txtdate">Date : </label></td>
                    <td><input type="date" name="txtdate" value="<?php echo date('Y-m-d'); ?>" required></td>
                </tr>

                <tr>
                    <td><label for="txtpid">Passenger: </label></td>
                    <td><select name="txtpid" required>
                    <option value="">Select Passenger:</option>
                    <?php
                     include'../../ridepay/Database/myDatabase.php';
                     $sql1 ="SELECT * FROM passenger";
                     $result=mysqli_query($con,$sql1);

                     while($row=mysqli_fetch_array($result)){
                         $pid=$row["passenger_id"];
                         $lname=$row["lastname"];
                         $fname=$row["firstname"];
                         $bal=$row["acc_balance"];
                         echo"<option value='$pid'>$lname, $fname(Balance: $bal)</option>";
                     }
                    ?>
                    </select></td>
               </tr>

                <tr>
                    <td><label for="txttopamount">Top up Amount: </label></td>
                    <td><input type="number" name="txttopamount"></td>
                </tr>

                <tr>
                    <td><input class='btn_save' type="submit" value="TOP UP" name="submit"></td>
                </tr>

            </table>
        </form>
    </body>
</html>
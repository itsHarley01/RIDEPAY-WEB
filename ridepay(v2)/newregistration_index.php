<!DOCTYPE html>
<html>
    <head>
        <title>RIDEPAY</title>
        <link rel="stylesheet" href="./CSS/edit.css">
    </head>
    <body>
        <header>
        <h1>REGISTER NEW PASSENGER</h1>

        </header>
        
        <form class='form' method="post" action="../ridepay/Process/newreg_form.php">
            <table>

                <tr>
                    <td><label for="txtregdate">Date of Registration: </label></td>
                    <td><input type="date" name="txtregdate" value="<?php echo date('Y-m-d'); ?>" required></td>
                </tr>

                <tr>
                    <td><label for="txtpassid">Passenger ID: </label></td>
                    <td><input type="text" name="txtpassid" value='PUID-' required></td>
                </tr>

                <tr>
                    <td><label for="txtlastname">Lastname: </label></td>
                    <td><input type="text" name="txtlastname" required></td>
                </tr>
        
                <tr>    
                    <td><label for="txtfirstname">First name: </label></td>
                    <td><input type="text" name="txtfirstname" required></td>
    
                </tr>
        
                <tr>
                    <td><label for="txtage">age: </label></td>
                    <td><input type="number" name="txtage" required></td>
                </tr>
                
                <tr>
                    <td><label for="txtconnum">Contact number: </label></td>
                    <td><input type="text" name="txtconnum" required></td>
                </tr>

                <tr>
                    <td><label for="txtbalance">Balance: </label></td>
                    <td><input type="number" name="txtbalance" value="50"></td>
                </tr>

                <tr>
                    <td><label for="txtfare">Fare type: </label></td>
                    <td><select name="txtfare" required>
                    <option value="">Select Fare type:</option>
                    <?php
                     include'../ridepay/Database/myDatabase.php';
                     $sql1 ="SELECT * FROM fare";
                     $result=mysqli_query($con,$sql1);

                     while($row=mysqli_fetch_array($result)){
                         $fare_id=$row["fare_id"];
                         $fare_type=$row["fare_type"];
                         echo"<option value='$fare_id'>$fare_type</option>";
                     }
                    ?>
                    </select></td>
               </tr>
                <tr>
                    <td><input class='btn_save' type="submit" value="Save & Generate QR" name="submit"> <input class='btn_save'  type="reset" value="CLEAR"></td>
                </tr>

            </table>
        </form>
    </body>
</html>
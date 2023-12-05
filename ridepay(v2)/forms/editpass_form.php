
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            TRANSPORTATION SYSTEM
        </title>
        <link rel="stylesheet" href="../CSS/edit.css">
    </head>
    <body>
        <?php
        include'../Database/myDatabase.php';

        $sql = "SELECT * FROM passenger";

        $result = mysqli_query($con, $sql)or die("Error. Please check query statement");
        $id = '';
        if(isset($_GET['passenger_id'])) {
            $id=$_GET['passenger_id'];

        $sql = "SELECT * FROM passenger WHERE passenger_id='$id'";
        $result = mysqli_query($con, $sql)or die("Error in SQL statement...");
        
        while($row=mysqli_fetch_array($result)) {
            $passengerid = $row['passenger_id'];
            $lastname = $row['lastname'];
            $firstname = $row['firstname'];
            $age = $row['age'];
            $mobilenum = $row['mobile_num'];
            $accbal = $row['acc_balance'];
            $ftype = $row['fare_id'];
            $ded = $row['discount_expiry_date'];
            $username = $row['username'];
            $password = $row['password'];
            }
        }
         ?>
        
         <div class="addsom">
       <h1>Edit Passenger</h1>
        <form class="form" method="post" action="../process/editpass_process.php">
            <table>
                <input type="hidden" name="txtid" value="<?php echo $id;?>">
                <tr>
                    <td><label for="txtpassengerid">ENTER PASSENGER ID: </label></td>
                    <td><input type="text" name="txtpassengerid" value="<?php echo $passengerid;?>" required></td>
                </tr>
                <tr>
                    <td><label for="txtlastname">ENTER LAST NAME: </label></td>
                    <td><input type="text" name="txtlastname" value="<?php echo $lastname;?>" required></td>
                </tr>
                <tr>
                    <td><label for="txtfirstname">ENTER FIRST NAME: </label></td>
                    <td><input type="text" name="txtfirstname" value="<?php echo $firstname;?>" required></td>
                </tr>
                <tr>
                   <td> <label for="txtage">ENTER AGE: </label></td>
                   <td> <input type="text" name="txtage" value="<?php echo $age;?>" required></td>
                </tr>
                <tr>
                    <td><label for="txtmobilenum">ENTER MOBILE NUMBER: </label></td>
                    <td><input type="text" name="txtmobilenum" value="<?php echo $mobilenum;?>" required></td>
                </tr>
                <tr>
                    <td><label for="txtaccbal">ENTER ACCOUNT BALANCE: </label></td>
                    <td><input type="text" name="txtaccbal" value="<?php echo $accbal;?>" required></td>
                </tr>

                <tr>
                    <td><label for="txtfare">FARE TYPE: </label></td>
                    <td><select name="txtfare" required>
                    <option><?php echo $ftype; ?></option>
                    <?php
                     $sql1 ="SELECT * FROM fare";
                     $result1=mysqli_query($con,$sql1);

                     while($row=mysqli_fetch_array($result1)){
                         $fare_id1=$row["fare_id"];
                         $fare_type1=$row["fare_type"];
                         echo"<option value='$fare_id1'>$fare_type1</option>";
                     }
                    ?>
                    </select></td>
               </tr>
               <tr>
                    <td><label for="txtded">DISCOUNT EXPIRY DATE: </label></td>
                    <td><input type="date"  name="txtded" value="<?php echo $ded;?>" readonly></td>
                </tr>

                <tr>
                    <td><label for="txtusername">ENTER USER NAME: </label></td>
                    <td><input type="text" name="txtusername" value="<?php echo $username;?>" required></td>
                </tr>
                <tr>
                    <td><label for="txtpassword">ENTER PASSWORD: </label></td>
                    <td><input type="text" name="txtpassword" value="<?php echo $password;?>" required></td>
                </tr>
                <tr>
                    <td><input class='btn_save' type="submit" value="UPDATE" name="submit"></td>
                </tr>
            </table>
        </form>
                    </div>
    </body>
</html>
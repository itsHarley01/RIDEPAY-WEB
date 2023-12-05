
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

        $sql = "SELECT * FROM bus";

        $result = mysqli_query($con, $sql)or die("Error. Please check query statement");
        $id = '';
        if(isset($_GET['bus_id'])) {
            $id=$_GET['bus_id'];

        $sql = "SELECT * FROM bus WHERE bus_id='$id'";
        $result = mysqli_query($con, $sql)or die("Error in SQL statement...");
        
        while($row=mysqli_fetch_array($result)) {
            $busid = $row['bus_id'];
            $driverid = $row['driver_id'];
            $capacity = $row['capacity'];
            }
        }
         ?>
         <div class="addsum">
         <h1>EDIT BUS</h1>
         
        
            <form class='form' method="post" action="../process/editbus_process.php">
            <table>
            <input type="hidden" name="txtid" value="<?php echo $id;?>">
            <tr>
                <td><label for="txtbusid">ENTER BUS ID: </label></td>
                <td><input type="text" name="txtbusid" value="<?php echo $busid;?>" required></td>
            </tr>

            <tr>
                <td><label for="txtdriverid">SELECT DRIVER: </label></td>
                <td><select name="txtdriverid">
                    <option value=""><?php echo $driverid; ?></option>
                    <?php
                    $sql = "SELECT * FROM driver";
                    $result = mysqli_query($con,$sql);
                    while($row=mysqli_fetch_array($result)){
                        $driverid = $row['driver_id'];
                        $name = $row['name'];
                        echo "<option value='$driverid'>$driverid - $name</option>";
                        }
                    ?>
                </select>
                </td>
              </tr>
            <tr>
                <td><label for="txtcapacity">ENTER CAPACITY: </label></td>
                <td><input type="number" name="txtcapacity" value="<?php echo $capacity;?>" required></td>
            </tr>
                    

            <tr>
                <td><input type="submit" value="UPDATE" name="submit"></td>
            </tr>
            </table>
            </form>
                    </div>
    </body>
</html>
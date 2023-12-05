
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
        $sql = "SELECT * FROM driver";

        $result = mysqli_query($con, $sql)or die("Error. Please check query statement");
        $id = '';
        if(isset($_GET['driver_id'])) {
            $id=$_GET['driver_id'];

        $sql = "SELECT * FROM driver WHERE driver_id='$id'";
        $result = mysqli_query($con, $sql)or die("Error in SQL statement...");
        
        while($row=mysqli_fetch_array($result)) {
            $driverid=$row['driver_id'];
            $name=$row['name'];
            $license = $row['license'];
            $connum = $row['con_num'];
            }
        }
         ?>
         <div class="addsum">
            <h1>EDIT DRIVER</h1>
        

        
            <form class="form" method="post" action="../process/editdriver_process.php">
            <table>
                <input type="hidden" name="txtid" value="<?php echo $id;?>">
         
            <tr>
                <td><label for="txtdriverid">ENTER DRIVER ID: </label></td>
                <td><input type="text" name="txtdriverid" value="<?php echo $driverid;?>" required></td>
            </tr>
            <tr>
                <td><label for="txtname">ENTER NAME: </label></td>
                <td><input type="text" name="txtname" value="<?php echo $name;?>" required></td>
            </tr>
            <tr>
                <td><label for="txtlicense">ENTER LICENSE: </label></td>
                <td><input type="text" name="txtlicense" value="<?php echo $license;?>" required></td>
            </tr>
            <tr>
                <td><label for="txtconnum">ENTER CONTACT NUMBER: </label></td>
                <td><input type="text" name="txtconnum" value="<?php echo $connum;?>" required></td>
            </tr>
            <tr>
                <td><input type="submit" value="UPDATE" name="submit"></td>
            </tr>
            </table>
         </form>
    </div>
    </body>
</html>
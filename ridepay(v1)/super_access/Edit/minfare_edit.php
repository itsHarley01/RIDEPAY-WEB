<?php
require_once('../auth.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            RIDEPAY
        </title>
        <link rel='stylesheet' href="../../CSS/edit.css">
    </head>
    <body>
        <?php
        include'../../Database/myDatabase.php';
        $id = '';
        if(isset($_GET['min_fare_id'])) {
            $id=$_GET['min_fare_id'];

        $sql = "SELECT * FROM minimum_fare WHERE min_fare_id='$id'";
        $result = mysqli_query($con, $sql)or die("Error in SQL statement...");
        
        while($row=mysqli_fetch_array($result)) {
            $min_fare_id=$row['min_fare_id'];
            $mfa=$row['min_fare_amount'];
            }
        }
         ?>
         <header>
            <a  class="btn_m" href="../../super_access/farem.php">Go Back</a>
            <h1>EDIT FARE AMOUNT</h1>
         </header>

            <form method="post" action="../Edit/minfare_edit_process.php">
            <table>
                <input type="hidden" name="txtid" value="<?php echo $id;?>">
         
            <tr>
                <td><label for="txtmfa">ENTER MIN FARE AMOUNT: </label></td>
                <td><input type="number" name="txtmfa" value="<?php echo $mfa;?>" required></td>
            </tr>

             <tr>
                <td><input type="submit" value="UPDATE" name="submit"></td>
            </tr>
           </table>
         </form>
        
    </body>
</html>
<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            RIDEPAY
        </title>
        <link rel="stylesheet" href="../../ridepay/CSS/managements_index.css">
    </head>
<body>

    <header>
        <a class='btn_m' href="../super_access/homepage.php">Back to Main Page</a>
            <h1>DRIVER RECORDS</h1>
        <a class='btn_m' href="../super_access/Form/adddriver_form.php">ADD NEW DRIVER</a>
    </header>
    
<?php
include'../../ridepay/Database/myDatabase.php';
$sql = "SELECT * FROM driver";
$txtsearch='';
if(isset($_POST['btnsearch'])){
     $txtsearch = $_POST['txtsearch'];
     $sql .= " WHERE driver_id like '$txtsearch%' OR name like '$txtsearch%' OR license like '$txtsearch%' OR con_num like '$txtsearch%'";
}
$sql .= " ORDER BY driver_id, name, license, con_num";

$result=mysqli_query($con, $sql) or die("Error: Please check the query statement");
echo "<form class='seform' method='post'>
<center>
<input class='sebar' type='text' name='txtsearch' value='$txtsearch' placeholder='       SEARCH HERE'> &nbsp;&nbsp;
<input class='btnser' value='search' type='submit' name='btnsearch'>
</center>
</form>";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement...");
echo "<table class='table' border=5 cellpadding=5 align=center>";
echo "<tr><th> DRIVER ID</th>";
echo "<th> NAME</th>";
echo "<th> LICENSE</th>";
echo "<th> CONTACT NUMBER</th>";
echo "<th> ACTION</th></tr>";

if(mysqli_num_rows($result) == 0) {
    echo"<tr><td colspan=5> NO RECORDS FOUND. Please add record into the database</td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        $driverid = $row['driver_id'];
        $name = $row['name'];
        $license = $row['license'];
        $connum = $row['con_num'];
        echo "<tr><td>$driverid</td>";
        echo "<td>$name</td>";
        echo "<td>$license</td>";
        echo "<td>$connum</td>";
        echo "<td> <a class='btnedit' href='../super_access/Edit/driver_edit_form.php? driver_id=$driverid'>EDIT</a>
        <a class='btndelete' href='../super_access/Delete/driver_delete_confirmation.php? driver_id=$driverid'>DELETE</a></td></tr>";
        }
    }
    echo "</table>";
?>
</body>
</html>
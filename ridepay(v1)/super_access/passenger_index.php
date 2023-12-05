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
        <a class="btn_m" href="../super_access/homepage.php">Back to HomePage</a>
    <h1>PASSENGER RECORDS</h1>
        
</header>
    
<?php

include'../../ridepay/Database/myDatabase.php';

$sql = "SELECT * FROM passenger";

$txtsearch='';
if(isset($_POST['btnsearch'])){
     $txtsearch = $_POST['txtsearch'];
     $sql .= " WHERE passenger_id like '$txtsearch%' OR lastname like '$txtsearch%' OR firstname like '$txtsearch%' OR age like '$txtsearch%'
	  			OR mobile_num like '$txtsearch%' OR acc_balance like '$txtsearch%' OR username like '$txtsearch%' OR password like '$txtsearch%'";
}
$sql .= " ORDER BY passenger_id, lastname, firstname, age, mobile_num, acc_balance, username, password";
//Execute SQL statement

$result=mysqli_query($con, $sql) or die("Error: Please check the query statement");
echo "<form class='seform' method='post'>
<center>
<input class='sebar' type='text' name='txtsearch' value='$txtsearch' placeholder='       SEARCH HERE'> &nbsp;&nbsp;
<input class='btnser' value='search' type='submit' name='btnsearch'>
</center>
</form>";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement...");
echo "<table class='table' border=5 cellpadding=5 align=center>";
echo "<tr><th>PASSENGER ID</th>";
echo "<th>LAST NAME</th>";
echo "<th>FIRST NAME</th>";
echo "<th>AGE</th>";
echo "<th>MOBILE NUMBER</th>";
echo "<th>ACCOUNT BALANCE</th>";
echo "<th>USERNAME</th>";
echo "<th>PASSWORD</th>";
echo "<th>ACTION </th></tr>";

if(mysqli_num_rows($result) == 0) {
    echo"<tr><td colspan=7> NO RECORDS FOUND. Please add record into the database</td></tr>";
} else {
    while($row=mysqli_fetch_array($result)) {
        $passengerid = $row['passenger_id'];
        $lastname = $row['lastname'];
        $firstname = $row['firstname'];
        $age = $row['age'];
        $mobilenum = $row['mobile_num'];
        $accbal = $row['acc_balance'];
        $username = $row['username'];
        $password = $row['password'];
        $passwordAsterisks = str_repeat("*", strlen($password));
        echo "<tr><td>$passengerid</td>";
        echo "<td>$lastname</td>";
        echo "<td>$firstname</td>";
        echo "<td>$age</td>";
        echo "<td>$mobilenum</td>";
        echo "<td>$accbal</td>";
        echo "<td>$username</td>";
        echo "<td>$passwordAsterisks</td>";
        echo "<td> <a class='btnedit' href='../super_access/Edit/passenger_edit_form.php? passenger_id=$passengerid'>EDIT</a>  
        <a class='btndelete' href='../super_access/Delete/passenger_delete_confirmation.php? passenger_id=$passengerid'>DELETE</a>  
        <a class='btndelete' href='../super_access/Form/acc_stat.php? passenger_id=$passengerid'>STATUS</a>
        <a class='btnqr' href='../super_access/Edit/generate.php? passenger_id=$passengerid'>QR CODE</a></td></tr>";

    }
}
echo "</table>";
?>

    <footer>
        <p>&copy; 2023 RIDEPAY. All rights reserved.</p>
    </footer>

</body>
</html>
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
            <a class='btn_m' href="../../admin_access/driver_index.php">Go back</a>
            <h1>ADD new driver</h1>
    </header>
    
<form class="form" method="post" action="../../admin_access/Process/adddriver_process.php">

    <table>
        <tr>
            <td><label for="txtdriverid">ENTER DRIVER ID: </label></td>
            <td><input type="text" name="txtdriverid" required></td>
        </tr>

        <tr>
            <td><label for="txtname">ENTER NAME: </label></td>
            <td><input type="text" name="txtname" required></td>
        </tr>

        <tr>
            <td><label for="txtlicense">ENTER LICENSE: </label></td>
            <td><input type="text" name="txtlicense" required></td>
        </tr>

        <tr>
            <td><label for="txtconnum">ENTER CONTACT NUMBER: </label></td>
            <td><input type="text" name="txtconnum" required></td>
        </tr>

        <tr>
            <td><input type="submit" value="SAVE" name="submit"></td>
        </tr>
        </table>
        </form>
    </body>
</html>
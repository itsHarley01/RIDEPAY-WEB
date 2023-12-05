
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        RIDEPAY
    </title>
    <link rel="stylesheet" href="../CSS/edit.css">
</head>
<body> 
    <div class="addsom">
            <h1>ADD new driver</h1>
    
<form class="form" method="post" action="../process/adddriver_process.php">

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
</div>
    </body>
</html>
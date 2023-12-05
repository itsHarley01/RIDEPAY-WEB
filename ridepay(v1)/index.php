

<?php
include '../ridepay/Database/myDatabase.php';
$err='';

if (isset($_POST["submit"])) {
    $uname = $_POST['txtusername'];
    $pword = $_POST['txtpassword'];

    $sql = "SELECT * FROM admin_login WHERE username = '$uname' AND password = '$pword'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        
        $type = $row['type'];

        if ($type == 1) {
            // Admin
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['user_type'] = 'admin';
            header("Location: admin_access/homepage.php");
            exit();
        } elseif ($type == 2) {
            // Super admin
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['user_type'] = 'super_admin';
            header("Location: super_access/homepage.php");
            exit();
        }
    } else {
        $err = '<p style="left: 21.15%; font: 1em sans-serif; color: red; position: absolute; margin-top: 12px; font-size: 12px;">Incorrect username or password!</p>';
    }
}
?>

<!DOCTYPE html>    
<html>
<head> 
    <title>Ridepay - Log in</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../ridepay/CSS/login_styles.css">
</head>
<body>
<center><img src="CSS/images/ridepaynameT.png" class="logo"></center>
<a class="credits" href='https://www.logodesign.net/image/transportation-bus-in-circle-with-rays-9618ld'>Logo source Logodesign.net</a>
        <div class="loginbase">
        <div class="vl"></div>
        <p class="copyright">&copy; 2023 RidePay</p>
        <img src="CSS/images/RidepaytxtT.png" class="logolog">
            <div class='container1'>
            <h2 class="login">Admin Login</h2>
                <form method="post" action="">
                    <input class="inputtu" type="text" name="txtusername" id="txtusername" placeholder="Username" required> <br>
                    <input class="inputtp" type="password" name="txtpassword" id="txtpassword" placeholder="Password" required> <br>
                    <input class="btnsub" type="submit" value="L o g i n" name="submit"><br>
                    <?php echo $err;?>
                </form>
            </div>
        </div>
</body>
</html>

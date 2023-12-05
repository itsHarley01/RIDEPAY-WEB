<?php
include './Database/myDatabase.php';
$err = '';

// Define the credentials array
$credentials = array(
    "admin" => "admin123",
    "super" => "super123",
);

if (isset($_POST["submit"])) {
    $uname = $_POST['txtusername'];
    $pword = $_POST['txtpassword'];

    if (array_key_exists($uname, $credentials) && $credentials[$uname] === $pword) {
        session_start();
        $_SESSION['username'] = $uname; // Set the session variable
        if ($uname === 'admin') {
            header("Location: ./homepage.php");
        } elseif ($uname === 'super') {
            header("Location: ./super.php");
        }
        exit();
    } else {
        $err = '<p style="left: 21.15%; font: 1em sans-serif; color: red; position: absolute; margin-top: 12px; font-size: 12px;">Incorrect username or password!</p>';
    }
}

// Handle the Log Out action
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_start();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ridepay - Log in</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./CSS/login_styles.css">
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
                <?php echo $err; ?>
            </form>
        </div>
    </div>
</body>
</html>

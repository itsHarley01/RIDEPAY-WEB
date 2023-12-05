<?php
// Check if a session is already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    // Clear all session variables
    $_SESSION = array();

    // Invalidate the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }

    // Destroy the session
    session_destroy();

    // Redirect to index.php
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'super') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ridepay | Dashboard</title>
    <link rel="icon" type="image/x-icon" href="./CSS/images/ridebuslogoW2.png">
    <link rel="stylesheet" href="./CSS/home_styles.css" class="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
</head>
<body>


    <div id="container">
        <div id="sidebar">
            <center>
                <div class="taassb">
                    <img src="./CSS/images/Ridepaytxt1.png" style="height: 35px; margin-top: 20px; margin-bottom: 0px;">
                    <p style="margin-top: 0px; color: white;">Status: <b style="color: #F2BE22;">super</b><b>admin</b></p>
                </div>
            </center>
            <hr>
            <ul>
                <li class="itemssb active">
                    <i class="fa-solid fa-house-chimney" style="color: #ffffff;"></i>
                    <a class="side" data-page="home">Home</a>
                </li>
                <li class="itemssb">
                    <i class="fa-solid fa-user-group" style="color: #ffffff;"></i>
                    <a class="side" data-page="passenger_index">Passengers</a>
                </li>
                <li class="itemssb">
                    <i class="fa-solid fa-bus" style="color: #ffffff;"></i>
                    <a class="side" data-page="bus_index">Bus</a>
                </li>
                <li class="itemssb">
                    <i class="fa-solid fa-user-tie" style="color: #ffffff;"></i>
                    <a class="side" data-page="driver_index">Driver</a>
                </li>
                <div class="menu-item" id="menu-toggle"><i class="fa-solid fa-money-check-dollar" style="color: #ffffff;"></i>Records
                <i class="fa-solid fa-chevron-left" id="toggle-icon" style="color: #ffffff; margin-left: 40px; font-size: 13px;"></i>
            </div>
            <ul class="sub-menu" id="sub-menu">
  <li class="itemssb" data-page="payment_history_index">Bus Sales</li>
  <li class="itemssb" data-page="topup_history_index">Top-up Sales</li>
  <li class="itemssb" data-page="register_history_index">Registration</li>
</ul>
                <li class="itemssb">
                    <i class="fa-solid fa-circle-dollar-to-slot" style="color: #ffffff;"></i>
                    <a class="side" data-page="passengertopup">Topup</a>
                </li>
                <li class="itemssb">
                <i class="fa-solid fa-peso-sign" style="color: #ffffff;"></i>
                    <a class="side" data-page="farem">Fare</a>
                </li>
                
                <a href="super.php?logout=true">
    <li class="logout" onclick="logOut()"> 
        <i class="fa-solid fa-right-from-bracket" style="color: red;"></i>
        <a id="lotxt">Log out</a>
    </li>
</a>
            </ul>
        </div>
        <div id="content">
            <iframe id="iframe" src="home.php" width="100%" height="100%" frameborder="0" ></iframe>
        </div>
    </div>
    <script src="homepage.js">
    </script>
</body>
</html>

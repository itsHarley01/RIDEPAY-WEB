
<link rel='stylesheet' href='../CSS/edit.css'>
<script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>  
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<?php

if(isset($_POST["submit"])) {

    include'../Database/myDatabase.php';
    $busid = $_POST['txtbusid'];
    $driverid = $_POST['txtdriverid'];
    $capacity = $_POST['txtcapacity'];

$sql = "INSERT into bus (bus_id, driver_id, capacity)VALUES ('$busid', '$driverid', '$capacity')";

$result = mysqli_query($con, $sql)or die("Error in insert statement please check again...");

if($result) {
    echo "<center class='conf'><lord-icon
    src='https://cdn.lordicon.com/lomfljuq.json'
    trigger='in'
    delay='100'
    state='in-check'
    colors='primary:#f2be22'
    style='width:85px;height:85px'>
</lord-icon><p class='idk'><b>Bus added!</b></p> You will be redirected to the bus index page in <span id='countdown'>5</span> seconds.</p>
    <p class='idk'>Click here <a class='redirect' href='../bus_index.php'><i class='fa-solid fa-arrow-left' style='color: #ffffff;'></i>    Back</a> to go back to topup page immediately.</p></center>";
    // JavaScript code for countdown and redirection
    echo '<script>
        var countdown = 5;
        var countdownElement = document.getElementById("countdown");
        var countdownInterval = setInterval(function() {
            countdown--;
            countdownElement.textContent = countdown;
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                window.location.href = "../bus_index.php"; // Redirect after 5 seconds
            }
        }, 1000); // Update countdown every 1 second
    </script>';
}

}
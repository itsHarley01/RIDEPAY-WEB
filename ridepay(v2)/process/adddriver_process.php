
<link rel='stylesheet' href='../CSS/edit.css'>
<script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>  
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<?php
if(isset($_POST["submit"])) {
    include'../Database/myDatabase.php';
$driverid = $_POST['txtdriverid'];
$name = $_POST['txtname'];
$license = $_POST['txtlicense'];
$connum = $_POST['txtconnum'];

$sql = "INSERT into driver(driver_id, name, license, con_num)VALUES ('$driverid', '$name', '$license', '$connum')";

$result = mysqli_query($con, $sql)or die("Error in insert statement please check again...");

if($result) {
    echo "<center class='conf'><lord-icon
    src='https://cdn.lordicon.com/lomfljuq.json'
    trigger='in'
    delay='100'
    state='in-check'
    colors='primary:#f2be22'
    style='width:85px;height:85px'>
</lord-icon><p class='idk'><b>Driver added!</b></p> You will be redirected to the driver index page in <span id='countdown'>5</span> seconds.</p>
    <p class='idk'>Click here <a class='redirect' href='../driver_index.php'><i class='fa-solid fa-arrow-left' style='color: #ffffff;'></i>    Back</a> to go back to driver page immediately.</p></center>";
    // JavaScript code for countdown and redirection
    echo '<script>
        var countdown = 5;
        var countdownElement = document.getElementById("countdown");
        var countdownInterval = setInterval(function() {
            countdown--;
            countdownElement.textContent = countdown;
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                window.location.href = "../driver_index.php"; // Redirect after 5 seconds
            }
        }, 1000); // Update countdown every 1 second
    </script>';
}
}
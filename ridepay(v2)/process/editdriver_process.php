<script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>  
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<link rel='stylesheet' href="../CSS/edit.css">
<?php
if(isset($_POST['submit'])) {
include'../Database/myDatabase.php';
$txtid = $_POST['txtid'];
$txtdriver = $_POST['txtdriverid'];
$txtname = $_POST['txtname'];
$txtlicense = $_POST['txtlicense'];
$txtconnum = $_POST['txtconnum'];

$sql = "UPDATE driver SET driver_id='$txtdriver', name='$txtname', license='$txtlicense', con_num='$txtconnum' WHERE driver_id='$txtid'";

$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");

if($result) {
    echo "<center class='conf'><lord-icon
    src='https://cdn.lordicon.com/lomfljuq.json'
    trigger='in'
    delay='100'
    state='in-check'
    colors='primary:#f2be22'
    style='width:85px;height:85px'>
</lord-icon><p class='idk'><b>Driver Edited!</b></p><p class='idk'> <span id='countdown'>5</span></p>
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
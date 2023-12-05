<link rel='stylesheet' href='../CSS/edit.css' >
<script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>  
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<?php
if(isset($_POST['submit'])) {
include'../Database/myDatabase.php';

$txtid = $_POST['txtid'];
$txtmfa= $_POST['txtmfa'];

$sql = "UPDATE minimum_fare SET min_fare_amount='$txtmfa' WHERE min_fare_id='$txtid'";
$result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");

if($result) {
     echo "<center class='conf'><lord-icon
            src='https://cdn.lordicon.com/lomfljuq.json'
            trigger='in'
            delay='100'
            state='in-check'
            colors='primary:#f2be22'
            style='width:85px;height:85px'>
        </lord-icon><p class='idk'><b>Fare Updated!</b></p> Redirecting to Fare page in <span id='countdown'>5</span> seconds.</p>
            <p class='idk'>Click here <a class='redirect' href='../farem.php'><i class='fa-solid fa-arrow-left' style='color: #ffffff;'></i>    Back</a> to go back to Fare page immediately.</p></center>";
            // JavaScript code for countdown and redirection
            echo '<script>
                var countdown = 5;
                var countdownElement = document.getElementById("countdown");
                var countdownInterval = setInterval(function() {
                    countdown--;
                    countdownElement.textContent = countdown;
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        window.location.href = "../farem.php"; // Redirect after 5 seconds
                    }
                }, 1000); // Update countdown every 1 second
            </script>';
}
}
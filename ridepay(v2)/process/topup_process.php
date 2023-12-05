<head>
<link rel='stylesheet' href='../CSS/edit.css'>
<script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>  
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
</head>
<?php
require_once '../Database/myDatabase.php';

$newBalance = '';

if (isset($_POST["submit"])) {
    $pid = $_POST['txtpid'];
    $tudate = $_POST['txtdate'];
    $bal = floatval($_POST['txtamount']);

    $sql = "SELECT acc_balance FROM passenger WHERE passenger_id = '$pid'";
    $sql_result = mysqli_query($con, $sql);

    $sql11 = "INSERT INTO topup_history (passenger_id, topup_date, amount) VALUES ('$pid', '$tudate', '$bal')";
    mysqli_query($con, $sql11);

    if ($sql_result) {
        $row = mysqli_fetch_assoc($sql_result);
        $accbal = $row['acc_balance'];

        $newBalance = $accbal + $bal;

        $sql1 = "UPDATE passenger SET acc_balance = $newBalance WHERE passenger_id = '$pid'";
        $sql_result1 = mysqli_query($con, $sql1);

        if ($sql_result1) {
            echo "<center class='conf'><lord-icon
            src='https://cdn.lordicon.com/lomfljuq.json'
            trigger='in'
            delay='100'
            state='in-check'
            colors='primary:#f2be22'
            style='width:85px;height:85px'>
        </lord-icon><p class='idk'><b>Top-up Successful!</b></p> You will be redirected to the top-up page in <span id='countdown'>5</span> seconds.</p>
            <p class='idk'>Click here <a class='redirect' href='../passengertopup.php'><i class='fa-solid fa-arrow-left' style='color: #ffffff;'></i>    Back</a> to go back to topup page immediately.</p></center>";
            // JavaScript code for countdown and redirection
            echo '<script>
                var countdown = 5;
                var countdownElement = document.getElementById("countdown");
                var countdownInterval = setInterval(function() {
                    countdown--;
                    countdownElement.textContent = countdown;
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        window.location.href = "../passengertopup.php"; // Redirect after 5 seconds
                    }
                }, 1000); // Update countdown every 1 second
            </script>';
        } else {
            echo "Error" . mysqli_error($con);
        }
    } else {
        echo "Error" . mysqli_error($con);
    }
} else {
    echo "Error";
}
?>

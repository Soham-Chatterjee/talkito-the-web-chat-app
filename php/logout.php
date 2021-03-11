<?php
    session_start();

    if (isset($_SESSION['unique_id'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if (isset($logout_id)){
            $status = "offline";
            date_default_timezone_set('Asia/Kolkata');
            $time = date('d/m/Y h:i A');
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}', last_seen = '{$time}' WHERE unique_id = {$logout_id}");
            if ($sql){
                echo $status;
                session_unset();
                session_destroy();
                header('location: ../index.php');
            }
        }
        else{
            header('location: ../user_page.php');
        }
    }else{
        header('location: ../index.php');
    }


?>
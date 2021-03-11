<?php
    session_start();

    if (isset($_SESSION['unique_id'])){
        include_once "config.php";
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        if (isset($user_id)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
            if($sql){
                $row = mysqli_fetch_assoc($sql);
                echo $row['status'];
            }
        }
        else{
            header('location: ../user_page.php');
        }
    }else{
        header('location: ../index.php');
    }


?>
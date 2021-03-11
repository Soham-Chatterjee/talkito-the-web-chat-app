<?php
    session_start();
    if (isset($_SESSION['unique_id'])){
        include_once "config.php";

        $full_name = mysqli_real_escape_string($conn, $_POST['name-change']);

        if (!empty($full_name)){
            $sql = mysqli_query($conn, "UPDATE users SET full_name = '{$full_name}' WHERE unique_id = {$_SESSION['unique_id']}");
            if($sql){
                echo "Success";
            }
            else{
                echo "Something went wrong";
            }
        }
        else{
            echo "Name cannot be empty";
        }
    }
    else{
        echo "Session not set!";
    }
?>
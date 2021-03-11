<?php

    session_start();
    include_once "config.php";

    $sql = mysqli_query($conn, "DELETE FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    $sql2 = mysqli_query($conn, "DELETE FROM messages WHERE (incoming_msg_id = {$_SESSION['unique_id']} OR outgoing_msg_id = {$_SESSION['unique_id']})");
    if($sql && $sql2){
        echo "Success";
    }
    else{
        echo "Something went wrong!";
    }

    
    
?>
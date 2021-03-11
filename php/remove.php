<?php
    session_start();
    if (isset($_SESSION['unique_id'])){
        include_once "config.php";
        $get_image_query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");

        if(mysqli_num_rows($get_image_query) > 0){
            $row = mysqli_fetch_assoc($get_image_query);
            if(file_exists("../images/user-images/".$row['prof_pic'])){
                unlink("../images/user-images/".$row['prof_pic']);
                $update_query = mysqli_query($conn, "UPDATE users SET prof_pic = 'prof_avatar.png' WHERE unique_id = {$_SESSION['unique_id']}");
                if($update_query){
                    echo "Success";
                }
                else{
                    echo "Failed to change profile picture";
                }
            }
        }
    }
    else{
        echo "Session not set!";
    }
?>
<?php

    session_start();
    include_once "config.php";

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    
    if (!empty($email) && !empty($pass)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0){
            $sql2 = mysqli_query($conn, "SELECT * from users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql2) > 0){
                $row = mysqli_fetch_assoc($sql2);
                $enc_pass = $row['password'];
                if (password_verify($pass, $enc_pass)){
                    $sql3 = mysqli_query($conn, "SELECT * from users WHERE email = '{$email}' and password = '{$enc_pass}'");
                    if (mysqli_num_rows($sql3) > 0){
                        $row2 = mysqli_fetch_assoc($sql3);
                        $status = "online";
                        $sql4 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row2['unique_id']}");
                        if($sql4){
                            $_SESSION['unique_id'] = $row2['unique_id'];
                            echo "Success";
                        }
                    }
                    else{
                        echo "Something went wrong!";
                    }
                }
                else{
                    echo "Incorrect password!";
                }
            }
            
        }
        else{
            echo "Email $email does not have an account. Please create one before logging in";
        }
    }
    else{
        echo "Please fill in the credential(s)!";
    }
?>
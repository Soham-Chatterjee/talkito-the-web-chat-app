<?php

    session_start();
    include_once "config.php";
    $old_pass = mysqli_real_escape_string($conn, $_POST['old-pass']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new-pass']);
    $retype_pass = mysqli_real_escape_string($conn, $_POST['retype-pass']);

    $options = [
        'cost' => 11,
    ];
    
    if (!empty($old_pass)){
        if (!empty($new_pass)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                $enc_pass = $row['password'];
                if (!empty($retype_pass)){
                    if (password_verify($old_pass, $enc_pass)){
                        $encrypt_new_pass = password_hash($new_pass, PASSWORD_BCRYPT, $options);
                        if ($new_pass === $retype_pass){
                            $sql2 = mysqli_query($conn, "UPDATE users SET password = '{$encrypt_new_pass}' WHERE unique_id = {$_SESSION['unique_id']}");
                            if ($sql2){
                                echo "Success";
                            }
                            else{
                                echo "Something went wrong!";
                            }
                        }
                        else{
                            echo "Passwords do not match!";
                        }
                    }
                    else{
                        echo "Incorrect old password!";
                    }
                }
                else{
                    echo "Passwords do not match!";
                }
                
            }
            else{
                echo "No account found";
            }
        }
        else{
            echo "New password cannot be blank!";
        }
    }
    else{
        echo "Incorrect old password!";
    }
?>
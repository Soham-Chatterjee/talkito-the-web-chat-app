<?php
    session_start();
    include_once "config.php";

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $retype_pass = mysqli_real_escape_string($conn, $_POST['retype_pass']);
    

    if (!empty($full_name) && !empty($email) && !empty($pass) && !empty($retype_pass)){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0){
                echo "Email $email already exists";
            }
            else{
                if ($pass === $retype_pass){
                    $status = "online";
                    $random_id = rand(time(), 10000000);
                    $default_pic = "prof_avatar.png";

                    $sql2 = mysqli_query($conn, "INSERT into users (unique_id, full_name, email, password, status)
                                        VALUES ({$random_id}, '{$full_name}', '{$email}', '{$pass}', '{$status}')");

                    if($sql2){
                        $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                        if (mysqli_num_rows($sql3) > 0){
                            $row = mysqli_fetch_assoc($sql3);
                            $_SESSION['unique_id'] = $row['unique_id'];
                            echo "Success";
                        }
                    }
                    else{
                        echo "$sql2";
                        echo "Something went wrong!";
                    }
                }
                else{
                    echo "Passwords do not match!";
                }
            }
        }
        else{
            echo "$email is not a valid email"; 
        }
        
    }
    else{
        echo "All input fields are required!";
    }

?>
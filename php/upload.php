<?php
    session_start();
    if (isset($_SESSION['unique_id'])){
        include_once "config.php";

        if(isset($_FILES['prof-pic'])){
            $img_name = $_FILES['prof-pic']['name'];
            $img_type = $_FILES['prof-pic']['type'];
            $tmp_name = $_FILES['prof-pic']['tmp_name'];
            
            $img_explode = explode('.',$img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];
            if(in_array($img_ext, $extensions) === true){
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if(in_array($img_type, $types) === true){
                    $time = time();
                    $new_img_name = $_SESSION['unique_id'].".".$img_ext;
                    if(file_exists("../images/user-images/".$_SESSION['unique_id'].".jpg")){
                        unlink("../images/user-images/".$_SESSION['unique_id'].".jpg");
                        if(move_uploaded_file($tmp_name,"../images/user-images/".$new_img_name)){
                            chmod("../images/user-images/".$new_img_name, 0755);
                            $update_query = mysqli_query($conn, "UPDATE users SET prof_pic = '{$new_img_name}' WHERE unique_id = {$_SESSION['unique_id']}");
                            if($update_query){
                                echo "Success";
                            }
                            else{
                                echo mysqli_error($conn);
                            }
                        }
                        else{
                            echo "Failed to move file";
                        }
                    }
                    elseif(file_exists("../images/user-images/".$_SESSION['unique_id'].".png")){
                        unlink("../images/user-images/".$_SESSION['unique_id'].".png");
                        if(move_uploaded_file($tmp_name,"../images/user-images/".$new_img_name)){
                            chmod("../images/user-images/".$new_img_name, 0755);
                            $update_query = mysqli_query($conn, "UPDATE users SET prof_pic = '{$new_img_name}' WHERE unique_id = {$_SESSION['unique_id']}");
                            if($update_query){
                                echo "Success";
                            }
                            else{
                                echo mysqli_error($conn);
                            }
                        }
                        else{
                            echo "Failed to move file";
                        }
                    }
                    else{
                        if(move_uploaded_file($tmp_name,"../images/user-images/".$new_img_name)){
                            chmod("../images/user-images/".$new_img_name, 0755);
                            $update_query = mysqli_query($conn, "UPDATE users SET prof_pic = '{$new_img_name}' WHERE unique_id = {$_SESSION['unique_id']}");
                            if($update_query){
                                echo "Success";
                            }
                            else{
                                echo mysqli_error($conn);
                            }
                        }
                        else{
                            echo "Failed to move file";
                        }
                    }
                }
                else{
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }
            else{
                echo "Please upload an image file - jpeg, png, jpg";
            }
        }
    }
    else{
        echo "Session not set!";
    }
?>
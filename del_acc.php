<?php
    session_start();
    if ((!isset($_SESSION['unique_id']))) {
        header('location: index.php');
    }
    else{
        include_once 'php/config.php';
        
       
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
        }
        else{
            header('location: user_page.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/del_acc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="shortcut icon" href="images/Icons/favicon.ico" type="image/x-icon">
    <title>Talkito - Delete Account</title>
</head>
<body>
<div class="wrapper">
        <div class="desc">
            <p class="head">We're sorry to see you go! :(</p>
            <span class="text">All your chats, pictures and details will be removed permanently. Do you wish to continue?</span>
        </div>
        <div class="del-but">
            <button onclick="delete_acc()">Yes, Delete My Account!</button>
            <button><a href="user_page.php" style="text-decoration: none; color: #fff;">No, Take me Back!</button>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function delete_acc(){
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "php/delete.php", true);
            xhr.onload = ()=> {
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        if (data == "Success"){
                            location.href = "php/logout.php?logout_id=<?php echo $row['unique_id'];?>";
                            errorText.style.display = 'none';
                        }
                        else{
                            console.log(data);
                        }
                    }
                }
            }
            xhr.send();
        }
    </script>
</body>
</html>
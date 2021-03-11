<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {
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
    <link rel="stylesheet" href="styles/chng_pass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="shortcut icon" href="images/Icons/favicon.ico" type="image/x-icon">
    <title>Talkito - Change Password</title>
</head>
<body>
<div class="wrapper">
        <div class="desc">
            <p class="head">Yeah its good to update the credentials!</p>
            <span class="text">Change your valuable password with just few simple steps!</span>
        </div>
        <div class="login-form">
            <div class="center login">
                <h1>Change Password</h1>
                <form method="post">
                    <div class="error-txt"></div>
                    <div class="txt_field">
                        <input name="old-pass" type="password" id="old-pass" autocomplete="off" required>
                        <span></span>
                        <label>Old Password</label>
                        <i class="fas fa-eye" onclick="toggle('old-pass', 'old-pass-eye')" id='old-pass-eye'></i>
                    </div>
                    <div class="txt_field">
                        <input name="new-pass" type="password" id="new-pass" autocomplete="off" required>
                        <span></span>
                        <label>New Password</label>
                        <i class="fas fa-eye" onclick="toggle('new-pass', 'new-pass-eye')" id='new-pass-eye'></i>
                    </div>
                    <div class="txt_field">
                        <input name="retype-pass" type="password" id="retype-pass" autocomplete="off" required>
                        <span></span>
                        <label>Retype Password</label>
                        <i class="fas fa-eye" onclick="toggle('retype-pass', 'retype-pass-eye')" id='retype-pass-eye'></i>
                    </div>
                    <div class="button">
                        <input type="submit" value="Done!" onclick="updatedata()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="scripts/pass-toggle.js"></script>
    <script src="scripts/chng_pass.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function updatedata(){
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "php/pass_chng.php", true);
            xhr.onload = ()=> {
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        let data = xhr.response;
                        if (data == "Success"){
                            location.href = "php/logout.php?logout_id=<?php echo $row['unique_id'];?>";
                            errorText.style.display = 'none';
                        }
                        else{
                            errorText.textContent = data;
                            errorText.style.display = 'block';
                        }
                    }
                }
            }

            let formdata = new FormData(form);
            xhr.send(formdata);
        }
    </script>
</body>
</html>
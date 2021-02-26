<?php
    session_start();
    if ((isset($_SESSION['unique_id']))) {
        header('location: user_page.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <title>Talkito! - Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="desc">
            <p class="head">Introducing Talkito! - The Web Chat App</p>
            <span class="text">Connect to your friends and family anytime anywhere in a safe and encrypted way!
                Login to Talkito! now!</span>
        </div>
        <div class="login-form">
            <div class="center login">
                <h1>Login</h1>
                <form method="post">
                    <div class="error-txt"></div>
                    <div class="txt_field">
                        <input name="email" type="text" autocomplete="off" required>
                        <span></span>
                        <label>Email</label>
                    </div>
                    <div class="txt_field">
                        <input name="pass" type="password" id="login-pass" autocomplete="off" required>
                        <span></span>
                        <label>Password</label>
                        <i class="fas fa-eye" onclick="toggle('login-pass', 'pass-eye')" id='pass-eye'></i>
                    </div>
                    <div class="pass">Forgot password?</div>
                    <div class="button">
                        <input type="submit" value="Login" onclick="savedata()">
                    </div>
                    <div class="signup_link">
                        Not a member till now? <a href="signup.php">Signup</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="scripts/pass-toggle.js"></script>
    <script src="scripts/login.js"></script>
</body>

</html>
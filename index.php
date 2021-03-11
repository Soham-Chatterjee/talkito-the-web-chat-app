<?php
    session_save_path();
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
    <link rel="shortcut icon" href="images/Icons/favicon.ico" type="image/x-icon">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            alert('This site uses cookies to store data. By using this site, you agree to the terms and conditions related to cookie usage.');
        });

        const registerOpenTab = () => {
            let tabsOpen = 1;
            console.log(tabsOpen)
            while (localStorage.getItem('openTab' + tabsOpen) !== null) {
                tabsOpen++;
                console.log(tabsOpen)
            }
            localStorage.setItem('openTab' + tabsOpen, 'open');
            if (localStorage.getItem('openTab2') !== null) {
                window.alert('This application is already running in ' + (tabsOpen - 1) + ' other browser tab(s).')
            }
        }

        // unregisterOpenTab FUNCTION
        const unregisterOpenTab = () => {
            let tabsOpen = 1;
            while (localStorage.getItem('openTab' + tabsOpen) !== null) {
                tabsOpen++;
            }
            localStorage.removeItem('openTab' + (tabsOpen - 1));
        }

        // EVENT LISTENERS
        // window.addEventListener('load', registerOpenTab);
        // window.addEventListener('beforeunload', unregisterOpenTab);

        window.onload = function(){registerOpenTab};
        window.BeforeUnloadEvent = function(){unregisterOpenTab};

        if ($(window).width() < 1280){
            window.location = "mobile.php";
        }
    </script>
</body>

</html>
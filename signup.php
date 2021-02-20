<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Talkito! - Register</title>
    <link rel="stylesheet" href="styles/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <div class="desc">
            <p class="head">Sign Up to Talkito! It only takes a few moments</p>
            <span class="text">Join the community where people get to know each other, in a completely safe and secure way!</span>
            <span class="text"><br>Talkito! does not save your chats, neither on the user end nor on the server end. Chat messages older than 7 days are automatically removed! So, you can freely talk to anyone without the fear of data breaches.</span>
            <span class="text"><br>Talkito! is completely free and open source with full transparency in its code. New improvements are always welcome!</span>
        </div>
        <div class="signup-form">
            <section class="center">
                <h1>Sign Up</h1>
                <form method="post">
                    <div class="error-txt">This is an error msg</div>
                    <div class="txt_field">
                        <input name="username" type="text" required>
                        <span></span>
                        <label>Full Name</label>
                    </div>
                    <div class="txt_field">
                        <input name="email" type="email" required>
                        <span></span>
                        <label>E-mail</label>
                    </div>
                    <div class="txt_field">
                        <input name="password" type="password"  id='pass' required>
                        <span></span>
                        <label>Password</label>
                        <i class="fas fa-eye" onclick="toggle('pass', 'pass-eye')" id='pass-eye'></i>
                    </div>
                    <div class="txt_field" id="retype_pass">
                        <input name="password" id='retype-pass' type="password" required>
                        <span></span>
                        <label>Retype Password</label>
                        <i class="fas fa-eye" onclick="toggle('retype-pass', 'retype-eye')" id='retype-eye'></i>
                    </div>
                    <div class="sel_field">
                        <p>Gender</p>
                        <div class="gender">
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label><br>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label><br>
                            <input type="radio" id="other" name="gender" value="other">
                            <label for="other">Other</label>
                        </div>
                    </div>
                    <input type="submit" value="Sign Up">
                    <div class="login_link">
                        Already a member? <a href="../templates/signup.html">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="scripts/pass-toggle.js"></script>
</body>

</html>
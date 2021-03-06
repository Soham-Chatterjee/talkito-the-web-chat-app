<?php
    session_save_path();
    session_start();
    if (!isset($_SESSION['unique_id'])) {
        header('location: index.php');
        die();
    }
?>
<?php
    include_once 'php/config.php';
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/user_page.css?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="images/Icons/favicon.ico" type="image/x-icon">
    <title>Talkito! - <?php echo $row['full_name'];?></title>
</head>

<body id="main_body">
    <div class="wrapper">
        <div class="left-panel">
            <div class="left-top">
                <div class="content">
                    <div class="prof-img"><img src="images/user-images/<?php echo $row['prof_pic'];?>" alt="profile-pic" onclick="prof_change()"></div>
                    <div class="user-options">
                        <button onclick="settings_open()" style="border: none; outline: none;"><i class="fas fa-ellipsis-v"></i></button>
                    </div>

                </div>
            </div>
            <div class="left-search">
                <div class="search-obj">
                    <input type="text" class='search-bar' placeholder="Search for an user" id='search-input' onkeyup='search()'>
                </div>
            </div>
            <div class="left-chats">
                <div class="users-list" id="userlist">
                    
                </div>
            </div>
        </div>
        <div class="default-panel" id="def-pan">
            <div class="def-text">
                <p>Select an user to start chat</p>
            </div>
        </div>
        <div class="settings" id='settings-pan'>
            <div class="settings-pan-top">
                <button onclick="settings_back()" style="background: none; outline: none; border: none; cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                <p>Settings</p>
            </div>
            <div class="settings-pan-content">
                <button onclick="prof_change()" style="color:#fff;">Profile</button>
                <button id='themebtn' style="color: #fff;" title="You have to login with your new password again!"><a href="chng_pass.php" style="text-decoration: none; color: #fff;">Change Password</button>
                <button><a href="php/logout.php?logout_id=<?php echo $row['unique_id'];?>" style="text-decoration: none; color: #fff;" id="logoutbtn">Log Out</a></button>
                <button><a href="del_acc.php" style="text-decoration: none; color: #fff;">Delete Account</a></button>
            </div>
        </div>
        <div class="prof-change" id='prof-pan'>
            <div class="prof-pan-top">
                <button onclick="prof_back(); refresh_name()" style="background: none; outline: none; border: none; cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                <p>Edit Profile</p>
            </div>
            <div class="prof-details" id="prof-details">
                <img src="images/user-images/<?php echo $row['prof_pic'];?>" class="profile" id="prof-pic" onclick="change_pic()" style="width: 450px; height: 450px; object-fit:cover;">
                <div class="img-options-div" id='img-options-div'>
                    <form method="POST" enctype="multipart/form-data" action="php/upload.php" autocomplete="off" id="img-form" hidden>
                        <input type="file" value="Change Profile Photo" name='prof-pic' id="file-input" onchange="upload()" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                    </form>
                    <button class="img-options" onclick="document.getElementById('file-input').click()" style="text-decoration: none; color: #fff; outline:none;">Change Profile Photo</button>
                    <button class="img-options" style="text-decoration: none; color: #fff; outline:none;" onclick="remove()">Remove Profile Photo</button>
                </div>
                <div class="error-txt"></div>
                <div class="hover-text" id='hover-text' onclick="change_pic()">
                    <i class="fas fa-camera"></i>
                    <p class="text" id='hov-txt'>CHANGE PROFILE PHOTO</p>
                </div>
                <div class="input-details">
                    <form action="#" method="post" id="name-form">
                        <input type="text" placeholder='<?php echo $row['full_name'];?>' id='name-input' maxlength="35" autocomplete="off" name='name-change'>
                    </form>
                    <button onclick="name_change()"><i class="fas fa-check" id="save-name"></i></button>
                </div>
            </div>
        </div>
        
    </div>
    <script type="text/javascript">
        function refresh_name(){
            name_input = document.getElementById('name-input');
            console.log(name_input.value);
            name_input.setAttribute('value','<?php echo $row['full_name'];?>');
            $('.input-details').load("user_page.php .input-details");
        }

        window.onbeforeunload = function(){
            document.getElementById('logoutbtn').click();
        }
    </script>
    <script src="scripts/main_page.js"></script>
</body>

</html>
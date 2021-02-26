<?php
    session_start();
    if ((!isset($_SESSION['unique_id'])) and (!isset($_GET['user_id']))) {
        header('location: index.php');
    }
    else{
        include_once 'php/config.php';
        if(!isset($_GET['user_id'])){
            header('location: user_page.php');
        }
        else{
            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            }
            else{
                header('location: user_page.php');
            }

            $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql2) > 0) {
                $row2 = mysqli_fetch_assoc($sql2);
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/chat_page.css?php echo time(); ?>"">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Chat - <?php echo $row['full_name'];?></title>
</head>

<body id="main_body">
    <div class="wrapper">
        <div class="left-panel">
            <div class="left-top">
                <div class="content">
                    <div class="prof-img"><img src="images/user-images/<?php echo $row2['prof_pic'];?>" alt="profile-pic" onclick="prof_change()"></div>
                    <div class="user-options">
                        <button onclick="settings_open()"><i class="fas fa-ellipsis-v"></i></button>
                    </div>

                </div>
            </div>
            <div class="left-search">
                <div class="search-obj">
                    <input type="text" class='search-bar' placeholder="Search for an user" id='search-input' onkeyup='search()'>
                    <button><i class="fas fa-search" onclick='toggleSearch()'></i></button>
                </div>
            </div>
            <div class="left-chats">
                <div class="users-list" id="userlist">
                    
                </div>
            </div>
        </div>
        <div class="settings" id='settings-pan'>
            <div class="settings-pan-top">
                <button onclick="settings_back()" style="background: none; outline: none; border: none; cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                <p>Settings</p>
            </div>
            <div class="settings-pan-content">
                <button onclick="prof_change()">Profile</button>
                <button id='themebtn' onclick="toggle_theme()">Theme: Dark</button>
                <button>Log Out</button>
            </div>
        </div>
        <div class="prof-change" id='prof-pan'>
            <div class="prof-pan-top">
                <button onclick="prof_back(); refresh_name()" style="background: none; outline: none; border: none; cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                <p>Edit Profile</p>
            </div>
            <div class="prof-details" id="prof-details">
                <img src="images/user-images/<?php echo $row2['prof_pic'];?>" class="profile" id="prof-pic" onclick="change_pic()" style='width:450px; height:450px; object-fit:cover;'>
                <div class="img-options-div" id='img-options-div'>
                    <input type="file" value="Change Profile Photo" id="file-input">
                    <button class="img-options" onclick="document.getElementById('file-input').click()">Change Profile Photo</button>
                    <button class="img-options">Remove Profile Photo</button>
                </div>
                <div class="error-txt">This is an error msg</div>
                <div class="hover-text" id='hover-text' onclick="change_pic()">
                    <i class="fas fa-camera"></i>
                    <p class="text" id='hov-txt'>CHANGE PROFILE PHOTO</p>
                </div>
                <div class="input-details">
                    <input type="text" value='<?php echo $row2['full_name'];?>' id='name-input' maxlength="35" autocomplete="off">
                    <button><i class="fas fa-check" id="save-name"></i></button>
                </div>
            </div>
        </div>
        <div class="right-panel" id="chat-pan">
            <div class="right-top">
                <a href="user_page.php" class="back-icon" onclick="chat_back();scrollToBottom();"><i class="fas fa-arrow-left"></i></a>
                <img src="images/user-images/<?php echo $row['prof_pic'];?>" alt="" title="<?php echo $row['full_name'];?>">
                <div class="details">
                    <span><?php echo $row['full_name'];?></span>
                    <p><?php
                            date_default_timezone_set('Asia/Kolkata');
                            if ($row['status'] === 'online'){
                                echo $row['status'];
                            }
                            else{
                                if(substr($row['last_seen'], 0, 10) === date('d/m/Y')){
                                    echo "last seen today at ".substr($row['last_seen'], 11, 8);
                                }
                                else{
                                    echo "last seen on ".substr($row['last_seen'], 0, 10)." at ".substr($row['last_seen'], 11, 8);
                                }
                            }
                     ?></p>
                </div>
            </div>
            <div class="right-chat">
            </div>
            <div class="right-typing">
                <form action="#" class='typing-area'>
                    <input type="text" name='outgoing_id' value="<?php echo $_SESSION['unique_id'];?>" hidden>
                    <input type="text" name='incoming_id' value="<?php echo $user_id;?>" hidden>
                    <input id='msg-input' name='message' type="text" placeholder="Type a message" autocomplete='off'>
                    <button id= 'msg-send' onclick="send();scrollToBottom();"><i class="fas fa-paper-plane" style="cursor: pointer;"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function refresh_name(){
            name_input = document.getElementById('name-input');
            console.log(name_input.value);
            name_input.setAttribute('value','<?php echo $row['full_name'];?>');
            $('.input-details').load("user_page.php .input-details")
        }
    </script>
    <script src="scripts/chat_page.js"></script>
    <script src="scripts/chat.js"></script>
</body>

</html>
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
                $status = $row['status'];
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css"/>
    <link rel="shortcut icon" href="images/Icons/favicon.ico" type="image/x-icon">
    <script src="scripts/fgEmojiPicker.js"></script>
    <title>Chat - <?php echo $row['full_name'];?></title>
</head>

<body id="main_body">
    <div class="wrapper">
        <div class="left-panel">
            <div class="left-top">
                <div class="content">
                    <div class="prof-img"><img src="images/user-images/<?php echo $row2['prof_pic'];?>" alt="profile-pic" onclick="prof_change()"></div>
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
        <div class="settings" id='settings-pan'>
            <div class="settings-pan-top">
                <button onclick="settings_back()" style="background: none; outline: none; border: none; cursor: pointer;"><i class="fas fa-arrow-left"></i></button>
                <p>Settings</p>
            </div>
            <div class="settings-pan-content">
                <button onclick="prof_change()" style="color:#fff;">Profile</button>
                <button id='themebtn' style="color: #fff;" title="You have to login with your new password again!"><a href="chng_pass.php" style="text-decoration: none; color: #fff;">Change Password</button>
                <button><a href="php/logout.php?logout_id=<?php echo $row2['unique_id'];?>" style="text-decoration: none; color: #fff;">Log Out</a></button>
                <button><a href="del_acc.php" style="text-decoration: none; color: #fff;">Delete Account</a></button>
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
                    <form method="POST" enctype="multipart/form-data" action="php/upload.php" autocomplete="off" id="img-form" hidden>
                        <input type="file" value="Change Profile Photo" name="prof-pic" id="file-input" onchange="upload()" accept="image/x-png,image/gif,image/jpeg,image/jpg">
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
                        <input type="text" placeholder='<?php echo $row2['full_name'];?>' id='name-input' maxlength="35" autocomplete="off" name='name-change'>
                    </form>
                    <button onclick="name_change()"><i class="fas fa-check" id="save-name"></i></button>
                </div>
            </div>
        </div>
        <div class="right-panel" id="chat-pan">
            <div class="right-top">
                <a href="user_page.php" class="back-icon" onclick="chat_back();scrollToBottom();"><i class="fas fa-arrow-left"></i></a>
                <img src="images/user-images/<?php echo $row['prof_pic'];?>" alt="" title="<?php echo $row['full_name'];?>">
                <div class="details" id='user-det'>
                    <span><?php echo $row['full_name'];?></span>
                    <p id='status-txt'><?php
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
                
                <form action="#" class='typing-area' id='msg-form'>
                    <input type="text" name='outgoing_id' value="<?php echo $_SESSION['unique_id'];?>" hidden>
                    <input type="text" name='incoming_id' value="<?php echo $user_id;?>" hidden>
                    <input id='msg-input' name='message' type="text" placeholder="Type a message" autocomplete='off'>
                    <!-- <div class="emoji" id="emoji"><i class="fas fa-grin-beam" style="cursor: pointer; font-size: 1.5rem; color:#fff; margin: auto 8%;"></i></div> -->
                    <button id="emo-button" style="background-color: #2f3232; border:none; outline:none; cursor:pointer;"><i class="fas fa-grin"></i></button>
                    <button id= 'msg-send' onclick="send();scrollToBottom();" style="background-color: #2f3232;"><i class="fas fa-paper-plane" style="cursor: pointer;"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let msginp = document.getElementById('msg-input');

        msginp.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            sendBtn.click();
        }
        });

        function refresh_name(){
            name_input = document.getElementById('name-input');
            console.log(name_input.value);
            name_input.setAttribute('value','<?php echo $row['full_name'];?>');
            $('.input-details').load("chat_page.php .input-details");
        }


        var emo = '';
        new FgEmojiPicker({
            trigger: ['#emo-button'],
            position: ['top', 'left'],
            dir: 'scripts/',
            prefetch: true,
            insertInto: document.getElementById('msg-input'),
            emit(emoji) {
                window.emo = emoji['emoji'];
            }
            
        },
        
        document.querySelector("#msg-input").value += emo);

        

    </script>
    <script src="scripts/chat_page.js"></script>
    <script src="scripts/chat.js"></script>
</body>

</html>
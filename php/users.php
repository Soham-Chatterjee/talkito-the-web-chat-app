<?php
    session_start();
    include_once "config.php";
    if (isset($_SESSION['unique_id'])){
        $outgoing_id = $_SESSION['unique_id'];
    }
    else{
        header('location: ../index.php');
        die();
    }

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}");
    
    $output = "";

    
    if (mysqli_num_rows($sql) == 0){
        $output .= "Talkito! does not have any other users at the moment! Please share this app with your friends and family and help them join the commmunity!";
    }elseif (mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

            $query2 = mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($query2);

            if (mysqli_num_rows($query2) > 0){
                $result = str_replace('\\','',base64_decode($row2['msg']));
            }
            else{
                $result = 'is on Talkito!';
            }

            (strlen($result) > 18) ? $msg = substr($result, 0, 18).'...' : $msg = $result;
            if (isset($row2['outgoing_msg_id'])){
                if ($outgoing_id === $row2['outgoing_msg_id']){
                    $you = "You: ";
                }
                else{
                    $you = "";
                }
            }
            else{
                $you = "";
            }

            // ($row['status'] == 'offline') ? $offline = "offline" : $offline = "";
            if($row['status'] == "offline"){
                $output .=  '<?php
                            session_start();
                            if (!isset($_SESSION["unique_id"])) {
                                header("location: index.php");
                            }?>
                            <a href="chat_page.php?user_id='.$row['unique_id'].'" id="user_chat" title="'.$row['full_name'].'">
                            <div class="chat-content">
                                <img src="images/user-images/'. $row['prof_pic'] .'" alt="">
                                <div class="details">
                                    <span>'. $row['full_name'] .'</span>
                                    <p title="'.$you.$result.'">'.$you.$msg.'</p>
                                </div>
                            </div>
                            <div class="status-dot" style="color: #97918a"><i class="fas fa-circle"></i></div>
                        </a>';
            }
            else{
                $output .=  '<?php
                            session_start();
                            if (!isset($_SESSION["unique_id"])) {
                                header("location: index.php");
                            }?>
                            <a href="chat_page.php?user_id='.$row['unique_id'].'" id="user_chat" title="'.$row['full_name'].'">
                            <div class="chat-content">
                                <img src="images/user-images/'. $row['prof_pic'] .'" alt="">
                                <div class="details">
                                    <span>'. $row['full_name'] .'</span>
                                    <p title="'.$you.$result.'">'.$you.$msg.'</p>
                                </div>
                            </div>
                            <div class="status-dot"><i class="fas fa-circle"></i></div>
                            </a>';
            }
            
        }
    }
    echo $output;
?>
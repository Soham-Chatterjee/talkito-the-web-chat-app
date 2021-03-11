<?php

    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (full_name LIKE '%{$searchTerm}%')");
    $output = '';
    if (mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

            $query2 = mysqli_query($conn, $sql2);

            $row2 = mysqli_fetch_assoc($query2);

            if (mysqli_num_rows($query2) > 0){
                $result = base64_decode($row2['msg']);
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

            if($row['status'] == "offline"){
                $output .=  '<a href="chat_page.php?user_id='.$row['unique_id'].'" id="user_chat">
                            <div class="chat-content">
                                <img src="images/user-images/'. $row['prof_pic'] .'" alt="">
                                <div class="details">
                                    <span>'. $row['full_name'] .'</span>
                                    <p>'.$you.$msg.'</p>
                                </div>
                            </div>
                            <div class="status-dot" style="color: #97918a"><i class="fas fa-circle"></i></div>
                        </a>';
            }
            else{
                $output .=  '<a href="chat_page.php?user_id='.$row['unique_id'].'" id="user_chat">
                            <div class="chat-content">
                                <img src="images/user-images/'. $row['prof_pic'] .'" alt="">
                                <div class="details">
                                    <span>'. $row['full_name'] .'</span>
                                    <p>'.$you.$msg.'</p>
                                </div>
                            </div>
                            <div class="status-dot"><i class="fas fa-circle"></i></div>
                        </a>';
            }
        }
    }else{
        $output .= '<div class="search-msg">
                        <p>No user found!</p>
                    </div>';
    }
    echo $output;

?>
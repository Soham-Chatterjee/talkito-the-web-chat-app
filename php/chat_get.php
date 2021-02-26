<?php
    session_start();
    if (isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output =  '<div class="chat-warn">
                        <div class="warn-text">
                            <p>Chat messages get refreshed after every 7 days to protect your privacy.</p>
                        </div>
                    </div>';

        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";

        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0){
            while ($row = mysqli_fetch_assoc($query)){
                if ($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p title="'.base64_decode($row['msg']).'">'.base64_decode($row['msg']).'</p>
                                    </div>
                                </div>';
                }
                else{
                    $output .= '<div class="chat incoming">
                                    <img src="images/user-images/'. $row['prof_pic'] .'" alt="" title="'.$row['full_name'].'">
                                    <div class="details">
                                        <p title="'.base64_decode($row['msg']).'">'. base64_decode($row['msg']) .'</p>
                                    </div>
                                </div>';
                }
            }

            echo $output;
        }
        
    }else{
        header('location: ../index.php');
    }

?>
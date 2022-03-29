<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["friend_id"]) && isset($_POST["message"])){

        $friend_id = $_POST["friend_id"];
        $message = $_POST["message"];

        if($friend_id != "" && !empty($message)){

            require_once "../classes/Users.class.php";

            $users_obj  = new Users();

            $friend_exists = $users_obj->friend_exists($friend_id);

            if($friend_exists[0]){

                $fr_data = $friend_exists[1];

                if($fr_data["User1"] == $__user_details["UserID"] || $fr_data["User2"] == $__user_details["UserID"]){

                    require_once "../classes/Chat.class.php";

                    $chat_obj  = new Chat();

                    $to = ($fr_data["User1"] == $__user_details["UserID"]) ? $fr_data["User2"] : $fr_data["User1"];

                    $add_message = $chat_obj->add_message($friend_id, $__user_details["UserID"], $to, $message);

                    if($add_message[0]){

                        $users_obj->update_friend_datum($friend_id, "LastMessageTimestamp", time());

                        echo "Message added successfully,".$add_message[1];

                    }else{

                        echo "Error adding message";

                    }

                }else{

                    echo "Error sending message. Try again";

                }

            }else{

                echo "Error sending message. Try again";

            }

        }else{

            echo "Fill in all fields";

        }

    }else{

        echo "All fields not set";

    }

?>

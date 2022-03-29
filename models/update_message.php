<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["chat_id"]) && isset($_POST["message"])){

        $chat_id = $_POST["chat_id"];
        $message = $_POST["message"];

        if($chat_id != "" && !empty($message)){

            require_once "../classes/Chat.class.php";

            $chat_obj = new Chat();

            $chat_exists = $chat_obj->chat_exists($chat_id);

            if($chat_exists[0]){

                $chat = $chat_exists[1];

                if($chat["MessageFrom"] != $__user_details["UserID"]){

                    die("An error occured. Try again");

                }

                $chat_obj->update_chat_datum($chat_id, "Message", $message);

                echo "Message updated successfully";

            }else{

                die("Error identifying chat");

            }

        }else{

            echo "Fill in all fields";

        }

    }else{

        echo "All fields not set";

    }

?>

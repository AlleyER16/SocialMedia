<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["chat_id"]) && $_POST["chat_id"] != ""){

        $chat_id = $_POST["chat_id"];

        require_once "../classes/Chat.class.php";

        $chat_obj = new Chat();

        $chat_exists = $chat_obj->chat_exists($chat_id);

        if($chat_exists[0]){

            $chat = $chat_exists[1];

            if($chat["MessageFrom"] != $__user_details["UserID"]){

                die("An error occured. Try again");

            }

            $chat_obj->delete_chat($chat_id);

            echo "Message deleted successfully";

        }else{

            die("Error identifying chat");

        }

    }else{

        echo "All fields not set";

    }

?>

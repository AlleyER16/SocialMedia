<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["user_id"]) && $_POST["user_id"] != ""){

        $user_id = $_POST["user_id"];

        require_once "../classes/Users.class.php";

        $users_obj = new Users();

        $friend_request_exists = $users_obj->friend_request_exists($__user_details["UserID"], $user_id);

        if($friend_request_exists[0]){

            $fr_data = $friend_request_exists[1];

            if($fr_data["RequestedBy"] != $__user_details["UserID"]){

                die("An error occured. Try again");

            }

            $users_obj->delete_friend_request($fr_data["ID"]);

            echo "Friend request removed successfully";

        }else{

            die("Error identifying friend request");

        }

    }else{

        echo "All fields not set";

    }

?>

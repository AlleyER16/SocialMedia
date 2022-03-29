<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["user_id"]) && $_POST["user_id"] != ""){

        $user_id = $_POST["user_id"];

        require_once "../classes/Users.class.php";

        $users_obj = new Users();

        $friend_request_exists = $users_obj->friend_request_exists($user_id, $__user_details["UserID"]);

        if($friend_request_exists[0]){

            $fr_data = $friend_request_exists[1];

            if($fr_data["User"] == $user_id){

                die("Friend request sent successfully");

            }else if($fr_data['RequestedBy'] == $user_id){

                die("Use has sent you friend request. Go accept");

            }

        }

        if($users_obj->add_friend_request($user_id, $__user_details["UserID"])){

            echo "Friend request sent successfully";

        }else{

            echo "Error sending request. Try again";

        }

    }else{

        echo "All fields not set";

    }

?>

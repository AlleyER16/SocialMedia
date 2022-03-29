<?php

    $__force_redirect = $__force_redirect ?? true;

    session_start();

    $__user_details = [];

    if(isset($_SESSION["user_logged"]) && $_SESSION["user_logged"] != ""){

        $user_id = $_SESSION["user_logged"];

        require_once "classes/Users.class.php";

        $users_obj = new Users();

        $user_exists = $users_obj->user_exists("UserID", $user_id);

        if($user_exists[0]){

            $__user_details = $user_exists[1];

            if($__user_details["ProfilePicture"] == NULL){

                $__user_details["ProfilePicture"] = ($__user_details["Gender"] == "Male") ? "assets/images/img_avatar.png" : "assets/images/img_avatar2.png";

            }else{

                $__user_details["ProfilePicture"] = "users/".$__user_details["UserID"]."/".$__user_details["ProfilePicture"];

            }

            if($__user_details["CoverPhoto"] == NULL){

                $__user_details["CoverPhoto"] = "assets/images/img_mountains.jpg";

            }else{

                $__user_details["CoverPhoto"] = "users/".$__user_details["UserID"]."/".$__user_details["CoverPhoto"];

            }

        }else{

            if($__force_redirect){
                header("location: login.php");
            }

        }

    }else{

        if($__force_redirect){
            header("location: login.php");
        }

    }

?>

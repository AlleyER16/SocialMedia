<?php

    $__force_redirect = $__force_redirect ?? true;

    session_start();

    $__user_details = [];

    if(isset($_SESSION["user_logged"]) && $_SESSION["user_logged"] != ""){

        $user_id = $_SESSION["user_logged"];

        require_once "../classes/Users.class.php";

        $users_obj = new Users();

        $user_exists = $users_obj->user_exists("UserID", $user_id);

        if($user_exists[0]){

            $__user_details = $user_exists[1];

        }else{

            die("Unauthorized");

        }

    }else{

        die("Unauthorized");

    }

?>

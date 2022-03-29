<?php

    if(isset($_POST["username"])&& isset($_POST["password"])){

        $username = $_POST["username"];
        $password = $_POST["password"];

        if(!empty($username) && !empty($password)){

            require_once "../classes/Users.class.php";

            $users_obj  = new Users();

            $user_exists = $users_obj->user_exists_by_auth($username, md5($password));

            if(!$user_exists[0]){

                die("Invalid username or password");

            }

            session_start();

            $_SESSION["user_logged"] = $user_exists[1]["UserID"];

            $users_obj->update_user_datum($_SESSION["user_logged"], "OnlineStatus", 1);

            echo "Account Verified. Logging in...";

        }else{

            echo "Fill in all fields";

        }

    }else{

        echo "All fields not set";

    }

?>

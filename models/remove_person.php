<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["user_id"]) && $_POST["user_id"] != ""){

        $user_id = $_POST["user_id"];

        require_once "../classes/Users.class.php";

        $users_obj = new Users();

        if($users_obj->removed_exists($__user_details["UserID"], $user_id)){

            die("User removed successfully");

        }

        if($users_obj->add_removed($__user_details["UserID"], $user_id)){

            echo "User removed successfully";

        }else{

            echo "Error removing user. Try again";

        }

    }else{

        echo "All fields not set";

    }

?>

<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["username"])){

        $username = $_POST["username"];

        if(!empty($username)){

            require_once "../classes/Users.class.php";

            $users_obj  = new Users();

            $user_exists = $users_obj->user_exists("Username", $username);

            if($user_exists[0] && $user_exists[1]["UserID"] != $__user_details["UserID"]){

                die("Username has been used");

            }

            if($users_obj->update_user_datum($__user_details["UserID"], "Username", $username)){

                echo "Username updated successfully";

            }else{

                echo "Error updating username";

            }

        }else{

            echo "Fill in all fields";

        }

    }else{

        echo "All fields not set";

    }

?>

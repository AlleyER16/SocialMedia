<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["current_password"]) && isset($_POST["new_password"]) && isset($_POST["confirm_password"])){

        $current_password = $_POST["current_password"];
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        if(!empty($current_password) && !empty($new_password) && !empty($confirm_password)){

            if(md5($current_password) != $__user_details["Password"]){
                die("Invalid current password");
            }

            if($new_password != $confirm_password){
                die("passwords do not match");
            }

            require_once "../classes/Users.class.php";

            $users_obj  = new Users();

            if($users_obj->update_user_datum($__user_details["UserID"], "Password", md5($confirm_password))){

                echo "Password updated successfully";

            }else{

                echo "Error updating password";

            }

        }else{

            echo "Fill in all fields";

        }

    }else{

        echo "All fields not set";

    }

?>

<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["full_name"])){

        $full_name = $_POST["full_name"];

        if(!empty($full_name)){

            require_once "../classes/Users.class.php";

            $users_obj  = new Users();

            if($users_obj->update_user_datum($__user_details["UserID"], "FullName", $full_name)){

                echo "Name updated successfully";

            }else{

                echo "Error updating name";

            }

        }else{

            echo "Fill in all fields";

        }

    }else{

        echo "All fields not set";

    }

?>

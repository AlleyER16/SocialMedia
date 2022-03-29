<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["telephone"])){

        $telephone = $_POST["telephone"];

        if(!empty($telephone)){

            require_once "../classes/Users.class.php";

            $users_obj  = new Users();

            $telephone_exists = $users_obj->user_exists("Telephone", $telephone);

            if($telephone_exists[0] && $telephone_exists[1]["UserID"] != $__user_details["UserID"]){

                die("Telephone has been used");

            }

            if($users_obj->update_user_datum($__user_details["UserID"], "Telephone", $telephone)){

                echo "Telephone updated successfully";

            }else{

                echo "Error updating telephone";

            }

        }else{

            echo "Fill in all fields";

        }

    }else{

        echo "All fields not set";

    }

?>

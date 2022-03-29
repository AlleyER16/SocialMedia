<?php

    if(isset($_POST["full_name"]) && isset($_POST["gender"]) && isset($_POST["date_of_birth"]) && isset($_POST["telephone"])
    && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])){

        $full_name = $_POST["full_name"];
        $gender = $_POST["gender"];
        $date_of_birth = $_POST["date_of_birth"];
        $telephone = $_POST["telephone"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if(!empty($full_name) && !empty($gender) && !empty($date_of_birth) && !empty($telephone) && !empty($username)
        && !empty($password) && !empty($confirm_password)){

            require_once "../classes/Users.class.php";

            $users_obj = new Users();


            if($password != $confirm_password){

                die("Passwords do not match");

            }

            if($users_obj->user_exists("Telephone", $telephone)[0]){

                die("Telephone has been used");

            }

            if($users_obj->user_exists("Username", $username)[0]){

                die("Username has been used");

            }


            $add_user = $users_obj->add_user($full_name, $gender, $date_of_birth, $telephone, $username, md5($password));

            if(!$add_user[0]){

                die("Error signing up. Try again");

            }

            session_start();

            $_SESSION["user_logged"] = $add_user[1];

            echo "Account Created Successfully. Redirecting...";

        }else{

            echo "Fill in all fields";

        }

    }else{

        echo "All fields not set";

    }

?>

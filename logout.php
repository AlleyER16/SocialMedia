<?php

    require_once "includes/__auth_check.php";


    require_once "classes/Users.class.php";

    $users_obj = new Users();


    $users_obj->update_user_datum($__user_details["UserID"], "OnlineStatus", 0);


    session_unset();

    session_destroy();

    header("location: login.php");

?>

<?php

    session_start();

    if(isset($_SESSION["admin_logged"]) && $_SESSION["admin_logged"] != ""){

        //pass

    }else{

        header("location: login.php");die();

    }

?>

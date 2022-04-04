<?php

    session_start();

    if(isset($_SESSION["admin_logged"]) && $_SESSION["admin_logged"] != ""){

        //pass

    }else{

        die("Error deleting user");

    }

?>

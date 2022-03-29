<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["post_title"]) && isset($_POST["post_body"])){

        $post_title = $_POST["post_title"];
        $post_body = $_POST["post_body"];

        if(!empty($post_title) && !empty($post_body)){

            require_once "../classes/Posts.class.php";

            $posts_obj  = new Posts();

            if($posts_obj->add_post($post_title, $post_body, $__user_details["UserID"])[0]){

                echo "Post added successfully";

            }else{

                echo "Error adding post. Try again";

            }

        }else{

            echo "Fill in all fields";

        }

    }else{

        echo "All fields not set";

    }

?>

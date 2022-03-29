<?php

    require_once "../includes/__scripts_auth_check.php";

    if(isset($_POST["post_id"]) && $_POST["post_id"] != ""){

        $post_id = $_POST["post_id"];

        require_once "../classes/Posts.class.php";

        $posts_obj = new Posts();

        if($posts_obj->post_like_exists($post_id, $__user_details["UserID"])){

            echo "Post liked successfully";

        }else{

            if($posts_obj->add_post_like($post_id, $__user_details["UserID"])){

                echo "Post liked successfully";

            }else{

                echo "Error adding post like";

            }

        }

    }else{

        echo "All fields not set";

    }

?>

<?php

    $post_id = $_GET["post_id"] ?? 0;

    require_once "../classes/Posts.class.php";

    $posts_obj = new Posts();

    echo $posts_obj->get_num_post_likes($post_id);

?>

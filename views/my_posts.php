<?php

    require_once "classes/Users.class.php";
    require_once "classes/Posts.class.php";

    $users_obj = new Users();
    $posts_obj = new Posts();

    $posts = $posts_obj->get_my_posts($__user_details["UserID"]);

    foreach($posts as $post){

        ?>
        <div id="post__<?= $post["PostID"] ?>" class="row navbar-default w3-padding-top w3-padding-bottom w3-border w3-margin-bottom" style="border-radius: 5px;">
            <div class="col-md-2 col-sm-2 col-xs-3">
                <img src="<?= $__user_details["ProfilePicture"] ?>" width="100%" class="img-circle" style="max-height: 70px; border: 2px solid black"/>
                <span class="w3-green w3-circle bottom-right1" style="width: 10px; height: 10px;"></span>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-9 w3-padding-top">
                <span><b><?= $__user_details["FullName"] ?></b> - <span><?= $post["PostTitle"] ?></span></span><br/>
                <span class="w3-text-black" style="font-size: 12px">12:00pm on Apr 5 2020</span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 w3-margin-top w3-margin-bottom" data-toggle="modal" data-target="#postextra<?php echo $pstid;?>">
                <p class="text-justify">
                    <?= $post["PostBody"] ?>
                </p>
            </div>

            <div class="col-md-6 w3-center">
                <?php

                    if($posts_obj->post_like_exists($post["PostID"], $__user_details["UserID"])){

                        ?>
                        <button type="button" class="btn btn-link w3-text-black w3-left" style="font-size: 15px;">
                            <span class="fa fa-heart"></span> <span class="num_post_loves"><?= $posts_obj->get_num_post_likes($post["PostID"]) ?> Likes</span>
                        </button>
                        <?php

                    }else{

                        ?>
                        <button type="button" class="btn btn-link w3-text-black w3-left" onclick="like_post($(this), <?= $post["PostID"] ?>)" style="font-size: 15px;">
                            <span class="fa fa-heart-o"></span> <span class="num_post_loves"><?= $posts_obj->get_num_post_likes($post["PostID"]) ?> Likes</span>
                        </button>
                        <?php

                    }

                ?>
            </div>
        </div>
        <?php

    }

?>

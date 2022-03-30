<?php

    require_once "classes/Users.class.php";
    require_once "classes/Posts.class.php";

    $users_obj = new Users();
    $posts_obj = new Posts();

    $posts = $posts_obj->get_timeline($__user_details["UserID"]);

    foreach($posts as $post){

        $user_details = $users_obj->user_exists("UserID", $post["CreatedBy"])[1];

        if($user_details["ProfilePicture"] == NULL){

            $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "assets/images/img_avatar.png" : "assets/images/img_avatar2.png";

        }else{

            $user_details["ProfilePicture"] = "users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];

        }

        ?>
        <div id="post__<?= $post["PostID"] ?>" class="row navbar-default w3-padding-top w3-padding-bottom w3-border w3-margin-bottom" style="border-radius: 5px;">
            <div class="col-md-2 col-sm-2 col-xs-3">
                <img src="<?= $user_details["ProfilePicture"] ?>" width="100%" class="img-circle" style="max-height: 50px; border: 2px solid black"/>
                <span class="w3-green w3-circle bottom-right1" style="width: 10px; height: 10px;"></span>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-9">
                <span><b><?= $user_details["FullName"] ?></b> - <span><?= $post["PostTitle"] ?></span></span><br/>
                <span class="w3-text-black" style="font-size: 12px"><?= date("h:i:a", $post["Timestamp"]) ?> on <?= date("d/m/Y", $post["Timestamp"]) ?></span>
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

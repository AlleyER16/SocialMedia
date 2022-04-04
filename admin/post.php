<?php

    require_once "includes/__auth_func.php";

    if(!isset($_GET["post_id"]) || $_GET["post_id"] == ""){

        header("location: posts.php");

    }

    require_once "../classes/Users.class.php";
    require_once "../classes/Posts.class.php";

    $users_obj = new Users();
    $posts_obj = new Posts();

    $post_exists = $posts_obj->post_exists($_GET["post_id"]);

    if(!$post_exists[0]){

        header("location: posts.php");

    }

    $__post_details = $post_exists[1];

    $__user_details = $users_obj->user_exists("UserID", $__post_details["CreatedBy"])[1];

    if($__user_details["ProfilePicture"] == NULL){

        $__user_details["ProfilePicture"] = ($__user_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";

    }else{

        $__user_details["ProfilePicture"] = "../users/".$__user_details["UserID"]."/".$__user_details["ProfilePicture"];

    }

    $__page = (isset($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : "info";

    $__pg = (isset($_GET["pg"]) && $_GET["pg"] != "") ? $_GET["pg"] : 1;
    $__division = 8;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Post - Admin</title>

        <?php require_once "includes/meta_tags.php"; ?>

        <?php require_once "includes/top_resources.php"; ?>
    </head>
    <body>

        <div class="container">
            <div class="row" style="padding-top: 50px;">
                <div class="col-lg-6">
                    <h1>Admin</h1>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="logout.php">Logout</a>
                </div>
                <div class="col-lg-12 mt-4 text-center">
                    <a href="index.php" class="btn btn-outline-primary">Users</a>
                    <a href="posts.php" class="btn btn-primary">Posts</a>
                </div>
                <div class="col-lg-3 mt-4 text-center">
                    <a href="post.php?post_id=<?= $__post_details["PostID"] ?>&page=info" class="btn btn<?= ($__page == "info") ? "" : "-outline" ?>-primary btn-block">Post Info</a>
                    <a href="post.php?post_id=<?= $__post_details["PostID"] ?>&page=likes" class="btn btn<?= ($__page == "likes") ? "" : "-outline" ?>-primary btn-block">Post Likes</a>
                </div>
                <div class="col-lg-9 mt-4">
                    <?php

                        if($__page == "info"){

                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <td colspan="4">Post Information</td>
                                                </tr>
                                                <tr>
                                                    <th>Post Title</th>
                                                    <th>User</th>
                                                    <th>Date Created</th>
                                                    <th>Num. Likes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= $__post_details["PostTitle"] ?></td>
                                                    <td>
                                                        <img src="<?= $__user_details["ProfilePicture"] ?>" style="width: 50px; height: 50px;" class="rounded-circle"/>
                                                        <?= $__user_details["FullName"] ?>
                                                    </td>
                                                    <td>
                                                        <?= date("d-m-Y h:ia", $__post_details["Timestamp"]) ?>
                                                    </td>
                                                    <td>
                                                        <?= $posts_obj->get_num_post_likes($__post_details["PostID"]) ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <td>Post Body</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= $__post_details["PostBody"] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php

                        }else if($__page == "likes"){

                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <td colspan="5">Post Likes</td>
                                                </tr>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>User</th>
                                                    <th>Username</th>
                                                    <th>Date Liked</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $post_likes = $posts_obj->get_post_likes($__post_details["PostID"], $__pg, $__division);

                                                    $counter = 0;

                                                    foreach ($post_likes as $post_like) {

                                                        $counter++;

                                                        $user = $users_obj->user_exists("UserID", $post_like["LovedBy"])[1];

                                                        if($user["ProfilePicture"] == NULL){

                                                            $user["ProfilePicture"] = ($user["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";

                                                        }else{

                                                            $user["ProfilePicture"] = "../users/".$user["UserID"]."/".$user["ProfilePicture"];

                                                        }

                                                        ?>
                                                        <tr>
                                                            <td><?= $counter ?></td>
                                                            <td>
                                                                <img src="<?= $user["ProfilePicture"] ?>" style="width: 50px; height: 50px;" class="rounded-circle"/>
                                                                <?= $user["FullName"] ?>
                                                            </td>
                                                            <td><?= $user["Username"] ?></td>
                                                            <td>
                                                                <?= date("d-m-Y h:ia", $post_like["Timestamp"]) ?>
                                                            </td>
                                                            <td>
                                                                <a href="user.php?user_id=<?= $user["UserID"] ?>" class="btn btn-success">View</a>
                                                            </td>
                                                        </tr>
                                                        <?php

                                                    }

                                                    if($counter == 0){

                                                        ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center">Post has no likes</td>
                                                        </tr>
                                                        <?php

                                                    }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <ul class="pagination justify-content-center">
                                        <?php

                                            $pagination = $posts_obj->get_post_likes_pagination($__post_details["PostID"], $__division);

                                            for($i = 1; $i <= $pagination; $i++){

                                                ?>
                                                <li class="page-item <?= ($i == $__pg) ? "active" : "" ?>"><a class="page-link" href="post.php?post_id=<?= $__post_details["PostID"] ?>&page=likes&pg=<?= $i ?>"><?= $i ?></a></li>
                                                <?php

                                            }

                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <?php

                        }

                    ?>
                </div>
            </div>
        </div>

        <?php require_once "includes/bottom_resources.php"; ?>

    </body>
</html>

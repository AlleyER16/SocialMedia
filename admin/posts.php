<?php

    require_once "includes/__auth_func.php";

    $__pg = (isset($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;
    $__division = 8;

    require_once "../classes/Users.class.php";
    require_once "../classes/Posts.class.php";

    $users_obj = new Users();
    $posts_obj = new Posts();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Posts - Admin</title>

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
                <div class="col-lg-12 mt-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Post Title</th>
                                    <th>User</th>
                                    <th>Date Created</th>
                                    <th>Num. Likes</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $posts = $posts_obj->get_posts($__pg, $__division);

                                    $counter = 0;

                                    foreach ($posts as $post) {

                                        $counter++;

                                        $user_details = $users_obj->user_exists("UserID", $post["CreatedBy"])[1];

                                        if($user_details["ProfilePicture"] == NULL){

                                            $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";
                                    
                                        }else{
                                    
                                            $user_details["ProfilePicture"] = "../users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];
                                    
                                        }

                                        ?>
                                        <tr>
                                            <td><?= $counter ?></td>
                                            <td><?= $post["PostTitle"] ?></td>
                                            <td>
                                                <img src="<?= $user_details["ProfilePicture"] ?>" style="width: 50px; height: 50px;" class="rounded-circle"/>
                                                <?= $user_details["FullName"] ?>
                                            </td>
                                            <td>
                                                <?= date("d-m-Y h:ia", $post["Timestamp"]) ?>
                                            </td>
                                            <td>
                                                <?= $posts_obj->get_num_post_likes($post["PostID"]) ?>
                                            </td>
                                            <td>
                                                <a href="post.php?post_id=<?= $post["PostID"] ?>" class="btn btn-success">View</a>
                                            </td>
                                        </tr>
                                        <?php

                                    }

                                    if($counter == 5){

                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-center">There are no posts</td>
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

                            $pagination = $posts_obj->get_posts_pagination($__division);

                            for($i = 1; $i <= $pagination; $i++){

                                ?>
                                <li class="page-item <?= ($i == $__pg) ? "active" : "" ?>"><a class="page-link" href="posts.php?page=<?= $i ?>"><?= $i ?></a></li>
                                <?php

                            }

                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php require_once "includes/bottom_resources.php"; ?>

    </body>
</html>

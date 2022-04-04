<?php

    require_once "includes/__auth_func.php";

    if(!isset($_GET["user_id"]) || $_GET["user_id"] == ""){

        header("location: users.php");

    }

    require_once "../classes/Users.class.php";
    require_once "../classes/Posts.class.php";

    $users_obj = new Users();
    $posts_obj = new Posts();

    $user_exists = $users_obj->user_exists("UserID", $_GET["user_id"]);

    if(!$user_exists[0]){

        header("location: users.php");

    }

    $__user_details = $user_exists[1];

    if($__user_details["ProfilePicture"] == NULL){

        $__user_details["ProfilePicture"] = ($__user_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";

    }else{

        $__user_details["ProfilePicture"] = "../users/".$__user_details["UserID"]."/".$__user_details["ProfilePicture"];

    }

    $__page = (isset($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : "friends";

    $__pg = (isset($_GET["pg"]) && $_GET["pg"] != "") ? $_GET["pg"] : 1;
    $__division = 8;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>User - Admin</title>

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
                    <a href="index.php" class="btn btn-primary">Users</a>
                    <a href="posts.php" class="btn btn-outline-primary">Posts</a>
                </div>
                <div class="col-lg-3 mt-4">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img src="<?= $__user_details["ProfilePicture"] ?>" style="width: 100px; height: 100px" class="rounded-circle"/>
                        </div>
                        <div class="col-12 text-center">
                            <?= $__user_details["FullName"] ?>
                        </div>
                        <div class="col-12 text-center">
                            @<?= $__user_details["Username"] ?>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <b>Gender: </b> <?= $__user_details["Gender"] ?>
                        </div>
                        <div class="col-12 text-center">
                            <b>Date of Birth: </b> <?= $__user_details["DateOfBirth"] ?>
                        </div>
                        <div class="col-12 text-center">
                            <b>Telephone: </b> <?= $__user_details["Telephone"] ?>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <b>Friends: </b> <?= $users_obj->get_num_friends($__user_details["UserID"]) ?>
                        </div>
                        <div class="col-12 text-center">
                            <b>Friend Requests: </b> <?= $users_obj->get_num_friend_requests($__user_details["UserID"]) ?>
                        </div>
                        <div class="col-12 text-center">
                            <b>Friend Requests Sent: </b> <?= $users_obj->get_num_friend_requests_sent($__user_details["UserID"]) ?>
                        </div>
                        <div class="col-12 text-center">
                            <b>Removed: </b> <?= $users_obj->get_num_removed($__user_details["UserID"]) ?>
                        </div>
                        <div class="col-12 text-center">
                            <b>Posts: </b> <?= $posts_obj->get_num_my_posts($__user_details["UserID"]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 mt-4">
                    <div class="row">
                        <div class="col-lg-12 mt-4 text-center">
                            <a href="user.php?user_id=<?= $__user_details["UserID"] ?>&page=friends" class="btn btn<?= ($__page == "friends") ? "" : "-outline" ?>-primary">Friends</a>
                            <a href="user.php?user_id=<?= $__user_details["UserID"] ?>&page=fr" class="btn btn<?= ($__page == "fr") ? "" : "-outline" ?>-primary">Friend Requests</a>
                            <a href="user.php?user_id=<?= $__user_details["UserID"] ?>&page=frs" class="btn btn<?= ($__page == "frs") ? "" : "-outline" ?>-primary">Friend Requests Sent</a>
                            <a href="user.php?user_id=<?= $__user_details["UserID"] ?>&page=removed" class="btn btn<?= ($__page == "removed") ? "" : "-outline" ?>-primary">Removed</a>
                            <a href="user.php?user_id=<?= $__user_details["UserID"] ?>&page=posts" class="btn btn<?= ($__page == "posts") ? "" : "-outline" ?>-primary">Posts</a>
                            <a href="user.php?user_id=<?= $__user_details["UserID"] ?>&page=chat" class="btn btn<?= ($__page == "chat") ? "" : "-outline" ?>-primary">Chat</a>
                        </div>
                        <?php

                            if($__page == "friends"){

                                ?>
                                <div class="col-lg-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Username</th>
                                                    <th>Date Friends</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
        
                                                    $friends = $users_obj->get_friends($__user_details["UserID"]);
        
                                                    $counter = 0;
        
                                                    foreach ($friends as $friend) {
        
                                                        $user_id = ($friend["User1"] == $__user_details["UserID"]) ? $friend["User2"] : $friend["User1"];
        
                                                        $user_details = $users_obj->user_exists("UserID", $user_id)[1];
        
                                                        if($user_details["ProfilePicture"] == NULL){
        
                                                            $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";
        
                                                        }else{
        
                                                            $user_details["ProfilePicture"] = "../users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];
        
                                                        }
        
                                                        $counter++;
        
                                                        ?>
                                                        <tr>
                                                            <td><?= $counter ?></td>
                                                            <td>
                                                                <img src="<?= $user_details["ProfilePicture"] ?>" style="width: 50px; height: 50px;" class="rounded-circle"/>
                                                                <?= $user_details["FullName"] ?>
                                                            </td>
                                                            <td><?= $user_details["Gender"] ?></td>
                                                            <td>@<?= $user_details["Username"] ?></td>
                                                            <td>
                                                                <?= date("d-m-Y h:ia", $friend["Timestamp"]) ?>
                                                            </td>
                                                            <td>
                                                                <a href="user.php?user_id=<?= $user_id ?>" class="btn btn-success">View</a>
                                                            </td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                    if($counter == 0){
        
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center">User has no friends</td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php

                            }else if($__page == "fr"){

                                ?>
                                <div class="col-lg-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Username</th>
                                                    <th>Date Sent</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
        
                                                    $friend_requests = $users_obj->get_friend_requests($__user_details["UserID"]);
        
                                                    $counter = 0;
        
                                                    foreach ($friend_requests as $friend_request) {

                                                        $user_details = $users_obj->user_exists("UserID", $friend_request["RequestedBy"])[1];
        
                                                        if($user_details["ProfilePicture"] == NULL){
        
                                                            $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";
        
                                                        }else{
        
                                                            $user_details["ProfilePicture"] = "../users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];
        
                                                        }
        
                                                        $counter++;
        
                                                        ?>
                                                        <tr>
                                                            <td><?= $counter ?></td>
                                                            <td>
                                                                <img src="<?= $user_details["ProfilePicture"] ?>" style="width: 50px; height: 50px;" class="rounded-circle"/>
                                                                <?= $user_details["FullName"] ?>
                                                            </td>
                                                            <td><?= $user_details["Gender"] ?></td>
                                                            <td>@<?= $user_details["Username"] ?></td>
                                                            <td>
                                                                <?= date("d-m-Y h:ia", $friend_request["Timestamp"]) ?>
                                                            </td>
                                                            <td>
                                                                <a href="user.php?user_id=<?= $user_details["UserID"] ?>" class="btn btn-success">View</a>
                                                            </td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                    if($counter == 0){
        
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center">User has no friend requests</td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php

                            }else if($__page == "frs"){

                                ?>
                                <div class="col-lg-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Username</th>
                                                    <th>Date Sent</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
        
                                                    $friend_requests_sent = $users_obj->get_friend_requests_sent($__user_details["UserID"]);
        
                                                    $counter = 0;
        
                                                    foreach ($friend_requests_sent as $friend_request) {

                                                        $user_details = $users_obj->user_exists("UserID", $friend_request["User"])[1];
        
                                                        if($user_details["ProfilePicture"] == NULL){
        
                                                            $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";
        
                                                        }else{
        
                                                            $user_details["ProfilePicture"] = "../users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];
        
                                                        }
        
                                                        $counter++;
        
                                                        ?>
                                                        <tr>
                                                            <td><?= $counter ?></td>
                                                            <td>
                                                                <img src="<?= $user_details["ProfilePicture"] ?>" style="width: 50px; height: 50px;" class="rounded-circle"/>
                                                                <?= $user_details["FullName"] ?>
                                                            </td>
                                                            <td><?= $user_details["Gender"] ?></td>
                                                            <td>@<?= $user_details["Username"] ?></td>
                                                            <td>
                                                                <?= date("d-m-Y h:ia", $friend_request["Timestamp"]) ?>
                                                            </td>
                                                            <td>
                                                                <a href="user.php?user_id=<?= $user_details["UserID"] ?>" class="btn btn-success">View</a>
                                                            </td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                    if($counter == 0){
        
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center">User has no friend requests sent</td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php

                            }else if($__page == "removed"){

                                ?>
                                <div class="col-lg-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Username</th>
                                                    <th>Date Removed</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
        
                                                    $removed = $users_obj->get_removed($__user_details["UserID"]);
        
                                                    $counter = 0;
        
                                                    foreach ($removed as $user) {

                                                        $user_id = ($user["User"] == $__user_details["UserID"]) ? $user["UserRemoved"] : $user["User"];

                                                        $user_details = $users_obj->user_exists("UserID", $user_id)[1];
        
                                                        if($user_details["ProfilePicture"] == NULL){
        
                                                            $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";
        
                                                        }else{
        
                                                            $user_details["ProfilePicture"] = "../users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];
        
                                                        }
        
                                                        $counter++;
        
                                                        ?>
                                                        <tr>
                                                            <td><?= $counter ?></td>
                                                            <td>
                                                                <img src="<?= $user_details["ProfilePicture"] ?>" style="width: 50px; height: 50px;" class="rounded-circle"/>
                                                                <?= $user_details["FullName"] ?>
                                                            </td>
                                                            <td><?= $user_details["Gender"] ?></td>
                                                            <td>@<?= $user_details["Username"] ?></td>
                                                            <td>
                                                                <?= date("d-m-Y h:ia", $user["Timestamp"]) ?>
                                                            </td>
                                                            <td>
                                                                <a href="user.php?user_id=<?= $user_id ?>" class="btn btn-success">View</a>
                                                            </td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                    if($counter == 0){
        
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center">User has removed no user</td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php

                            }else if($__page == "posts"){

                                ?>
                                <div class="col-lg-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Title</th>
                                                    <th>Date Created</th>
                                                    <th>Num. Likes</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
        
                                                    $posts = $posts_obj->get_my_posts($__user_details["UserID"]);
        
                                                    $counter = 0;
        
                                                    foreach ($posts as $post) {
        
                                                        $counter++;
        
                                                        ?>
                                                        <tr>
                                                            <td><?= $counter ?></td>
                                                            <td><?= $post["PostTitle"] ?></td>
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
        
                                                    if($counter == 0){
        
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center">User has no post</td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php

                            }else if($__page == "chat"){

                                ?>
                                <div class="col-lg-12 mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Username</th>
                                                    <th>Last Message</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
        
                                                    $friends = $users_obj->get_chat($__user_details["UserID"]);
        
                                                    $counter = 0;
        
                                                    foreach ($friends as $friend) {
        
                                                        $user_id = ($friend["User1"] == $__user_details["UserID"]) ? $friend["User2"] : $friend["User1"];
        
                                                        $user_details = $users_obj->user_exists("UserID", $user_id)[1];
        
                                                        if($user_details["ProfilePicture"] == NULL){
        
                                                            $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";
        
                                                        }else{
        
                                                            $user_details["ProfilePicture"] = "../users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];
        
                                                        }
        
                                                        $counter++;
        
                                                        ?>
                                                        <tr>
                                                            <td><?= $counter ?></td>
                                                            <td>
                                                                <img src="<?= $user_details["ProfilePicture"] ?>" style="width: 50px; height: 50px;" class="rounded-circle"/>
                                                                <?= $user_details["FullName"] ?>
                                                            </td>
                                                            <td><?= $user_details["Gender"] ?></td>
                                                            <td>@<?= $user_details["Username"] ?></td>
                                                            <td>
                                                                <?= date("d-m-Y h:ia", $friend["LastMessageTimestamp"]) ?>
                                                            </td>
                                                            <td>
                                                                <a href="chat.php?chat_id=<?= $friend["ID"] ?>" class="btn btn-success">View</a>
                                                            </td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                    if($counter == 0){
        
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center">User has no chat</td>
                                                        </tr>
                                                        <?php
        
                                                    }
        
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php

                            }

                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once "includes/bottom_resources.php"; ?>

    </body>
</html>
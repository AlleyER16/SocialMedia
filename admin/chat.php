<?php

    require_once "includes/__auth_func.php";

    if(!isset($_GET["chat_id"]) || $_GET["chat_id"] == ""){

        header("location: users.php");

    }

    require_once "../classes/Users.class.php";
    require_once "../classes/Chat.class.php";

    $users_obj = new Users();
    $chat_obj = new Chat();

    $friend_exists = $users_obj->friend_exists($_GET["chat_id"]);

    if(!$friend_exists[0]){
        header("location: users.php");
    }

    $__friend_data = $friend_exists[1];

    $__user1_details = $users_obj->user_exists("UserID", $__friend_data["User1"])[1];

    if($__user1_details["ProfilePicture"] == NULL){

        $__user1_details["ProfilePicture"] = ($__user1_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";

    }else{

        $__user1_details["ProfilePicture"] = "../users/".$__user1_details["UserID"]."/".$__user1_details["ProfilePicture"];

    }


    $__user2_details = $users_obj->user_exists("UserID", $__friend_data["User2"])[1];

    if($__user2_details["ProfilePicture"] == NULL){

        $__user2_details["ProfilePicture"] = ($__user2_details["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";

    }else{

        $__user2_details["ProfilePicture"] = "../users/".$__user2_details["UserID"]."/".$__user2_details["ProfilePicture"];

    }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Chat - Admin</title>

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
                    <a href="posts.php" class="btn btn-outline-primary">Posts</a>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="card">
                        <div class="card-header">Chat</div>
                        <div class="card-body">
                            <?php

                                $messages = $chat_obj->get_messages($_GET["chat_id"]);

                                foreach($messages as $message){

                                    if($message["MessageFrom"] == $__user1_details["UserID"]){

                                        ?>
                                        <div class="row mb-2">
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                <img src="<?= $__user1_details["ProfilePicture"] ?>" style="width: 40px; height: 40px;" class="rounded-circle"/>
                                                <button class="btn btn-primary"><?= $message["Message"] ?></button>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                        </div>
                                        <?php

                                    }else{

                                        ?>
                                        <div class="row mb-2">
                                            <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                            <div class="col-md-10 col-sm-10 col-xs-10 text-right">
                                               <button class="btn btn-primary" ><?= $message["Message"] ?></button>
                                               <img src="<?= $__user2_details["ProfilePicture"] ?>" style="width: 40px; height: 40px;" class="rounded-circle"/>
                                            </div>
                                        </div>
                                        <?php

                                    }

                                }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once "includes/bottom_resources.php"; ?>

    </body>
</html>
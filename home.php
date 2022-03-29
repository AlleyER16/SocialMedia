<?php

    require_once "includes/__auth_check.php";

?>
<!DOCTYPE html>
<html>
    <head>
         <title>Social Media -> <?= $__user_details["FullName"] ?></title>

        <?php require_once "includes/meta.php" ?>

        <?php require_once "includes/resources.php" ?>
    </head>
    <body>

        <nav class="custom_navbar">
            <?php require_once "views/navbar.php" ?>
        </nav>

        <nav class="mobile_navbar">
            <?php require_once "views/mobile_navbar.php" ?>
        </nav>

        <nav class="mobile_menu">
            <?php require_once "views/mobile_menu.php" ?>
        </nav>

        <?php require_once "views/feedback_divs.php" ?>

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-2 w3-padding-top left_bar">
                    <?php require_once "views/left_sidebar.php" ?>
                </div>

                <div class="col-md-2 left_fill"></div>

                <div class="col-md-4 col-sm-8 w3-padding-top main_content">

                    <div class="row w3-padding">
                        <form id="create_post">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?= $__user_details["FullName"] ?> <span class="w3-text-amber">@<?= $__user_details["Username"] ?></span>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-2 col-sm-2 col-xs-3">
                                        <img src="<?= $__user_details["ProfilePicture"] ?>" width="100%" class="img-circle" style="max-height: 50px;"/>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-9">
                                        <input type="text" name="post_title" class="form-control" placeholder="Post title" required/><br/>
                                        <textarea class="form-control" name="post_body" rows="5" placeholder="What is on your Mind?" required></textarea>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="submit" class="btn btn-success">Upload Post</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row w3-margin-bottom w3-padding" id="people_you_may_know">
                        <?php require_once "views/people_you_may_know.php" ?>
                    </div>

                    <div class="w3-padding" id="posts">
                        <?php require_once "views/posts.php" ?>
                    </div>

                </div>

                <div class="col-md-1 space_division"></div>

                <div class="col-md-3 w3-padding-top ads_section">

                    <?php require_once "views/ads.php" ?>

                    <div id="top_friend_request">
                        <?php require_once "views/top_friend_request.php" ?>
                    </div>

                </div>

                <div id="chatlist" class="col-md-2 col-sm-4 w3-padding-top w3-border-left w3-light-grey w3-padding-bottom chat_section">
                    <?php require_once "views/chat_list.php" ?>
                </div>

            </div>

        </div>

        <script type="text/javascript" src="controller/friend_requests.js"></script>
        <script type="text/javascript" src="controller/post_operations.js"></script>
        <script type="text/javascript" src="controller/post_creating.js"></script>
        <script type="text/javascript" src="controller/adding_friends.js"></script>

    </body>
</html>

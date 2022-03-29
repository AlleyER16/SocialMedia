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

                <div class="col-md-5 col-sm-8 w3-padding-top main_content">

                    <div class="friendrequest w3-margin-top">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Advanced Post</div>
                                    <div class="panel-body">
                                        <div class="row w3-margin-bottom">
                                            <form id="advanced_post">
                                                <div class="col-md-12">
                                                    <label>Post Title</label>
                                                    <input type="text" class="form-control" name="post_title" placeholder="Enter Post Title" style="border-radius: 0px;"/>
                                                </div>
                                                <div class="col-md-12 w3-margin-top">
                                                    <label>Post Body</label>
                                                    <textarea class="form-control" name="post_body">Enter Post Body</textarea>
                                                </div>
                                                <div class="col-md-12 w3-margin-top">
                                                    <button type="submit" class="btn btn-success btn-block" style="border-radius: 0px;">Upload Post</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="chatlist" class="col-md-2 col-sm-4 w3-padding-top w3-border-left w3-light-grey w3-padding-bottom chat_section">
                    <?php require_once "views/chat_list.php" ?>
                </div>

            </div>

        </div>

        <script src="controller/post_creating.js"></script>
    </body>
</html>

<?php

    require_once "includes/__auth_check.php";

    if(!isset($_GET["search"]) || empty($_GET["search"])){
        header("location: post.php");
    }

    $search = $_GET["search"];

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

                    <div class="btn-group btn-group-justified text-center">
                        <h3><b>Search:</b> <?= $search ?></h3>
                    </div>

                    <div id="search_results">
                        <?php require_once "views/search_results.php" ?>
                    </div>

                </div>

                <div id="chatlist" class="col-md-2 col-sm-4 w3-padding-top w3-border-left w3-light-grey w3-padding-bottom chat_section">
                    <?php require_once "views/chat_list.php" ?>
                </div>

            </div>

        </div>

        <script type="text/javascript" src="controller/components_refresh.js"></script>

        <script type="text/javascript">

            setInterval(chatlist_refresh, 500);

            setInterval(friend_requests_count_refresh, 500);

            setInterval(num_unread_chat_refresh, 500);

        </script>

        <script type="text/javascript" src="controller/friend_requests.js"></script>
        <script type="text/javascript" src="controller/adding_friends.js"></script>

	</body>
</html>

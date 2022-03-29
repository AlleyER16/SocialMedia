<?php

    require_once "includes/__auth_check.php";

    $__page = $_GET["page"] ?? "fr";

?>
<!DOCTYPE html>
<html>
    <head>
	    <title>Social Media -> <?= $__user_details["FullName"] ?></title>

        <title>ABook -> Akashi Senpai</title>

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

                    <div class="btn-group btn-group-justified">
                        <a href="friends.php?page=fr" class="btn btn-success">Friend Requests</a>
                        <a href="friends.php?page=frs" class="btn btn-success">Sent Requests</a>
                        <a href="friends.php?page=pymn" class="btn btn-success">People</a>
                    </div>

                    <?php

                        if($__page == "fr"){

                            ?>
                            <div id="friend_requests">
                                <?php require_once "views/friend_requests.php" ?>
                            </div>
                            <?php

                        }else if($__page == "frs"){

                            ?>
                            <div id="friend_requests_sent">
                                <?php require_once "views/friend_requests_sent.php" ?>
                            </div>
                            <?php

                        }else if($__page == "pymn"){

                            ?>
                            <div id="s_people_you_may_know">
                                <?php require_once "views/several_people_you_may_know.php" ?>
                            </div>
                            <?php

                        }

                    ?>

                </div>

                <div id="chatlist" class="col-md-2 col-sm-4 w3-padding-top w3-border-left w3-light-grey w3-padding-bottom chat_section">
                    <?php require_once "views/chat_list.php" ?>
                </div>

            </div>

        </div>

        <script type="text/javascript" src="controller/friend_requests.js"></script>
        <script type="text/javascript" src="controller/adding_friends.js"></script>

	</body>
</html>

<?php

    require_once "includes/__auth_check.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Single Post -> Akashi Senpai</title>

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

                    <div class="w3-padding" id="posts">
                        <div class="row navbar-default w3-padding-top w3-padding-bottom w3-border w3-margin-bottom" style="border-radius: 5px;">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img src="assets/images/img_avatar.png" width="100%" class="img-circle" style="max-height: 50px; border: 2px solid black"/>
                                <span class="w3-green w3-circle bottom-right" style="width: 10px; height: 10px;"></span>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <span><b>Akashi Senpai</b> - <span>First Post</span></span><br/>
                                <span class="w3-text-black" style="font-size: 12px">12:00pm on Apr 5 2020</span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 w3-margin-top w3-margin-bottom" data-toggle="modal" data-target="#postextra<?php echo $pstid;?>">
                                <p class="text-justify">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio totam,
                                    maxime omnis neque quaerat eligendi, facere cupiditate, ipsa culpa consequuntur soluta.
                                    Sint fugiat non, nulla sit unde ea nisi itaque!
                                </p>
                            </div>

                            <div class="col-md-6 w3-center">
                                <button type="submit" class="btn btn-link w3-text-black w3-left" data-toggle="modal" data-target="#postreacts1" style="font-size: 15px;">
                                    <span class="fa fa-heart-o"></span> 1
                                </button>
                            </div>

                            <div class="col-md-6 w3-right-align">
                                <button type="submit" class="btn btn-link w3-text-black" style="font-size: 15px;">
                                    <span class="fa fa-comments-o"></span> 5
                                </button>
                            </div>

                            <div class="col-md-12 col-sm-12"><hr/></div>

                            <div class="col-md-3 col-sm-3 col-xs-3 w3-center">
                                <form class="love_post">
                                    <input type="hidden" name="post_id" value="2"/>
                                    <button type="submit" class="btn btn-link w3-text-black" style="font-size: 15px;">
                                        <span class="fa fa-heart-o"></span> Love
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9 w3-center">
                                <div class="col-md-2 col-sm-3 col-xs-3">
                                    <img src="assets/images/img_avatar.png" width="100%" class="img-circle" style="max-height: 30px;"/>
                                </div>
                                <div class="col-md-10 col-sm-9 col-xs-9">
                                    <form class="comment_post">
                                        <div class="input-group">
                                            <input type="hidden" name="post_id" value="1"/>
                                            <input type="text" name="comment" placeholder="Write a comment... " class="form-control"autocomplete="off"/>
                                            <div class="input-group-btn">
                                                <button  type="submit" class="btn btn-default"><i class="fa fa-comment"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 navbar-default w3-margin-bottom">
                                <div class="col-md-6 col-sm-6 col-xs-6 w3-center w3-padding-top w3-padding-bottom w3-border-right">
                                    <a href="#" id="load_post_loves" post_id="1">Love</a>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 w3-center w3-padding-top w3-padding-bottom">
                                    <a href="#" id="load_post_comments" post_id="1">Comments</a>
                                </div>
                            </div>
                        </div>

                        <div id="post_component">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="assets/images/img_avatar.png" class="img-circle" width="100%"/>
                                </div>
                                <div class="col-md-10 w3-padding-top">
                                    Akashi Senpai
                                </div>
                            </div>
                        </div>

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

        <script type="text/javascript" src="controller/components_refresh.js"></script>

        <script type="text/javascript">

            setInterval(chatlist_refresh, 500);

            setInterval(friend_requests_count_refresh, 500);

            setInterval(num_unread_chat_refresh, 500);

            $("#load_post_loves").click(function(){

                var post_id = $(this).attr("post_id");

                var url = "includes/post_loves.jsp?post_id="+post_id;

                $("#post_component").load(url);

            });

            $("#load_post_comments").click(function(){

                var post_id = $(this).attr("post_id");

                var url = "includes/post_comments.jsp?post_id="+post_id;

                $("#post_component").load(url);

            });

        </script>

        <script type="text/javascript" src="controller/post_operations.js"></script>
        <script type="text/javascript" src="controller/friend_requests.js"></script>

	</body>
</html>

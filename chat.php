<!DOCTYPE html>
<html>
    <head>
	       <title>Social Media -> Akashi Senpai</title>

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

        <div class="">
            <div class="col-md-3 col-sm-4 col-xs-12 w3-grey friends_view chat_hide">
                <?php require_once "views/chat_chatlist.php" ?>
            </div>

            <div class="col-md-9 col-sm-8 col-xs-12 chat_view chat_show">
                <div class="row w3-light-grey w3-padding-top w3-padding-bottom">
                    <div class="col-md-1 col-sm-3 col-xs-3 w3-padding-top">
                        <img src="assets/images/img_avatar.png" class="img-circle" style="width: 100%; max-height: 65px; max-width: 70px; border: 2px solid black;"/>
                    </div>
                    <div class="col-md-11 col-sm-9 col-xs-9">
                        <h5>
                            Akashi Senpai
                            <span class="w3-green w3-circle" style="width: 10px; padding: 1px;height: 10px;">AC</span>
                        </h5>
                        <span>
                            <span><b class="w3-text-blue">@senpai_akashi</span>
                        </span>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 w3-padding-top">

                    </div>
                </div>

                <div id="actual_chat" style="margin-top: 20px;">
                    <div class="row w3-margin-bottom">
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <button class="btn btn-primary">Yo Niggs How Far</button>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                    </div>
                    <div class="row w3-margin-bottom">
                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                        <div class="col-md-10 col-sm-10 col-xs-10 w3-right-align">
                            <button class="btn btn-primary">My G i dey alright</button>
                        </div>
                    </div>
                    <div class="row w3-margin-bottom">
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <button class="btn btn-primary">That Aptech Project Wan Mad Die</button>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                    </div>
                    <div class="row w3-margin-bottom">
                        <div class="col-md-2 col-sm-2 col-xs-2"></div>
                        <div class="col-md-10 col-sm-10 col-xs-10 w3-right-align">
                            <button class="btn btn-primary">I Swear</button>
                        </div>
                    </div>
                </div>

                <div class="message_box w3-teal w3-padding w3-margin-top">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <form id="send_message">
                                    <div class="col-md-9 col-sm-8 col-xs-8">
                                        <input type="text" name="message" class="form-control" placeholder="Enter Message" style="border-radius: 0px;"/>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-4">
                                        <button type="submit" class="btn btn-success btn-block" style="border-radius: 0px;">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script type="text/javascript" src="controller/components_refresh.js"></script>

        <script type="text/javascript">

            setInterval(friend_requests_count_refresh, 500);

            setInterval(num_unread_chat_refresh, 500);

        </script>

        <script type="text/javascript" src="controller/chat.js"></script>
	</body>
</html>

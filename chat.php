<?php

    require_once "includes/__auth_check.php";


    require_once "classes/Chat.class.php";

    $chat_obj = new Chat();


    $flag = false;


    if(isset($_GET["fr"]) && $_GET["fr"] != ""){

        $friend_exists = $users_obj->friend_exists($_GET["fr"]);

        if($friend_exists[0]){

            $fr_data = $friend_exists[1];

            if($fr_data["User1"] == $__user_details["UserID"] || $fr_data["User2"] == $__user_details["UserID"]){

                $user_id = ($fr_data["User1"] == $__user_details["UserID"]) ? $fr_data["User2"] : $fr_data["User1"];

                $user_details = $users_obj->user_exists("UserID", $user_id)[1];

                if($user_details["ProfilePicture"] == NULL){

                    $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "assets/images/img_avatar.png" : "assets/images/img_avatar2.png";

                }else{

                    $user_details["ProfilePicture"] = "users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];

                }

                $chat_obj->update_messages_read($_GET["fr"], $__user_details["UserID"]);

                $flag = true;

            }

        }

    }

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

        <div>
            <div class="col-md-3 col-sm-4 col-xs-12 w3-grey friends_view chat_hide w3-light">
                <?php require_once "views/chat_chatlist.php" ?>
            </div>

            <?php

                if($flag){

                    ?>
                    <div class="col-md-9 col-sm-8 col-xs-12 chat_view chat_show">
                        <div class="row w3-light-grey w3-padding-top w3-padding-bottom">
                            <div class="col-md-1 col-sm-3 col-xs-3 w3-padding-top">
                                <img src="<?= $user_details["ProfilePicture"] ?>" class="img-circle" style="width: 100%; max-height: 65px; max-width: 70px; border: 2px solid black;"/>
                            </div>
                            <div class="col-md-11 col-sm-9 col-xs-9">
                                <h5>
                                    <?= $user_details["FullName"] ?>
                                    <?php

                                        if($user_details["OnlineStatus"] == 1){

                                            ?>
                                            <span class="w3-green w3-circle" style="width: 10px; padding: 1px;height: 10px;">AC</span>
                                            <?php

                                        }

                                    ?>
                                </h5>
                                <span>
                                    <span><b class="w3-text-blue">@<?= $user_details["Username"] ?></span>
                                </span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 w3-padding-top">

                            </div>
                        </div>

                        <div id="actual_chat" style="margin-top: 20px; padding-bottom: 50px;">
                            <?php

                                $messages = $chat_obj->get_messages($_GET["fr"]);

                                foreach($messages as $message){

                                    if($message["MessageTo"] == $__user_details["UserID"]){

                                        ?>
                                        <div class="row w3-margin-bottom" id="cht__<?= $message["ID"] ?>">
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                <button class="btn btn-primary" id="msg__<?= $message["ID"] ?>"><?= $message["Message"] ?></button>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                        </div>
                                        <?php

                                    }else{

                                        ?>
                                        <div class="row w3-margin-bottom" id="cht__<?= $message["ID"] ?>">
                                            <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                            <div class="col-md-10 col-sm-10 col-xs-10 w3-right-align">
                                                <span style="cursor: pointer; text-decoration: underline" class="text-danger" onclick="delete_chat(<?= $message["ID"] ?>)">Delete</span>
                                                <span style="cursor: pointer;  text-decoration: underline" class="text-primary" onclick="edit_chat(<?= $message["ID"] ?>, `<?= $message["Message"] ?>`)">Edit</span>
                                                <button class="btn btn-primary" id="msg__<?= $message["ID"] ?>"><?= $message["Message"] ?></button>
                                            </div>
                                        </div>
                                        <?php

                                    }

                                }

                            ?>
                        </div>

                        <div class="message_box w3-teal w3-padding w3-margin-top col-md-9 col-sm-8 col-xs-12" style="position: fixed; bottom: 0; right: 0px;">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <form id="send_message">
                                            <input type="hidden" name="friend_id" value="<?= $_GET["fr"] ?>"/>
                                            <div class="col-md-9 col-sm-8 col-xs-8">
                                                <input type="text" name="message" class="form-control" placeholder="Enter Message" required style="border-radius: 0px;"/>
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
                    <?php

                }else{

                    ?>
                    <div class="col-md-9 col-sm-8 col-xs-12 chat_view chat_show text-center" style="display: flex; align-items: center; justify-content: center;">
                        <div class="d-block">
                            <h3>No messages</h3>
                            <p>Nothing to show here</p>
                        </div>
                    </div>
                    <?php

                }

            ?>
        </div>

        <div id="updateChatModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Message</h4>
              </div>
              <form id="update_chat_form">
                  <input type="hidden" name="chat_id" value=""/>
                  <div class="modal-body">
                      <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <label>Message</label>
                                <textarea name="message" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <span class="server_response"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>

          </div>
        </div>

        <script type="text/javascript" src="controller/chat.js"></script>
	</body>
</html>

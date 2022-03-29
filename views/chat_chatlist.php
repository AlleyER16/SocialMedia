<?php

    require_once "classes/Users.class.php";
    require_once "classes/Chat.class.php";

    $users_obj = new Users();
    $chat_obj = new Chat();

    $friends = $users_obj->get_friends($__user_details["UserID"]);

    $total_messages = 0;

    foreach($friends as $friend){

        $total_messages = $total_messages + $chat_obj->get_num_unread_message($friend["ID"], $__user_details["UserID"]);

    }

?>
<div class="row w3-padding-top w3-padding-bottom navbar-default w3-teal w3-padding-left">
    Message
    <?php

        if($total_messages >= 1){

            ?>
            <button class="w3-right badge w3-green w3-margin-right" style="border: none;">2</button>
            <?php

        }

    ?>
</div>
<div class="row">
    <?php

        if(count($friends) >= 1){

            foreach($friends as $friend){

                $user_id = ($friend["User1"] == $__user_details["UserID"]) ? $friend["User2"] : $friend["User1"];

                $user_details = $users_obj->user_exists("UserID", $user_id)[1];

                if($user_details["ProfilePicture"] == NULL){

                    $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "assets/images/img_avatar.png" : "assets/images/img_avatar2.png";

                }else{

                    $user_details["ProfilePicture"] = "users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];

                }

                $last_message = $chat_obj->get_last_chat_message($friend["ID"]);
                $num_unread_message = $chat_obj->get_num_unread_message($friend["ID"], $__user_details["UserID"]);

                ?>
                <a href="chat.php?fr=<?= $friend["ID"] ?>">
                    <button type="submit" class="navbar-default col-md-12 w3-padding-top w3-padding-bottom btn btn-link w3-light-grey w3-hover-blue" style="padding: 0px;">
                        <div class="col-md-3 col-sm-3">
                            <img src="<?= $user_details["ProfilePicture"] ?>" class="img-circle" style="width: 100%; max-height: 60px; min-width: 50px; border: 2px solid black;"/>
                            <?php

                                if($user_details["OnlineStatus"] == 1){

                                    ?>
                                    <span class="w3-green w3-circle bottom-right1" style="width: 10px; height: 10px;"></span>
                                    <?php

                                }

                            ?>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6" style="overflow: hidden; white-space: nowrap;">
                                    <span class="w3-left"><?= $user_details["FullName"] ?></span>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <span>
                                        <?php
                                            if($friend["LastMessageTimestamp"] != NULL){
                                                if(date("d/m/Y", time()) == date("d/m/Y", $friend["LastMessageTimestamp"])){
                                                    echo date("h:ia", $friend["LastMessageTimestamp"]);
                                                }else{
                                                    echo date("d/m/Y", $friend["LastMessageTimestamp"]);
                                                }
                                            }

                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="row w3-padding-top w3-padding-bottom">
                                <div class="col-md-9 col-sm-9" style="overflow: hidden; white-space: nowrap;">
                                    <span class=" w3-left">
                                    <?php

                                        if($last_message[0]){

                                            $message = $last_message[1];

                                            if($message["MessageFrom"] == $__user_details["UserID"]){

                                                if($message["ReadStatus"] == 1){

                                                    ?>
                                                    <i class="fa fa-check"></i>
                                                    <i class="fa fa-check"></i>
                                                    <?php

                                                }else{

                                                    ?>
                                                    <i class="fa fa-check"></i>
                                                    <?php

                                                }



                                            }

                                            echo $message["Message"];

                                        }else{

                                            echo "No messages yet";

                                        }

                                    ?>
                                    </span>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <?php

                                        if($num_unread_message >= 1){

                                            ?>
                                            <span class="badge w3-circle"><?= $num_unread_message ?></span>
                                            <?php

                                        }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </button>
                </a>
                <?php

            }

        }else{

            ?>
            <button type="submit" class="navbar-default col-md-12 w3-padding-top w3-padding-bottom btn btn-link w3-light-grey w3-hover-blue" style="padding: 0px;">
                <div class="col-lg-12 text-center">
                    You have no friends
                </div>
            </button>
            <?php

        }

    ?>
</div>

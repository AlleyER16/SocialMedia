<?php

    require_once "classes/Users.class.php";

    $users_obj = new Users();

    $friends = $users_obj->get_friends($__user_details["UserID"]);

    $num_friends = count($friends);

?>
<div class="friendrequest w3-margin-top">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Friends <span class="badge" id="__num_friends"><?= $num_friends ?></span></div>
                <div class="panel-body">
                    <?php

                        if($num_friends >= 1){

                            foreach ($friends as $friend) {

                                $user_id = ($friend["User1"] == $__user_details["UserID"]) ? $friend["User2"] : $friend["User1"];

                                $user_details = $users_obj->user_exists("UserID", $user_id)[1];

                                if($user_details["ProfilePicture"] == NULL){

                                    $user_details["ProfilePicture"] = ($user_details["Gender"] == "Male") ? "assets/images/img_avatar.png" : "assets/images/img_avatar2.png";

                                }else{

                                    $user_details["ProfilePicture"] = "users/".$user_details["UserID"]."/".$user_details["ProfilePicture"];

                                }

                                ?>
                                <div class="row w3-margin-bottom" id="friend__<?= $user_details["UserID"] ?>">
                                    <div class="col-md-3 col-sm-3 col-xs-4">
                                        <img src="<?= $user_details["ProfilePicture"] ?>" class="img-rounded" style="width: 100px; height: 100px"/>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-8" style="padding-top: 10px;">
                                        <b><?= $user_details["FullName"] ?></b><br/>
                                        <span>@<?= $user_details["Username"] ?></span>
                                        <div class="row">
                                            <div class="col-xs-12" type="decline_request">
                                                <form class="decline_friend_request">
                                                    <input type="hidden" name="user_id" value="<?= $user_details["UserID"] ?>"/>
                                                    <button type="submit" class="btn btn-sm btn-danger">UNFRIEND</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php

                            }

                        }else{

                            ?>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    You have no friends
                                </div>
                            </div>
                            <?php

                        }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

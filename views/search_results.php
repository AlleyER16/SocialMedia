<?php

    require_once "classes/Users.class.php";

    $users_obj = new Users();

    $search_results = $users_obj->search_users($__user_details["UserID"], $search);

    $num_search_results = count($search_results);

?>
<div class="friendrequest w3-margin-top">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Search Results <span class="badge"><?= $num_search_results ?></span></div>
                <div class="panel-body">
                    <?php

                        if($num_search_results >= 1){

                            foreach ($search_results as $user) {

                                if($user["ProfilePicture"] == NULL){

                                    $user["ProfilePicture"] = ($user["Gender"] == "Male") ? "assets/images/img_avatar.png" : "assets/images/img_avatar2.png";

                                }else{

                                    $user["ProfilePicture"] = "users/".$user["UserID"]."/".$user["ProfilePicture"];

                                }

                                if($users_obj->are_friends($user["UserID"], $__user_details["UserID"])){

                                    ?>
                                    <div class="row w3-margin-bottom" id="friend__<?= $user["UserID"] ?>">
                                        <div class="col-md-3 col-sm-3 col-xs-4">
                                            <img src="<?= $user["ProfilePicture"] ?>" class="img-rounded" style="width: 100px; height: 100px"/>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-8" style="padding-top: 10px;">
                                            <b><?= $user["FullName"] ?></b><br/>
                                            <span>@<?= $user["Username"] ?></span>
                                            <div class="row">
                                                <div class="col-xs-12" type="decline_request">
                                                    <form class="decline_friend_request">
                                                        <input type="hidden" name="user_id" value="<?= $user["UserID"] ?>"/>
                                                        <button type="submit" class="btn btn-sm btn-danger">UNFRIEND</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                }else{

                                    $friend_request_exists = $users_obj->friend_request_exists($user["UserID"], $__user_details["UserID"]);

                                    if($friend_request_exists[0]){

                                        $fr_data = $friend_request_exists[1];

                                        if($fr_data["User"] == $__user_details["UserID"]){

                                            ?>
                                            <div class="row w3-margin-bottom" id="fr__<?= $user["UserID"] ?>">
                                                <div class="col-md-3 col-sm-3 col-xs-4">
                                                    <img src="<?= $user["ProfilePicture"] ?>" class="img-rounded" style="width: 100px; height: 100px"/>
                                                </div>
                                                <div class="col-md-9 col-sm-9 col-xs-8" style="padding-top: 10px;">
                                                    <b><?= $user["FullName"] ?></b><br/>
                                                    <span>@<?= $user["Username"] ?></span>
                                                    <div class="row">
                                                        <div class="col-xs-6" type="accept_request">
                                                            <form class="accept_friend_request">
                                                                <input type="hidden" name="user_id" value="<?= $user["UserID"] ?>"/>
                                                                <button type="submit" class="btn btn-sm btn-success">ACCEPT</button>
                                                            </form>
                                                        </div>
                                                        <div class="col-xs-6" type="decline_request">
                                                            <form class="decline_friend_request">
                                                                <input type="hidden" name="user_id" value="<?= $user["UserID"] ?>"/>
                                                                <button type="submit" class="btn btn-sm btn-danger">DECLINE</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                        }else if($fr_data["RequestedBy"] == $__user_details["UserID"]){

                                            ?>
                                            <div class="row w3-margin-bottom">
                                                <div class="col-md-3 col-sm-3 col-xs-4">
                                                    <img src="<?= $user["ProfilePicture"] ?>" class="img-rounded" style="width: 100px; height: 100px"/>
                                                </div>
                                                <div class="col-md-9 col-sm-9 col-xs-8" style="padding-top: 10px;">
                                                    <b><?= $user["FullName"] ?></b><br/>
                                                    <span>@<?= $user["Username"] ?></span>
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <form class="remove_friend_request">
                                                                <input type="hidden" name="user_id" value="<?= $user["UserID"] ?>"/>
                                                                <button type="submit" class="btn btn-sm btn-danger">REMOVE REQUEST</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                        }

                                    }else{

                                        ?>
                                        <div class="row w3-margin-bottom" id="pymn__<?= $user["UserID"] ?>">
                                            <div class="col-md-3 col-sm-3 col-xs-4">
                                                <img src="<?= $user["ProfilePicture"] ?>" class="img-rounded" style="width: 100px; height: 100px"/>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-8" style="padding-top: 10px;">
                                                <b><?= $user["FullName"] ?></b><br/>
                                                <span class="w3-text-amber">@<?= $user["Username"] ?></span>
                                                <div class="row">
                                                    <div class="col-xs-6" type="add_friend">
                                                        <form class="add_friend">
                                                            <input type="hidden" name="user_id" value="<?= $user["UserID"] ?>"/>
                                                            <button type="submit" class="btn btn-sm btn-success">ADD FRIEND</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-xs-6" type="remove_person">
                                                        <form class="remove_friend">
                                                            <input type="hidden" name="user_id" value="<?= $user["UserID"] ?>"/>
                                                            <button type="submit" class="btn btn-sm btn-danger">REMOVE</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php

                                    }

                                }

                            }

                        }else{

                            ?>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    No search results
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

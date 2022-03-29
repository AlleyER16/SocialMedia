<?php

    require_once "classes/Users.class.php";

    $users_obj = new Users();

    $peoples = $users_obj->get_people_you_may_know($__user_details["UserID"]);

    $num_pymn = count($peoples);

?>
<div class="friendrequest w3-margin-top">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">People You May Know</div>
                <div class="panel-body">
                    <?php

                        if($num_pymn >= 1){

                            foreach ($peoples as $user) {

                                if($user["ProfilePicture"] == NULL){

                                    $user["ProfilePicture"] = ($user["Gender"] == "Male") ? "assets/images/img_avatar.png" : "assets/images/img_avatar2.png";

                                }else{

                                    $user["ProfilePicture"] = "users/".$user["UserID"]."/".$user["ProfilePicture"];

                                }

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

                        }else{

                            ?>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    There are no friends suggestions rignt now
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

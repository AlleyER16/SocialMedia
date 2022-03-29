<?php

    require_once "classes/Users.class.php";

    $users_obj = new Users();

    $peoples = $users_obj->get_people_you_may_know($__user_details["UserID"]);

    if(count($peoples) >= 1){

        ?>
        <div class="navbar-default w3-margin-top img-rounded" id="disp">
            <h6 class="w3-padding">People you may know</h6>

            <div class="dscrollmenu">
                <?php

                    foreach ($peoples as $person) {

                        if($person["ProfilePicture"] == NULL){

                            $person["ProfilePicture"] = ($person["Gender"] == "Male") ? "assets/images/img_avatar.png" : "assets/images/img_avatar2.png";

                        }else{

                            $person["ProfilePicture"] = "users/".$person["UserID"]."/".$person["ProfilePicture"];

                        }

                        ?>
                        <span id="pymn__<?= $person["UserID"] ?>">
                            <div class="col-xs-12">
                                <div class="thumbnail">
                                    <img src="<?= $person["ProfilePicture"] ?>" class="img-rounded" style="width: 100%; height: 260px;"/>
                                    <div class="caption" style="width: 100%; height: 110px;">
                                        <h6><?= $person["FullName"] ?></h6>
                                        <span class="w3-padding-bottom w3-text-amber"> @<?= $person["Username"] ?></span>
                                        <div class="row w3-padding-bottom">
                                            <div class="col-xs-6" type="add_friend">
                                                <form class="add_friend">
                                                    <input type="hidden" name="user_id" value="<?= $person["UserID"] ?>"/>
                                                    <button type="submit" class="btn btn-sm btn-block btn-success">ADD FRIEND</button>
                                                </form>
                                            </div>
                                            <div class="col-xs-6" type="remove_person">
                                                <form class="remove_friend">
                                                    <input type="hidden" name="user_id" value="<?= $person["UserID"] ?>"/>
                                                    <button type="submit" class="btn btn-sm btn-block btn-danger">REMOVE</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                        <?php

                    }

                ?>
            </div>
        </div>
        <?php

    }

?>

<?php

    require_once "includes/__auth_check.php";

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

                    <div class="row w3-margin-top">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Name</div>
                                <div class="panel-body">
                                    <div class="row w3-margin-bottom">
                                        <form id="change_name_form">
                                            <div class="col-md-12">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" name="full_name" placeholder="Enter First Name" value="<?= $__user_details["FullName"] ?>" style="border-radius: 0px;"/>
                                            </div>
                                            <div class="col-md-12 w3-margin-top">
                                                <button type="submit" class="btn btn-success btn-block" style="border-radius: 0px;">Update Name</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Change Username</div>
                                <div class="panel-body">
                                    <div class="row w3-margin-bottom">
                                        <form id="change_username_form">
                                            <div class="col-md-12">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?= $__user_details["Username"] ?>" style="border-radius: 0px;"/>
                                            </div>
                                            <div class="col-md-12 w3-margin-top">
                                                <button type="submit" class="btn btn-success btn-block" style="border-radius: 0px;">Update Username</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Change Telephone</div>
                                <div class="panel-body">
                                    <div class="row w3-margin-bottom">
                                        <form id="change_telephone_form">
                                            <div class="col-md-12">
                                                <label>Telephone</label>
                                                <input type="tel" class="form-control" name="telephone" placeholder="Enter Telephone Number" value="<?= $__user_details["Telephone"] ?>" style="border-radius: 0px;"/>
                                            </div>
                                            <div class="col-md-12 w3-margin-top">
                                                <button type="submit" class="btn btn-success btn-block" style="border-radius: 0px;">Update Telephone</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Change Password</div>
                                <div class="panel-body">
                                    <div class="row w3-margin-bottom">
                                        <form id="password_update_form">
                                            <div class="col-md-12">
                                                <label>Current Password</label>
                                                <input type="password" class="form-control" name="current_password" placeholder="Enter Old Password" style="border-radius: 0px;"/>
                                            </div>
                                            <div class="col-md-12 w3-margin-top">
                                                <label>New Password</label>
                                                <input type="password" class="form-control" name="new_password" placeholder="Enter New Password" style="border-radius: 0px;"/>
                                            </div>
                                            <div class="col-md-12 w3-margin-top">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password" style="border-radius: 0px;"/>
                                            </div>
                                            <div class="col-md-12 w3-margin-top">
                                                <button type="submit" class="btn btn-success btn-block" style="border-radius: 0px;">Update Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="chatlist" class="col-md-2 col-sm-4 w3-padding-top w3-border-left w3-light-grey w3-padding-bottom chat_section">
                    <?php require_once "views/chat_list.php" ?>
                </div>

            </div>

        </div>

        <script src="controller/settings.js"></script>
	</body>
</html>

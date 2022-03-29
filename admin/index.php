<?php

    require_once "includes/__auth_func.php";

    $__page = "analytics";

    $__pg = (isset($_GET["page"]) && $_GET["page"] != "") ? $_GET["page"] : 1;
    $__division = 8;

    require_once "../classes/Users.class.php";

    $users_obj = new Users();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Users - Admin</title>

        <?php require_once "includes/meta_tags.php"; ?>

        <?php require_once "includes/top_resources.php"; ?>
    </head>
    <body>

        <div class="container">
            <div class="row" style="padding-top: 50px;">
                <div class="col-lg-6">
                    <h1>Admin</h1>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="logout.php">Logout</a>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Username</th>
                                    <th>Telephone</th>
                                    <th>Date of Birth</th>
                                    <th>Timestamp</th>
                                    <th>Analytics</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $users = $users_obj->get_users($__pg, $__division);

                                    $counter = 0;

                                    foreach ($users as $user) {

                                        $counter++;

                                        ?>
                                        <tr>
                                            <td><?= $counter ?></td>
                                            <td><?= $user["FullName"] ?></td>
                                            <td><?= $user["Gender"] ?></td>
                                            <td><?= $user["Username"] ?></td>
                                            <td><?= $user["Telephone"] ?></td>
                                            <td><?= $user["DateOfBirth"] ?></td>
                                            <td>
                                                <?= date("d-m-Y h:ia", $user["Timestamp"]) ?>
                                            </td>
                                            <td>
                                                <?= $users_obj->get_num_friends($user["UserID"]) ?> Friends<br/>
                                                <?= $users_obj->get_num_friend_requests($user["UserID"]) ?> Friend Requests<br/>
                                                <?= $users_obj->get_num_friend_requests_sent($user["UserID"]) ?> Friend Requests Sent<br/>
                                                <?= $users_obj->get_num_removed($user["UserID"]) ?> Removed
                                            </td>
                                        </tr>
                                        <?php

                                    }

                                    if($counter == 0){

                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-center">There are no users</td>
                                        </tr>
                                        <?php

                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <ul class="pagination justify-content-center">
                        <?php

                            $pagination = $users_obj->get_users_pagination($__division);

                            for($i = 1; $i <= $pagination; $i++){

                                ?>
                                <li class="page-item <?= ($i == $__pg) ? "active" : "" ?>"><a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                                <?php

                            }

                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php require_once "includes/bottom_resources.php"; ?>

    </body>
</html>

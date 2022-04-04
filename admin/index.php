<?php

    require_once "includes/__auth_func.php";

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
                <div class="col-lg-12 mt-4 text-center">
                    <a href="index.php" class="btn btn-primary">Users</a>
                    <a href="posts.php" class="btn btn-outline-primary">Posts</a>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $users = $users_obj->get_users($__pg, $__division);

                                    $counter = 0;

                                    foreach ($users as $user) {

                                        $counter++;

                                        if($user["ProfilePicture"] == NULL){

                                            $user["ProfilePicture"] = ($user["Gender"] == "Male") ? "../assets/images/img_avatar.png" : "../assets/images/img_avatar2.png";
                                    
                                        }else{
                                    
                                            $user["ProfilePicture"] = "../users/".$user["UserID"]."/".$user["ProfilePicture"];
                                    
                                        }

                                        ?>
                                        <tr>
                                            <td><?= $counter ?></td>
                                            <td>
                                                <img src="<?= $user["ProfilePicture"] ?>" style="width: 50px; height: 50px;" class="rounded-circle"/>
                                                <?= $user["FullName"] ?>
                                            </td>
                                            <td><?= $user["Gender"] ?></td>
                                            <td><?= $user["Username"] ?></td>
                                            <td><?= $user["Telephone"] ?></td>
                                            <td><?= $user["DateOfBirth"] ?></td>
                                            <td>
                                                <?= date("d-m-Y h:ia", $user["Timestamp"]) ?>
                                            </td>
                                            <td>
                                                <a href="user.php?user_id=<?= $user["UserID"] ?>" class="btn btn-success">View</a>
                                                <button class="btn btn-danger" onclick="delete_user($(this), <?= $user['UserID'] ?>)">Delete</button>
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

        <script type="text/javascript">
            const delete_user = (trigger_btn, user_id) => {

                trigger_btn.html("Deleting...").attr("disabled", "disabled");

                $.ajax({
                    type: "GET",
                    data: {user_id},
                    url: "models/delete_user.php",
                    success: function(data) {
                        data = $.trim(data);

                        if(data == "User deleted successfully"){
                            window.location.reload();
                        }else{
                            alert(data);
                            trigger_btn.removeAttr("disabled").html("Delete");
                        }
                    }
                });

            }
        </script>

    </body>
</html>

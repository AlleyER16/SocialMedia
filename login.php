<!DOCTYPE html>
<html>
    <head>
        <title>Social Media Login</title>

        <?php require_once "includes/meta.php" ?>

        <?php require_once "includes/resources.php" ?>
    </head>
    <body class="bg-primary">

        <?php require_once "views/login_signup_header.php" ?>

        <?php require_once "views/feedback_divs.php" ?>

        <div class="container" style="margin-top: 10%;">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 form-div" style="padding: 24px; border-radius: 15px;">
                <h1 class="w3-center">Login</h1>
                <p class="w3-center">Login to your account</p>
                <form id="login_form">

                    <div class="form-group">

                        <label class="w3-text-white">Username</label>

                        <div class="input-group">
                            <input type="text" class="form-control" name="username" placeholder="Enter Username" autocomplete="off">

                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default">
                                    <i class="fa fa-phone"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="w3-text-white">Password:</label>

                        <div class="input-group">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" autocomplete="off" />

                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default" id="show_password">
                                    <i class="fa fa-lock"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <input type="submit" class="btn btn-success" value="Login"/> <input type="reset" class="btn btn-danger"/>

                </form>

                <p class="w3-text-white" style="margin-top: 10px;">
                    Do not have an account <a href="signup.php" class="w3-text-blue w3-underline">Create</a>
                </p>

            </div>

        </div>

        <script type="text/javascript" src="controller/login.js"></script>
    </body>
</html>

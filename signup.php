<!DOCTYPE html>
<html>
    <head>
        <title>ABook Sign Up</title>

        <?php require_once "includes/meta.php" ?>

        <?php require_once "includes/resources.php" ?>
    </head>
    <body class="bg-primary">

        <?php require_once "views/login_signup_header.php" ?>

        <?php require_once "views/feedback_divs.php" ?>

        <div class="container">
            <div class="cont">
                <div class="col-md-6 col-sm-5 w3-padding m-disp-none">
                    <h4 class="w3-text-white w3-center login-text w3-margin-top" >Welcome to ABook</h4>
                    <img src="assets/images/pallor.jpg" width="100%" class="w3-margin-bottom"/>
                    <p class="w3-justify">Create an ABook Account we will guide you through all the steps from the signup you can do many things with ABook with ABook you can:</p>

                    <p class="w3-center"><span class="fa fa-share"></span> Connect with people around the world</p>
                    <p class="w3-center"><span class="fa fa-share"></span> Chat with people</p>
                    <p class="w3-center"><span class="fa fa-share"></span> Store files</p>
                </div>

                <div class="col-md-4 col-md-offset-1 col-sm-7">

                    <h1 class="w3-text-white w3-center">Sign up</h1>
                    <p class="w3-text-white w3-center login-text">Sign up with ABook</p>

                    <hr/>

                    <form id="signup_form">

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="w3-text-white w3-label">Full Name</label>
                                <input type="text" class="form-control" name="full_name" placeholder="Enter Full Name"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 form-group">
                                <label class="w3-text-white">Gender</label>
                                <select class="form-control" name="gender" oninput="this.style.background = 'white' ">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control"/>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label class="w3-text-white">Telephone</label>
                                <input type="tel" name="telephone" class="form-control" placeholder="Enter Telephone">
                            </div>
                            <div class="form-group">
                                <label class="w3-text-white">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Username">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 form-group">
                                <label class="w3-text-white">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password">
                                        <div class="input-group-btn">
                                        <button  type="button" class="btn btn-default" id="show_password">
                                            <i class="fa fa-lock"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 form-group">
                                <label class="w3-text-white">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    <div class="input-group-btn">
                                        <button  type="button" class="btn btn-default" id="show_confirm_password">
                                            <i class="fa fa-lock"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-success" value="Sign Up"/>
                        <input type="reset" class="btn btn-danger"/>

                    </form>

                    <hr/>

                    <p class="w3-margin-top w3-text-white">Already have an account <a href="login.php" class="w3-text-blue w3-underline">login</a></p>

                </div>

            </div>
        </div>

        <script type="text/javascript" src="controller/signup.js"></script>
    </body>
</html>

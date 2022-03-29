<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>Login - Bank</title>

        <?php require_once "includes/meta_tags.php"; ?>

        <?php require_once "includes/top_resources.php"; ?>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="card" style="margin-top: 50px;">
                        <div class="card-body">
                            <form id="login_form">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <h3>Login</h3>
                                        <p>Login to your account</p>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Enter username" required/>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter password" required/>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success btn-block">Login</button>
                                    </div>
                                    <div class="col-lg-12 mt-3 text-center">
                                        <span class="server_response"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once "includes/bottom_resources.php"; ?>

        <script type="text/javascript">
            $(document).ready(function() {

                $("#login_form").submit(function(e) {

                    e.preventDefault();

                    const submit_button = $(this).find("button[type='submit']");
                    const server_response = $(this).find("span[class='server_response']");

                    submit_button.html("Logging in...").attr("disabled", "disabled");

                    const form_data = $(this).serialize();

                    $.ajax({
                        type: "POST",
                        data: form_data,
                        url: "models/login.php",
                        success: function(data) {
                            data = $.trim(data);

                            if(data == "Login successfully"){

                                window.location = "index.php";

                            }else{
                                server_response.html(data);
                                submit_button.removeAttr("disabled").html("Login");
                            }
                        }
                    });

                });

            });
        </script>
    </body>
</html>

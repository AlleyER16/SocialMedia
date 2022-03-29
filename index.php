<?php

    $__force_redirect = false;

    require_once "includes/__auth_check.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Social Media</title>

        <?php require_once "includes/meta.php" ?>

        <?php require_once "includes/resources.php" ?>
    </head>
    <body onload="need()" class="bg-primary">

        <div class="container">
            <div class="welcome col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h1 class="w3-center w3-text-white">Social Media</h1>
                <p class="w3-center w3-text-white"><b>Welcome <?= ($__user_details != []) ? $__user_details["FullName"] : "to Social Media" ?></b></p>
                <div class="progress">
                    <div id="progress"class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                        <span id="value" >Loading...</span>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function move() {
              var elem = document.getElementById("progress");
              var value = document.getElementById("value");
              var width = 20;
              var id = setInterval(frame, 50);
              function frame() {
                if (width >= 100) {
                  clearInterval(id);
                } else {
                  width++;
                  elem.style.width = width + '%';
                  //value.innerHTML = width * 1  + '%';
                }
              }
            }
            function int()
            {
                var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                window.location.assign("home.php");
            }
            function need()
            {
                move();
                setInterval(int, 4500);
            }
        </script>

    </body>
</html>

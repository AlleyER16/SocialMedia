
function display_feedback(message){

    $("#show_operation_message").find("#message").html(message);

    $("#show_loading").slideUp("fast");

    interval = setInterval(function(){

        $("#show_operation_message").slideDown("fast").delay(1000);
        $("#show_operation_message").toggle("fast");

        clearInterval(interval);

    }, 500);

}

$(document).ready(function() {

    $("#show_password").click(function() {

        var password_field_object = $("#password");

        var field_type = password_field_object.attr("type");

        if(field_type === "password"){

            password_field_object.attr("type", "text");
            $(this).html("<span class=\"fa fa-unlock\"></span>");

        }else if(field_type === "text"){

            password_field_object.attr("type", "password");
            $(this).html("<span class=\"fa fa-lock\"></span>");

        }

    });

    $("#login_form").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var telephone = $(this).find("input[name='telephone']").val();
        var password = $(this).find("input[name='password']").val();

        var form_data = $(this).serialize();

        $.ajax({

            url: "models/login.php",
            type: "post",
            data: form_data,
            success: function(data){

                if(jQuery.trim(data) === "Account Verified. Logging in..."){

                    display_feedback(jQuery.trim(data));

                    signup_redirect_interval = setInterval(function() {

                        window.location = "home.php";

                    }, 1000);

                }else{

                    display_feedback(jQuery.trim(data));

                }

            },
            error: function(){

                display_feedback("Error Logging In. Retry");

            }

        });

    });

});


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

    $("#password_update_form").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var form_data = $(this).serialize();

        $.ajax({

            url: "models/update_password.php",
            type: "post",
            data: form_data,
            success: function(data){

                data = $.trim(data);

                if(data === "Password updated successfully"){

                    $('#password_update_form').trigger("reset");

                }

                display_feedback(data);

            },
            error: function(){

                display_feedback("Error Updating Password. Retry");

            }

        });

    });

    $("#change_name_form").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var form_data = $(this).serialize();

        $.ajax({

            url: "models/update_name.php",
            type: "post",
            data: form_data,
            success: function(data){

                data = $.trim(data);

                if(data === "Name updated successfully"){

                    window.location.reload();return;

                }

                display_feedback(data);

            },
            error: function(){

                display_feedback("Error Updating Name. Retry");

            }

        });

    });

    $("#change_username_form").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var form_data = $(this).serialize();

        $.ajax({

            url: "models/update_username.php",
            type: "post",
            data: form_data,
            success: function(data){

                data = $.trim(data);

                if(data === "Username updated successfully"){

                    window.location.reload();return;

                }

                display_feedback(data);

            },
            error: function(){

                display_feedback("Error Updating Username. Retry");

            }

        });

    });

    $("#change_telephone_form").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var form_data = $(this).serialize();

        $.ajax({

            url: "models/update_telephone.php",
            type: "post",
            data: form_data,
            success: function(data){

                data = $.trim(data);

                if(data === "Telephone updated successfully"){

                    window.location.reload();return;

                }

                display_feedback(data);

            },
            error: function(){

                display_feedback("Error Updating Telephone. Retry");

            }

        });

    });

});

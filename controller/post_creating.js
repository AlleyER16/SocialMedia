
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

    $("#create_post").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var form_data = $(this).serialize();

        $.ajax({

            url: "models/add_post.php",
            type: "post",
            data: form_data,
            success: function(data){

                data = $.trim(data);

                if(data === "Post added successfully"){

                    window.location.reload();

                }else{

                    display_feedback(data);

                }

            },
            error: function(){

                display_feedback("Error Creating Post. Retry");

            }

        });

    });

});


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

    $(".add_friend").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var user_id = $(this).find("input[name='user_id']").val();

        if(user_id === ""){

            display_feedback("Error Sending Friend Request");

        }else{

            //Do Ajax
            var form_data = $(this).serialize();

            //Expected Request File
            var url = "model/";

            $.ajax({

                url: url,
                type: "post",
                data: form_data,
                success: function(data){

                    var test_data = jQuery.trim(data);

                    display_feedback(test_data);

                },
                error: function(){

                    display_feedback("Error Sending Friend Request. Retry");

                }

            });

        }

    });

    $(".remove_friend").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var user_id = $(this).find("input[name='user_id']").val();

        if(user_id === ""){

            display_feedback("Error Removing Friend");

        }else{

            //Do Ajax
            var form_data = $(this).serialize();

            //Expected Request File
            var url = "model/";

            $.ajax({

                url: url,
                type: "post",
                data: form_data,
                success: function(data){

                    var test_data = jQuery.trim(data);

                    display_feedback(test_data);

                },
                error: function(){

                    display_feedback("Error Removing Friend. Retry");

                }

            });

        }

    });

});
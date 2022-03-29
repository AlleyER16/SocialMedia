
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

    $(".accept_friend_request").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        const submit_button = $(this).find("button[type='submit']");

        const user_id = $(this).find("input[name='user_id']").val();

        const accept_request_div = $(`#fr__${user_id}`).find("div[type='accept_request']");
        const decline_request_div = $(`#fr__${user_id}`).find("div[type='decline_request']");

        var form_data = $(this).serialize();

        $.ajax({

            url: "models/accept_friend_request.php",
            type: "post",
            data: form_data,
            success: function(data){

                var data = jQuery.trim(data);

                if(data == "Unauthorized"){

                    window.location = "login.php";
                    return;

                }

                if(data == "Friend request accepted successfully"){

                    submit_button.html("REQUEST ACCEPTED").removeClass("btn-danger").addClass("btn-success");

                    decline_request_div.remove();
                    accept_request_div.removeClass("col-xs-6").addClass("col-xs-12");

                    const num_friend_requests = parseInt($("#__num_fr").html()) - 1;

                    $("#__num_fr").html(num_friend_requests);

                }

                display_feedback(data);

            },
            error: function(){

                display_feedback("Error Accepting Friend Request. Retry");

            }

        });

    });

    $(".remove_friend_request").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        const submit_button = $(this).find("button[type='submit']");

        var form_data = $(this).serialize();

        $.ajax({

            url: "models/remove_friend_request.php",
            type: "post",
            data: form_data,
            success: function(data){

                var data = jQuery.trim(data);

                if(data == "Unauthorized"){

                    window.location = "login.php";
                    return;

                }

                if(data == "Friend request removed successfully"){

                    submit_button.html("REQUEST REMOVED");

                    const num_friend_requests_sent = parseInt($("#__num_frs").html()) - 1;

                    $("#__num_frs").html(num_friend_requests_sent);

                }

                display_feedback(data);

            },
            error: function(){

                display_feedback("Error Removing Friend Request. Retry");

            }

        });

    });

    $(".decline_friend_request").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        const submit_button = $(this).find("button[type='submit']");

        const user_id = $(this).find("input[name='user_id']").val();

        const accept_request_div = $(`#fr__${user_id}`).find("div[type='accept_request']");
        const decline_request_div = $(`#fr__${user_id}`).find("div[type='decline_request']");

        var form_data = $(this).serialize();

        $.ajax({

            url: "models/decline_friend_request.php",
            type: "post",
            data: form_data,
            success: function(data){

                var data = jQuery.trim(data);

                if(data == "Unauthorized"){

                    window.location = "login.php";
                    return;

                }

                if(data == "Friend request declined successfully"){

                    submit_button.html("REQUEST DECLINED");

                    accept_request_div.remove();
                    decline_request_div.removeClass("col-xs-6").addClass("col-xs-12");

                    const num_friend_requests = parseInt($("#__num_fr").html()) - 1;

                    $("#__num_fr").html(num_friend_requests);

                }

                display_feedback(data);

            },
            error: function(){

                display_feedback("Error Declining Friend Request. Retry");

            }

        });

    });

});

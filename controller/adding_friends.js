
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

        const form_data = $(this).serialize();

        const submit_button = $(this).find("button[type='submit']");

        const user_id = $(this).find("input[name='user_id']").val();

        const remove_person_div = $(`#pymn__${user_id}`).find("div[type='remove_person']");
        const add_friend_div = $(`#pymn__${user_id}`).find("div[type='add_friend']");

        $.ajax({

            url: "models/send_friend_request.php",
            type: "post",
            data: form_data,
            success: function(data){

                var data = jQuery.trim(data);

                if(data == "Unauthorized"){

                    window.location = "login.php";return;

                }

                if(data == "Friend request sent successfully"){

                    submit_button.html("FRIEND REQUEST SENT").removeClass("btn-danger").addClass("btn-success");

                    remove_person_div.remove();
                    add_friend_div.removeClass("col-xs-6").addClass("col-xs-12");

                    display_feedback(data);

                }else{

                    display_feedback(data);

                }

            },
            error: function(){

                display_feedback("Error Sending Friend Request. Retry");

            }

        });

    });

    $(".remove_friend").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        const form_data = $(this).serialize();

        const submit_button = $(this).find("button[type='submit']");

        const user_id = $(this).find("input[name='user_id']").val();

        const remove_person_div = $(`#pymn__${user_id}`).find("div[type='remove_person']");
        const add_friend_div = $(`#pymn__${user_id}`).find("div[type='add_friend']");

        $.ajax({

            url: "models/remove_person.php",
            type: "post",
            data: form_data,
            success: function(data){

                var data = jQuery.trim(data);

                if(data == "Unauthorized"){

                    window.location = "login.php";return;

                }

                if(data == "User removed successfully"){

                    submit_button.html("REMOVED");

                    add_friend_div.remove();
                    remove_person_div.removeClass("col-xs-6").addClass("col-xs-12");

                    display_feedback(data);

                }else{

                    display_feedback(data);

                }

            },
            error: function(){

                display_feedback("Error removing person. Retry");

            }

        });

    });

});

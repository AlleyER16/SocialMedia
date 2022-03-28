
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

    $("#advanced_post").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var post_title = $(this).find("input[name='post_title']").val();
        var post_body = $(this).find("textarea").val();

        if(post_title === "" || jQuery.trim(post_body) === ""){

            display_feedback("Fill In All Fields");

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

                    if(jQuery.trim(data) === "Expected Value"){

                        window.location = "post.php";

                    }else{

                        display_feedback(jQuery.trim(data));

                    }

                },
                error: function(){
                    
                    display_feedback("Error Creating Post. Retry");

                }

            });

        }

    });

    $("#create_post").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var post_body = $(this).find("textarea").val();

        if(jQuery.trim(post_body) === ""){

            display_feedback("Fill In All Fields");

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

                    if(jQuery.trim(data) === "Expected Value"){

                        window.location.reload();

                    }else{

                        display_feedback(jQuery.trim(data));

                    }

                },
                error: function(){
                    
                    display_feedback("Error Creating Post. Retry");

                }

            });

        }

    });

});


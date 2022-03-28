
function display_feedback(message){

    $("#show_operation_message").find("#message").html(message);

    $("#show_loading").slideUp("fast");
            
    interval = setInterval(function(){

        $("#show_operation_message").slideDown("fast").delay(1000);
        $("#show_operation_message").toggle("fast");

        clearInterval(interval);

    }, 500);

}

function set_loved(post_id){

    var post_loved_html = ""+
        "<button type=\"button\" class=\"btn btn-link w3-text-black\" style=\"font-size: 15px;\">"+
            "<span class=\"fa fa-heart\"></span> Loved"+
        "</button>";

    $("#post"+post_id).find(".love_post_container").html(post_loved_html);

}

function load_top_comment(post_id){

    var url = "includes/top_post_comment.php?post_id="+post_id;

    $("#post"+post_id).find(".top_post_comment").load(url);

}

function load_num_loves(post_id){

    var request_url = "model/";

    $.ajax({

        url: request_url,
        type: "post",
        data: "post_id="+post_id,
        success: function(data){

            $("#post"+post_id).find(".num_post_loves").html(jQuery.trim(data));

        },
        error: function(){

            display_feedback("Error Refreshing Num Likes");

        }

    });

}

function load_num_comment(post_id){

    var request_url = "model/";

    $.ajax({

        url: request_url,
        type: "post",
        data: "post_id="+post_id,
        success: function(data){

            $("#post"+post_id).find(".num_post_comment").html(jQuery.trim(data));

        },
        error: function(){

            display_feedback("Error Refreshing Num Likes");

        }

    });


}

$(document).ready(function() {

    $(".love_post").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var post_id = $(this).find("input[name='post_id']").val();

        if(post_id === ""){

            display_feedback("Error Reacting To Post");

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

                        load_num_loves(post_id);

                    }else{

                        display_feedback(jQuery.trim(data));

                    }

                },
                error: function(){
                    
                    display_feedback("Error Reacting To Post. Retry");

                }

            });

        }

    });

    $(".comment_post").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var post_id = $(this).find("input[name='post_id']").val();
        var comment = $(this).find("input[name='comment']").val();

        if(post_id === ""){

            display_feedback("Error Reacting To Post");

        }else if(comment === ""){

            display_feedback("Fill In Comment Field");

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

                        load_top_comment(post_id);
                        load_num_comment(post_id);

                    }else{

                        display_feedback(jQuery.trim(data));

                    }

                },
                error: function(){
                    
                    display_feedback("Error Commenting On Post. Retry");

                }

            });

        }

    });

});
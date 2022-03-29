
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

function like_post(trigger_btn, post_id){

    $("#show_loading").slideDown("fast").delay(100);

    $.ajax({

        url: "models/like_post.php",
        type: "post",
        data: {post_id},
        success: function(data){

            data = $.trim(data);

            if(data === "Post liked successfully"){

                trigger_btn.removeAttr("onclick");

                $.ajax({

                    url: "models/get_num_post_likes.php",
                    type: "get",
                    data: {post_id},
                    success: function(data){

                        const btn_html = `
                            <span class="fa fa-heart"></span> <span class="num_post_loves">${data} Likes</span>
                        `;

                        trigger_btn.html(btn_html);

                    }

                });

            }

            display_feedback(data);

        },
        error: function(){

            display_feedback("Error liking post. Retry");

        }

    });

}

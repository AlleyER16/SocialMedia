
function display_feedback(message){

    $("#show_operation_message").find("#message").html(message);

    $("#show_loading").slideUp("fast");
            
    interval = setInterval(function(){

        $("#show_operation_message").slideDown("fast").delay(1000);
        $("#show_operation_message").toggle("fast");

        clearInterval(interval);

    }, 500);

}

function append_message(message){

    var message_html = ""+
        "<div class=\"row w3-margin-bottom\">"+
        "   <div class=\"col-md-2 col-sm-2 col-xs-2\"></div>"+
        "   <div class=\"col-md-10 col-sm-10 col-xs-10 w3-right-align\">"+
        "       <button class=\"btn btn-primary\">"+ message +"</button>"+
        "   </div>"+
        "</div>";

    $("#actual_chat").append(message_html);

}

function refresh_chatlist(){

    url = "includes/chat_chatlist.php";

    $(".friends_view").load(url);

}

//Go bact To
/*
function refresh_new_message(){

}
*/

$(document).ready(function() {  

    chatlist_refresh = setInterval(function(){

        refresh_chatlist();

    }, 1000);

    $("#send_message").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var message = $(this).find("input[name='message']").val();

        if(message === ""){

            display_feedback("Fill In Message Field");

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

                    if(jQuery.trim(data) === "Message Sent"){

                        append_message(message);

                    }else{

                        display_feedback(jQuery.trim(data));

                    }

                },
                error: function(){
                    
                    display_feedback("Error Sending Message. Retry");

                }

            });

        }

    });

});
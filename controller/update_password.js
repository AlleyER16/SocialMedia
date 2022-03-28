
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

        var old_password = $(this).find("input[name='old_password']").val();
        var new_password = $(this).find("input[name='new_password']").val();
        var c_password = $(this).find("input[name='c_password']").val();

        if(old_password === "" || new_password === "" || c_password === ""){

            display_feedback("Fill In All Fields");

        }else{

            if(new_password === c_password){

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

                            display_feedback("Password Updated Successfully");

                        }else{

                            display_feedback(jQuery.trim(data));

                        }

                    },
                    error: function(){
                        
                        display_feedback("Error Updating Password. Retry");

                    }

                });

            }else{

                display_feedback("New Password And Confirm Password Do Not Match");

            }

        }

    });

});
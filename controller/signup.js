
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

    $("#show_password").click(function() {

        var password_field_object = $("#password");

        var field_type = password_field_object.attr("type");

        if(field_type === "password"){

            password_field_object.attr("type", "text");
            $(this).html("<span class=\"fa fa-unlock\"></span>");

        }else if(field_type === "text"){

            password_field_object.attr("type", "password");
            $(this).html("<span class=\"fa fa-lock\"></span>");

        }

    });

    $("#show_confirm_password").click(function() {

        var password_field_object = $("#confirm_password");

        var field_type = password_field_object.attr("type");

        if(field_type === "password"){

            password_field_object.attr("type", "text");
            $(this).html("<span class=\"fa fa-unlock\"></span>");

        }else if(field_type === "text"){

            password_field_object.attr("type", "password");
            $(this).html("<span class=\"fa fa-lock\"></span>");

        }

    });

    $("#signup_form").submit(function(event) {

        event.preventDefault();

        $("#show_loading").slideDown("fast").delay(100);

        var full_name = $(this).find("input[name='full_name']").val();
        var gender = $(this).find("input[name='gender']").val();
        var date_of_birth = $(this).find("input[name='date_of_birth']").val();
        var telephone = $(this).find("input[name='telephone']").val();
        var username = $(this).find("input[name='username']").val();
        var password = $(this).find("input[name='password']").val();
        var confirm_password = $(this).find("input[name='confirm_password']").val();

        if(full_name === "" || gender === "" || date_of_birth === "" || telephone === "" || username === "" || password === "" || confirm_password === ""){

            display_feedback("Fill In All Fields");

        }else{

            if(password === confirm_password){

                //Do Ajax
                var form_data = $(this).serialize();

                //Expected Request File
                var url = "model/signup_db.jsp";

                $.ajax({

                    url: url,
                    type: "post",
                    data: form_data,
                    success: function(data){

                        if(jQuery.trim(data) === "Account Created Successfully. Redirecting..."){

                            display_feedback(jQuery.trim(data));
                            
                            signup_redirect_interval = setInterval(function() {
                                
                                window.location = "post.jsp";
                                
                            }, 1000);

                        }else{

                            display_feedback(jQuery.trim(data));

                        }

                    },
                    error: function(){
                        
                        display_feedback("Error Creating Account. Retry");

                    }

                });

            }else{

                display_feedback("Password And Confirm Password Do Not Match");

            }

        }

    });

});
<%-- 
    Document   : signup_db
    Created on : Jun 7, 2020, 12:47:19 PM
    Author     : REHOBOTH
--%>

<%@page import="com.socio.medium.Users"%>
<%
    
    
    if(request.getParameter("full_name") != null && request.getParameter("gender") != null 
        && request.getParameter("date_of_birth") != null && request.getParameter("telephone") != null 
        && request.getParameter("username") != null && request.getParameter("password") != null){
        
        String full_name = request.getParameter("full_name");
        String gender = request.getParameter("gender");
        String date_of_birth = request.getParameter("date_of_birth");
        String telephone = request.getParameter("telephone");
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        
        if("".equals(full_name) && "".equals(gender) && "".equals(date_of_birth) && "".equals(telephone)
            && "".equals(username) && "".equals(password)){
            
            out.println("There Are Empty Fields");
            
        }else{
            
            /*
            out.println("Full Name: "+full_name+"<br/>");
            out.println("Gender: "+gender+"<br/>");
            out.println("Date Of Birth: "+date_of_birth+"<br/>");
            out.println("Telephone: "+telephone+"<br/>");
            out.println("Username: "+username+"<br/>");
            out.println("Password: "+password+"<br/>");
            */
            
            Users users_instance = new Users();
            
            if(users_instance.telephone_taken(telephone)){
                
                out.println("Telephone Has Been Taken");
                
            }else{
                
                if(users_instance.username_taken(username)){
                    
                    out.println("Username Has Been Taken");
                    
                }else{
                    
                    String cover_photo = "images/img_mountains.jpg";
                    
                    String profile_picture = "";
                    
                    if("Male".equals(gender)){
                        profile_picture = "images/img_avatar.png";
                    }else if("Female".equals(gender)){
                        profile_picture = "images/img_avatar2.png";
                    }
                    
                    if(!users_instance.add_user(full_name, gender, date_of_birth, telephone, username, password, profile_picture, cover_photo, 1)){
                        
                        int newly_assigned_user_id = users_instance.get_user_id(telephone, password);
                        
                        session.setAttribute("user_logged", newly_assigned_user_id);
                        
                        out.println("Account Created Successfully. Redirecting...");
                        
                    }else{
                        
                        out.println("Error Creating Account");
                        
                    }
                    
                }
                
            }
            
        }
        
    }else{
        
        out.println("Fill in all fields");
        
    }

%>

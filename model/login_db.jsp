<%-- 
    Document   : login_db
    Created on : Jun 7, 2020, 2:00:20 PM
    Author     : REHOBOTH
--%>

<%@page import="com.socio.medium.Users"%>
<%
    
    
    if(request.getParameter("telephone") != null && request.getParameter("password") != null){
        
        String telephone = request.getParameter("telephone");
        String password = request.getParameter("password");
        
        if("".equals(telephone) && "".equals(password)){
            
            out.println("There Are Empty Fields");
            
        }else{
            
            /*
            out.println("Telephone: "+telephone+"<br/>");
            out.println("Password: "+password+"<br/>");
            */
            
            Users users_instance = new Users();
            
            if(users_instance.user_exists_by_login_details(telephone, password)){
                        
                int newly_assigned_user_id = users_instance.get_user_id(telephone, password);
                        
                session.setAttribute("user_logged", newly_assigned_user_id);
                        
                out.println("Account Verified. Logging in...");
                        
            }else{
                        
                out.println("Invalid Telephone or Password");
                        
            }
            
        }
        
    }else{
        
        out.println("Fill in all fields");
        
    }

%>


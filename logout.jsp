<%-- 
    Document   : logout
    Created on : Jun 6, 2020, 6:12:29 AM
    Author     : REHOBOTH
--%>

<%@page import="com.socio.medium.Users"%>
<%
    
    int user_id = Integer.parseInt(session.getAttribute("user_logged").toString());
    
    Users users_instance = new Users();
    
    users_instance.set_user_online_status(user_id, 0);
    
    session.removeAttribute("user_logged");
    
    response.sendRedirect("login.jsp");
%>

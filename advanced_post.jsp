<%-- 
    Document   : advanced_post
    Created on : Jun 6, 2020, 6:10:41 AM
    Author     : REHOBOTH
--%>

<%@page import="com.socio.medium.Users"%>
<%
    Users users_instance = new Users();
%>
<%
    if(session.getAttribute("user_logged") != null){
        
        int user_id = Integer.parseInt(session.getAttribute("user_logged").toString());
        
        if(users_instance.user_exists_by_user_id(user_id)){
            
            %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
	<title>ABook -> Akashi Senpai</title>

	<jsp:include page="includes/meta.jsp" />
        
        <jsp:include page="includes/resources.jsp" />
        
        <style type="text/css">
            
        </style>
    </head>
    <body>
        
        <nav class="custom_navbar">
            <jsp:include page="includes/navbar.jsp" />
        </nav>

        <nav class="mobile_navbar">
            <jsp:include page="includes/mobile_navbar.jsp" />
        </nav>

        <nav class="mobile_menu">
            <jsp:include page="includes/mobile_menu.jsp" />
        </nav>
        
        <jsp:include page="includes/feedback_divs.jsp" />

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-2 w3-padding-top left_bar">
                    <?php include "includes/left_sidebar.php"; ?>
                </div>
                
                <div class="col-md-2 left_fill"></div>

                <div class="col-md-5 col-sm-8 w3-padding-top main_content">

                    <div class="friendrequest w3-margin-top">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Advanced Post</div>
                                    <div class="panel-body">
                                        <div class="row w3-margin-bottom">
                                            <form id="advanced_post">
                                                <div class="col-md-12">
                                                    <label>Post Title</label>
                                                    <input type="text" class="form-control" name="post_title" placeholder="Enter Post Title" style="border-radius: 0px;"/>
                                                </div>
                                                <div class="col-md-12 w3-margin-top">
                                                    <label>Post Body</label>
                                                    <textarea class="form-control" name="post_body">Enter Post Body</textarea>
                                                </div>
                                                <div class="col-md-12 w3-margin-top">
                                                    <button type="submit" class="btn btn-success btn-block" style="border-radius: 0px;">Upload Post</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div id="chatlist" class="col-md-2 col-sm-4 w3-padding-top w3-border-left w3-light-grey w3-padding-bottom chat_section">
                    <jsp:include page="includes/feedback_divs.jsp" />
                </div>

            </div>

        </div>

        <script type="text/javascript" src="controller/components_refresh.js"></script>

        <script type="text/javascript">
        
            setInterval(chatlist_refresh, 500);

            setInterval(friend_requests_count_refresh, 500);

            setInterval(num_unread_chat_refresh, 500);
        
        </script>

        <script src="controller/post_creating.js"></script>
    </body>
</html>
            <%
            
        }else{
            
            response.sendRedirect("login.jsp");
            
        }
        
    }else{
        response.sendRedirect("login.jsp");
    }
%>
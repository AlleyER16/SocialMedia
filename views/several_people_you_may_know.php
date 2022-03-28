<div class="friendrequest w3-margin-top">
    <div class="col-md-12">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">People You May Know</div>
                <div class="panel-body">
                    <div class="row w3-margin-bottom">
                        <div class="col-md-3 col-sm-3 col-xs-4">
                            <img src="<%= this_profile_picture %>" style="width: 100%; height: 80px"/>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-8">
                            <b><%= this_full_name %></b><br/>
                            <span class="w3-text-amber">@<%= this_username %></span>
                            <div class="row">
                                <div class="col-xs-6">
                                    <form class="add_friend">
                                        <input type="hidden" name="user_id" value="<%= this_user_id %>"/>
                                        <input type="submit" value="ADD FRIEND" class="btn btn-sm btn-success"/>
                                    </form>
                                </div>
                                <div class="col-xs-6">
                                    <form class="remove_friend">
                                        <input type="hidden" name="user_id" value="<%= this_user_id %>"/>
                                        <input type="submit" value="REMOVE" class="btn btn-sm btn-danger"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="panel-footer w3-center">
                <button class="btn btn-success">&lt</button>
                <button class="btn btn-info">1</button>
                <button class="btn btn-success">2</button>
                <button class="btn btn-success">&gt</button>
            </div>
        -->
    </div>
</div>
</div>
</div>

<div class="navbar-default w3-margin-top" id="disp">
    <h6 class="w3-padding">People you may know</h6>

    <div class="dscrollmenu">
        <span>
            <div class="col-xs-12">
                <div class="thumbnail">
                    <img src="assets/images/img_avatar.png" style="width: 100%; height: 260px;"/>
                    <div class="caption" style="width: 100%; height: 110px;">
                        <h6>Rehoboth Micah-Daniels</h6>
                        <span class="w3-padding-bottom w3-text-amber"> @akashi_senpai</span>
                        <div class="row">
                            <div class="col-xs-6">
                                <form class="add_friend">
                                    <input type="hidden" name="user_id" value="<%= this_user_id %>"/>
                                    <input type="submit" value="ADD FRIEND" class="btn btn-sm btn-danger"/>
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
        </span>
    </div>
</div>

<div class="col-md-10 col-md-offset-1 text-center" style="margin-top: 10px;">
    <img src="<?= $__user_details["ProfilePicture"] ?>" class="img-rounded" style="width: 100px; height: 100px;"/>
</div>
<div class="col-md-12 w3-center w3-margin-top">
    <?= $__user_details["FullName"] ?><br/><span class="w3-text-amber">@<?= $__user_details["Username"] ?></span>
</div>
<div class="col-md-12 w3-center" style="margin-top: 50px;">
    <a href="home.php">Home</a>
</div>
<div class="col-md-12 w3-center w3-margin-top">
    <a href="profile.php">Profile</a>
</div>
<div class="col-md-12 w3-center w3-margin-top">
    <a href="chat.php">Chat <span class="unread_chat_count"></span></a>
</div>
<div class="col-md-12 w3-center w3-margin-top">
    <a href="friends.php">Friend Requests <span class="friend_requests_count"></span></a>
</div>
<div class="col-md-12 w3-center w3-margin-top">
    <a href="settings.php">Settings</a>
</div>
<div class="col-md-12 w3-center w3-margin-top">
    <a href="logout.php">Logout</a>
</div>

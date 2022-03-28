
<div id="post1" class="row navbar-default w3-padding-top w3-padding-bottom w3-border w3-margin-bottom" style="border-radius: 5px;">
    <div class="col-md-2 col-sm-2 col-xs-3">
        <img src="assets/images/img_avatar.png" width="100%" class="img-circle" style="max-height: 50px; border: 2px solid black"/>
        <span class="w3-green w3-circle bottom-right" style="width: 10px; height: 10px;"></span>
    </div>
    <div class="col-md-10 col-sm-10 col-xs-9">
        <span><b>Akashi Senpai</b> - <span>First Post</span></span><br/>
        <span class="w3-text-black" style="font-size: 12px">12:00pm on Apr 5 2020</span>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 w3-margin-top w3-margin-bottom" data-toggle="modal" data-target="#postextra<?php echo $pstid;?>">
        <p class="text-justify">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio totam,
            maxime omnis neque quaerat eligendi, facere cupiditate, ipsa culpa consequuntur soluta.
            Sint fugiat non, nulla sit unde ea nisi itaque!
        </p>
    </div>

    <div class="col-md-6 w3-center">
        <button type="submit" class="btn btn-link w3-text-black w3-left" data-toggle="modal" data-target="#postreacts1" style="font-size: 15px;">
            <span class="fa fa-heart-o"></span> <span class="num_post_loves">5</span>
        </button>
    </div>

    <div class="col-md-6 w3-right-align">
        <button type="submit" class="btn btn-link w3-text-black" style="font-size: 15px;">
            <span class="fa fa-comments-o"></span> <span class="num_post_comment">5</span>
        </button>
    </div>

    <div class="col-md-12 col-sm-12"><hr/></div>

    <div class="col-md-3 col-sm-3 col-xs-3 w3-center">
        <div class="love_post_container">
            <form class="love_post">
                <input type="hidden" name="post_id" value="2"/>
                <button type="submit" class="btn btn-link w3-text-black" style="font-size: 15px;">
                    <span class="fa fa-heart-o"></span> Love
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-9 col-sm-9 col-xs-9 w3-center">
        <div class="col-md-2 col-sm-3 col-xs-3">
            <img src="assets/images/img_avatar.png" width="100%" class="img-circle" style="max-height: 30px;"/>
        </div>
        <div class="col-md-10 col-sm-9 col-xs-9">
            <form class="comment_post">
                <div class="input-group">
                    <input type="hidden" name="post_id" value="1"/>
                    <input type="text" name="comment" placeholder="Write a comment... " class="form-control" autocomplete="off"/>
                    <div class="input-group-btn">
                        <button  type="submit" class="btn btn-default"><i class="fa fa-comment"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12"><hr/></div>

    <div class="col-md-12 col-xs-12 w3-padding-bottom" class="top_post_comment">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-3">
                <img src="assets/images/img_avatar.png" width="100%" class="img-circle" style="max-height: 50px;"/>
            </div>
            <div class="col-md-10 col-sm-10 col-xs-9">
                <div class="panel-body w3-light-grey w3-border w3-round-xlarge" style="border-radius: 50%;"><b>Akashi</b><br/>Useless Post</div>
            </div>
        </div>
    </div>

</div>

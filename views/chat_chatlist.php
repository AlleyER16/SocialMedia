<div class="row w3-padding-top w3-padding-bottom navbar-default w3-teal w3-padding-left">
    Message <button class="w3-right badge w3-green w3-margin-right" style="border: none;">2</button>
</div>
<div class="row">
    <form method="POST" action="chooseid.jsp">
        <input type="hidden" name="chooseid" value="<?php echo $frid;?>"/>
        <button type="submit" class="navbar-default col-md-12 w3-padding-top w3-padding-bottom btn btn-link w3-light-grey w3-hover-blue" style="padding: 0px;">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <img src="assets/images/img_avatar.png" class="img-circle" style="width: 100%; max-height: 60px; min-width: 50px; border: 2px solid black;"/>
                <span class="w3-green w3-circle bottom-right1" style="width: 10px; height: 10px;"></span>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6" style="overflow: hidden; white-space: nowrap;">
                        <span class="w3-left">Akashi Senpai</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <span>12/04/2020</span>
                    </div>
                </div>
                <div class="row w3-padding-top w3-padding-bottom">
                    <div class="col-md-9 col-sm-9 col-xs-9" style="overflow: hidden; white-space: nowrap;"><span class=" w3-left"><i class="fa fa-check"></i> Mumu Man</span></div>
                    <div class="col-md-3 col-sm-3 col-xs-3"><span class="badge w3-circle">2</span></div>
                </div>
            </div>
        </button>
    </form>
</div>

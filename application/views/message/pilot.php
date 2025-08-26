<?php $other = $data['otherUser'];$data = $data['mainUser']; ?>
<?php $fullnameOther = ucwords(strtolower(get_data_value($other,'user_fname')).' '.strtolower(get_data_value($other,'user_lname'))); ?>
<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12col-lg-10 col-md-11">
                    <div id="home-tab" class="tab-pane active">
                        <div class="tabs">
                            <div class="tab-content  mgbt-xs-20">
                                <div class="tab-pane active" id="main-tab">
<div class="child-menu">

    <textarea id="post-content" onkeyup="publicJS.sendMessage(event, $(this),<?php $tmp = explode('::',$data['convo']);echo ($tmp[0] == $this->session->userdata('user_id')?$tmp[1]:$tmp[0]); ?>)" class="no-bd" rows="3" placeholder="Send message to <?php echo $fullnameOther; ?>" ></textarea>
    <div class="image-panel" text-id="post-content"></div>
    <div class="vd_textarea-menu vd_bg-yellow vd_bd-yellow" >
        <ul class="nav nav-pills ">
<li class="pull-right" id="send-it" onclick="publicJS.sendText($('#post-content'),<?php $tmp = explode('::',$data['convo']);echo ($tmp[0] == $this->session->userdata('user_id')?$tmp[1]:$tmp[0]); ?>);">
    <a data-toggle="tab-post" href="javascript:void(0);" style="border-left:1px solid rgba(255,255,255,.3)">
<span class="menu-icon">
        <i class="fa fa-check fa-fw"></i>
</span>
<span class="menu-text">
        Post
</span>
                </a>
            </li>
        </ul>
    </div>
</div>
                                </div>
                            </div>
                        </div>

                        <div class="panel widget light-widget">
                            <div class="panel-body">
                                <div class="row mgbt-xs-0">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="content-list content-image content-chat">
                                            <ul class="list-wrapper no-bd-btm pd-lr-10 message-list"  zeroMessage="You don't have any favorite articles." barShowFuntion="" isBlocked="false" page="0" sort=""  barTitle="Favorite Articles" countContainer="" searchTerm="" url="<?php echo site_url('messages/'.$data['convo']); ?>" ></ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

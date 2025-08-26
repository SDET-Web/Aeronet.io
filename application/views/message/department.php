<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-sm-3">
            <div class="panel widget light-widget panel-bd-top">
                <div class="panel-heading no-title"> </div>
                <div class="panel-body">
                    <div class="text-center vd_info-parent"> <img alt="example image" src="<?php echo get_user_pic_url(get_data_value($data,'user_image'),get_data_value($data,'user_type')); ?>"> </div>
                    <br /><br />
                    <div class="row">
                        <div class="col-xs-12"><h2 class="font-semibold mgbt-xs-5"><?php echo get_data_value($data,'user_company'); ?></h2><?php echo get_data_value($data,'user_bio'); ?></div>
                    </div>
                    <h4> Verified Aircrafts</h4>
                    <p>
                        <?php if(count($data['aircraft'])): ?>
                            <?php foreach($data['aircraft'] as $key=>$item): ?>
                                <?php echo $item['mfr_name'].' '.$item['model_name']; ?><br />
                            <?php endforeach; ?>
                        <?php endif; ?>
                         </p>

                    <br />
                    <br />
                    <table class="table table-striped table-hover">
                        <tbody>
                        <tr>
                            <td style="width:60%;">Status</td>
                            <td><span class="label label-<?php $tmp = get_select_user_status(get_data_value($data,'user_status'));echo $tmp[1]; ?>"><?php echo $tmp[0]; ?></span></td>
                        </tr>
                        <tr>
                            <td>Profile Completed</td>
                            <td><div class="progress">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo get_data_value($data,'user_profile_percent'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo get_data_value($data,'user_profile_percent'); ?>%">
                                        <span class="sr-only"><?php echo get_data_value($data,'user_profile_percent'); ?>% Complete</span>
                                    </div> &nbsp;<?php echo get_data_value($data,'user_profile_percent'); ?>%
                                </div></td>
                        </tr>
                        <tr>
                            <td>Flight Times Last Updated</td>
                            <td> <?php echo get_data_value_date($data,'user_modified'); ?> </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="panel widget light-widget">
                <div class="panel-body-list">
                    <h3 class="pd-10 mgbt-xs-0">Jobs Board</h3>
                    <div class="content-grid column-xs-2 column-sm-3 height-xs-auto mgbt-xs-20">
                        <div>
                            <a href="#">  <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/flight.jpg" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="closing text-center" style=""> <a href="<?php echo site_url('flight-dispatch-board'); ?>">See All Listings<i class="fa fa-angle-double-right prepend-icon"></i></a> </div>
                </div>
            </div>
            <!-- panel widget -->


        </div>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-lg-8 col-md-9">
                    <div id="home-tab" class="tab-pane active">
                        <div class="tabs">
                            <div class="tab-content  mgbt-xs-20">
                                <div class="tab-pane active" id="main-tab">
                                    <div class="child-menu">

                                        <textarea id="post-content" onkeyup="publicJS.sendMessage(event, $(this),<?php $tmp = explode('::',$data['mainUser']['convo']);echo ($tmp[0] == $this->session->userdata('user_id')?$tmp[1]:$tmp[0]); ?>)" class="no-bd" rows="3" placeholder="What are you doing?" ></textarea>
                                        <div class="image-panel" text-id="post-content"></div>
                                        <div class="vd_textarea-menu vd_bg-yellow vd_bd-yellow" >
                                            <ul class="nav nav-pills ">
                                                <li class="pull-right" id="send-it" onclick="publicJS.sendText($('#post-content'),<?php $tmp = explode('::',$data['mainUser']['convo']);echo ($tmp[0] == $this->session->userdata('user_id')?$tmp[1]:$tmp[0]); ?>);">
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
                                            <ul class="list-wrapper no-bd-btm pd-lr-10 message-list"  zeroMessage="You don't have any favorite articles." barShowFuntion="" isBlocked="false" page="0" sort=""  barTitle="Favorite Articles" countContainer="" searchTerm="" url="<?php echo site_url('messages/'.$data['mainUser']['convo']); ?>" ></ul>
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

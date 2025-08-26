<div class="vd_title-section clearfix" style="margin: 0;">
    <ul class="nav nav-pills">
        <li class="<?php echo ($type == JOB_TARGET_PILOT ? "active" : "vd_bg-white vd_grey"); ?>">
            <a href="<?php echo site_url("/applications/for-pilots"); ?>">
                <h4> Pilots  </h4>
            </a>
        </li>
        <li class="<?php echo ($type == JOB_TARGET_MECHANIC ? "active" : "vd_bg-white vd_grey"); ?>">
            <a href="<?php echo site_url("/applications/for-mechanics"); ?>">
                <h4> Mechanics </h4>
            </a>
        </li>
        <li class="<?php echo ($type == JOB_TARGET_DISPATCHER ? "active" : "vd_bg-white vd_grey"); ?>">
            <a href="<?php echo site_url("/applications/for-dispatchers"); ?>">
                <h4> Dispatcher </h4>
            </a>
        </li>
        <li class="<?php echo ($type == JOB_TARGET_ATTENDENT ? "active" : "vd_bg-white vd_grey"); ?>">
            <a href="<?php echo site_url("/applications/for-attendents"); ?>">
                <h4> Flight Attendant </h4>
            </a>
        </li>
    </ul>
    <br/>
    It should just be the 30 day job post then they expire.  Unless of course they repost.
    <div class="tab-content  mgbt-xs-20">
        <div class="tab-pane active" id="tab31">
            <!--
               <div class="vd_panel-header">

                 <h1 style="margin-top:10px;">Pilots Pipleline</h1><br/>

               </div>-->
            <div class="vd_content-section clearfix">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="panel widget" style="margin-left:-20px;">
                            <div class="panel-heading vd_bg-yellow">
                                <h3 class="panel-title"> <span class="menu-icon"> <i class="fas fa-users"></i> </span> Applied <? echo(count($jobs[APP_STATUS_PENDING]).count($jobs[APP_STATUS_FEEDBACK]));?></h3>
                                <div class="vd_panel-menu">
                                    <div data-action="minimize" data-original-title="Minimize" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-minus"></i> </div>
                                    <div data-action="refresh"  data-original-title="Refresh" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon smaller-font"> <i class="fa fa-sync-alt"></i> </div>
                                    <div data-original-title="Show" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon smaller-font">
                                        <div class="menu-trigger" data-action="click-trigger"> <i class="fas fa-cog"></i> </div>
                                        <div data-action="click-target" class="vd_mega-menu-content  width-xs-2  left-xs">
                                            <div class="child-menu">
                                                <div class="content-list content-menu">
                                                    <ul class="list-wrapper pd-lr-10">
                                                        <li>
                                                            <a href="#">
                                                                <div class="menu-icon"><i class=" fas fa-user"></i></div>
                                                                <div class="menu-text">Order by Name</div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="menu-icon"><i class="fas fa-list-ol"></i></div>
                                                                <div class="menu-text">Order by Date</div>
                                                            </a>
                                                        </li>
                                                        <li class="line"></li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="menu-icon"><i class=" fas fa-tasks"></i></div>
                                                                <div class="menu-text">Job Type Basic </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <div class="menu-icon"><i class=" fas fa-credit-card"></i></div>
                                                                <div class="menu-text">Job Type Premium</div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-action="close" data-original-title="Close" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-window-close"></i> </div>
                                </div>
                                <!-- vd_panel-menu -->
                            </div>
                            <div class="panel-body-list">
                                <div class="content-list content-image menu-action-right">
                                    <div  data-rel="scroll" data-scrollheight="300"	>
                                        <ul class="list-wrapper pd-lr-15">
                                            <?php if (count($jobs[APP_STATUS_PENDING]) > 0): ?>
                                            <?php foreach ($jobs[APP_STATUS_PENDING] as $job): ?>
                                            <li>
                                                <div class="menu-icon">
                                                    <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                                    <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                                    <span class="vd_red"><i class="fa fa-money-check-alt fa-sm"></i> </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="menu-text">
                                                    <em>
                                                        <h5><?php echo $job["user_fname"]. " " . $job["user_lname"]; ?></h5>
                                                    </em>
                                                </div>
                                                <div class="menu-text">
                                                    <div class="menu-info">
                                                        <a href="#">
                                                            <h5><?php echo select_user_type($job["user_type"]); ?></h5>
                                                        </a>
                                                        <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $job["user_rating"]; ?></span>
                                                        <br/> <span class="menu-date "><i class="fa fa-clock"></i>&nbsp;<?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $job["updated"])); ?></span>
                                                    </div>
                                                </div>
                                                <div class="menu-action">
                                                    <a href="#" data-modal-external-file="<?php echo site_url("applications/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="menu-action-icon" data-close-modal="true">   <i class="fa fa-check"></i>  </a>
                                                    <a href="<?php echo site_url("applications/disqualify/" . $job["job_id"] . "/" . $job["id"]); ?>" data-original-title="Reject" data-toggle="tooltip" data-placement="bottom" class="menu-action-icon vd_red" data-close-modal="true">   <i class="fa fa-times"></i>  </a>
                                                    <!-- data-modal-external-file="<?php echo site_url("applications/j/reject/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="rejModal"  -->
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="closing text-center">  <a href="#">
                                    <i class="fa fa-angle-double-right"></i> Shortlist the Applicant for Feedback<br/>
                                    <i class="fa fa-times-circle"></i> Reject the Applicant to Disqualify </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Panel Widget -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="panel widget" style="margin-left:-20px;">
                            <div class="panel-heading vd_bg-twitter">
                                <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-question-circle"></i> </span> Feedback</h3>
                                <div class="vd_panel-menu">
                                    <div data-action="minimize" data-original-title="Minimize" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-minus"></i> </div>
                                    <div data-action="refresh"  data-original-title="Refresh" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon smaller-font"> <i class="fa fa-sync-alt"></i> </div>
                                    <div data-action="close" data-original-title="Close" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-window-close"></i> </div>
                                </div>
                                <!-- vd_panel-menu -->
                            </div>
                            <div class="panel-body-list">
                                <div class="content-list content-image menu-action-right">
                                    <div  data-rel="scroll" data-scrollheight="300"	>
                                        <ul class="list-wrapper pd-lr-15">
                                            <?php if (count($jobs[APP_STATUS_FEEDBACK]) > 0): ?>
                                            <?php foreach ($jobs[APP_STATUS_FEEDBACK] as $job): ?>
                                            <li>
                                                <div class="menu-icon">
                                                    <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                                    <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                                        <span class="vd_red"><i class="fa fa-money-check-alt fa-sm"></i> </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="menu-text"><h5><?php echo $job["user_fname"]. " " . $job["user_lname"]; ?></h5></div>
                                                <div class="menu-text">
                                                    <div class="menu-info">
                                                        <a href="#">
                                                            <h5><?php echo select_user_type($job["user_type"]); ?></h5>
                                                        </a>
                                                        <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $job["user_rating"]; ?></span>
                                                        <br/> <span class="menu-date "><i class="fa fa-clock"></i>&nbsp;<?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $job["updated"])); ?></span>
                                                    </div>
                                                </div>
                                                <div class="menu-action">
                                                     </div>

                                                <div class="menu-action">
                                                  <a href="#" onclick="eModal.iframe('<?php echo site_url("applications/feedback/" . $job["job_id"] . "/" . $job["id"]); ?>', 'Post FeedBack')" class="menu-action-icon vd_green">   <i class="fa fa-upload"></i>  </a>
                                                 <a href="<?php echo site_url("applications/disqualify/" . $job["job_id"] . "/" . $job["id"]); ?>" data-original-title="Reject" data-toggle="tooltip" data-placement="bottom" class="menu-action-icon vd_red" data-close-modal="true">   <i class="fa fa-times"></i>  </a>
                                                  <a href="#" data-modal-external-file="<?php echo site_url("applications/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="menu-action-icon" data-close-modal="true">   <i class="fa fa-check"></i>  </a>
                                                 </div>

                                            </li>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="closing text-center">  <a href="#">
                                    <i class="fa fa-angle-double-right"></i> Qualify the Applicant<br/>
                                    <i class="fa fa-times-circle"></i> Reject the Applicant to Disqualify </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Panel Widget -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="panel widget" style="margin-left:-20px;">
                            <div class="panel-heading vd_bg-red">
                                <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-trash"></i> </span> Disqualified</h3>
                                <div class="vd_panel-menu">
                                    <div data-action="minimize" data-original-title="Minimize" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-minus"></i> </div>
                                    <div data-action="refresh"  data-original-title="Refresh" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon smaller-font"> <i class="fa fa-sync-alt"></i> </div>
                                    <div data-action="close" data-original-title="Close" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-window-close"></i> </div>
                                </div>
                                <!-- vd_panel-menu -->
                            </div>
                            <div class="panel-body-list">
                                <div class="content-list content-image menu-action-right">
                                    <div  data-rel="scroll" data-scrollheight="300"	>
                                        <ul class="list-wrapper pd-lr-15">
                                            <?php if (count($jobs[APP_STATUS_DISQUALIFIED]) > 0): ?>
                                            <?php foreach ($jobs[APP_STATUS_DISQUALIFIED] as $job): ?>
                                            <li>
                                                <div class="menu-icon">
                                                    <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                                    <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                                        <span class="vd_red"><i class="fa fa-money-check-alt fa-sm"></i> </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="menu-text"><h5><?php echo $job["user_fname"]. " " . $job["user_lname"]; ?></h5></div>
                                                <div class="menu-text">
                                                    <div class="menu-info">
                                                        <a href="#">
                                                            <h5><?php echo select_user_type($job["user_type"]); ?></h5>
                                                        </a>
                                                        <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $job["user_rating"]; ?></span>
                                                        <br/> <span class="menu-date "><i class="fa fa-clock"></i>&nbsp;<?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $job["updated"])); ?></span>
                                                    </div>
                                                </div>
                                                <div class="menu-action">
                                                    <a href="#" data-modal-external-file="<?php echo site_url("applications/j/reject/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="menu-action-icon" data-close-modal="true">
                                                        <i class="fa fa-user-times"></i>  </a>
                                                     <a href="#" data-modal-external-file="<?php echo site_url("applications/j/reject/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="menu-action-icon vd_red" data-close-modal="true">
                                                     <i class="fa fa-times"></i> </a>
                                                     <a href="#" data-modal-external-file="<?php echo site_url("applications/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="menu-action-icon" data-close-modal="true">   <i class="fa fa-check"></i>  </a>
                                                
                                                 </div>
                                            </li>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="closing text-center">  <a href="#">
                                    <i class="fa fa-times-circle"></i>Disqualify the Applicant with Reason  </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Panel Widget -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="panel widget" style="margin-left:-20px;">
                            <div class="panel-heading vd_bg-green">
                                <h3 class="panel-title"> <span class="menu-icon"> <i class="fas fa-trophy"></i> </span> Qualified</h3>
                                <!-- vd_panel-menu -->
                            </div>
                            <div class="panel-body-list">
                                <div class="content-list content-image menu-action-right">
                                    <div  data-rel="scroll" data-scrollheight="300"	>
                                        <ul class="list-wrapper pd-lr-15">
                                            <?php if (count($jobs[APP_STATUS_QUALIFIED]) > 0): ?>
                                            <?php foreach ($jobs[APP_STATUS_QUALIFIED] as $job): ?>
                                            <li>
                                                <div class="menu-icon">
                                                    <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                                    <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                                        <span class="vd_red"><i class="fa fa-money-check-alt fa-sm"></i> </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="menu-text"><h5><?php echo $job["user_fname"]. " " . $job["user_lname"]; ?></h5></div>
                                                <div class="menu-text">
                                                    <div class="menu-info">
                                                        <a href="#">
                                                            <h5><?php echo select_user_type($job["user_type"]); ?></h5>
                                                        </a>
                                                        <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $job["user_rating"]; ?></span>
                                                        <br/> <span class="menu-date "><i class="fa fa-clock"></i>&nbsp;<?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $job["updated"])); ?></span>
                                                    </div>
                                                </div>
                                                <div class="menu-action">
                                                    <div class="menu-action-icon vd_green"  data-original-title="Approved" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-user-plus"></i> </div>
                                                    <div class="menu-action-icon vd_red"   data-original-title="Remove" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-times"></i> </div>
                                                <a href="#" data-modal-external-file="<?php echo site_url("applications/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="menu-action-icon" data-close-modal="true">   <i class="fa fa-check"></i>  </a>
                                                   
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    Add function to delete or clear the list as well
                                </div>
                            </div>
                        </div>
                        <!-- Panel Widget -->
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab32"> Mechanic Board </div>
        <div class="tab-pane" id="tab33"> Dispatcher Board </div>
        <div class="tab-pane" id="tab34"> Flight Attendant </div>
    </div>
</div>

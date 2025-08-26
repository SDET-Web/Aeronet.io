<div class="vd_title-section clearfix">
   <div class="vd_content-section clearfix">
       <br/> <a  href="<?php echo site_url('flight-dispatch-board/subscribe/addons/l8premiumcts'); ?>">
       <img src="/assets/backend/img/Tracking.jpg" class="img-responsive center-block"> </a>
      <div class="col-md-12 col-xs-12"><br/>
      <ul class="nav nav-pills">
          <li class="<?php echo ($type == JOB_TARGET_PILOT ? "active" : "vd_bg-white vd_grey"); ?>">
              <a href="<?php echo site_url("/candidate-tracking/for-pilots"); ?>">
                Pilots
              </a>
          </li>
          <li class="<?php echo ($type == JOB_TARGET_MECHANIC ? "active" : "vd_bg-white vd_grey"); ?>">
              <a href="<?php echo site_url("/candidate-tracking/for-mechanics"); ?>">
               Mechanics
              </a>
          </li>
          <li class="<?php echo ($type == JOB_TARGET_DISPATCHER ? "active" : "vd_bg-white vd_grey"); ?>">
              <a href="<?php echo site_url("/candidate-tracking/for-dispatchers"); ?>">
               Dispatcher
              </a>
          </li>
          <li class="<?php echo ($type == JOB_TARGET_ATTENDENT ? "active" : "vd_bg-white vd_grey"); ?>">
              <a href="<?php echo site_url("/candidate-tracking/for-attendents"); ?>">
              Flight Attendant
              </a>
          </li>
      </ul></div></div>
                <br/>
            <div class="row">
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-yellow">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fas fa-users"></i> </span> Applicants</h3>
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
                           <div  data-rel="scroll" data-scrollheight="auto"	>
                              <ul class="list-wrapper pd-lr-15">
                                <?php if (count($jobs[APP_STATUS_PENDING]) > 0): ?>
                                <?php foreach ($jobs[APP_STATUS_PENDING] as $job): ?>
                                <li>
                                    <div class="menu-icon">
                                        <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                        <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                        <span class="vd_green"><i class="fa fa-user-shield fa-sm"></i> </span>
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
                                        <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-original-title="Approve" data-toggle="tooltip" data-placement="bottom" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true">   <i class="fa fa-user"></i>  </a><br/>
                                        <a href="<?php echo site_url("candidate-tracking/disqualify/temp/" . $job["job_id"] . "/" . $job["id"]); ?>" data-original-title="Reject" data-toggle="tooltip" data-placement="bottom" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true">   <i class="fa fa-user-times"></i>  </a>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                               
<!--- Passsive candidates -->
<!--
                             <?php /* if (count($matched) > 0): ?>
                                <?php  foreach ($matched as $user): ?>
                                <li>
                                    <div class="menu-icon">
                                        <img src="<?php echo get_user_pic_url(get_data_value($user,'user_image'),get_data_value($user,'user_type')); ?>">
                                    </div>
                                    <div class="menu-text">
                                        <em>
                                            <h5><?php echo $user["user_fname"]. " " . $user["user_lname"]; ?></h5>
                                        </em>
                                    </div>
                                    <div class="menu-text">
                                        <div class="menu-info">
                                            <a href="#">
                                                <h5><?php echo select_user_type($user["user_type"]); ?></h5>
                                            </a>

                                            <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $user["user_rating"]; ?></span>
                                            <br/> <span class="menu-date "><b>Matched:</b> <?php echo $user["job"]["title"]; ?></span>
                                        </div>
                                    </div>
                                    <div class="menu-action">

                                        <a data-toggle="popover" data-placement="top" data-content="Open on top. Click again to close"
                                        data-original-title="Top" class="btn menu-icon vd_bd-yellow vd_yellow">
                                        </a>
                                        <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/shortlist/" . $user["job"]["id"] . "/" . $user["user_id"] . "/user"); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true">   <i class="fa fa-check"></i>  </a>
                                        <a href="<?php echo site_url("candidate-tracking/disqualify/temp/" . $user["job"]["id"] . "/" . $user["user_id"] . "/user"); ?>" data-original-title="Reject" data-toggle="tooltip" data-placement="bottom" class="menu-action-icon vd_" data-close-modal="true">   <i class="fa fa-user-times"></i>  </a>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php endif; */?> -->
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Panel Widget -->
               </div>
                <div class="hidden-md hidden-lg hidden-sm col-xs-12">
                    <div style="margin-top:-60px">
                 <img src="/assets/backend/img/connect.jpg" class="img-responsive center-block"> </div>
                </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-twitter">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-search"></i> </span> Addendum Questionnaire </h3>
                        <div class="vd_panel-menu">
                           <div data-action="minimize" data-original-title="Minimize" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-minus"></i> </div>
                           <div data-action="refresh"  data-original-title="Refresh" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon smaller-font"> <i class="fa fa-sync-alt"></i> </div>
                           <div data-action="close" data-original-title="Close" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-window-close"></i> </div>
                        </div>
                        <!-- vd_panel-menu -->
                     </div>
                     <div class="panel-body-list">
                        <div class="content-list content-image menu-action-right">
                           <div  data-rel="scroll" data-scrollheight="auto"	>
                              <ul class="list-wrapper pd-lr-15">
                                <?php if (count($jobs[APP_STATUS_FEEDBACK]) > 0): ?>
                                <?php foreach ($jobs[APP_STATUS_FEEDBACK] as $job): ?>
                                <li>
                                    <div class="menu-icon">
                                        <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                        <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                        <span class="vd_green"><i class="fa fa-user-shield fa-sm"></i> </span>
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
                                       <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/screening/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true"><i class="fa fa-search-plus"></i>  </a>
                                       <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true"><i class="fa fa-check"></i>  </a>
                                       <a href="<?php echo site_url("candidate-tracking/disqualify/temp/" . $job["job_id"] . "/" . $job["id"]); ?>" data-original-title="Reject" data-toggle="tooltip" data-placement="bottom" class="menu-action-icon vd_" data-close-modal="true">   <i class="fa fa-user-times"></i>  </a>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Panel Widget -->
               </div>
                <div class="hidden-md hidden-lg hidden-sm col-xs-12">
                    <div style="margin-top:-60px">
                 <img src="/assets/backend/img/connect2.jpg" class="img-responsive center-block"> </div>
                </div>

               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-blue">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-video"></i> </span> Video Interviewing</h3>
                        <div class="vd_panel-menu">
                           <div data-action="minimize" data-original-title="Minimize" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-minus"></i> </div>
                           <div data-action="refresh"  data-original-title="Refresh" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon smaller-font"> <i class="fa fa-sync-alt"></i> </div>
                           <div data-action="close" data-original-title="Close" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-window-close"></i> </div>
                        </div>
                        <!-- vd_panel-menu -->
                     </div>
                     <div class="panel-body-list">
                        <div class="content-list content-image menu-action-right">
                           <div  data-rel="scroll" data-scrollheight="auto"	>
                              <ul class="list-wrapper pd-lr-15">
                                <?php if (count($jobs[APP_STATUS_VIDEO]) > 0): ?>
                                <?php foreach ($jobs[APP_STATUS_VIDEO] as $job): ?>
                                <li>
                                    <div class="menu-icon">
                                        <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                        <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                        <span class="vd_green"><i class="fa fa-user-shield fa-sm"></i> </span>
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
                                        
                  <a href="#" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" onclick="eModal.iframe('<?php echo site_url("candidate-tracking/video/" . $job["job_id"] . "/" . $job["id"]); ?>', 'VIDEO INTERVIEWING')" > <i class="fa fa-video"></i>  </a>   

                <a class="btn-xs vd_btn vd_bg-blue btn-block pd-5" href="<?php echo site_url("candidate-tracking/screening/" . $job["id"] . "/background/confirm"); ?>" data-original-title="Move to Background Checks" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-id-card"></i> </a>
                              
                <!--  <a href="#" data-modal-external-file="<?php //echo site_url("candidate-tracking/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true">   <i class="fa fa-check"></i>  </a>
                <a href="#" data-modal-external-file="<?php //echo site_url("candidate-tracking/screening/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true"><i class="fa fa-search-plus"></i>  </a>
!-->             <a class="btn-xs vd_btn vd_bg-blue btn-block pd-5" href="<?php echo site_url("candidate-tracking/screening/" . $job["id"] . "/accept/confirm"); ?>" data-original-title="Qualify" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-trophy"></i></a>
                
                  <a class="btn-xs vd_btn vd_bg-blue btn-block pd-5" href="<?php echo site_url("candidate-tracking/disqualify/temp/" . $job["job_id"] . "/" . $job["id"]); ?>" data-original-title="Reject" data-toggle="tooltip" data-placement="bottom" class="menu-action-icon vd_" data-close-modal="true">   <i class="fa fa-user-times"></i>  </a>
                  
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Panel Widget -->
               </div>
                <div class="hidden-md hidden-lg hidden-sm col-xs-12">
                    <div style="margin-top:-60px">
                 <img src="/assets/backend/img/connect.jpg" class="img-responsive center-block"> </div>
                </div>

               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-green">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-search-plus"></i> </span> Background Checks</h3>
                        <!-- vd_panel-menu -->
                     </div>
                     <div class="panel-body-list">
                        <div class="content-list content-image menu-action-right">
                           <div  data-rel="scroll" data-scrollheight="auto"	>
                              <ul class="list-wrapper pd-lr-15">
                                <?php if (count($jobs[APP_STATUS_BACKGROUND]) > 0): ?>
                                <?php foreach ($jobs[APP_STATUS_BACKGROUND] as $job): ?>
                                <li>
                                    <div class="menu-icon">
                                        <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                        <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                        <span class="vd_green"><i class="fa fa-user-shield fa-sm"></i> </span>
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
                                     
                                     <a href="#" onclick="eModal.iframe('<?php echo site_url("candidate-tracking/background/" . $job["job_id"] . "/" . $job["id"]); ?>', 'BACKGROUND CHECKS');" class="btn-xs vd_btn vd_bg-blue btn-block pd-5"> <i class="fa fa-id-card"></i></a>
                                     <a href="#" onclick="eModal.iframe('<?php echo site_url("candidate-tracking/video/" . $job["job_id"] . "/" . $job["id"]); ?>', 'VIDEO INTERVIEWING')" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" > <i class="fa fa-video"></i>  </a>
                                     <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/screening/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true"><i class="fa fa-search-plus"></i>  </a>
                                     <!--<a href="#" data-modal-external-file="<?php //echo site_url("candidate-tracking/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true">   <i class="fa fa-check"></i>  </a>-->
                                     <a href="<?php echo site_url("candidate-tracking/disqualify/temp/" . $job["job_id"] . "/" . $job["id"]); ?>" data-original-title="Prospects" data-toggle="tooltip" data-placement="top" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true">   <i class="fa fa-user-times"></i>  </a>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Panel Widget -->
               </div>
                <div class="hidden-md hidden-lg hidden-sm col-xs-12">
                    <div style="margin-top:-60px">
                 <img src="/assets/backend/img/connect2.jpg" class="img-responsive center-block"> </div>
                </div>

               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-red">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fas fa-trash"></i> </span> Prospects</h3>
                        <div class="vd_panel-menu">
                           <div data-action="minimize" data-original-title="Minimize" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-minus"></i> </div>
                           <div data-action="refresh"  data-original-title="Refresh" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon smaller-font"> <i class="fa fa-sync-alt"></i> </div>
                           <div data-action="close" data-original-title="Close" data-toggle="tooltip" data-placement="bottom" class=" menu entypo-icon"> <i class="fa fa-window-close"></i> </div>
                        </div>
                        <!-- vd_panel-menu -->
                     </div>
                     <div class="panel-body-list">
                        <div class="content-list content-image menu-action-right">
                           <div  data-rel="scroll" data-scrollheight="auto"	>
                              <ul class="list-wrapper pd-lr-15">
                                <?php if (count($jobs[APP_STATUS_DISQUALIFIED]) > 0): ?>
                                <?php foreach ($jobs[APP_STATUS_DISQUALIFIED] as $job): ?>
                                <li>
                                    <div class="menu-icon">
                                        <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                        <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                        <span class="vd_green"><i class="fa fa-user-shield fa-sm"></i> </span>
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
                                     <!-- <a href="#" data-modal-external-file="<?php// echo site_url("candidate-tracking/reject/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true"><i class="fa fa-times"></i></a>-->
                                      <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true">   <i class="fa fa-check"></i>  </a>

                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                              </ul>
                               <br/>
                                <h3 class="panel-title vd_bg-green pd-10"> ** Qualified ** </h3>
                                <br/>
                               <ul class="list-wrapper pd-lr-15">
                                <?php if (count($jobs[APP_STATUS_QUALIFIED]) > 0): ?>
                                <?php foreach ($jobs[APP_STATUS_QUALIFIED] as $job): ?>
                                <li>
                                    <div class="menu-icon">
                                        <img src="<?php echo get_user_pic_url(get_data_value($job,'user_image'),get_data_value($job,'user_type')); ?>">
                                        <?php if($job["plan"] == L8_JOB_PLAN_PAID): ?>
                                        <span class="vd_green"><i class="fa fa-user-shield fa-sm"></i> </span>
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
                                     <!-- <a href="#" data-modal-external-file="<?php// echo site_url("candidate-tracking/reject/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true"><i class="fa fa-times"></i></a>-->
                                      <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="btn-xs vd_btn vd_bg-blue btn-block pd-5" data-close-modal="true">   <i class="fa fa-check"></i>  </a>

                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Panel Widget -->
               </div>
            </div>
         </div>

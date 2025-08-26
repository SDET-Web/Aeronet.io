<div class="vd_title-section clearfix">
   <div class="vd_content-section clearfix">
      <h1 style="width:100%;padding:0px;"> &nbsp; &nbsp;Job Seekers</h1>
      <!--<ul class="nav nav-pills" style="padding:15px;">
         <li class="active">
            <a href="#tab31" data-toggle="tab">
               <h5><strong class="font-semibold"> Pilot (Captain) </strong></h5>
            </a>
         </li>
         <li class="vd_bg-white vd_grey">
            <a href="#tab31-1" data-toggle="tab">
               <h5><strong class="font-semibold"> Pilot (Co-Pilot) </strong></h5>
            </a>
         </li>
         <li class="vd_bg-white vd_grey">
            <a href="#tab32" data-toggle="tab">
               <h5><strong class="font-semibold"> Mechanics </strong></h5>
            </a>
         </li>
         <li class="vd_bg-white vd_grey">
            <a href="#tab34" data-toggle="tab">
               <h5><strong class="font-semibold"> Flight Attendant </strong></h5>
            </a>
         </li>
         <li class="vd_bg-white vd_grey">
            <a href="#tab33" data-toggle="tab">
               <h5><strong class="font-semibold"> Dispatcher </strong></h5>
            </a>
         </li>
      </ul> -->
      <ul class="nav nav-pills">
          <li class="<?php echo ($type == JOB_TARGET_PILOT ? "active" : "vd_bg-white vd_grey"); ?>">
              <a href="<?php echo site_url("/candidate-tracking/for-pilots"); ?>">
                  <h4> Pilots  </h4>
              </a>
          </li>
          <li class="<?php echo ($type == JOB_TARGET_MECHANIC ? "active" : "vd_bg-white vd_grey"); ?>">
              <a href="<?php echo site_url("/candidate-tracking/for-mechanics"); ?>">
                  <h4> Mechanics </h4>
              </a>
          </li>
          <li class="<?php echo ($type == JOB_TARGET_DISPATCHER ? "active" : "vd_bg-white vd_grey"); ?>">
              <a href="<?php echo site_url("/candidate-tracking/for-dispatchers"); ?>">
                  <h4> Dispatcher </h4>
              </a>
          </li>
          <li class="<?php echo ($type == JOB_TARGET_ATTENDENT ? "active" : "vd_bg-white vd_grey"); ?>">
              <a href="<?php echo site_url("/candidate-tracking/for-attendents"); ?>">
                  <h4> Flight Attendant </h4>
              </a>
          </li>
      </ul>
      The main connecting factor for flight departments and talent is the flight department’s “aircraft type” and the talent’s “type rating”
      <br/>
      Aircraft type or manufacture name and model= type certificate holder and civil model designation
      <br/>
      The type certificate holder and civil model designation is retrieved during the flight department’s registration from the N number
      <br/>
      http://registry.faa.gov/aircraftinquiry/NNum_Results.aspx?NNumbertxt=N701VV
      <div class="tab-content  mgbt-xs-20">
         <div class="tab-pane active" id="tab31">
            The ranking will be in this order
            <br/>
            1- Pilots who have a Commercial or Airline Transport Pilot certificate plus the FAA designated aircraft type rating for that specific aircraft
            <br/>2- Highest Flight Time in Aircraft Type
            <br/>3- Highest Total Flight Time
            <br/>4- Location
            <br/>5- Most recently updated profile    <br/><br/>
            Applicant after shortlisted will appear in ADDITIONAL SCREENING list after completing the addendum questions will be shifted to VIDEO INTERVIEWING list here department will send 5 questions and after getting video answers will qualify applicant for BACKGROUND CHECKS only if department has purchased the addon.
            <br/>
            During any phase they can reject applicant base on answer and it will appear in DISQUALIFIED list.
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
                           <div  data-rel="scroll" data-scrollheight="300"	>
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
                                        <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/shortlist/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="menu-action-icon" data-close-modal="true">   <i class="fa fa-check"></i>  </a>
                                        <a href="<?php echo site_url("candidate-tracking/disqualify/temp/" . $job["job_id"] . "/" . $job["id"]); ?>" data-original-title="Reject" data-toggle="tooltip" data-placement="bottom" class="menu-action-icon vd_" data-close-modal="true">   <i class="fa fa-user-times"></i>  </a>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if (count($matched) > 0): ?>
                                <?php foreach ($matched as $user): ?>
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
                                        <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/shortlist/" . $user["job"]["id"] . "/" . $user["user_id"] . "/user"); ?>" data-target="apprModal" class="menu-action-icon" data-close-modal="true">   <i class="fa fa-check"></i>  </a>
                                        <a href="<?php echo site_url("candidate-tracking/disqualify/temp/" . $user["job"]["id"] . "/" . $user["user_id"] . "/user"); ?>" data-original-title="Reject" data-toggle="tooltip" data-placement="bottom" class="menu-action-icon vd_" data-close-modal="true">   <i class="fa fa-user-times"></i>  </a>
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
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-twitter">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-search"></i> </span> Additional Screening </h3>
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
                                        <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/screening/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="menu-action-icon" data-close-modal="true">                                             <i class="fa fa-search-plus"></i>  </a>
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
                           <div  data-rel="scroll" data-scrollheight="300"	>
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
                                        <a href="#" onclick="eModal.iframe('<?php echo site_url("candidate-tracking/video/" . $job["job_id"] . "/" . $job["id"]); ?>', 'VIDEO INTERVIEWING')" ><i class="fa fa-video"></i></a>
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
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-green">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-search-plus"></i> </span> Background Checks</h3>
                        <!-- vd_panel-menu -->
                     </div>
                     <div class="panel-body-list">
                        <div class="content-list content-image menu-action-right">
                           <div  data-rel="scroll" data-scrollheight="300"	>
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
                                        <a href="#" onclick="eModal.iframe('<?php echo site_url("candidate-tracking/background/" . $job["job_id"] . "/" . $job["id"]); ?>', 'BACKGROUND CHECKS');"><i class="fa fa-id-card"></i></a>
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
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-red">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fas fa-trash"></i> </span> Disqualified</h3>
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
                                      <a href="#" data-modal-external-file="<?php echo site_url("candidate-tracking/reject/" . $job["job_id"] . "/" . $job["id"]); ?>" data-target="apprModal" class="menu-action-icon" data-close-modal="true"><i class="fa fa-times"></i></a>
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
         <div class="tab-pane" id="tab31-1"> Pilot (Co-Pilot)
            The ranking will be in the same pilot order
         </div>
         <div class="tab-pane" id="tab32">
            The ranking will be in this order
            <br/>
            1- Talent who have the flight department’s aircraft type rating in their profile.
            <br/> 2- Location
            <br/> 3- Most recently updated profile
         </div>
         <div class="tab-pane" id="tab34">
            The ranking will be in this order
            <br/>
            1- Talent who have the flight department’s aircraft type rating in their profile.
            <br/> 2- Location
            <br/> 3- Most recently updated profile
            <div class="row">
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-yellow">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fas fa-users"></i> </span> Applied</h3>
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
                                 <li>
                                    <div class="menu-icon"><a href="#"><img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/avatar/avatar.jpg"></a>
                                       <span class="vd_green"><i class="fa fa-user-tie fa-sm"></i> </span>
                                    </div>
                                    <div class="menu-text">
                                       <em>
                                          <h5><strong class="font-semibold">David Haney</strong></h5>
                                       </em>
                                    </div>
                                    <div class="menu-text">
                                       <div class="menu-info">
                                          <a href="#">
                                             <h5> Flight Attendant</h5>
                                          </a>
                                          <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : STU,MEL</span>
                                          <br/> <span class="menu-date "><i class="fa fa-clock"></i>12 Minutes Ago</span>
                                       </div>
                                    </div>
                                    <div class="menu-action">
                                       <div class="menu-action-icon vd_green"  data-toggle="modal" data-target="#FapprModal">  <i class="fa fa-check"></i> </div>
                                       <!-- Modal -->
                                       <div class="modal fade" id="FapprModal" role="dialog">
                                          <div class="modal-dialog">
                                             <!-- Modal content-->
                                             <div class="modal-content">
                                                <div class="modal-header vd_bg-green">
                                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   <h4 class="modal-title vd_white">
                                                   Applicant Details</strong></h5>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                      <div class="col-md-12 col-xs-12">
                                                         <h5><strong class="font-semibold"> Flight Attendant:  </strong></h5>
                                                         <h5><strong class="font-semibold"> Aircraft type rating for that specific aircraft : </strong></h5>
                                                         <p>Some text in the description.</p>
                                                         <h5><strong class="font-semibold"> Location : </strong></h5>
                                                         <h5><strong class="font-semibold"> Updated profile : </strong></h5>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer vd_bg-green">
                                                   <a href="<?php echo site_url('flight-board-subscription/s'); ?>">
                                                   <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                                                   <i class="fa fa-check"></i></span> Approve Applicant </button></a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- End Modal -->
                                       <div class="menu-action-icon vd_green" data-toggle="modal" data-target="#rejModal">   <i class="fa fa-user-times"></i> </div>
                                       <div class="modal fade" id="rejModal" role="dialog">
                                          <div class="modal-dialog">
                                             <!-- Modal content-->
                                             <div class="modal-content">
                                                <div class="modal-header vd_bg-green">
                                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   <h4 class="modal-title vd_white">
                                                   Disqualified</strong></h5>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                      <div class="col-md-12 col-xs-12">
                                                         <h5><strong class="font-semibold">Disqualified with comments </strong></h5>
                                                         <textarea rows="5" col="12" ></textarea>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer vd_bg-green">
                                                   <a href="<?php echo site_url('flight-board-subscription/s'); ?>">
                                                   <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                                                   <i class="fa fa-user-times"></i></span> Disqualified the Application </button></a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- End Modal -->
                                    </div>
                                 </li>
                              </ul>
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
                                 <li>
                                    <div class="menu-icon"><a href="#"><img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/avatar/avatar.jpg"></a></div>
                                    <div class="menu-text">
                                       <em>
                                          <h5><strong class="font-semibold">David Haney</strong></h5>
                                       </em>
                                    </div>
                                    <div class="menu-text">
                                       <div class="menu-info">
                                          <a href="#">
                                             <h5>Flight Attendant</h5>
                                          </a>
                                          <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : STU,MEL</span>
                                          <br/> <span class="menu-date "><i class="fa fa-clock"></i>12 Minutes Ago </span>
                                       </div>
                                    </div>
                                    <div class="menu-action">
                                       <div class="menu-action-icon vd_green"  data-toggle="modal" data-target="#FfeedModal">
                                          <i class="fa fa-upload"></i>
                                       </div>
                                       <!-- Modal -->
                                       <div class="modal fade" id="FfeedModal" role="dialog">
                                          <div class="modal-dialog">
                                             <!-- Modal content-->
                                             <div class="modal-content">
                                                <div class="modal-header vd_bg-green">
                                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   <h4 class="modal-title vd_white">
                                                   Send FeedBack</strong></h5>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                      <div class="col-md-12 col-xs-12">
                                                         <p> Give employer the option to send addendum(IF they paid for the monthly CTS and are accepting applications)
                                                         </p>
                                                         <a href="javascript:void(0);"  data-action="click-trigger">
                                                         <button type="button" class="btn vd_btn vd_bg-twitter btn-block">Send Addendum (If sent show SENT 2 days before)</button></a>
                                                         <div class="vd_mega-menu-content  vd_bg-white width-xs-5  center-xs-4 open-bottom" style="left:0px;" data-action="click-target">
                                                            <div class="child-menu pd-20">
                                                               <div class="content-list content-menu">
                                                                  <ul class="list-wrapper pd-lr-10">
                                                                     <li>
                                                                        <a href="#">
                                                                           <div>
                                                                              View Addendum Question
                                                                           </div>
                                                                        </a>
                                                                     </li>
                                                                     <li>
                                                                        <div>
                                                                           <div class="mgbt-xs-10"><a href="#">
                                                                              <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                                                                              <i class="fa fa-check"></i></span> Send Now </button></a>
                                                                           </div>
                                                                        </div>
                                                                     </li>
                                                                  </ul>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="row">
                                                      <div class="col-md-12 col-xs-12">
                                                         <a href="javascript:void(0);"  data-action="click-trigger">
                                                         <button type="button" class="btn vd_btn vd_bg-dark-blue btn-block">Driving Records Check + National Driver Registry  </button></a>
                                                         <br/> IF they paid for the monthly CTS and purchased below addons then send request forms to release .
                                                         <a href="javascript:void(0);"  data-action="click-trigger">
                                                         <button type="button" class="btn vd_btn vd_bg-dark-yellow btn-block"> Motor Vehicle Records </button></a>
                                                         <br/> IF they paid for the monthly CTS and purchased below addons then send request forms to release .
                                                         <a href="javascript:void(0);"  data-action="click-trigger">
                                                         <button type="button" class="btn vd_btn vd_bg-grey btn-block"> Criminal Background Check + County Criminal, Misdemeanor and Felony Records Search </button></a>
                                                         <br/> IF they paid for the monthly CTS and purchased below addons then send request forms to release .
                                                         <a href="javascript:void(0);"  data-action="click-trigger">
                                                         <button type="button" class="btn vd_btn vd_bg-blue btn-block">Resume Verifications per institution or reference  </button></a>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-footer vd_bg-green">
                                             </div>
                                          </div>
                                       </div>
                                       <!-- End Modal -->
                                       <div class="menu-action-icon vd_green" data-toggle="modal" data-target="#rejModal"> <i class="fa fa-user-times"></i> </div>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Panel Widget -->
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="panel widget" style="margin-left:-20px;">
                     <div class="panel-heading vd_bg-red">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fas fa-trash"></i> </span> Disqualified</h3>
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
                                 <li>
                                    <div class="menu-icon"><a href="#"><img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/avatar/avatar.jpg"></a></div>
                                    <div class="menu-text">
                                       <em>
                                          <h5><strong class="font-semibold">David Haney</strong></h5>
                                       </em>
                                    </div>
                                    <div class="menu-text">
                                       <div class="menu-info">
                                          <a href="#">
                                             <h5>Flight Attendant</h5>
                                          </a>
                                          <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : STU,MEL</span>
                                          <br/> <span class="menu-date "><i class="fa fa-clock"></i>12 Minutes Ago </span>
                                       </div>
                                    </div>
                                    <div class="menu-action">
                                       <div class="menu-action-icon vd_green"  data-original-title="Approve" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa fa-user-times"></i> </div>
                                       <div class="menu-action-icon vd_green"   data-original-title="Reject" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-user-times"></i> </div>
                                    </div>
                                 </li>
                              </ul>
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
                                 <li>
                                    <div class="menu-icon"><a href="#"><img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/avatar/avatar.jpg"></a></div>
                                    <div class="menu-text">
                                       <em>
                                          <h5><strong class="font-semibold">David Haney</strong></h5>
                                       </em>
                                    </div>
                                    <div class="menu-text">
                                       <div class="menu-info">
                                          <a href="#">
                                             <h5>Flight Attendant</h5>
                                          </a>
                                          <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : STU,MEL</span>
                                          <br/> <span class="menu-date "><i class="fa fa-clock"></i>12 Minutes Ago </span>
                                       </div>
                                    </div>
                                    <div class="menu-action">
                                       <div class="menu-action-icon vd_green"  data-original-title="Approve" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-user-plus"></i> </div>
                                       <div class="menu-action-icon vd_green"   data-original-title="Reject" data-toggle="tooltip" data-placement="bottom"> <i class="fa fa-user-times"></i> </div>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Panel Widget -->
               </div>
            </div>
         </div>
         <div class="tab-pane" id="tab33"> The ranking will be in this order
            <br/>
            1-   Location<br/>
            2-  Most recently updated profiles
         </div>
      </div>
   </div>
   <br/>
   <div class="vd_content-section clearfix">
      <h2 style="width:100%;padding:0px;">Following Your Flight Departments</h2>
      Flight departments can view their followers and click on links to a talent member’s profile, But not to their resume.
      <br/>
      The ranking for followers is simply who followed them first.
      <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel widget" style="margin-left:-20px;">
               <div class="panel-heading vd_bg-green">
                  <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-plane"></i> </span> Pilots</h3>
                  <!-- vd_panel-menu -->
               </div>
               <div class="panel-body-list">
                  <div class="content-list">
                     <div  data-rel="scroll" data-scrollheight="400"	>
                        <ul class="list-wrapper">
                          <?php if(count($data["following"]["p"]) > 0): ?>
                          <?php foreach($data["following"]["p"] as $user): ?>
                            <li>
                               <div class="center-block">
                             <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">
                               <img class="center-block" style="max-height: 100px;" src="<?php echo get_user_pic_url($user->user_image,$user->user_type); ?>">
                               <div class="menu-text"><em> <h5><?php echo $user->user_fname . " " . $user->user_lname; ?></h5></em> </div>
                               <div class="menu-text">
                                 <div class="menu-info">
                                     <a href="#"><h5><?php echo select_user_type($user->user_type); ?></h5></a>
                                     <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $user->user_rating; ?></span>
                               <br/> <span class="menu-date "><i class="fa fa-clock"></i><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $user->conn_created)); ?> </span>

                                 </div>
                             </div>
                           </a>
                          </div>
                           </li>
                                                 <?php endforeach; ?>
                         <?php endif; ?>

                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel widget" style="margin-left:-20px;">
               <div class="panel-heading vd_bg-green">
                  <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-toolbox"></i> </span> Mechanics</h3>
                  <!-- vd_panel-menu -->
               </div>
               <div class="panel-body-list">
                  <div class="content-list">
                     <div  data-rel="scroll" data-scrollheight="400"	>
                        <ul class="list-wrapper">
                          <?php if(count($data["following"]["m"]) > 0): ?>
                          <?php foreach($data["following"]["m"] as $user): ?>
                            <li>
                               <div class="center-block">
                             <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">
                               <img class="center-block" style="max-height: 100px;" src="<?php echo get_user_pic_url($user->user_image,$user->user_type); ?>">
                               <div class="menu-text"><em> <h5><?php echo $user->user_fname . " " . $user->user_lname; ?></h5></em> </div>
                               <div class="menu-text">
                                 <div class="menu-info">
                                     <a href="#"><h5><?php echo select_user_type($user->user_type); ?></h5></a>
                                     <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $user->user_rating; ?></span>
                               <br/> <span class="menu-date "><i class="fa fa-clock"></i><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $user->conn_created)); ?> </span>

                                 </div>
                             </div>
                           </a>
                          </div>
                           </li>
                                                 <?php endforeach; ?>
                         <?php endif; ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel widget" style="margin-left:-20px;">
               <div class="panel-heading vd_bg-green">
                  <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-user-tie"></i> </span>Flight Attendant</h3>
                  <!-- vd_panel-menu -->
               </div>
               <div class="panel-body-list">
                  <div class="content-list">
                     <div  data-rel="scroll" data-scrollheight="400"	>
                        <ul class="list-wrapper">
                          <?php if(count($data["following"]["a"]) > 0): ?>
                          <?php foreach($data["following"]["a"] as $user): ?>
                            <li>
                               <div class="center-block">
                             <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">
                               <img class="center-block" style="max-height: 100px;" src="<?php echo get_user_pic_url($user->user_image,$user->user_type); ?>">
                               <div class="menu-text"><em> <h5><?php echo $user->user_fname . " " . $user->user_lname; ?></h5></em> </div>
                               <div class="menu-text">
                                 <div class="menu-info">
                                     <a href="#"><h5><?php echo select_user_type($user->user_type); ?></h5></a>
                                     <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $user->user_rating; ?></span>
                               <br/> <span class="menu-date "><i class="fa fa-clock"></i><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $user->conn_created)); ?> </span>

                                 </div>
                             </div>
                           </a>
                          </div>
                           </li>
                                                 <?php endforeach; ?>
                         <?php endif; ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel widget" style="margin-left:-20px;">
               <div class="panel-heading vd_bg-green">
                  <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-headphones"></i> </span> Dispatchers</h3>
                  <!-- vd_panel-menu -->
               </div>
               <div class="panel-body-list">
                  <div class="content-list">
                     <div  data-rel="scroll" data-scrollheight="400"	>
                        <ul class="list-wrapper">
                          <?php if(count($data["following"]["s"]) > 0): ?>
                          <?php foreach($data["following"]["s"] as $user): ?>
                            <li>
                               <div class="center-block">
                             <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">
                               <img class="center-block" style="max-height: 100px;" src="<?php echo get_user_pic_url($user->user_image,$user->user_type); ?>">
                               <div class="menu-text"><em> <h5><?php echo $user->user_fname . " " . $user->user_lname; ?></h5></em> </div>
                               <div class="menu-text">
                                 <div class="menu-info">
                                     <a href="#"><h5><?php echo select_user_type($user->user_type); ?></h5></a>
                               <br/> <span class="menu-date "><i class="fa fa-clock"></i><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $user->conn_created)); ?> </span>

                                 </div>
                             </div>
                           </a>
                          </div>
                           </li>
                                                 <?php endforeach; ?>
                         <?php endif; ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

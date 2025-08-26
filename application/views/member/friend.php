<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-sm-3">
            <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?>
        </div>
        <div class="col-sm-9">
            <div class="tabs widget">

                <ul class="nav nav-tabs widget">
                    <li class="active"> <a data-toggle="tab" href="#home-tab"> Home <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li> <a data-toggle="tab" href="#profile-tab"> Profile <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li> <a data-toggle="tab" href="#photos-tab"> Photos <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li> <a data-toggle="tab" href="#friends-tab"> Friends <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li> <a data-toggle="tab" href="#groups-tab"> Flight Departments <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                </ul>
                <div class="tab-content">
                    <div id="home-tab" class="tab-pane active">
                        <div class="pd-20">


                            <div class="vd_content-section clearfix">

                                <div class="row">
                                    <div class="col-lg-8 col-md-9">
                                        <div class="tabs">
                                            <ul class="nav nav-tabs widget">
                                                <li > <a href="#main-tab" data-toggle="tab"> <span class="menu-icon"><i class="fa fa-comments"></i></span> Publish a post <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                                            </ul>
                                            <div class="tab-content  mgbt-xs-20">
                                                <div class="tab-pane active" id="main-tab">
                                                    <div class="myeditablediv"></div>
                                                    <a id="post-article" href="javascript:void(0);" style="border-left: 1px solid rgba(255,255,255,.3);position: absolute;bottom: 5px;right: 20px;color: #fff;padding: 0 15px;">
													<span class="menu-icon">
																		<i class="fa fa-camera fa-fw"></i>
																		</span>
                                                                                                            <span class="menu-icon">
																			<i class="fa fa-smile-o fa-fw"></i>
																		</span>
                                                                                                            <span class="menu-icon">
																			<i class="fa fa-check fa-fw"></i>
																		</span>
																		<span class="menu-text">
																			Post
																		</span>
                                                    </a>

                                                </div>




                                            </div>
                                        </div>



                                        <br/>
                                        <ul class="vd_timeline post-list"  zeroMessage="You don't have any favorite articles." barShowFuntion="" isBlocked="false" page="0" sort=""  barTitle="Favorite Articles" countContainer="#count-favorite-article" searchTerm="" url="<?php echo site_url('post/'.$this->session->userdata('user_id')); ?>" >
                                        </ul>
                                        <br/><br/>
                                    </div>
                                    <!-- col-md-x -->
                                    <div class="col-lg-4 col-md-3">
                                        <div class="panel widget light-widget">
                                            <?php $this->load->view('people_panel'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- row -->

                            </div>
                            <!-- .vd_content-section -->

                        </div> <!-- pd-20 -->
                    </div>  <!-- groups tab -->
                    <div id="profile-tab" class="tab-pane">
                        <div class="pd-20">
                            <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-user mgr-10 profile-icon"></i> PERSONAL INFO</h3>
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">First Name:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_fname'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">Last Name:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_lname'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">Email:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_email'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">Address:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_address'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">City:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_city'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">State:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_state'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">Zip Code:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_zip'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>



                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">Cell Phone:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_pmobile'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                            <hr class="pd-10"  />
                            <div class="row">
                                <!-- col-sm-7 -->
                                <div class="col-sm-7">
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-certificate mgr-10 profile-icon"></i>CERTIFICATE </h3>
                                    <div class="skill-list">
                                        <div class="skill-name"> <?php echo get_data_value($data,'user_certificate'); ?> Pilot</div>
                                    </div>
                                    <br/><br/>
                                    <?php $percent = (count(explode(',',get_data_value($data,'user_rating'))) / count(select_user_rating())) * 100; ?>
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-star-o mgr-10 profile-icon"></i>RATINGS</h3>
                                    <div class="skill-list">
                                        <div class="skill-name"> <?php echo get_data_value($data,'user_rating'); ?></div>
                                        <div class="progress  progress-sm">
                                            <div style="width: <?php echo $percent; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $percent; ?>" role="progressbar" class="progress-bar progress-bar-info "> <span class="sr-only"><?php echo $percent; ?>%</span> </div>
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <?php $percent = (count(explode(',',get_data_value($data,'user_rating_type'))) / count(select_user_rating_type())) * 100; ?>
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-star-half-empty mgr-10 profile-icon"></i>TYPE RATINGS</h3>
                                    <div class="skill-list">
                                        <div class="skill-name"> <?php echo get_data_value($data,'user_rating_type'); ?> </div>
                                        <div class="progress  progress-sm">
                                            <div style="width:<?php echo $percent; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $percent; ?>" role="progressbar" class="progress-bar progress-bar-info "> <span class="sr-only"><?php echo $percent; ?>%</span> </div>
                                        </div>
                                    </div>
                                    <br /><br />
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-plane mgr-10 profile-icon"></i>AIRCRAFT OWNERSHIP</h3>

                                    <?php if(count($data['aircraft'])): ?>
                                        <?php foreach($data['aircraft'] as $key=>$item): ?>
                                            <div class="row">
                                                <div class="col-sm-6"> <div class="text-center vd_info-parent"><br/> <img height="100px" alt="aircraft" src="<?php echo get_aircraft_photo_url(get_input_value($item,'photo','')); ?>"> </div></div>

                                                <div class="col-sm-6">
                                                    <div class="content-list">
                                                        <div data-rel="scroll">
                                                            <ul  class="list-wrapper">
                                                                <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Make <span class="menu-date"> : <?php echo $item['mfr_name'].' '.$item['year_mfr']; ?> </span> </span>  </li>
                                                                <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Model <span class="menu-date"> :  <?php echo $item['model_name']; ?> </span></span>  </li>

                                                            </ul>
                                                        </div></div>

                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="row">
                                            <div class="col-sm-6">No aircrafts found</div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <!-- col-sm-7 -->
                                <div class="col-sm-5">
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-globe mgr-10 profile-icon"></i> FLIGHT TIME</h3>
                                    <div class="">
                                        <div class="content-list">
                                            <div data-rel="scroll">
                                                <ul  class="list-wrapper">
                                                    <?php if(count($data['flightTime'])): ?>
                                                        <?php foreach($data['flightTime'] as $key=>$item): ?>
                                                            <li> <span class="menu-icon <?php echo ($key%2==0?'vd_yellow':($key%3==0?'vd_blue':'vd_red')); ?>"><i class="fa fa-plane"></i></span> <span class="menu-text"> <?php echo get_data_value($item,'time_key'); ?> <span class="menu-date"> : <?php echo get_data_value($item,'time_val'); ?> </span> </span>  </li>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                            <div class="closing text-left" style="padding:5px;"> <b>FLIGHT PHYSICAL EXAM</b> <i class="fa fa-angle-double-right"></i><b style="color:#F85D2C;font-size:13px;">  <?php echo get_data_value($data,'user_medical_month'); ?> - <?php echo get_data_value($data,'user_medical_year'); ?>  <?php echo get_data_value($data,'user_medical'); ?></b> </div>
                                        </div>
                                    </div>
                                    <br />
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-plane mgr-10 profile-icon"></i>FLIGHT TIME BY AIRCRAFT</h3>
                                    <?php if(count($data['aircraft_flown'])): ?>
                                        <?php foreach($data['aircraft_flown'] as $key=>$item): ?>
                                            <div class="row">
                                                <div class="col-sm-6"> <div class="text-center vd_info-parent"><br/> <img alt="aircraft" height="100px" src="<?php echo get_aircraft_photo_url(get_input_value($item,'photo','')); ?>"> </div></div>

                                                <div class="col-sm-6">
                                                    <div class="content-list">
                                                        <div data-rel="scroll">
                                                            <ul  class="list-wrapper">
                                                                <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Make <span class="menu-date"> : <?php echo $item['mfr_name'].' '.$item['year_mfr']; ?> </span> </span>  </li>
                                                                <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Model <span class="menu-date"> :  <?php echo $item['model_name']; ?> </span></span>  </li>
                                                                <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  <?php echo $item['total']; ?> </span></span> </li>
                                                                <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> PIC <span class="menu-date"> :  <?php echo $item['pic']; ?> </span></span>   </li>
                                                                <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> SIC <span class="menu-date"> :  <?php echo $item['sic']; ?> </span></span>  </li>
                                                                <li>  <span class="menu-icon vd_blue"><i class=" fa fa-renren"></i></span> <span class="menu-text"> Date of Last Flight <span class="menu-date"> :  <?php echo $item['date']; ?> </span></span>   </li>

                                                            </ul>
                                                        </div></div>

                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="row">
                                            <div class="col-sm-6">No aircrafts found</div>
                                        </div>
                                    <?php endif; ?>




                                </div>
                            </div>
                            <!-- row -->
                            <hr class="pd-10"  />
                            <div class="row">
                                <div class="col-sm-7 mgbt-xs-20">
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-file-text-o mgr-10 profile-icon"></i> WORK EXPERIENCE</h3>
                                    <div class="content-list content-menu">
                                        <ul class="list-wrapper">
                                            <?php if(isset($data['employers'])): ?>
                                                <?php foreach($data['employers'] as $item): $item = (array)$item; ?>
                                                    <li class="mgbt-xs-10"> <span class="menu-icon vd_green"><i class="fa  fa-circle-o"></i></span> <span class="menu-text"> <a href="#"><?php echo get_data_value($item,'empl_jobtitle'); ?></a> at <a href="#"><?php echo get_data_value($item,'empl_company'); ?></a> <span class="menu-info"><span class="menu-date"> <?php echo get_data_value($item,'empl_monthfromjob').' '.get_data_value($item,'empl_yearfromjob'); ?> ~ <?php echo get_data_value($item,'empl_monthtojob').' '.get_data_value($item,'empl_yeartojob'); ?></span><br/><strong>Duties: </strong><?php echo get_data_value($item,'empl_jobduties'); ?></span> </span> </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-trophy mgr-10 profile-icon"></i> EDUCATION</h3>
                                    <div class="content-list content-menu">
                                        <ul class="list-wrapper">
                                            <?php if(isset($data['educations'])): ?>
                                                <?php foreach($data['educations'] as $item): $item = (array)$item; ?>
                                                    <li class="mgbt-xs-10"> <span class="menu-icon vd_green"><i class="fa  fa-circle-o"></i></span> <span class="menu-text"> <?php echo get_data_value($item,'edu_degree'); ?> at <a href="#"><?php echo get_data_value($item,'edu_school'); ?></a> <span class="menu-info"><span class="menu-date"> <?php echo get_data_value($item,'edu_monthfromschool').' '.get_data_value($item,'edu_yearfromschool'); ?> ~ <?php echo get_data_value($item,'edu_monthtoschool').' '.get_data_value($item,'edu_yeartoschool'); ?></span></span> </span> </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>



                            <hr class="pd-10"  />
                            <div class="row">
                                <div class="col-sm-11 mgbt-xs-20">
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-gear mgr-10 profile-icon"></i> ADDITIONAL INFO </h3>

                                    <div class="content-list content-menu">
                                        <ul class="list-wrapper">
                                            <li class="mgbt-xs-10">  <span class="menu-text"> <h4> Volunteer Work</h4><a href="#"><?php echo get_data_value($data,'user_volunteerwork'); ?></a>  </span> </li>

                                        </ul>
                                    </div>

                                    <div class="content-list content-menu">
                                        <ul class="list-wrapper">
                                            <li class="mgbt-xs-10">  <span class="menu-text"> <h4> Additional Skills/Certifications</h4><a href="#"><?php echo get_data_value($data,'user_additional_skills'); ?></a>  </span> </li>

                                        </ul>
                                    </div>

                                    <div class="content-list content-menu">
                                        <ul class="list-wrapper">
                                            <li class="mgbt-xs-10">  <span class="menu-text"> <h4> Personal Information</h4><a href="#"><?php echo get_data_value($data,'user_bio'); ?></a>  </span> </li>

                                        </ul>
                                    </div>


                                </div>

                            </div>
                        </div>
                        <!-- pd-20 -->
                    </div>


                    <!-- To Edit Profile -->
                    <div id="profile-tab-edit" class="tab-pane">




                    </div>
                    <!-- end of edit profile -->

                    <!-- home-tab -->



                    <div id="photos-tab" class="tab-pane">
                        <div class="pd-20">
                            <h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-picture-o mgr-10 profile-icon"></i> PHOTOS</h3>
                            <br/>

                            <div class="isotope js-isotope vd_gallery">
                                <?php
                                if(count($data['photos']) > 0):
                                    foreach($data['photos'] as $item): $item = (array)$item; ?>
                                        <div class="gallery-item  filter-1">
                                            <a href="<?php echo get_photo_url($item['photo_path']); ?>" data-rel="<?php echo $item['photo_title']; ?>" style="background-image: url('<?php echo get_photo_url($item['photo_path']); ?>');background-position: center;">
                                                <div class="bg-cover"></div>
                                            </a>
                                            <div class="vd_info">
                                                <h3 class="mgbt-xs-15"><?php echo $item['photo_title']; ?></h3>
                                            </div>

                                        </div>
                                    <?php endforeach;
                                else:?>
                                    <div class="alert info">No photos uploaded</div>
                                <?php endif; ?>
                            </div>

                            <div class="clearfix"></div>

                        </div>
                        <!-- pd-20 -->
                    </div> <!-- photos tab -->



                    <!-- photos tab -->
                    <div id="friends-tab" class="tab-pane">
                        <div class="pd-20">
                            <h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-users mgr-10 profile-icon"></i> FRIENDS</h3>
                            <div class="content-grid column-xs-3 column-sm-4 column-md-4 column-lg-6 height-xs-4 mgbt-xs-20">
                                <div>
                                    <ul class="list-wrapper">
                                        <?php if(count($data['connections'])): ?>
                                            <?php foreach($data['connections'] as $key=>$item): $item = (array)$item; ?>
                                                <li>
                                                    <a href="<?php echo site_url('pilot/' + $item['user_id']); ?>">
												<span class="menu-icon">
													<img src="<?php echo get_user_pic_url($item['user_image'],$item['user_type']); ?>" alt="<?php echo($fullname); ?>" style="width: 100px;height: 100px;" />
												</span>
                                                    </a>
											<span class="menu-text"> <?php echo($fullname); ?>
                                                <span class="menu-info">
													<span class="menu-date"><?php echo get_data_value($item,'user_city'); ?></span>
													<span class="menu-action">
														<?php if($item['conn_status'] == 'p'): ?>
                                                            <span data-placement="bottom" data-toggle="tooltip" data-original-title="Approve" class="menu-action-icon vd_green vd_bd-green accept-user" object-id="<?php echo $item['conn_id']; ?>"><i class="fa fa-check"></i></span>
                                                            <span data-placement="bottom" data-toggle="tooltip" data-original-title="Reject" class="menu-action-icon vd_red vd_bd-red decline-user"  object-id="<?php echo $item['conn_id']; ?>"><i class="fa fa-times"></i></span>
                                                        <?php else: ?>
                                                            <span class="label label-danger unfollow-user" object-id="<?php echo $item['conn_id']; ?>">UNFRIEND</span>
                                                        <?php endif; ?>
													</span>
												</span>
											</span>
                                                </li>
                                            <?php endforeach;?>
                                        <?php else: ?>
                                            <p>No friends found</p>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div><!-- pd-20 -->
                    </div>

                    <div id="groups-tab" class="tab-pane">
                        <div class="pd-20">
                            <h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-leaf mgr-10 profile-icon"></i> Flight Departments</h3>
                            <div class="row">
                                <?php if(count($data['departments'])): ?>
                                    <?php foreach($data['departments'] as $key=>$item): $item = (array)$item; ?>

                                        <div class="col-xs-12 col-sm-6">
                                            <div class="content-list content-large menu-action-right">
                                                <ul class="list-wrapper pd-lr-15">
                                                    <li>
                                                        <div class="menu-icon"><a href="#"><img src="<?php echo get_user_pic_url($item['user_image'],'d'); ?>" alt="example image"></a></div>
                                                        <div class="menu-text">
                                                            <h4 class="mgbt-xs-0"><a href="#"><?php echo get_data_value($item,'user_company'); ?></a></h4>
                                                            <div class="menu-info">
                                                                <span class="menu-date"> <?php echo get_data_value($item,'user_count'); ?> members </span>

                                                            </div>
                                                            <p><?php echo substr(get_data_value($item,'user_bio'),0,100); ?>...</p>
                                                            <?php if($item['conn_status'] == 'connected'): ?>
                                                                <p><span class="label label-danger unfollow-user" object-id="<?php echo $item['user_id']; ?>">Unfollow</span></p>
                                                            <?php else: ?>
                                                                <p><span class="label label-success follow-user" object-id="<?php echo $item['user_id']; ?>">Follow</span></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </li>
                                                </ul> <!-- list-wrapper -->
                                            </div> <!-- content-list -->
                                        </div> <!-- col-xs-12 col-sm-6 -->
                                    <?php endforeach;
                                else:?>
                                    <div class="alert info">No groups uploaded</div>
                                <?php endif; ?>
                            </div> <!-- row -->
                        </div> <!-- pd-20 -->
                    </div>  <!-- groups tab -->

                </div>
                <!-- tab-content -->
            </div>
            <!-- tabs-widget -->
        </div>
    </div>
    <!-- row -->

</div>

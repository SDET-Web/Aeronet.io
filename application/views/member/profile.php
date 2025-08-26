<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-sm-3">
            <div class="panel widget light-widget panel-bd-top">
                <div class="panel-heading no-title"> </div>
                <div class="panel-body">
                    <div class="text-center vd_info-parent"> <img alt="example image" src="<?php echo get_user_pic_url(get_data_value($data,'user_image'),get_data_value($data,'user_type')); ?>"> </div>
                    <div class="row">
                        <?php if($data['user_id'] != $this->session->userdata('user_id')): ?>
                        <?php if($data['is_connected'] == null): ?>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-xs btn-block no-br connect_big" object-id="<?php echo $data['user_id']; ?>"><i class="fa fa-check-circle append-icon" ></i>Connect</a> </div>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-grey btn-xs btn-block no-br" href="<?php echo site_url('conversation/'.($this->session->userdata('user_id') > $data['user_id']?$this->session->userdata('user_id').'::'.$data['user_id']:$data['user_id'].'::'.$this->session->userdata('user_id'))); ?>"><i class="fa fa-envelope append-icon"></i>Send Message</a> </div>
                        <?php else: ?>
                        <?php if($data['is_connected']->conn_status == 'p'): ?>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-xs btn-block no-br" style="background-color:#f89c2c !important"><i class="fa fa-check-circle append-icon" ></i>Pending</a> </div>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-grey btn-xs btn-block no-br" href="<?php echo site_url('conversation/'.($this->session->userdata('user_id') > $data['user_id']?$this->session->userdata('user_id').'::'.$data['user_id']:$data['user_id'].'::'.$this->session->userdata('user_id'))); ?>"><i class="fa fa-envelope append-icon"></i>Send Message</a> </div>
                        <?php else: ?>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-xs btn-block no-br" style="background-color:#1b9859!important"><i class="fa fa-check-circle append-icon" ></i>Friends</a> </div>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-grey btn-xs btn-block no-br"  href="<?php echo site_url('conversation/'.($this->session->userdata('user_id') > $data['user_id']?$this->session->userdata('user_id').'::'.$data['user_id']:$data['user_id'].'::'.$this->session->userdata('user_id'))); ?>"><i class="fa fa-envelope append-icon"></i>Send Message</a> </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <br /><br />
                    <h2 class="font-semibold mgbt-xs-5"><?php echo get_data_value($data,'user_fname').' '.get_data_value($data,'user_lname'); ?></h2>
                    <?php  /*<h4> <?php echo get_select_user_type(get_data_value($data,'user_type')); ?></h4> */ ?>
                    <p> Certificate : <?php echo get_data_value($data,'user_certificate'); ?> Pilot<br/>
                        Ratings: <?php echo get_data_value($data,'user_rating'); ?><br/>
                        Type Ratings: <?php echo get_data_value($data,'user_rating_type'); ?> <br/>
                        Total Time : <?php echo isset($data['flightTime'][0])?get_data_value($data['flightTime'][0],'time_val'):''; ?><br/>
                        Instrument (actual): <?php echo isset($data['flightTime'][4])?get_data_value($data['flightTime'][4],'time_val'):''; ?><br/>
                        Multi Engine: <?php echo isset($data['flightTime'][6])?get_data_value($data['flightTime'][6],'time_val'):''; ?><br />
                         </p>
                    <div class="mgtp-20">
                        <div class="mgtp-20">
                            <table class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td style="width:60%;">Status</td>
                                    <td><span class="label label-<?php $tmp = get_select_user_status(get_data_value($data,'user_status'));echo $tmp[1]; ?>"><?php echo $tmp[0]; ?></span></td>
                                </tr>
                                <tr>
                                    <td>Flight Times Last Updated</td>
                                    <td> <?php echo get_data_value_date($data,'user_modified'); ?> </td>
                                </tr>
                                <tr>
                                    <td>WINGS Credits</td>
                                    <td><?php echo isset($data['course'])?count($data['course']).(count($data['course']) > 1?' Courses':' Course').'<br /><a href="'.site_url('course').'">View History</a>':'No Course submitted'; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- panel widget -->

            <div class="panel widget light-widget <?php echo ($data['is_connected'] == null?'hidden':''); ?>">
                <div class="panel-body-list">
                    <h3 class="pd-20 mgbt-xs-0"><i class="fa fa-users mgr-10"></i>Friends</h3>
                    <div class="content-grid column-xs-2 column-sm-3 height-xs-auto mgbt-xs-20">
                        <div>
                            <ul class="list-wrapper">
                                <?php if(count($data['connections'])): ?>
                                    <?php for($i = 0; $i < (count($data['connections']) > 9?9:count($data['connections']));$i++): $item = (array)$data['connections'][$i]; ?>
                                        <li> <a href="<?php echo site_url('pilot/'.$item['user_id']); ?>"> <span class="menu-icon"><img alt="example image" src="<?php echo get_user_pic_url($item['user_image'],$item['user_type']); ?>"></span> </a> </li>
                                    <?php endfor;?>
                                <?php else: ?>
                                    <p class="text-center">No connection found</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <?php if(count($data['connections']) > 9): ?>
                        <div class="closing text-center" style=""> <a href="#">See All Friends<i class="fa fa-angle-double-right prepend-icon"></i></a> </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- panel widget -->
            <div class="panel widget light-widget <?php echo ($data['is_connected'] == null?'':'hidden'); ?>">
                <div class="panel widget light-widget">
                    <?php $this->load->view('people_panel'); ?>
                </div>
            </div>

            <!-- panel widget -->

            <div class="panel widget light-widget <?php echo ($data['is_connected'] == null?'hidden':''); ?>">
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
            <div class="tabs widget">
                Note: Following Pilot profile page will not Show Home tab, Friends and Jobs Board sections to other pilots and departments.<br/>
                Instead of Friends it will show people you may know section to connect and departments to follow.
                <ul class="nav nav-tabs widget">
                    <li class="<?php echo ($data['is_connected'] == null?'hidden':'active'); ?>"> <a data-toggle="tab" href="#home-tab"> Home <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li class="<?php echo ($data['is_connected'] == null?'active':''); ?>"> <a data-toggle="tab" href="#profile-tab"> Profile <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li> <a data-toggle="tab" href="#photos-tab"> Photos <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li class="<?php echo ($data['is_connected'] == null?'hidden':''); ?>"> <a data-toggle="tab" href="#friends-tab"> Friends <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li class="<?php echo ($data['is_connected'] == null?'hidden':''); ?>"> <a data-toggle="tab" href="#groups-tab"> Groups <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                </ul>
                <div class="tab-content">
                    <div id="home-tab" class="tab-pane <?php echo ($data['is_connected'] == null?'':'active'); ?>">
                        <div class="pd-20">
                            <div class="vd_content-section clearfix">
                                <div class="row">
                                    <div class="col-lg-8 col-md-9">
                                        <ul class="vd_timeline post-list"  zeroMessage="You don't have any favorite articles." barShowFuntion="" isBlocked="false" page="0" sort=""  barTitle="Favorite Articles" countContainer="#count-favorite-article" searchTerm="" url="<?php echo site_url('post/'.$data['user_id']); ?>" >
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
                    <div id="profile-tab" class="tab-pane <?php echo ($data['is_connected'] == null?'active':''); ?>">
                        <div class="pd-20">
                            <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-user mgr-10 profile-icon"></i> Personal Info</h3>
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
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-certificate mgr-10 profile-icon"></i>Certificate </h3>
                                    <div class="skill-list">
                                        <div class="skill-name"> <?php echo get_data_value($data,'user_certificate'); ?> Pilot</div>
                                    </div>
                                    <br/><br/>
                                    <?php $percent = (count(explode(',',get_data_value($data,'user_rating'))) / count(select_user_rating())) * 100; ?>
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-star-o mgr-10 profile-icon"></i>Ratings</h3>
                                    <div class="skill-list">
                                        <div class="skill-name"> <?php echo get_data_value($data,'user_rating'); ?></div>
                                        <div class="progress  progress-sm">
                                            <div style="width: <?php echo $percent; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $percent; ?>" role="progressbar" class="progress-bar progress-bar-info "> <span class="sr-only"><?php echo $percent; ?>%</span> </div>
                                        </div>
                                    </div>
                                    <br/><br/>
                                    <?php $percent = (count(explode(',',get_data_value($data,'user_rating_type'))) / count(select_user_rating_type())) * 100; ?>
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-star-half-empty mgr-10 profile-icon"></i>Type Ratings</h3>
                                    <div class="skill-list">
                                        <div class="skill-name"> <?php echo get_data_value($data,'user_rating_type'); ?> </div>
                                        <div class="progress  progress-sm">
                                            <div style="width:<?php echo $percent; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $percent; ?>" role="progressbar" class="progress-bar progress-bar-info "> <span class="sr-only"><?php echo $percent; ?>%</span> </div>
                                        </div>
                                    </div>
                                    <br /><br />
                                    
                                   
                                     <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-child mgr-10 profile-icon"></i>FLIGHT PHYSICAL EXAM</h3>
                                    <div class="skill-list">
                                        <div class="skill-name"> <b style="color:#F85D2C;font-size:13px;">  <?php echo get_data_value($data,'user_medical_month'); ?> - <?php echo get_data_value($data,'user_medical_year'); ?>  <?php echo get_data_value($data,'user_medical'); ?></b>  </div>
                                        
                                    </div>
                                    <br /><br />
                                    
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-plane mgr-10 profile-icon"></i>Aircraft Ownership</h3>

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
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-globe mgr-10 profile-icon"></i> Flight Time</h3>
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
                                            
                                        </div>
                                    </div>
                                    <br />
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-plane mgr-10 profile-icon"></i>Flight Time by Aircraft</h3>
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
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-file-text-o mgr-10 profile-icon"></i> EXPERIENCE</h3>
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
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-gear mgr-10 profile-icon"></i> Additional Info</h3>

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
                    <div id="profile-tab-edit" class="tab-pane">




                    </div>
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
													<img src="<?php echo get_user_pic_url($item['user_image'],$item['user_type']); ?>" alt="<?php echo get_data_value($data,'user_fname').' '.get_data_value($data,'user_lname'); ?>" style="width: 100px;height: 100px;" />
												</span>
                                                    </a>
											<span class="menu-text"> <?php echo get_data_value($data,'user_fname').' '.get_data_value($data,'user_lname'); ?>
                                                <span class="menu-info">
													<span class="menu-date"><?php echo get_data_value($item,'user_city'); ?></span>
													<span class="menu-action">
														<?php if($item['conn_status'] == 'p'): ?>
                                                            <span data-placement="bottom" data-toggle="tooltip" data-original-title="Approve" class="menu-action-icon vd_green vd_bd-green accept-user" object-id="<?php echo $item['conn_id']; ?>"><i class="fa fa-check"></i></span>
                                                            <span data-placement="bottom" data-toggle="tooltip" data-original-title="Reject" class="menu-action-icon vd_red vd_bd-red decline-user"  object-id="<?php echo $item['conn_id']; ?>"><i class="fa fa-times"></i></span>
                                                        <?php else: ?>
                                                            <span class="label label-danger unfollow-user" object-id="<?php echo $item['conn_id']; ?>">UNFOLLOW</span>
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
                            <h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-leaf mgr-10 profile-icon"></i> GROUPS</h3>
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
                                                            <p><span class="label label-danger unfollow-user" object-id="<?php echo $item['user_id']; ?>">Unfollow</span></p>
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

<!-- Modal -->
<div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Send Message</h4>
            </div>
            <div class="modal-body">
                <textarea type="text" id="input-451-448" placeholder="Press enter to send you message" onkeyup="publicJS.sendMessage(event, $(this),<?php echo $data['user_id']; ?>)"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


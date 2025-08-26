<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-sm-3">
            <div class="panel widget light-widget panel-bd-top">
                <div class="panel-heading no-title"> </div>
                <div class="panel-body">
                    <div class="text-center vd_info-parent"> <img alt="example image" src="<?php echo get_user_pic_url(get_data_value($data,'user_image'),get_data_value($data,'user_type')); ?>"> </div>
                    <?php if($data['user_id'] != $this->session->userdata('user_id')): ?>
                    <?php if($data['is_connected'] == null): ?>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-xs btn-block no-br follow_big" object-id="<?php echo $data['user_id']; ?>"><br><h4><i class="fa fa-check-circle append-icon"></i>Follow</h4></a> </div>
                    <?php else: ?>
                        <div class="col-xs-12"> <a class="btn vd_btn vd_bg-green btn-xs btn-block no-br" style="background-color:#1b9859!important"><br><h4><i class="fa fa-check-circle append-icon"></i>Following</h4></a> </div>
                    <?php endif; ?>
                    <?php endif; ?>
                    <br /><br />
                    <br /><br />
                    <div class="row">
                        <div class="col-xs-12"><h2 class="font-semibold mgbt-xs-5"><?php echo get_data_value($data,'user_company'); ?></h2><?php echo get_data_value($data,'user_bio'); ?></div>
                    </div>
                    <h4> Verified Aircrafts</h4>
                    <p><?php if(count($data['aircraft'])): ?>
                            <?php foreach($data['aircraft'] as $key=>$item): ?>
                                <?php echo $item['mfr_name'].' '.$item['model_name']; ?><br />
                            <?php endforeach; ?>
                        <?php endif; ?></p>

                </div>
            </div>
            <!-- panel widget -->

            <div class="panel widget light-widget">
                <div class="panel widget light-widget">
                    <?php $this->load->view('people_panel',array('dept'=>true)); ?>
                </div>
            </div>

            <div class="panel widget light-widget <?php echo ($data['is_connected'] == null?'hidden':''); ?>">
                <div class="panel-body-list">
                    <h3 class="pd-20 mgbt-xs-0"><i class="fa fa-users mgr-10"></i>Pilot Pool</h3>
                    <div class="content-grid column-xs-2 column-sm-3 height-xs-auto mgbt-xs-20">
                        <div>
                            <ul class="list-wrapper">
                                <?php if(count($data['connections'])): ?>
                                    <?php for($i = 0; $i < (count($data['connections']) > 9?9:count($data['connections']));$i++): $item = (array)$data['connections'][$i]; ?>
                                        <li> <a href="<?php echo site_url('pilot/'.$item['user_id']); ?>"> <span class="menu-icon"><img alt="example image" src="<?php echo get_user_pic_url($item['user_image',$item['user_type']); ?>"></span> </a> </li>
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
                <ul class="nav nav-tabs widget">
                    <li class="<?php echo ($data['is_connected'] == null?'hidden':'active'); ?>"> <a data-toggle="tab" href="#home-tab"> Home <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li class="<?php echo ($data['is_connected'] == null?'active':''); ?>"> <a data-toggle="tab" href="#profile-tab"> Profile <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li> <a data-toggle="tab" href="#photos-tab"> Photos <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li class="<?php echo ($data['is_connected'] == null?'hidden':''); ?>"> <a data-toggle="tab" href="#friends-tab"> Pilot Pool <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li class="<?php echo ($data['is_connected'] == null?'hidden':''); ?>"> <a data-toggle="tab" href="#groups-tab"> Groups <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
                    <li> <a data-toggle="tab" href="#projects-tab"> Publish Post or News  <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>

                </ul>
                <div class="tab-content">

                    <div id="home-tab" class="tab-pane <?php echo ($data['is_connected'] == null?'hidden':'active'); ?>">
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
                                            <?php $this->load->view('people_panel',array('dept'=>true)); ?>
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
                            <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-user mgr-10 profile-icon"></i> Flight Department Info</h3>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row mgbt-xs-0">
                                        <label class="col-xs-5 control-label">Company Name:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_company'); ?></div>
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
                                        <label class="col-xs-5 control-label">Position:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_position'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>
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
                                        <label class="col-xs-5 control-label">Cell Phone:</label>
                                        <div class="col-xs-7 controls"><?php echo get_data_value($data,'user_pmobile'); ?></div>
                                        <!-- col-sm-10 -->
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                            <hr class="pd-10"  />
                            <div class="row">
                                <div class="col-sm-11 mgbt-xs-20">
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-star-o mgr-10 profile-icon"></i>Verified Aircraft</h3>
                                    <div class="skill-list">
                                        <div class="skill-name"><?php echo get_data_value($data,'user_planes'); ?></div>

                                    </div> <br/><br/>
                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-gear mgr-10 profile-icon"></i> Company Bio</h3>

                                    <div class="content-list content-menu">
                                        <ul class="list-wrapper">
                                            <li class="mgbt-xs-10">  <span class="menu-text"><?php echo get_data_value($data,'user_bio'); ?></span> </li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">

                                    <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-globe mgr-10 profile-icon"></i> Hiring Qualification</h3>
                                    <div class="row"><div class="col-sm-4">
                                            <div class="">
                                                <div class="content-list">

                                                    <ul  class="list-wrapper">
                                                        <h3 class="mgbt-xs-15 font-semibold" style="color:#5bc0de;">GULFSTREAM GIV</h3>
                                                        <b>Captain Qualifications Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> PIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>
                                                        <b>Captain Preferred Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> PIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>
                                                        <b>Co Pilot Qualifications Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> SIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>
                                                        <b>Co Pilot Preferred Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> SIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>


                                                    </ul>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="col-sm-4">
                                            <div class="">
                                                <div class="content-list">

                                                    <ul  class="list-wrapper">
                                                        <h3 class="mgbt-xs-15 font-semibold" style="color:#5bc0de;">GULFSTREAM GIII </h3>
                                                        <b>Captain Qualifications Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> PIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>
                                                        <b>Captain Preferred Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> PIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>
                                                        <b>Co Pilot Qualifications Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> SIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>
                                                        <b>Co Pilot Preferred Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> SIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>


                                                    </ul>
                                                </div>


                                            </div>

                                        </div>

                                        <div class="col-sm-4">
                                            <div class="">
                                                <div class="content-list">

                                                    <ul  class="list-wrapper">
                                                        <h3 class="mgbt-xs-15 font-semibold" style="color:#5bc0de;" >GULFSTREAM G650 </h3>
                                                        <b>Captain Qualifications Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> PIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>
                                                        <b>Captain Preferred Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> PIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>
                                                        <b>Co Pilot Qualifications Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> SIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>
                                                        <b>Co Pilot Preferred Minimums</b>
                                                        <li> <span class="menu-icon vd_yellow"><i class="fa fa-plane"></i></span> <span class="menu-text"> Certificate <span class="menu-date"> ATP </span> </span>  </li>
                                                        <li> <span class="menu-icon vd_blue"><i class=" fa fa-dashboard"></i></span> <span class="menu-text"> Total Flight Time <span class="menu-date"> :  1 Hour </span></span>  </li>
                                                        <li> <span class="menu-icon vd_red"><i class=" fa fa-cogs"></i></span> <span class="menu-text"> Total Time in Type <span class="menu-date"> :  12 </span></span> </li>
                                                        <li>  <span class="menu-icon vd_yellow"><i class=" fa fa-plane"></i></span> <span class="menu-text"> SIC Time in Type <span class="menu-date"> :  19 </span></span>   </li>
                                                        <li>  <span class="menu-icon vd_blue"><i class=" fa fa-cog"></i></span> <span class="menu-text"> College Degree <span class="menu-date"> :  Yes </span></span>  </li>


                                                    </ul>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <!-- col-sm-7 -->
                                </div>

                            </div>
                            <!-- row -->



                            <hr class="pd-10"  />

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
                                <div class="col-xs-12 col-sm-6">
                                    <div class="content-list content-large menu-action-right">
                                        <ul class="list-wrapper pd-lr-15">
                                            <li>
                                                <div class="menu-icon"><a href="#"><img src="img/groups/logo-01.jpg" alt="example image"></a></div>
                                                <div class="menu-text">
                                                    <h4 class="mgbt-xs-0"><a href="#">Groupis Group</a></h4>
                                                    <div class="menu-info">
                                                        <span class="menu-date"> 3467 members </span>

                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidtation ullamco...</p>
                                                </div>
                                                <div class="menu-action">
                                                    <div data-placement="bottom" data-toggle="tooltip" data-original-title="Leave Group" class="menu-action-icon vd_red">
                                                        <i class="fa fa-times"></i>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul> <!-- list-wrapper -->
                                    </div> <!-- content-list -->
                                </div> <!-- col-xs-12 col-sm-6 -->

                                <div class="col-xs-12 col-sm-6">
                                    <div class="content-list content-large menu-action-right">
                                        <ul class="list-wrapper pd-lr-15">
                                            <li>
                                                <div class="menu-icon"><a href="#"><img src="img/groups/logo-02.jpg" alt="example image"></a></div>
                                                <div class="menu-text">
                                                    <h4 class="mgbt-xs-0"><a href="#">Ztormin Community</a></h4>
                                                    <div class="menu-info">
                                                        <span class="menu-date"> 12597 members </span>

                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidtation ullamco...</p>
                                                </div>
                                                <div class="menu-action">
                                                    <div data-placement="bottom" data-toggle="tooltip" data-original-title="Leave Group" class="menu-action-icon vd_red">
                                                        <i class="fa fa-times"></i>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul> <!-- list-wrapper -->
                                    </div> <!-- content-list -->
                                </div> <!-- col-xs-12 col-sm-6 -->

                                <div class="col-xs-12 col-sm-6">
                                    <div class="content-list content-large menu-action-right">
                                        <ul class="list-wrapper pd-lr-15">
                                            <li>
                                                <div class="menu-icon"><a href="#"><img src="img/groups/logo-03.jpg" alt="example image"></a></div>
                                                <div class="menu-text">
                                                    <h4 class="mgbt-xs-0"><a href="#">Book Lovers</a></h4>
                                                    <div class="menu-info">
                                                        <span class="menu-date"> 67 members </span>

                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidtation ullamco...</p>
                                                </div>
                                                <div class="menu-action">
                                                    <div data-placement="bottom" data-toggle="tooltip" data-original-title="Leave Group" class="menu-action-icon vd_red">
                                                        <i class="fa fa-times"></i>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul> <!-- list-wrapper -->
                                    </div> <!-- content-list -->
                                </div> <!-- col-xs-12 col-sm-6 -->




                            </div> <!-- row -->
                        </div> <!-- pd-20 -->
                    </div>  <!-- groups tab -->
                    <div id="projects-tab" class="tab-pane">
                        <div class="pd-20">
                            <div class="clearfix"></div>
                            <div class="hidden new-add-edit" style="margin-top:50px;margin-bottom:50px;">
                                <input id="new-id" value="0" type="hidden" />
                                <textarea id="news-content" class="no-bd myeditablediv" rows="3" placeholder="What are you doing?" ></textarea>
                                <br />
                                <button type="submit" id="save-article" class="btn vd_btn btn-xs vd_bg-green"> <i class="fa fa-plus append-icon"></i> SAVE </button>
                            </div>


                            <h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-bolt mgr-10 profile-icon"></i> Internal Flight Department News</h3>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>

                                    <th> Date</th>
                                    <th>Details</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($data['news'])): ?>
                                    <?php foreach($data['news'] as $key=>$item): $item = (array)$item;?>
                                        <tr>
                                            <td class="center"><?php echo get_data_value_date($item,'post_created'); ?></td>
                                            <td><?php echo substr(strip_tags($item['post_content']),0,100); ?>... </td>



                                            <td class="menu-action rounded-btn">
                                                <a class="btn menu-icon vd_bg-green" onclick="publicJS.postDetail(<?php echo $item['post_id']; ?>);">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">No news found</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

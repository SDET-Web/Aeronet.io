<?php //print_r($data);exit; ?>
<div class="vd_content-section clearfix">
    <div class="row">
        <div class=" col-md-12 col-xs-12">
            <h3 class="mgbt-xs-15 mgtp-10 font-semibold"><i class="fa fa-search-plus mgr-10 profile-icon"></i> Pilot Search</h3>
<br/>
          
            <div class="row">
                <div class="col-lg-8 col-md-6 col-xs-12 <?php if($this->input->post('action') == ''): ?>hidden<?php endif; ?>">
                        <div class="panel widget light-widget">
                            <div class="panel-body">
                                <div class="content-list content-image content-chat">
                                    <ul class="list-wrapper no-bd-btm pd-lr-10">
                                        <?php $countP = 0; if(count($data['data'])): ?>
                                            <?php foreach($data['data'] as $key=>$item): $item = (array)$item;
                                                if($item['user_type'] != 'd'):
                                                    $countP++
                                                    ?>

                                                    <li style="padding:10px;">
                                                        <a href="<?php echo site_url('pilot/'.$item['user_id']); ?>">
                                                            <div class="menu-icon"><img src="<?php echo get_user_pic_url($item['user_image'],$item['user_type']); ?>" alt="<?php echo get_data_value($item,'user_name'); ?>"></div>
                                                            <div class="menu-text"> <b style="font-size:18px;"><?php echo get_data_value($item,'user_name'); ?></b>
                                                                <div class="menu-info">
                                                            <span class="menu-date" style="font-size:16px;color:#080;font-weight:600;font-style:normal;">
                                                            <?php echo get_select_user_type(get_data_value($item,'user_type')); ?></span>
                                                            <span style="font-size:16px;color:#999;font-weight:600;font-style:normal;">
                                                            <?php echo get_data_value($item,'user_address').' '.get_data_value($item,'user_city').' '.get_data_value($item,'user_state'); ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="menu-badge">
                                                                    <br/><br/><button type="button" class="btn vd_btn vd_bg-green connect">
                                                                        <i class="fa fa-check-circle append-icon"></i>Send Message</button>
                                                            </div>
                                                        </a>
                                                    </li>
                                                <?php endif;endforeach;?>
                                        <?php else: ?>
                                            <li class="group-heading vd_bg-black-20">No pilots matched the critera.</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                </div>
                <div class="<?php if($this->input->post('action') != ''): ?>col-lg-4 col-md-6<?php else: ?>col-lg-12 col-md-12<?php endif; ?>">
                    <form method="post">
                        <input type="hidden" name="action" value="search_member" />
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="panel widget light-widget">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="row">
                                                    <label class="col-md-12 col-sm-12 control-label">Which aircraft are you interested in staffing?</label>
                                                    <div class="col-md-12 col-sm-12">
                                                        <select class="selectAircraft select" name="aircrafts[]" multiple="multiple">
                                                            <?php foreach($data['aircraft'] as $aircraft): ?>
                                                                <option value="<?php echo $aircraft['aircraft_id']; ?>"><?php echo $aircraft['mfr_name'].' '.$aircraft['model_name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h4 class="col-md-12">Let's find the right pilot to meet your needs</h4>
                                            <div class="clearfix">&nbsp;</div>
                                            <?php foreach(array(
                                                              'typeRating'=>'Aircraft Type Rating',
                                                              'typeTime'=>'Time in Type',
                                                              'typeTimePilot'=>'Pilot-in-Command Time in Type',
                                                              'totalTime'=>'Total Time',
                                                              'totalTimePilot'=>'Total Pilot-in-Command',
                                                              'recency'=>'Recency',
                                                              'location'=>'Location',
                                                              'letter'=>'Letters of Recommendations',
                                                              'collegeDegree'=>'College Degree',
                                                              'gpa'=>'GPA',
                                                              'master'=>'Masters Degree',
                                                              'volunteer'=>'Volunteer Work',
                                                              'pageViews'=>'Flight department\'s page views',
                                                          ) as $key=>$val):?>
                                                <div class="form-group <?php if($this->input->post('action') != ''): ?>col-md-12<?php else: ?>col-md-6<?php endif; ?>">
                                                    <div class="row">
                                                        <label class="col-md-6 col-sm-12 control-label"><?php echo $val; ?></label>
                                                        <div class="col-md-6 col-sm-12">
                                                            <select id="<?php echo $key; ?>" class="select input" name="<?php echo $key; ?>">
                                                                <option value="0">Not Required</option>
                                                                <option value="1">Required</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>


                                            <h4 class="col-md-12">Key resume trigger words (these word are not required but simply boost a candidates ranking if found in their resume)</h4>
                                            <div class="form-group col-md-12">
                                                <div class="row">
                                                    <?php foreach(array(
                                                                      'International Experience',
                                                                      'A and P (aviation mx technician)',
                                                                      'Argus',
                                                                      '️Chief Pilot',
                                                                      '️Check Airman',
                                                                      '️Instructor',
                                                                      '️Part 91    (general aviation ops)',
                                                                      'Part 135 (on demand charter ops)',
                                                                      '️Part 121 (scheduled airline ops)',
                                                                      '️US Air Force',
                                                                      '️US Navy',
                                                                      '️US Marines',
                                                                      '️US Army',
                                                                      'Flight Safety',
                                                                      '️CAE Simuflite',
                                                                      '️SimCom',
                                                                      '️Aircraft Detailing',
                                                                      '️Others trigger words (i.e. University of Illinois,  veteran, etc)',
                                                                  ) as $val): ?>
                                                        <div class="checkbox <?php if($this->input->post('action') != ''): ?>col-md-6<?php else: ?>col-md-4<?php endif; ?> col-sm-6">
                                                            <label><input type="checkbox" name="keywords[]" value="<?php echo $val; ?>"><?php echo $val; ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="panel-footer">
                                        <button class="btn btn-success">Generate My Pilot Pool</button>
                                        <button class="btn btn-gray">Cancel</button>
                                    </div>
                                </div>
                                <br/><br/>
                                
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



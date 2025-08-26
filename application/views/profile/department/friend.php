    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-hidden">
            <div class="hidden-xs">
           <?php $this->load->view('profile/sidebar/department',array('data'=>$data)); ?>
        </div></div>
        <div class="col-md-8 col-sm-12 col-xs-12"><br/><a name="phead"></a>
        <a href="#">
    <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/passive.jpeg" type="button" data-toggle="modal" data-target="#PSV" class="img-responsive center-block"> </a>
     <br/>         <div class="row">
              <div class="col-md-5 col-sm-6 col-xs-12">
              <div class="panel widget" style="margin-left:-5px;">
                        <div class="panel-heading vd_bg-green text-center">
                        <h3 class="panel-title text-center"> <span class="menu-icon"> <i class="fa fa-plane"></i> </span> Pilots</h3>

                        <!-- vd_panel-menu -->
                        </div>
                 
                        <div class="panel-body-list">
                        <div class="content-list">
                        <div  data-rel="scroll" data-scrollheight="auto"	>
                        <ul class="list-wrapper pd-lr-15">
                          <?php if(count($data["following"]["p"]) > 0): ?>
                          <?php foreach($data["following"]["p"] as $user): ?>
                           <li>
                            <div class="menu-icon" style="width:75px;">
                             <img class="tl-img img-left img-circle  mgtp-5" src="<?php echo get_user_pic_url($user->user_image,$user->user_type); ?>" name="aboutme" style="height:50px;width:50px;"></span>
                            </div>
                              <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">  
                                  <div class="menu-text"><br/><em> <h5><b><?php echo $user->user_fname . " " . $user->user_lname; ?></b></h5></em> </div></a>
                             <div class="menu-text">
                                 <div class="menu-info">
                                     <a href="#"><h5><?php echo select_user_type($user->user_type); ?></h5></a>
                                <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $user->user_rating; ?></span>
                               <br/> <span class="menu-date "><i class="fa fa-clock"></i><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $user->conn_created)); ?> </span>

                                 </div>
                             </div>
                           
<?php $user_apply = $this->Model_cts->userApplicantApplications($user->user_id); ?>
<?php if(count($user_apply) > 0): ?>
<button type="button" class="btn vd_btn vd_bg-black-50 btn-block vd_white"><i class="fa fa-check-circle"></i> Already Shortlisted</button>
<?php else:?>
<?php if($data["subscription"]["braintree_plan"] == L8_PLAN_PREMIUM_CTS):
$url= 'headhunter/shortlist/' . $umodel["job_id"] . "/" . $resume. "/d" . "/" . $match["user_id"];
else:
$url= 'flight-dispatch-board/subscribe/addons/l8premiumcts';?>
<?php endif; ?>
<a href="<?php echo site_url('pilot/shortlist/' . $user->user_id ."/". $this->session->userdata('user_id')); ?>">    
<button type="button" class="btn vd_btn vd_bg-blue btn-block vd_white"><i class="fa fa-check-circle"></i> Shortlist </button></a>
<?php endif; ?>


    <br/>
                           </li>
                                                 <?php endforeach; ?>
                         <?php endif; ?>

                         </ul>



                        </div>
                         </div>
                        </div>
                        </div>
              </div>

                  <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="panel widget" style="margin-left:-20px;">
                        <div class="panel-heading vd_bg-green text-center">
                        <h3 class="panel-title text-center"> <span class="menu-icon"> <i class="fa fa-toolbox"></i> </span> Mechanics</h3>

                        <!-- vd_panel-menu -->
                        </div>
                        <div class="panel-body-list">
                        <div class="content-list">
                        <div  data-rel="scroll" data-scrollheight="auto"	>

                           <ul class="list-wrapper pd-lr-15">
                             <?php if(count($data["following"]["m"]) > 0): ?>
                             <?php foreach($data["following"]["m"] as $user): ?>
                               <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">
                              <li>
                                <div class="menu-icon" style="width:75px;">
                             <img class="tl-img img-left img-circle  mgtp-5" src="<?php echo get_user_pic_url($user->user_image,$user->user_type); ?>" name="aboutme" style="height:50px;width:50px;"></span>
                            </div>
                              <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">  
                                  <div class="menu-text"><br/><em> <h5><b><?php echo $user->user_fname . " " . $user->user_lname; ?></b></h5></em> </div></a>
                              <div class="menu-text">
                                    <div class="menu-info">
                                        <a href="#"><h5><?php echo select_user_type($user->user_type); ?></h5></a>
                                   <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $user->user_rating; ?></span>
                                  <br/> <span class="menu-date "><i class="fa fa-clock"></i><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $user->conn_created)); ?> </span>

                                    </div>
                                </div>

                              </li>
                            </a>
                                                    <?php endforeach; ?>
                            <?php endif; ?>


                         </ul>
                        </div>
                         </div>
                        </div>
                        </div>
                  </div>


                  <div class="col-md-5 col-sm-6 col-xs-12">
                   <div class="panel widget" style="margin-left:-20px;">
                        <div class="panel-heading vd_bg-green text-center">
                        <h3 class="panel-title text-center"> <span class="menu-icon"> <i class="fa fa-user-tie"></i> </span>Flight Attendant</h3>

                        <!-- vd_panel-menu -->
                        </div>
                        <div class="panel-body-list">
                        <div class="content-list">
                        <div  data-rel="scroll" data-scrollheight="auto"	>

                         <ul class="list-wrapper pd-lr-15">
                           <?php if(count($data["following"]["a"]) > 0): ?>
                           <?php foreach($data["following"]["a"] as $user): ?>
                            <li>
                              <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">
                              <div class="menu-icon" style="width:75px;">
                             <img class="tl-img img-left img-circle  mgtp-5" src="<?php echo get_user_pic_url($user->user_image,$user->user_type); ?>" name="aboutme" style="height:50px;width:50px;"></span>
                            </div>
                              <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">  
                                  <div class="menu-text"><br/><em> <h5><b><?php echo $user->user_fname . " " . $user->user_lname; ?></b></h5></em> </div></a>
                              <div class="menu-text">
                                  <div class="menu-info">
                                      <a href="#"><h5><?php echo select_user_type($user->user_type); ?></h5></a>
                                 <span class="menu-rating vd_yellow "><i class="fas fa-star"></i> Ratings : <?php echo $user->user_rating; ?></span>
                                <br/> <span class="menu-date "><i class="fa fa-clock"></i><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $user->conn_created)); ?> </span>

                                  </div>
                              </div>
                            </a>
                            </li>
                                                  <?php endforeach; ?>
                          <?php endif; ?>


                         </ul>


                        </div>
                         </div>
                        </div>
                        </div>
                  </div>


                  <div class="col-md-5 col-sm-6 col-xs-12">
                   <div class="panel widget" style="margin-left:-20px;">
                        <div class="panel-heading vd_bg-green text-center">
                        <h3 class="panel-title text-center"> <span class="menu-icon"> <i class="fa fa-headphones"></i> </span> Dispatchers</h3>

                        <!-- vd_panel-menu -->
                        </div>
                        <div class="panel-body-list">
                        <div class="content-list">
                        <div  data-rel="scroll" data-scrollheight="auto"	>
                         <ul class="list-wrapper pd-lr-15">
                           <?php if(count($data["following"]["s"]) > 0): ?>
                           <?php foreach($data["following"]["s"] as $user): ?>
                            <li>
                              <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">
                              <div class="menu-icon" style="width:75px;">
                             <img class="tl-img img-left img-circle  mgtp-5" src="<?php echo get_user_pic_url($user->user_image,$user->user_type); ?>" name="aboutme" style="height:50px;width:50px;"></span>
                            </div>
                              <a href="<?php echo site_url('pilot/' . $user->user_id); ?>">  
                                  <div class="menu-text"><br/><em> <h5><b><?php echo $user->user_fname . " " . $user->user_lname; ?></b></h5></em> </div></a>
                             <div class="menu-text">
                                  <div class="menu-info">
                                      <a href="#"><h5> Dispatcher </h5></a>
                                 <br/> <span class="menu-date "><i class="fa fa-clock"></i><?php echo get_time_elapsed_string(date("Y-m-d h:i:s", $user->conn_created)); ?> </span>

                                  </div>
                              </div>
                            </a>
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
<div id="PSV" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/passive.jpeg" class="img-responsive center-block">
      </div>
      <div class="modal-body">
<p> There’s no way around it — the perfect job candidate is often already employed.
<br/>
Traditional recruiting involves posting a job listing and waiting for candidates to apply. Passive candidate sourcing, on the other hand, refers to the process of proactively searching for employed candidates and reaching out to them in an effort to solicit their interest in your flight department. 
<br/>
Locating, wooing and successfully luring passive candidates used to be a difficult and arduous task.
<br/>
<strong>AeroNet simplifies and automates passive candidate sourcing</strong> by allowing members to follow your flight department-thus soliciting an interest.  
<br/>
AeroNet autonomously ranks members according to your preselected hiring requirements, then offers multiply routes to communicate and develop a professional relationship.  </p> 
 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
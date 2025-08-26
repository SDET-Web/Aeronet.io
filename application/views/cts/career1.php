<div class="vd_content-section clearfix">
<div class="row" style="margin-top:-15px;" >
   <div class="col-md-3 col-sm-4 col-xs-12">
     
         <?php $this->load->view('profile/sidebar/shortdep',array('data'=>$data)); ?>
     
   </div>

   <div class="col-md-8 col-sm-8 col-xs-12">
   <!--
   <h3 class="mgbt-xs-15 mgtp-10 font-semibold"> CAREERS </h3>  -->
   
  <!---   If condition when members will view career page and department has not subscribed        -->
 <?php if($this->session->userdata("user_type") <> "d" ): ?>

 <?php if($data["user_hiring"] == "" && $data["user_accepting_application"] == "" && $data["subscription"][0]["braintree_plan"] ==''): ?>
  
    <br/><h4 class='vd_blue'> Sorry, currently we are not accepting applications/resumes.<br/>
    <b>Please continue to follow our page to receive job alerts.</b></h4>
   
 <?php endif; ?>
   

 <?php if($data["subscription"][0]["braintree_plan"] == L8_PLAN_BASIC && $data["subscription"][0]["braintree_plan"] <> L8_PLAN_PREMIUM_CTS ): ?>

<div class="mgbt-xs-10"><a  target="blank" href="<?php echo site_url('flight-dispatch-board'); ?>">
               <br/>

               <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                <i class="fa fa-tasks"></i></span> View Job Board for  Latest Jobs </button></a>
                <?php //echo ($data["user_hiring"]. $data["user_accepting_application"]);?>


      </div><?php endif; ?>


 <?php endif; ?>


     <!--- If user type is D but not subscribed -->
    <?php if(!isset($data["subscription"][0]) && $data["subscription"][0]["braintree_plan"] == ''&& $this->session->userdata("user_type") == "d"): ?>
     <br/>
     <div class="panel widget">
         <div class="panel-heading vd_bg-green">
            <h4 class="panel-title"> <span class="menu-icon"> <i class="fa fa-podcast"></i> </span>
            Subscribe </h4>
         </div>
         <div class="panel-body">

       <div class="mgbt-xs-10"><a href="<?php echo site_url('flight-dispatch-board/create'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                <i class="fa fa-tasks"></i></span> Subscribe to Post Unlimited Free Jobs </button></a>
               </div>

        <div class="mgbt-xs-10"><a href="<?php echo site_url('flight-dispatch-board/create'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                <i class="fa fa-magic"></i></span> Subscribe to Crew Recruiter and ATS </button></a>
               </div>

         </div></div>

    <?php endif; ?>

      <!--- If user type is D but  subscribed to Basic Plan -->

<?php if($data["subscription"][0]["braintree_plan"] == L8_PLAN_BASIC && $this->session->userdata("user_type") == "d"): ?>

       <br/>
       <div class="panel widget">
         <div class="panel-heading vd_bg-green">
            <h4 class="panel-title"> <span class="menu-icon"> <i class="fa fa-podcast"></i> </span>
           Thanks for Subscribing to Basic Membership  </h4>
         </div>
         <div class="panel-body">

                    <div class="mgbt-xs-10"><a href="<?php echo site_url('flight-dispatch-board/create'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                <i class="fa fa-tasks"></i></span> Post Unlimited Free Jobs </button></a>
               </div>

             <div class="mgbt-xs-10"><a href="<?php echo site_url('applications/for-pilots'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                <i class="fa fa-users"></i></span> View Your Job Applicants </button></a>
               </div>

             <div class="mgbt-xs-10"><a href="<?php echo site_url('my/network'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                <i class="fa fa-link"></i></span> Your Passive Candidates </button></a>
               </div>
             <br/>
             <h5>Subscribe to Crew Recruiter and ATS  to Post Jobs with addendum, Applicant Tracking System
and passive candidates (followers) can be manually moved to the ATS.  </h5>
             <br/>

                   <a class="btn vd_btn vd_bg-green btn-lg" href="<?php echo site_url("flight-dispatch-board/subscribe/addons/l8premiumcts"); ?>">
                 Crew Recruiter and ATS <br/>
                       Get Started for Free 7 days trial</a> <br/>
         </div></div>

    <?php endif; ?>


 <!--- If user type is D and subscribed to ATS -->

 <?php if($data["subscription"][0]["braintree_plan"] == L8_PLAN_PREMIUM_CTS): ?>

     <?php if($this->session->userdata("user_type")  == "d"): ?>

       <br/>
      <div class="panel widget">
         <div class="panel-heading vd_bg-green">
            <h4 class="panel-title"> <span class="menu-icon"> <i class="fa fa-podcast"></i> </span> CANDIDATE TRACKING SOFTWARE  </h4>
         </div>
         <div class="panel-body">
            <div class="rows">
               <div class="col-md-8 col-sm-8 col-xs-12 pd-5">
                  <h4 class="vd_green">Sorry We’re Not Hiring</h4>
               </div>
               <div class="col-md-3 col-sm-4 col-xs-12 pd-5"> <input type="checkbox" id="notHiringSwitch" data-rel="switch"   data-wrapper-class="green" <?php echo ($data["user_hiring"] == "n" ? "checked" : ""); ?>>   </div>
               <div class="col-md-8 col-sm-8 col-xs-12 pd-5">
                 <?php if($data["user_accepting_application"] == "y"): ?>
                   <h4 class="vd_green">Accepting Applicants</h4>
                 <?php else: ?>
                 <h4 class="vd_green">Not Accepting Applicants</h4>
                 <?php endif;?>
               </div>
               <div class="col-md-3 col-sm-4 col-xs-12 pd-5"> <input type="checkbox" data-rel="switch" id="applicationSwitch"  data-wrapper-class="green" <?php echo ($data["user_accepting_application"] == "y" ? "checked" : ""); ?>>  </div>
               <div class="col-md-8 col-sm-8 col-xs-12 pd-5">
                  <h4 class="vd_green">We’re Hiring</h4>
               </div>
               <div class="col-md-3 col-sm-4 col-xs-12 pd-5">
              <input type="checkbox" id="hiringSwitch" data-rel="switch"   data-wrapper-class="green" <?php echo ($data["user_hiring"] == "y" ? "checked" : ""); ?>>   </div>


            </div>
         </div>
      </div>
    <?php endif; ?>
      <?php if($data["user_hiring"] == "y" && $this->session->userdata("user_type")  == "d"): ?>
       
       <div class="tabs widget">
  <ul class="nav nav-tabs widget">
    <li class="active"> <a data-toggle="tab" href="#profile-tab"> Step 1 <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
    <li> <a data-toggle="tab" href="#projects-tab"> Step 2 <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>    
    <li> <a data-toggle="tab" href="#photos-tab"> Step 3 <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
    <li> <a data-toggle="tab" href="#friends-tab"> Step 4 <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
    </ul>
  <div class="tab-content">
    <div id="profile-tab" class="tab-pane active">
        <div class="pd-20">pppppppppppppppppp</div>
        </div>
    <!-- home-tab -->
    
    <div id="projects-tab" class="tab-pane">
    	<div class="pd-20">vvvvvvvvvvvvvvv
</div>
        </div>
    <!-- home-tab -->
    
  </div>
</div>
       
       
       
      <div class="row">
         <div class="col-md-12">
            <div class="panel widget">
               <div class="panel-heading vd_bg-blue">
                  <h4 class="panel-title"> <span class="menu-icon"> <i class="fa fa-magic"></i> </span>Please Post Your Job Requirement Questions </h4>
               </div>
               <div class="panel-body-list">
                  <form class="form-horizontal" method="POST" id="app">
                    <input type="hidden" name="job_title" v-model="title" />
                    <input type="hidden" name="action" value="postJob" />
                     <div id="wizard-3" class="form-wizard condensed">
                        <ul class="nav nav-pills nav-justified">
                           <li>
                              <a href="#tab31" data-toggle="tab">
                                 <div class="menu-icon"> 1 </div>
                                 Step
                              </a>
                           </li>
                           <li>
                              <a href="#tab32" data-toggle="tab">
                                 <div class="menu-icon"> 2 </div>
                                 Step
                              </a>
                           </li>
                           <li>
                              <a href="#tab33" data-toggle="tab">
                                 <div class="menu-icon"> 3 </div>
                                 Step
                              </a>
                           </li>
                           <li>
                              <a href="#tab34" data-toggle="tab">
                                 <div class="menu-icon"> 4 </div>
                                 Step
                              </a>
                           </li>
                        </ul>
                        <div class="tab-content no-bd pd-25">
                           <div class="tab-pane" id="tab31">
                              <div class="form-group">
                                 <label class="col-sm-4 control-label"> Which aircraft are you interested in staffing? </label>
                                 <div class="col-sm-7 controls">
                                    <?php form_new_select_updated(select_aircraft_make_model_byUserID_forSubscription($this->session->userdata('user_id')), "", "aircraft", $this->input->post('aircraft'), true); ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label"> What position will the candidates be seeking?</label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(["c" => "Captain", "o" => "Co-Pilot", "p" => "Chief Pilot", "m" => "Maintenance Technician", "a" => "Flight Attendent", "d" => "Flight Dispatcher"], "", "target", $this->input->post('target'), true); ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label">Will the position be Full Time or Contract?</label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(["y" => "Full Time", "n" => "Contract Pilot"], "", "is_fulltime", $this->input->post('is_fulltime'), true); ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label">Average hours flown per year?</label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(["50-100" => "50-100", "100-200" => "100-200", "200-300" => "200-300", "400-500" => "400-500", "500+" => "500+"], "", "hours", $this->input->post('hours'), true); ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label">FAR Part 91 or 135?</label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(["91" => "91", "135" => "135", "Both" => "Both"], "", "far", $this->input->post('far'), true); ?>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="tab32">

                              <br/>
                              <template v-if="target == 'c' || target == 'o' || target == 'p'">
                                <h1> Let's find the right pilot to meet your needs.</h1>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">Certificates</label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["Commercial" => "Commercial", "ATP" => "ATP"], "", "pilot_0", $this->input->post('pilot_0'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">Aircraft Type Rating </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "pilot_1", $this->input->post('pilot_1'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label"> Currency  </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "pilot_2", $this->input->post('pilot_2'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">  Time in Type   </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["Required-100 minimum" => "Required-100 minimum", "Required-500 minimum" => "Required-500 minimum", "Required-1000 minimum" => "Required-1000 minimum", "Not Required" => "Not Required"], "", "pilot_3", $this->input->post('pilot_3'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label"> Total Time    </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["500 minimum" => "500 minimum", "1000 minimum" => "1000 minimum", "2500 minimum" => "2500 minimum", "5000 minimum" => "5000 minimum"], "", "pilot_4", $this->input->post('pilot_4'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label"> Total Pilot-in-Command   </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["500 minimum" => "500 minimum", "1000 minimum" => "1000 minimum", "2500 minimum" => "2500 minimum", "5000 minimum" => "5000 minimum"], "", "pilot_5", $this->input->post('pilot_5'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label"> Would you like all pilot candidates to complete the aviation addendum?  </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "pilot_6", $this->input->post('pilot_6'), true); ?>
                                   </div>
                                </div>
                              </template>
                              <template v-else-if="target == 'm'">
                                <h1>  Let's find the right Maintenance Technician to meet your needs.</h1>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">3 year minimum experience as A&P mechanic  </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "mechanic_0", $this->input->post('mechanic_0'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">Must have experience or training on Aircraft </label>
                                   <div class="col-sm-7 controls">
                                      <?php form_new_select_updated(select_aircraft_make_model_byUserID($this->session->userdata('user_id')), "", "mechanic_1", $this->input->post('mechanic_1'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label"> Must have Inspection Authorization (IA) </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "mechanic_2", $this->input->post('mechanic_2'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">Bachelors Degree </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "mechanic_3", $this->input->post('mechanic_3'), true); ?>
                                   </div>
                                </div>
                              </template>
                              <template v-else-if="target == 'a'">
                                <h1>Let's find the right Flight Attendant  to meet your needs.</h1>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">2 year minimum experience in Customer Service  </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "flight_0", $this->input->post('flight_0'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">FAA flight attendant certificate (trained under part 121)  </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "flight_1", $this->input->post('flight_1'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">Must have part 91 or 135 training at one of the following  </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["Flight Safety International (FSI)" => "Flight Safety International (FSI)", "FACTS" => "FACTS", "Corporate Flight Attendant Training & Global Consulting" => "Corporate Flight Attendant Training & Global Consulting"], "", "flight_2", $this->input->post('flight_2'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">Must have had part 91 or 135 training in the last 12 months.</label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "flight_3", $this->input->post('flight_3'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">Must have experience or training on Aircraft. </label>
                                   <div class="col-sm-7 controls">
                                      <?php form_new_select_updated(select_aircraft_make_model_byUserID($this->session->userdata('user_id')), "", "flight_4", $this->input->post('flight_4'), true); ?>
                                   </div>
                                </div>
                              </template>
                              <template v-else-if="target == 'd'">
                                <h1>Let's find the right Dispatcher to meet your needs.</h1>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">2 years minimum experience  </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "dispatcher_0", $this->input->post('dispatcher_0'), true); ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-4 control-label">Must have part 91 or part 135 experience  </label>
                                   <div class="col-sm-7 controls">
                                     <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "dispatcher_1", $this->input->post('dispatcher_1'), true); ?>
                                   </div>
                                </div>
                              </template>
                           </div>
                           <div class="tab-pane" id="tab33">
                              <div class="form-group">
                                 <label class="col-sm-4 control-label">Location  </label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(["l" => "Less than 100 miles", "a" => "Any Distance"], "", "state", $this->input->post('state'), true); ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label">College Degree </label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "college", $this->input->post('college'), true); ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label">Masters Degree  </label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "masters", $this->input->post('masters'), true); ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label">Volunteer Work  </label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(["y" => "Required", "n" => "Not Required"], "", "volunteer", $this->input->post('volunteer'), true); ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label"> Salary Range  </label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(["35k-50k" => "35k-50k", "50k-80K" => "50k-80K", "80k-120K" => "80k-120K", "120k-160K" => "120k-160K", "160k-180K" => "160k-180K", "180K+" => "180K+"], "", "salary", $this->input->post('salary'), true); ?>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-4 control-label"> Benefits  </label>
                                 <div class="col-sm-7 controls">
                                   <?php form_new_select_updated(select_benefits(), "", "benefits", $this->input->post('benefits'), true); ?>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="tab34">
                              <h4 class="vd_green"> Review Your Requirements</h4>
                              <h5><b> Position Title:</b> {{ targetText }} for Aircraft Name</h5>
                              <h5><b> Job Function :</b> Pilot/ captain</h5>
                              <h5><b> Job Type :</b> {{ fulltimeText }}</h5>
                              <h5><b>  Average hours flown per year : </b> {{ hours }}</h5>
                              <h5><b> FAR Part 91 or 135 : </b> {{ far }}</h5>
                              <br/>
                              <template v-if="target == 'c' || target == 'o' || target == 'p'">
                                <h4 class="vd_blue">Requirements for Pilots jobs</h4>
                                <h5><b>Certificates : </b> {{ pilot_0 }}</h5>
                                <h5><b> Aircraft Type Rating   : </b> {{ pilot_1 == "y" ? "Required" : "Not Required" }}</h5>
                                <h5><b> Currency : </b> {{ pilot_2 == "y" ? "Required" : "Not Required" }}</h5>
                                <h5><b>  Time in Type  : </b> {{ pilot_3 }}</h5>
                                <h5><b>  Pilot-in-Command Time in Type : </b> {{ pilot_4 }}</h5>
                                <h5><b>  Total Time  : </b> {{ pilot_5 }} </h5>
                                <h5><b>  Total Pilot-in-Command : </b> {{ pilot_6 == "y" ? "Required" : "Not Required" }} </h5>
                              </template>
                              <template v-else-if="target == 'm'">
                                <h4 class="vd_blue">Requirements for Maintenance Technician jobs</h4>
                                <h5><b> 3 year minimum experience as A&P mechanic : </b> {{ mechanic_0 == "y" ? "Required" : "Not Required" }}</h5>
                                <h5><b> Must have experience or training on Aircraft : </b> {{ mechanic_2 == "y" ? "Required" : "Not Required" }}</h5>
                                <h5><b> Bachelors Degree : </b> {{ mechanic_3 == "y" ? "Required" : "Not Required" }}</h5>
                              </template>
                              <template v-else-if="target == 'a'">
                                <h4 class="vd_blue">Requirements for Flight Attendent jobs</h4>
                                <h5><b> 2 year minimum experience in Customer Service : </b> {{ flight_0 == "y" ? "Required" : "Not Required" }}</h5>
                                <h5><b> FAA flight attendant certificate (trained under part 121) : </b> {{ flight_1 == "y" ? "Required" : "Not Required" }}</h5>
                                <h5><b> Must have part 91 or 135 training at one of the following : </b> {{ flight_2 == "y" ? "Required" : "Not Required" }}</h5>
                                <h5><b> Must have had part 91 or 135 training in the last 12 months : </b> {{ flight_3 == "y" ? "Required" : "Not Required" }}</h5>
                                <h5><b> Must have experience or training on Aircraft : </b> {{ flight_4 == "y" ? "Required" : "Not Required" }}</h5>
                              </template>
                              <template v-else-if="target == 'd'">
                                <h4 class="vd_blue">Requirements for Flight Dispatcher jobs</h4>
                                <h5><b> 2 years minimum experience : </b> {{ dispatcher_0 == "y" ? "Required" : "Not Required" }}</h5>
                                <h5><b> Must have part 91 or part 135 experience : </b> {{ dispatcher_1 == "y" ? "Required" : "Not Required" }}</h5>
                              </template>
                              <br/>
                              <h5><b>College Degree : </b> {{ college == "y" ? "Required" : "Not Required" }}</h5>
                              <h5><b> Masters Degree  : </b> {{ masters == "y" ? "Required" : "Not Required" }}</h5>
                              <h5><b> Volunteer Work : </b> {{ volunteer == "y" ? "Required" : "Not Required" }}</h5>
                              <h5><b> Salary Range : </b> {{ salary }}</h5>
                              <h5><b> Benefits: </b> {{ benefitsText }}</h5>
                           </div>

                           <div class="form-actions wizard mgtp-20">
                              <div class="row mgbt-xs-0">
                                 <div class="col-xs-6"> <a class="btn vd_btn prev" href="javascript:void(0);"><span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-left"></i></span> Previous</a> </div>
                                 <div class="col-xs-6 text-right">
                                   <a class="btn vd_btn next" href="javascript:void(0);">Next <span class="menu-icon"><i class="fa fa-fw fa-chevron-circle-right"></i></span></a>
                                    <button type="submit" class="btn vd_btn vd_bg-green finish"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Finish</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                      </div>

                  </form>
               </div>
            </div>
            <!-- Panel Widget -->
         </div>
         <!-- col-md-12 -->
      </div>
      <?php endif; ?>
      <!-- row -->


     <div class="panel widget"><br/>
         
     <?php if($data["user_hiring"] == "n" && $data["user_accepting_application"] == "n"): ?>

      <h4 class='vd_blue'>Sorry, currently we are not accepting applications/resumes.</h4>
      <br/>
      <?php endif; ?>
      
    <?php if($data["user_hiring"] == "n" && $data["user_accepting_application"] == "y"): ?>

      <h4 class='vd_blue'>Accepting applications/resumes for future positions.</h4>
      <br/>
      <?php endif; ?>

      <?php if(count($data["openings"]) > 0 &&  $data["user_hiring"] == "y" ): ?>
      
      <?php if($this->session->userdata("user_type")  <> "d"): ?>
      <h4 class='vd_blue'> We are hiring! </h4>
      
        We respect your career search, and understand the importance of a private search. 
       All information exchanged will remain confidential between applicant and flight department.
      <br/>
      <?php endif; ?>
      
      
      <?php foreach($data["openings"] as $opening): ?>
       <div class="panel-body">              
            <div class="row">
              <div class="col-xs-12">
               
                <?php if($opening->target == "c" || $opening->target == "o" || $opening->target == "p"): ?>
                  <div class="panel-heading vd_bg-green">
                    <h4 class="panel-title"> <span class="menu-icon"> <i class="fa fa-plane"></i> </span>
                       <?php echo $opening->title; ?>
                    </h4>
                 </div>
               <?php elseif($opening->target == "m"): ?>
                 <div class="panel-heading vd_bg-facebook">
                    <h4 class="panel-title"> <span class="menu-icon"> <i class="fa fa-toolbox"></i> </span>
                       We are Hiring and Accepting Applications for Maintenance Technician
                    </h4>
                 </div>

               <?php elseif($opening->target == "a"): ?>
                 <div class="panel-heading vd_bg-soft-green">
                    <h4 class="panel-title"> <span class="menu-icon"> <i class="fa fa-user-tie"></i> </span>
                       We are Hiring and Accepting Applications for Flight Attendant
                    </h4>
                 </div>
               <?php else: ?>
                 <div class="panel-heading vd_bg-blue">
                    <h4 class="panel-title"> <span class="menu-icon"> <i class="fa fa-headphones"></i> </span>
                       <?php echo $opening->title; ?>
                    </h4>
                 </div>
               <?php endif; ?>
              </div>
               <div class="col-md-7 col-xs-12">
                   
                 <br/>
                   <div class="mgbt-xs-10">
                     <button type="button" class="btn vd_btn vd_bg-blue btn-block"><b> Posted : </b> <?php echo date("F d, Y", $opening->created); ?> </button>
                  </div>
                  <h5 class="vd_blue"><b> <?php echo select_job_type($opening->target); ?> for <?php echo $opening->mfr . " " . $opening->model; ?> </b></h5>
                  <h5><b> Job Function :</b> <?php echo select_job_type($opening->target); ?></h5>
                  <h5><b> Job Type :</b> <?php echo $opening->is_fulltime != "y" ? "Contract Pilot" : "Full Time"; ?></h5>
                  <h5><b>  Average hours flown per year : </b> <?php echo $opening->hours; ?></h5>
                  <h5><b> FAR Part 91 or 135 : </b> <?php echo $opening->far; ?></h5>
                  <br/>
                  <?php if($opening->target == "c" || $opening->target == "o" || $opening->target == "p"): ?>
                  <h5><b>Certificates : </b> <?php echo $opening->pilot_0 == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b> Aircraft Type Rating   : </b> <?php echo $opening->pilot_1 == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b> Currency : </b> <?php echo $opening->pilot_2 == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b>  Time in Type  : </b> <?php echo $opening->pilot_3; ?></h5>
                  <h5><b>  Pilot-in-Command Time in Type : </b> <?php echo $opening->pilot_4; ?></h5>
                  <h5><b>  Total Time  : </b> <?php echo $opening->pilot_4; ?> </h5>
                  <h5><b>  Total Pilot-in-Command : </b> <?php echo $opening->pilot_6 == "y" ? "Required" : "Not Required"; ?> </h5>
                <?php elseif($opening->target == "m"): ?>
                  <h5><b>3 year minimum experience as A&P mechanic : </b> <?php echo $opening->mechanic_0 == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b>Must have experience or training on Aircraft : </b> <?php echo $opening->mechanic_1; ?></h5>
                  <h5><b>Must have Inspection Authorization (IA) : </b> <?php echo $opening->mechanic_2 == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b>Bachelors Degree : </b> <?php echo $opening->mechanic_3 == "y" ? "Required" : "Not Required"; ?></h5>
                <?php elseif($opening->target == "a"): ?>
                  <h5><b>2 year minimum experience in Customer Service : </b> <?php echo $opening->flight_0 == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b>FAA flight attendant certificate (trained under part 121) : </b> <?php echo $opening->flight_1 == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b>Must have part 91 or 135 training at one of the following : </b> <?php echo $opening->flight_2; ?></h5>
                  <h5><b>Must have had part 91 or 135 training in the last 12 months : </b> <?php echo $opening->flight_3 == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b>Must have experience or training on Aircraft : </b> <?php echo $opening->flight_4; ?></h5>
                <?php elseif($opening->target == "d"): ?>
                  <h5><b>2 years minimum experience : </b> <?php echo $opening->dispatcher_0 == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b>Must have part 91 or part 135 experience : </b> <?php echo $opening->dispatcher_0 == "y" ? "Required" : "Not Required"; ?></h5>
                <?php endif; ?>

               </div>
               <div class="col-md-5 col-xs-12">
                  <br/>
                  <h5><b>College Degree : </b> <?php echo $opening->college  == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b> Masters Degree  : </b> <?php echo $opening->masters  == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b> Volunteer Work : </b> <?php echo $opening->volunteer  == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b> Salary Range : </b> <?php echo $opening->salary_range; ?></h5>
                  <h5><b> Benefits: </b> <?php echo select_benefits($opening->benefits); ?></h5>
                  <br/>
                  <div class="mgbt-xs-10">

                    <?php if($this->session->userdata("user_type")  != "d" && $data["user_accepting_application"] == "y"): ?>
                      <?php if(in_array($opening->id, $data["jobsApplied"])): ?>
                        <a type="button" class="btn vd_btn vd_bg-gray btn-block" disabled><b> Already Applied </b> </a>
                      <?php else: ?>
                        <a type="button" href="?apply=<?php echo $opening->id; ?>" class="btn vd_btn vd_bg-green btn-block"><b> Apply </b> </a>
                      <?php endif; ?>
                   <?php endif; ?>



                     <br/>
                     <br/>
                     <?php if($this->session->userdata("user_type")  == "d"): ?>
                     <button type="button" data-id="<?php echo $opening->id; ?>" class="deleteOption btn vd_btn vd_bg-red btn-block"><b> Remove Post  </b> </button>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
      <?php endif; ?>
   </div>
  <?php endif; ?>
</div></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
var app = new Vue({
  el: '#app',
  data: {
    aircraft: "",
    target: "c",
    is_fulltime: "y",
    hours: "50-100",
    far: "91",
    pilot_0: "Commercial",
    pilot_1: "y",
    pilot_2: "y",
    pilot_3: "Required-100 minimum",
    pilot_4: "500 minimum",
    pilot_5: "500 minimum",
    pilot_6: "y",
    mechanic_0: "y",
    mechanic_1: "",
    mechanic_2: "y",
    mechanic_3: "y",
    flight_0: "y",
    flight_1: "y",
    flight_2: "Flight Safety International (FSI)",
    flight_3: "y",
    flight_4: "",
    dispatcher_0: "y",
    dispatcher_1: "y",
    state: "l",
    college: "y",
    masters: "y",
    volunteer: "y",
    salary: "35k-50k",
    benefits: "0"
  },

  computed: {
    targetText: function () {
      list = {
        "c": "Captain",
        "o": "Co-Pilot",
        "p": "Chief Pilot",
        "m": "Maintenance Technician",
        "a": "Flight Attendent",
        "d": "Flight Dispatcher"
      }
      return list[this.target]
    },

    fulltimeText: function () {
      list = {
        "y": "Full Time",
        "n": "Contract Pilot"
      }
      return list[this.is_fulltime]
    },

benefitsText: function () {
      list = {
        "0": "Company Paid Medical Dental and Vision",
        "1": "Company Paid Short Term Disability, Long Term Disability, and Basic Life",
        "2": "401k",
        "3": "Company"
      }
      return list[this.benefits]
    },

    title : function () {
      return "We are Hiring and Accepting Applications for " + this.targetText
    }
  }
});

<?php if(isset($data["subscription"][0]) && $data["subscription"][0]["braintree_plan"] == L8_PLAN_PREMIUM_CTS): ?>
$(document).ready(function() {
  $( "#hiringSwitch" ).on('switchChange.bootstrapSwitch', function(event, state) {
    if(state == true) {
      window.location.href = "?hiring=y"
    } else {
      window.location.href = "?hiring=n"
    }
  });
  $( "#notHiringSwitch" ).on('switchChange.bootstrapSwitch', function(event, state) {
    if(state == true) {
      window.location.href = "?hiring=n"
    } else {
      window.location.href = "?hiring=y"
    }
  });

  $( "#applicationSwitch" ).on('switchChange.bootstrapSwitch', function(event, state) {
    if(state == true) {
      window.location.href = "?application=y"
    } else {
      window.location.href = "?application=n"
    }
  });
});
<?php else: ?>
$(document).ready(function() {
  $( "#hiringSwitch, #applicationSwitch, #notHiringSwitch" ).on('switchChange.bootstrapSwitch', function(event, state) {
      window.location.href = "<?php echo site_url("flight-dispatch-board/create"); ?>";
  });
});
<?php endif; ?>
$(document).ready(function () {
  $(".deleteOption").click(function() {
    $("#deleteYes").attr("href", "?delete=" + $(this).attr("data-id"));
    $("#delModal").modal("show");
  });
});
</script>
<div class="modal fade" id="delModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header vd_bg-red">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title vd_white">
            Delete</strong></h4>
         </div>
         <div class="modal-body">
            <div>
               <div class="col-md-12 col-xs-12">
                  <h5><strong class="font-semibold">Are you sure you want to delete this position. </strong></h5>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a id="deleteYes" href="#" type="button" class="btn vd_btn vd_bg-blue">Yes </a>
            <button type="button" class="btn vd_btn" class="close" data-dismiss="modal">Close</button>

         </div>
      </div>
   </div>
</div>

<style>
career{margin-top:0px;background:#fff;}.container.hero{background:transparent url(<?php echo RIZ_ASSETS_BACKEND; ?>/img/careerbg.jpg) no-repeat center top; background-size:100% auto;min-height:157px}
.container .bumper{padding:30px 25px}.boxy{background:#fff;-webkit-box-shadow:0 0 15px #000;box-shadow:0 0 15px #000;position:relative}
.intro{margin-top:15px;font-size:20px;} .intro2{margin-top:10px;font-size:18px;}
container.relative{position:relative}.inline-block{display:inline-block}hr{margin:30px 0}hr.double-margin{margin:60px 0}
a.cr{-webkit-transition:all .15s linear;transition:all .15s linear;text-decoration:none;border-bottom:1px dashed;border-color:#005f9b}
a.cr:hover{border-color:#00304e;text-decoration:none}a.cr.no-transition{-webkit-transition:all 0s linear;transition:all 0s linear}.clear{clear:both}
div.page-title,h1.page-title{color:#fff;padding:15px;background:#005f9b;background:rgba(0,95,155,.75);margin:15px 0 0;height:72px;position:relative}
div.page-title:after,h1.page-title:after{content:'';line-height:0;font-size:0;width:0;height:0;border-bottom:72px solid rgba(0,95,155,.75);border-left:0 solid transparent;border-right:30px solid transparent;position:absolute;top:0;right:-30px}
h1{color:#005f9b}h2{color:#005f9b;font-size:24px} .thumb{background:#000;display:block;color:#fff;-webkit-box-shadow:4px 4px 0 rgba(0,0,0,.3);box-shadow:4px 4px 0 rgba(0,0,0,.3);margin-bottom:30px}.thumb img{display:block;max-width:100%;height:auto}.reverse .thumb{-webkit-box-shadow:-4px 4px 0 rgba(0,0,0,.3);box-shadow:-4px 4px 0 rgba(0,0,0,.3)}    

.control-label{
  font-family: 'Roboto Condensed', sans-serif;
  font-size:18px; font-weight:400; color:#2d79b4;
  padding: 15px; margin-bottom:10px;
}

.form-group input{
  width:100%;font-family: 'Roboto Condensed', sans-serif;
  font-size:22px; font-weight:400; color:#2d79b4;
  padding: 15px;background-color:#eeeeee;
  border: 1px solid #2d79b4; border-radius:4px;
  margin-bottom: 30px;
}
.form-group ::-webkit-input-placeholder {
  color:#2d79b4;
  text-transform: capitalize;
}

.form-group :-moz-placeholder { /* Firefox 18- */
  color:#2d79b4;
  text-transform: capitalize;
}

.form-group ::-moz-placeholder {  /* Firefox 19+ */
  color:#2d79b4;
  text-transform: capitalize;
}

.form-group select{
  font-family: 'Roboto Condensed', sans-serif;
  font-size:18px; font-weight:400; color:#2d79b4;
  padding: 15px; border: 1px solid #2d79b4; border-radius:4px;
  margin-bottom: 30px;
}


</style>

<career>
<div class="container relative hero">
<div class="bumper">
<h1 class="inline-block page-title">Edit Careers</h1>
<div class="boxy">
<div class="bumper">
          
<div class="row">
<div class="col-xs-12 col-sm-8"><?php $this->load->view('profile/sidebar/career_bar',array('data'=>$data)); ?> 

<!--- If user type is D but not subscribed CTS  -->
    <?php if($data["subscription"]["braintree_plan"] <> L8_PLAN_PREMIUM_CTS && $this->session->userdata("user_type") == "d"): ?>
     <div class="swiper-container s2">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="container">
                <h4 class="vd_red intro" style="text-align:center;">Sorry, Currently we are not accepting applications.</h4>   
            </div></div>
            
            <div class="swiper-slide">
                <div class="container">
                <h4 class="vd_yellow intro" style="text-align:center;">Accepting applications for future opportunities! We look forward to reviewing your
                    resume and watching your professional progression.</h4>
                </div></div>
               
        <div class="swiper-slide">
                <div class="container ">
                <h4 class="vd_green intro" style="text-align:center;">Yes We’re hiring! We look forward to reviewing your resume and getting to know you.</h4>			
                        </div></div>
 </div>
    <!-- Add Pagination --><br/>
    <div class="swiper-pagination padding-top-50"></div>
  </div>      
    
<hr /> 

<div class="panel widget">
     <div class="panel-body">         
            <div class="row">               
               <div class="col-md-12 col-sm-12 col-xs-12">
                   <h4 class="vd_blue"><u>Upgrade to:</u></h4>  
                   <h4 class="vd_grey">A Complete Talent Acquisition Suit for small and Mid Size Flight Departments </h4>
                   <p>Recruiting and Applicant Tracking Software(ATS) built around your aircraft and culture with automated work flows that mirror air carrier internal HR processes.</p>
              
               <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/hire-ring.png" class="img-responsive center-block" >
                <br/><br/>   <h4 class="vd_blue" style="text-align:center;">Pause or cancel anytime</h4> <br/><br/>
                <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/CTS.png" class="img-responsive center-block" >   
                    <br/>
<div style="text-align:center;">
                   <a class="btn vd_btn vd_bg-green btn-lg" href="<?php echo site_url("flight-dispatch-board/subscribe/addons/l8premiumcts"); ?>">
                 Crew Recruiter and ATS <br/>
                 Get Started for Free 7 days trial</a> </div>             
               </div></div></div></div>
<?php endif; ?>

<?php if($data["subscription"]["braintree_plan"] == L8_PLAN_PREMIUM_CTS): ?>
 <?php if($this->session->userdata("user_type")  == "d"): ?>
      <div class="panel widget">
         <div class="panel-heading vd_bg-soft-blue">
            <h4 class="panel-title"> <span class="menu-icon"> <i class="fa fa-podcast"></i> </span> CANDIDATE TRACKING SOFTWARE  </h4>
         </div>
         <div class="panel-body" style="background-color:#DBF4FD;">
            <div class="rows">
               <div class="col-md-8 col-sm-8 col-xs-12 pd-5">
                  <h4 class="vd_blue intro">Sorry We’re Not Hiring</h4>
               </div>
               <div class="col-md-3 col-sm-4 col-xs-12 pd-5"> <input type="checkbox" id="notHiringSwitch" data-rel="switch"   data-wrapper-class="green" <?php echo ($data["user_not_hiring"] == "y" ? "checked" : ""); ?>>   </div>
               <div class="col-md-8 col-sm-8 col-xs-12 pd-5">
                 <?php if($data["user_accepting_application"] == "y"): ?>
                   <h4 class="vd_blue intro">Accepting Applicants</h4>
                 <?php else: ?>
                 <h4 class="vd_blue intro">Accepting Applicants</h4>
                 <?php endif;?>
               </div>
               <div class="col-md-3 col-sm-4 col-xs-12 pd-5"> <input type="checkbox" data-rel="switch" id="applicationSwitch"  data-wrapper-class="green" <?php echo ($data["user_accepting_application"] == "y" ? "checked" : ""); ?>>  </div>
               <div class="col-md-8 col-sm-8 col-xs-12 pd-5">
                  <h4 class="vd_blue intro">We’re Hiring</h4>
               </div>
               <div class="col-md-3 col-sm-4 col-xs-12 pd-5">
              <input type="checkbox" id="hiringSwitch" data-rel="switch"   data-wrapper-class="green" <?php echo ($data["user_hiring"] == "y" ? "checked" : ""); ?>>   </div>
                
            </div>
         </div>
      </div>
    <?php endif; ?>

<?php if(($data["user_hiring"] == "y" || $data["user_accepting_application"] == "y") && $this->session->userdata("user_type")  == "d"): ?>

 
       <div class="row">
        <div class="col-sm-7 col-xs-12 pd-25">
                   <h4 class="vd_blue">Do you want to show the Equal Employment Opportunity Commission logo on your career page?</h4>
                    <img src="<?php echo RIZ_ASSETS; ?>images/slider/EEO.png" class="center-block" width="200" height="200" > 
                </div>
                <div class="col-sm-5 col-xs-12 pd-25" style="text-align:center;"> 
                 <input type="checkbox" id="logo" data-rel="switch"   data-wrapper-class="green" > </div>
        </div>
       
       <div class="panel-heading vd_bg-black-60">           
        <h4 class="panel-title vd_white"> Post Your Job Requirement Questions </h4>
        </div>

       <div class="tabs widget">
  <ul class="nav nav-tabs widget">
    <li class="active"> <a data-toggle="tab" href="#tab31"> Step 1 <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
    <li> <a data-toggle="tab" href="#tab32"> Step 2 <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
    <li> <a data-toggle="tab" href="#tab33"> Step 3 <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
    <li> <a data-toggle="tab" href="#tab34"> Step 4 <span class="menu-active"><i class="fa fa-caret-up"></i></span> </a></li>
    </ul>
  <form class="form-horizontal" method="POST" id="app">
                    <input type="hidden" name="job_title" v-model="title" />
                    <input type="hidden" name="action" value="postJob" />

  <div class="tab-content no-bd pd-25" style="background-color:#DBF4FD;">

                           <div class="tab-pane active" id="tab31">
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
                                  
                                  <h4 class="vd_green"> Let's find the right pilot to meet your needs. </h4>
                                  <br/>
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
                                  <h4 class="vd_green"> Let's find the right Maintenance Technician to meet your needs. </h4>
                                  <br/>
                                
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
                                <h4 class="vd_green">Let's find the right Flight Attendant  to meet your needs.</h4>
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
                                <h4 class="vd_green"> Let's find the right Dispatcher to meet your needs.</h4>
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
                              <h3 class="vd_green"> Review Your Requirements</h3>
                              <h4><b> Position Title:</b> {{ targetText }} for Aircraft Name</h4>
                              <h4><b> Job Function :</b> Pilot/ captain</h4>
                              <h4><b> Job Type :</b> {{ fulltimeText }}</h4>
                              <h4><b>  Average hours flown per year : </b> {{ hours }}</h4>
                              <h4><b> FAR Part 91 or 135 : </b> {{ far }}</h4>
                              <br/>
                              <template v-if="target == 'c' || target == 'o' || target == 'p'">
                                <h3 class="vd_blue">Requirements for Pilots jobs</h3>
                                <h4><b>Certificates : </b> {{ pilot_0 }}</h4>
                                <h4><b> Aircraft Type Rating   : </b> {{ pilot_1 == "y" ? "Required" : "Not Required" }}</h4>
                                <h4><b> Currency : </b> {{ pilot_2 == "y" ? "Required" : "Not Required" }}</h4>
                                <h4><b>  Time in Type  : </b> {{ pilot_3 }}</h4>
                                <h4><b>  Pilot-in-Command Time in Type : </b> {{ pilot_4 }}</h4>
                                <h4><b>  Total Time  : </b> {{ pilot_5 }} </h4>
                                <h4><b>  Total Pilot-in-Command : </b> {{ pilot_6 == "y" ? "Required" : "Not Required" }} </h4>
                                <h4><b>  Would you like all pilot candidates to complete the aviation addendum? : </b> {{ pilot_6 == "y" ? "Required" : "Not Required" }} </h4>


                              </template>
                              <template v-else-if="target == 'm'">
                                <h3 class="vd_blue">Requirements for Maintenance Technician jobs</h3>
                                <h4><b> 3 year minimum experience as A&P mechanic : </b> {{ mechanic_0 == "y" ? "Required" : "Not Required" }}</h4>
                                <h4><b> Must have experience or training on Aircraft : </b> {{ mechanic_2 == "y" ? "Required" : "Not Required" }}</h4>
                                <h4><b> Bachelors Degree : </b> {{ mechanic_3 == "y" ? "Required" : "Not Required" }}</h4>
                              </template>
                              <template v-else-if="target == 'a'">
                                <h3 class="vd_blue">Requirements for Flight Attendent jobs</h3>
                                <h4><b> 2 year minimum experience in Customer Service : </b> {{ flight_0 == "y" ? "Required" : "Not Required" }}</h4>
                                <h4><b> FAA flight attendant certificate (trained under part 121) : </b> {{ flight_1 == "y" ? "Required" : "Not Required" }}</h4>
                                <h4><b> Must have part 91 or 135 training at one of the following : </b> {{ flight_2 == "y" ? "Required" : "Not Required" }}</h4>
                                <h4><b> Must have had part 91 or 135 training in the last 12 months : </b> {{ flight_3 == "y" ? "Required" : "Not Required" }}</h4>
                                <h4><b> Must have experience or training on Aircraft : </b> {{ flight_4 == "y" ? "Required" : "Not Required" }}</h4>
                              </template>
                              <template v-else-if="target == 'd'">
                                <h3 class="vd_blue">Requirements for Flight Dispatcher jobs</h3>
                                <h4><b> 2 years minimum experience : </b> {{ dispatcher_0 == "y" ? "Required" : "Not Required" }}</h4>
                                <h4><b> Must have part 91 or part 135 experience : </b> {{ dispatcher_1 == "y" ? "Required" : "Not Required" }}</h4>
                              </template>
                              <br/>
                               <h4><b>Location : </b> {{ stateText }}</h4>

                              <h4><b>College Degree : </b> {{ college == "y" ? "Required" : "Not Required" }}</h4>
                              <h4><b> Masters Degree  : </b> {{ masters == "y" ? "Required" : "Not Required" }}</h4>
                              <h4><b> Volunteer Work : </b> {{ volunteer == "y" ? "Required" : "Not Required" }}</h4>
                              <h4><b> Salary Range : </b> {{ salary }}</h4>
                              <h4><b> Benefits: </b> {{ benefitsText }}</h4>
                              <div class="row mgbt-xs-0">
                                 <div class="col-xs-12">
                <button type="submit" class="btn large vd_btn vd_bg-blue finish"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Post Job Now</button>
<a class="btn large vd_btn vd_bg-green" href="<?php echo site_url('careers'); ?>">View Your Jobs List </a>
</div></div></div>
</form></div></div>
<?php endif; ?>
      <!-- row -->     
<?php endif; ?>
</div>

<div class="col-xs-12 col-sm-4">
<div class="thumb">
<img width="380" height="230" src="<?php echo RIZ_ASSETS_BACKEND; ?>img/career.jpg" 
     class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="about" /></div>
     <br>
<hr>
<div class="textwidget" style="text-align:center;">
<h3>Contract Crew Scheduler</h3>
<p>Send trip alerts to your contract crew network.</p>
<div class="textwidget"><br><a class="cr" href="" class="fancybox">
        <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/flight_calender.jpg" alt="Aeronet.io career" class="img-responsive"></a></div>
</div>

</div></div>
            
            
        
</div>
</div>
</div></div>
</career>
   
   
    
    
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

    stateText: function () {
      list = {
        "l": "Less than 100 miles",
        "a": "Any Distance"
      }
      return list[this.state]
    },

    title : function () {
      return "We are Hiring and Accepting Applications for " + this.targetText
    }
  }
});

<?php if($data["isSubscribed"] == true): ?>
$(document).ready(function() {
  $( "#hiringSwitch" ).on('switchChange.bootstrapSwitch', function(event, state) {
    if(state == true) {
      window.location.href = "?hiring=y&application=n"
    } else {
      window.location.href = "?hiring=n&application=n"
    }
  });
  $( "#notHiringSwitch" ).on('switchChange.bootstrapSwitch', function(event, state) {
    if(state == true) {
      window.location.href = "?hiring=n&application=n"
    } else {
      window.location.href = "?hiring=y&application=n"
    }
  });

  $( "#applicationSwitch" ).on('switchChange.bootstrapSwitch', function(event, state) {
    if(state == true) {
      window.location.href = "?application=y&hiring=n"
    } else {
      window.location.href = "?application=n&hiring=n"
    }
  });
});
<?php else: ?>
$(document).ready(function() {
  $( "#hiringSwitch, #applicationSwitch, #notHiringSwitch" ).on('switchChange.bootstrapSwitch', function(event, state) {
      window.location.href = "<?php echo site_url("flight-dispatch-board/subscribe/addons/l8premiumcts"); ?>";
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

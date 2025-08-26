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
</style>

<career>
<div class="container relative hero">
<div class="bumper">
<h1 class="inline-block page-title">Careers</h1>
<div class="boxy">
<div class="bumper">
          
<div class="row">
<div class="col-xs-12 col-sm-10"><?php $this->load->view('profile/sidebar/career_bar',array('data'=>$data)); ?> 
    
    <?php if($data["isSubscribed"] == null && $data['user_id'] == $this->session->userdata('user_id')):?><br/>
    <h4 class="text-center vd_blue">Your application window is now closed; please subscribe to AeroNet’s Applicant Tracking System to continue receiving applications.</h4><br/><br/>
    <a class="btn vd_btn vd_bg-blue btn-xs btn-block pd-10" href="<?php echo site_url('flight-dispatch-board/subscribe/addons/l8premiumcts'); ?>">
        <h4>Subscribe Now </h4></a>
    <?php endif; ?>
      
     <?php if($data["user_hiring"] == "n" && $data["user_accepting_application"] == "n"):  ?><p class="pd-20"></p>
    <h2 class='vd_btn vd_bg-red vd_white pd-20'>Sorry, currently we are not accepting applications/resumes.</h2>
     <?php endif; ?>

    <?php if($data["user_hiring"] == "n" && $data["user_accepting_application"] == "y"): ?><p class="pd-20"></p>
      <h2 class='vd_btn vd_bg-yellow vd_blue pd-20'>Accepting applications/resumes for future positions.</h2>     
      <?php endif; ?>

      <?php if($data["user_hiring"] == "y" && $data["user_accepting_application"] == "y"): ?><p class="pd-20"></p>
      <h2 class='vd_btn vd_bg-green vd_white pd-20'> We are hiring! </h2>     
      <?php endif; ?>
      
      <?php if($data["user_hiring"] == "y" || $data["user_accepting_application"] == "y" ): ?>
      
      <p><h4> <i> We respect your search, and understand the importance of a private search. All information exchanged shall remain confidential between talent member and flight department.</i></h4></p>
      <br/>
     
       <?php if(count($data["openings"]) < 1 ):?>
       <h3 class="widget-title"> New jobs coming soon!</h3>
      <?php else: ?>
        <div class="panel widget">
      <?php foreach($data["openings"] as $opening): ?>
       <div class="panel-body" style="background-color:#DBF4FD;">
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
               <div class="col-md-7 col-xs-12 pd-15">
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
                  <h5><b> Location : </b> <?php echo $opening->state  == "l" ? "Less than 100 miles" : "Any Distance"; ?></h5>
                  <h5><b>College Degree : </b> <?php echo $opening->college  == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b> Masters Degree  : </b> <?php echo $opening->masters  == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b> Volunteer Work : </b> <?php echo $opening->volunteer  == "y" ? "Required" : "Not Required"; ?></h5>
                  <h5><b> Salary Range : </b> <?php echo $opening->salary_range; ?></h5>
                  <h5><b> Benefits: </b> <?php echo select_benefits($opening->benefits); ?></h5>
                  <br/>
                  <div class="mgbt-xs-10">

                   <?php if($this->session->userdata("user_type")  != "d" && ($data["user_hiring"] == "y" || $data["user_accepting_application"] == "y")): ?>
                   <?php if(in_array($opening->id, $data["jobsApplied"])): ?>
                        <a type="button" class="btn vd_btn vd_bg-gray btn-block" disabled><b> Already Applied </b> </a>
                      <?php else: ?>
                       
                        <!-- <a type="button" href="?apply=<?php //echo $opening->id; ?>" class="btn vd_btn vd_bg-green btn-block"><b> Apply </b> </a>-->
                       <a type="button" href="<?php echo secure_url('flight-dispatch-board/jobdetail/'.urlencode(base64_encode($opening->id))); ?>" class="btn vd_btn vd_bg-green btn-block"><b> Apply </b> </a>
                      <?php endif; ?><?php endif; ?>
                  
                     <br/>
                     <?php if($this->session->userdata("user_type")  == "d"): ?>
                     <button type="button" data-id="<?php echo $opening->id; ?>" class="deleteOption btn vd_btn vd_bg-red btn-block"><b> Remove Post  </b> </button>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      <?php endforeach; ?></div><?php endif; ?> 
      <?php endif; ?> 
     
       <!----- For Flight Departments   --->  
</div>
</div>
</div>
</div>
</div></div>
</career>
<script>
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
                  <h5><strong class="font-semibold">Are you sure, do you want to remove this job position? </strong></h5>
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
   
 
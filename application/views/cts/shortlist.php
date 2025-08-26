<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header vd_bg-green">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title vd_white">Applicant Details</h4>
        </div>
        <div class="modal-body">  
                <div class="row">
                <div class="col-md-8 col-xs-12">
                    <h5><strong class="font-semibold"> <b> <?php echo $job->mfr . ' - ' . $job->model; ?></b></strong></h5>                  
                    <h5><strong class="font-semibold"> <?php echo $job->title; ?></strong></h5>
                    <h6> Job Type : <?php echo $job->is_fulltime == 'y' ? 'Full Time' : 'Part Time'; ?></h6>
        <h6>  Average hours flown per year :  <?php echo $job->hours; ?></h6>
        <h6> FAR Part 91 or 135 :  <?php echo $job->far; ?></h6>
        <br/>
        <?php if($job->target == 'c' || $job->target == 'o' || $job->target == 'p'): ?>
          <h6>Certificates :  <?php echo $job->pilot_0; ?></h6>
          <h6> Aircraft Type Rating   :  <?php echo $job->pilot_1 == "y" ? "Required" : "Not Required"; ?></h6>
          <h6> Currency :  <?php echo $job->pilot_2 == "y" ? "Required" : "Not Required"; ?></h6>
          <h6>  Time in Type  :  <?php echo $job->pilot_3; ?></h6>
          <h6>  Pilot-in-Command Time in Type :  <?php echo $job->pilot_4; ?></h6>
          <h6>  Total Time  :  <?php echo $job->pilot_5; ?> </h6>
          <h6>  Total Pilot-in-Command :  <?php echo $job->pilot_6 == "y" ? "Required" : "Not Required"; ?> </h6>
        <?php elseif($job->target == 'm'): ?>
          <h6> 3 year minimum experience as A&P mechanic :  <?php echo $job->mechanic_0 == "y" ? "Required" : "Not Required"; ?></h6>
          <h6> Must have experience or training on Aircraft :  <?php echo $job->mechanic_2 == "y" ? "Required" : "Not Required"; ?></h6>
          <h6> Bachelors Degree :  <?php echo $job->mechanic_3 == "y" ? "Required" : "Not Required"; ?></h6>
        <?php elseif($job->target == 'a'): ?>
          <h6> 2 year minimum experience in Customer Service :  <?php echo $job->flight_0 == "y" ? "Required" : "Not Required"; ?></h6>
          <h6> FAA flight attendant certificate (trained under part 121) :  <?php echo $job->flight_1 == "y" ? "Required" : "Not Required"; ?></h6>
          <h6> Must have part 91 or 135 training at one of the following :  <?php echo $job->flight_2 == "y" ? "Required" : "Not Required"; ?></h6>
          <h6> Must have had part 91 or 135 training in the last 12 months :  <?php echo $job->flight_3 == "y" ? "Required" : "Not Required"; ?></h6>
          <h6> Must have experience or training on Aircraft :  <?php echo $job->flight_4 == "y" ? "Required" : "Not Required"; ?></h6>
        <?php elseif($job->target == 'd'): ?>
          <h6> 2 years minimum experience :  <?php echo $job->dispatcher_0 == "y" ? "Required" : "Not Required"; ?></h6>
          <h6> Must have part 91 or part 135 experience :  <?php echo $job->dispatcher_1 == "y" ? "Required" : "Not Required"; ?></h6>
        <?php endif; ?>
        <br/>
        <!--<h6>Location :  <?php /*if($job->state == "l"){echo('Less than 100 miles');}
        elseif($job->state == "a"){echo('Any Distance');}?></h6>
        <h6>College Degree :  <?php echo $job->college == "y" ? "Required" : "Not Required"; ?></h6>
        <h6> Masters Degree  :  <?php echo $job->masters == "y" ? "Required" : "Not Required"; ?></h6>
        <h6> Volunteer Work :  <?php echo $job->volunteer == "y" ? "Required" : "Not Required"; ?></h6>
        <h6> Salary Range :  <?php echo $job->salary_range; ?></h6>
        <h6> Benefits:  <?php if($job->benefits == 0){echo('Company Paid Medical Dental and Vision');}
        elseif($job->benefits == 1){echo('Company Paid Short Term Disability, Long Term Disability, and Basic Life');}
        elseif($job->benefits == 2){echo('401k');}
        elseif($job->benefits == 2){echo('Company');}
         */?></h6>-->
                        
                </div><div class="col-md-4 col-xs-12">
                   <!-- <img style="max-width: 150px" src="<?php //echo RIZ_UPLOAD_AIRCRAFT . $job->photo; ?>" />--><br/>
                    <?php if($application->message <> ""):?>
                    <h5> Applicant Message: </h5>
                    <?php echo $application->message; endif;?>
                    <br/><br/>
                    <a href="<?php echo site_url("pilot/" . $application->user_id . "/profile"); ?>" target="_blank" class="btn vd_btn vd_bg-twitter btn-block"> View Profile </a>
                    <br/>
                    <?php if($application->resume != ''): ?>
                        <a href="<?php echo site_url('upload/member/resume/'.$application->resume); ?>" target="_blank" class="btn vd_btn vd_bg-twitter btn-block"> Download Resume</a>
                    <?php endif; ?>
                    <br/>
                    <?php //if($job->plan == L8_JOB_PLAN_PAID) { ?>
                     <!--   <a href="candidate-tracking/addendum/<?php //echo(encrypt($application->id)."/".$application->user_id); ?>" target="_blank" class="btn vd_btn vd_bg-twitter btn-block"> View Addendum</a>-->
                    <?php //} ?>
                    
                </div>
                </div>              
             
        </div>   
                     
        <?php if($application->status == 'p'): ?>
        <div class="modal-footer vd_bg-green">
            <?php //echo $application->status; ?>
            <a href="<?php echo site_url('candidate-tracking/shortlist/' . $id . '/' . $application->id . '/confirm'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
         <i class="fa fa-check"></i></span> Shortlist this Applicant </button></a>
        </div>
        <?php endif;?>
    </div>
</div>

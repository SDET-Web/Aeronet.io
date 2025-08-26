<div class="row" style="margin-top:80px;padding:30px;">
    <div class="<?php echo $showSideBar ? 'col-md-8' : 'col-md-12'; ?> col-sm-12">
        <h3><?php echo singular(select_job_type($job->target)); ?> for <?php echo $job->mfr ." " , $job->model; ?></h3>
        <h6> Job Function : <?php echo singular(select_job_type($job->target)); ?> </h6>
        <h6> Job Type : <?php echo $job->is_fulltime == 'y' ? 'Full Time' : 'Part Time'; ?></h6>
        <h6>  Average hours flown per year :  <?php echo $job->hours; ?></h6>
        <h6> FAR Part 91 or 135 :  <?php echo $job->far; ?></h6>
        
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
        <h6>Location :  <?php if($job->state == "l"){echo('Less than 100 miles');}
        elseif($job->state == "a"){echo('Any Distance');}?></h6>
        <h6>College Degree :  <?php echo $job->college == "y" ? "Required" : "Not Required"; ?></h6>
        <h6> Masters Degree  :  <?php echo $job->masters == "y" ? "Required" : "Not Required"; ?></h6>
        <h6> Volunteer Work :  <?php echo $job->volunteer == "y" ? "Required" : "Not Required"; ?></h6>
        <h6> Salary Range :  <?php echo $job->salary_range; ?></h6>
        <h6> Benefits:  <?php if($job->benefits == 0){echo('Company Paid Medical Dental and Vision');}
        elseif($job->benefits == 1){echo('Company Paid Short Term Disability, Long Term Disability, and Basic Life');}
        elseif($job->benefits == 2){echo('401k');}
        elseif($job->benefits == 2){echo('Company');}
         ?></h6>
        
    </div>
    <?php if($showSideBar): ?>
    <form id="job_form" name="form" method="post" enctype="multipart/form-data" onsubmit="set_form_fields()">
        <input type="hidden" name="action" value="submit_video"/>

        <div class="col-md-4 col-sm-12">
            <h1>Video Interview</h1>
            
            <?php if($pipelineAnswered == L8_INSERT_ERROR):?>
            <p>Please upload a video providing answers to the following questions</p>
            <ul>
            <?php foreach($questions as $question): ?>
              <li><?php echo $question; ?><br /></li>
            <?php endforeach; ?>
            </ul>
            <input type="file" name="videofile" />
            <br />
                <button type="submit" class="btn button-main2" id="purchase" style="width: 100%">Submit</button>
            </div>
          <?php else: ?>
            <p>Download the video answers to the following questions</p>
            <ul>
            <?php foreach($questions as $question): ?>
              <li><?php echo $question; ?><br /></li>
            <?php endforeach; ?>
            </ul>
            <br />
            <h4><a href="<?php echo site_url('upload/member/resume/' . $pipelineAnswered->response); ?>" target="_blank">
            View Video Answer </a><a href=<?php echo(site_url("flight-dispatch-board/video/".$pipelineAnswered->id));?>>
               <span class="append-icon">
               <i class="fa fa-times"></i></span></a></h4>
                        
            </div>
          <?php endif; ?>
        </div>
    </form>
    <?php endif; ?>
</div>
<div class="clear"></div>
<div class="space"></div>

<script type="text/javascript" src="<?php echo RIZ_SKIN; ?>js/jquery.v1.7.2.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('.employer a').click(function () {
            $this = $(this);

            <?php if(is_logged_in() && !is_paid_member() && $this->session->userdata('user_credit') <= 0){?>
            $('.error_msg').show();
            return false;
            <?php } ?>
        });
    });
</script>

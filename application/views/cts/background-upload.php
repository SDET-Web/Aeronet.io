<div class="row" style="margin-top:50px;padding:30px;">
    <div class="<?php echo $showSideBar ? 'col-md-7' : 'col-md-12'; ?> col-sm-12">
        <h4><?php echo singular(select_job_type($job->target)); ?> for <?php echo $job->mfr ." " , $job->model; ?></h4>
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
    <div class="col-md-5 col-xs-12">
     <h3>Background Checks</h3>
    <?php if($questions == ''):?>
     <br/><h5>Flight department will send you PDF document to download please answer all questions in provided document and upload the SCANS on this page.</h5>
    <?php endif;?>
               
    <?php if($questions != '' and $pipelineAnswered == L8_INSERT_ERROR): ?> 
      <h5><br/> Congratulation you are selected for </h5><?php echo($questions); ?><h5>After completing forms please scan and upload here.</h5>
      
      <?php if($addons == '1' or $addons == '2'): 
       if($video>0):echo'You have uploaded total( '.$video.' out of 6 ) FAA GOV Pilot Form'; endif; ?>
      <?php for ($i = 0; $i <=6; $i++): ?>
      <?php if($video == $i):?>
       <form id="job_form" name="form" method="post" enctype="multipart/form-data" onsubmit="set_form_fields()">
        <input type="hidden" name="action" value="submit_video<?php echo($video+1);?>"/>          
        <input type="file" name="videofile" />
            <br/>
            <button type="submit" class="btn button-main2" id="purchase" style="width: 100%">Submit Form <?php echo($video+1);?></button><hr>
             </form>
      <?php endif; ?>
      <?php endfor; ?>          
       <?php else:?>
        <form id="job_form" name="form" method="post" enctype="multipart/form-data" onsubmit="set_form_fields()">
        <input type="hidden" name="action" value="submit_video"/>          
        <input type="file" name="videofile" />
            <br/>
            <button type="submit" class="btn button-main2" id="purchase" style="width: 100%">Submit Form</button><hr>
             </form>      
                            
        <?php endif;?>
      <?php endif; ?>
      
      
      
      <?php if($addons == '1' or $addons == '2'): ?>
      <?php if($pipelineAnswered <> L8_INSERT_ERROR and $answers<>''):?>
            <br/>
            <h5>Thanks for your timely response our team will review your documents and contact you soon.</h5>
            <?php for ($i = 0; $i <=5; $i++): 
             $str1= explode(',', $answers[$i]);?>
            <br/><a href="<?php echo site_url('upload/member/resume/' . $str1[0]); ?>" target="_blank"><span class="append-icon">
               <i class="fa fa-download"></i></span> &nbsp; <?php echo($i+1);?> . View  Document ( <?php echo($str1[0]);?> )</a>  
               <a href=<?php echo(site_url("flight-dispatch-board/background-check/".$str1[1]));?>>
               <span class="append-icon">
               <i class="fa fa-times"></i></span></a>
          <?php endfor; ?>
          <?php endif; ?>      
      <?php else:?>
      <?php if($pipelineAnswered <> L8_INSERT_ERROR and $pipelineAnswered->response <> ''):?>
            <br/>
            <h5>Thanks for your timely response our team will review your document and contact you soon.</h5>
            <a href="<?php echo site_url('upload/member/resume/' . $pipelineAnswered->response); ?>" target="_blank"><span class="append-icon">
            <i class="fa fa-download"></i></span> View Document ( <?php echo($pipelineAnswered->response);?> ) </button></a> 
            <a href=<?php echo(site_url("flight-dispatch-board/background-check/".$pipelineAnswered->id));?>>
               <span class="append-icon">
               <i class="fa fa-times"></i></span></a>
          <?php endif; ?>
      
      <?php endif; ?>
      
     
        
   
    <?php endif; ?>
</div></div>

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

<div class="row" style="padding: 30px;">
    <div class="<?php echo $showSideBar ? 'col-md-8' : 'col-md-12'; ?> col-sm-12">
        <h2 class="color-lightgray"><?php echo singular(select_job_type($job->target)); ?> for <?php echo $job->mfr ." " , $job->model; ?></h2>
        <h5><b> Job Function :</b> <?php echo singular(select_job_type($job->target)); ?> </h5>
        <h5><b> Job Type :</b> <?php echo $job->is_fulltime == 'y' ? 'Full Time' : 'Part Time'; ?></h5>
        <h5><b>  Average hours flown per year : </b> <?php echo $job->hours; ?></h5>
        <h5><b> FAR Part 91 or 135 : </b> <?php echo $job->far; ?></h5>
        <br/>
        <?php if($job->target == 'c' || $job->target == 'o' || $job->target == 'p'): ?>
          <h5><b>Certificates : </b> <?php echo $job->pilot_0; ?></h5>
          <h5><b> Aircraft Type Rating   : </b> <?php echo $job->pilot_1 == "y" ? "Required" : "Not Required"; ?></h5>
          <h5><b> Currency : </b> <?php echo $job->pilot_2 == "y" ? "Required" : "Not Required"; ?></h5>
          <h5><b>  Time in Type  : </b> <?php echo $job->pilot_3; ?></h5>
          <h5><b>  Pilot-in-Command Time in Type : </b> <?php echo $job->pilot_4; ?></h5>
          <h5><b>  Total Time  : </b> <?php echo $job->pilot_5; ?> </h5>
          <h5><b>  Total Pilot-in-Command : </b> <?php echo $job->pilot_6 == "y" ? "Required" : "Not Required"; ?> </h5>
        <?php elseif($job->target == 'm'): ?>
          <h5><b> 3 year minimum experience as A&P mechanic : </b> <?php echo $job->mechanic_0 == "y" ? "Required" : "Not Required"; ?></h5>
          <h5><b> Must have experience or training on Aircraft : </b> <?php echo $job->mechanic_2 == "y" ? "Required" : "Not Required"; ?></h5>
          <h5><b> Bachelors Degree : </b> <?php echo $job->mechanic_3 == "y" ? "Required" : "Not Required"; ?></h5>
        <?php elseif($job->target == 'a'): ?>
          <h5><b> 2 year minimum experience in Customer Service : </b> <?php echo $job->flight_0 == "y" ? "Required" : "Not Required"; ?></h5>
          <h5><b> FAA flight attendant certificate (trained under part 121) : </b> <?php echo $job->flight_1 == "y" ? "Required" : "Not Required"; ?></h5>
          <h5><b> Must have part 91 or 135 training at one of the following : </b> <?php echo $job->flight_2 == "y" ? "Required" : "Not Required"; ?></h5>
          <h5><b> Must have had part 91 or 135 training in the last 12 months : </b> <?php echo $job->flight_3 == "y" ? "Required" : "Not Required"; ?></h5>
          <h5><b> Must have experience or training on Aircraft : </b> <?php echo $job->flight_4 == "y" ? "Required" : "Not Required"; ?></h5>
        <?php elseif($job->target == 'd'): ?>
          <h5><b> 2 years minimum experience : </b> <?php echo $job->dispatcher_0 == "y" ? "Required" : "Not Required"; ?></h5>
          <h5><b> Must have part 91 or part 135 experience : </b> <?php echo $job->dispatcher_1 == "y" ? "Required" : "Not Required"; ?></h5>
        <?php endif; ?>
        <br/>
        <h5><b>College Degree : </b> <?php echo $job->college == "y" ? "Required" : "Not Required"; ?></h5>
        <h5><b> Masters Degree  : </b> <?php echo $job->masters == "y" ? "Required" : "Not Required"; ?></h5>
        <h5><b> Volunteer Work : </b> <?php echo $job->volunteer == "y" ? "Required" : "Not Required"; ?></h5>
        <h5><b> Salary Range : </b> <?php echo $job->salary_range; ?></h5>
        <h5><b> Benefits: </b> <?php echo $job->benefits; ?></h5>
        <div class="form-level2" style="padding: 30px 0; text-align: center;">
            <button onclick="window.print()" class="btn button-main2" style="background:#333">Print</button>
            <a href="mailto:<?php echo $job->title; ?>?Subject='New Job on AeroNet.io '" class="btn button-main2" target="_blank" style="background:#333">Share</a>
        </div>
    </div>
    <?php if($showSideBar): ?>
    <form id="job_form" name="form" method="post" enctype="multipart/form-data" onsubmit="set_form_fields()">
        <input type="hidden" name="action" value="postApplication"/>

        <div class="col-md-4 col-sm-12">
            <h1>Application</h1>
            <?php if($application != L8_INSERT_ERROR): ?>
                <div>
                    <h3>Resume</h3>
                    <pre><a target="_blank" href="<?php echo site_url('upload/member/resume/'.$application->resume); ?>"><?php echo $application->resume; ?></a></pre>
                </div>
            <?php endif; ?>

            <?php
            if($this->session->userdata("user_type") == "d") {
              $this->load->view('job/answers', array('addendum' => $applicant->addendum));
            } else {
              $this->load->view('job/questions', array('addendum' => $applicant->addendum));
            }

            ?>
                <button type="submit" class="btn button-main2" id="purchase" style="width: 100%">Apply Now</button>
            </div>
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

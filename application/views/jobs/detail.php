<section id="featureW">
    
    <?php if($department == L8_INSERT_ERROR):?>
       <h4 class="color-lightgray center"><strong>This job is on hold.</strong></h4>
    <?php else: ?>
    

<div class="row" style="padding:15px;">
    <div class="<?php echo $showSideBar ? 'col-md-6' : 'col-md-12'; ?> col-sm-12">
                
        <h4 class="color-lightgray"><strong><?php echo $job->title; ?></strong></h4>
        <div class="row">
            <div class="col-md-6">
                <div class="color-lightgray">
                    <h5 class="color-lightgray">Make-Model : <br/> <?php echo $job->mfr . ' - ' . $job->model; ?> </h5>
                </div>
                <div class="color-lightgray"><h5 class="color-lightgray">Location : <?php echo $job->state; ?></h5></div>
                <div class="color-lightgray"><b>Posted
                        On : </b> <?php echo date(RIZ_FORMAT, $job->created); ?></div>

                <!--<div class="color-lightgray"><b> Closing : </b>
                <?php //echo date(RIZ_FORMAT, $job->due); ?></div>-->


            </div>
            <div class="col-md-6">
                <?php if ($job->photo != '') { ?>
                    <div class="left" style="width:160px; float: right;"><img style="max-width: 150px" src="<?php echo RIZ_UPLOAD_AIRCRAFT . $job->photo; ?>"/>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div style="padding: 30px 0;">
            <h5>Job Description : </h5>
            <div class="color-lightgray"><?php echo $job->description; ?></div>
            <h5>Job Requirements : </h5>
            <div class="color-lightgray"><?php echo $job->requirements; ?></div>
        </div>

        <div class="form-level2" style="padding: 20px 0; text-align: center;">
            <button onclick="window.print()" class="btn button-main2" style="background:#333">Print</button>
            <a href="mailto:name@gmail.com?Subject=<?php echo $job->title; ?>&Body=<a href='www.aeronet.io'>Visit AeroNet.io for more details</a>" class="btn button-main2" style="background:#333">Share</a>
        </div>
    </div>
    <?php if($showSideBar): ?>
    <form id="job_form" name="form" method="post" enctype="multipart/form-data" onsubmit="set_form_fields()">
        <input type="hidden" name="action" value="postApplication"/>

        <div class="col-md-6 col-sm-12">
            <h1>Application</h1>
            <?php if($application != L8_INSERT_ERROR): ?>
                <?php if($department != L8_INSERT_ERROR): ?>
            <span style="color:#a5d24a"> You have applied for this job and your application is under review.<br/>
            <a href='<?php echo site_url('my/appliedjobs'); ?>'>Click here to Check Status of your application</a></span>
                <?php endif; ?>
                <div>
                    <h3>Resume</h3>
                    <strong><a target="_blank" href="<?php echo site_url('upload/member/resume/'.$application->resume); ?>">View current resume on file <?php // echo $application->resume; ?></a>
               </strong> </div>
                <div>
                    <h3>Message</h3>
                    <pre><?php echo $application->message; ?></pre>
                </div>
            <?php else: ?>
                <div class="form-group">
                    <label class="control-label">Upload Professional Resume <br />
                    </label>
                    
                         <style>.image-upload input{display: none;} .image-upload img{width: 280px;cursor: pointer;}</style> 
                         <div class="image-upload"><label for="file-input"><img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/DCT.jpeg"/>
                         </label><input id="file-input" type="file" name="resume"/></div>
                        
                    
                    <?php if(isset($applicant->user_resume)): ?>
                         <strong>
                        <a target="_blank" href="<?php echo site_url('upload/member/resume/'.$applicant->user_resume); ?>">View current resume on file <?php //echo $applicant->user_resume; ?></a>
                       </strong>  <div class="clearfix"></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="control-label">Message<br />
                    </label>
                    <?php form_new_textarea_updated('', 'message', "" , false, 1, '', ''); ?>
                </div>
            <?php endif; ?>

            <?php if($department != L8_INSERT_ERROR && $job->plan == L8_JOB_PLAN_PAID) {
            $this->load->view('job/questions', array('addendum' => $applicant->addendum));
             }?>
            <?php if($application == L8_INSERT_ERROR): ?>
                <button type="submit" class="btn button-main2" id="purchase" style="width: 100%"> Apply Now </button>
             <?php else: ?> 
                <button type="submit" class="btn button-main2" id="purchase" style="width: 100%"> Update </button>
              <?php endif; ?>
            </div>
        
    </form>
    <?php endif; ?>
</div>
<div class="clear"></div>
 <p class="pt-40"></p>
<?php endif; ?> 
</section>

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

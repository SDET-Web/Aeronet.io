<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header vd_bg-green">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title vd_white">More Details</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <h5><strong class="font-semibold"> Aircraft (Make - Model) : <?php echo $job->mfr . ' - ' . $job->model; ?></strong></h5>
                    <h5><strong class="font-semibold"> Job Title : <?php echo $job->title; ?></strong></h5>
                    <h5><strong class="font-semibold"> Location(Airport): <?php echo $job->state; ?> </strong></h5>
                    <h5> Job Description : </h5>
                    <?php echo $job->description; ?>
                    <h5> Job Requirements :  </h5>
                    <?php echo $job->requirements; ?>
                    
                </div>
                <div class="col-md-4 col-xs-12">
                    <img style="max-width: 150px" src="<?php echo RIZ_UPLOAD_AIRCRAFT . $job->photo; ?>" /><br/>
                    <br/>
                    <br/>
                    <a href="<?php echo site_url("pilot/" . $application->user_id . "/profile"); ?>" target="_blank" class="btn vd_btn vd_bg-twitter btn-block"> View Profile </a>
                    <br/>
                    <?php if($application->resume != ''): ?>
                        <a href="<?php echo site_url('upload/member/resume/'.$application->resume); ?>" target="_blank" class="btn vd_btn vd_bg-twitter btn-block"> Download Resume</a>
                    <?php endif; ?>
                    <br/>
                </div>
                <div class="col-md-12 col-xs-12">
                 <h5> Application Message : </h5>
                    <?php echo $application->message; ?>
                    <?php
                    if($job->plan == L8_JOB_PLAN_PAID) {
                        $this->load->view('job/answers', array('addendum' => $applicant->addendum));
                    } ?>   
                </div>
            </div>
        </div>
        <?php //echo $application->status; ?>
         <?php if($application->status == 'p'): ?>
        <div class="modal-footer vd_bg-green">
            <a href="<?php echo site_url('applications/shortlist/' . $id . '/' . $application->id . '/confirm'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
         <i class="fa fa-check"></i></span> Shortlist this Applicant </button></a>
        </div>
        <? endif;?>
    </div>
</div>

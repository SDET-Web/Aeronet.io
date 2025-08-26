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
                  <h5><strong class="font-semibold"> Pilot certificate:  <?php echo $applicant->user_certificate == "" ? "Not Provided" : $applicant->user_certificate; ?></strong></h5>
                  <h5><strong class="font-semibold"> Aircraft type rating for that specific aircraft : <?php echo $job->aircraft_type_rating == "" ? "Not Provided" : $job->aircraft_type_rating; ?></strong></h5>
                  <h5><strong class="font-semibold"> Highest Flight Time in your Aircraft Type : <?php echo $applicant->flightTime['maxFlight']; ?> </strong></h5>
                  <h5><strong class="font-semibold">Highest Total Flight Time : <?php echo $applicant->flightTime['total']['Total Flight Time']; ?></strong></h5>
                    <h5><strong class="font-semibold"> Location: <?php echo location_range($job->state); ?> </strong></h5>
                </div>
                <div class="col-md-4 col-xs-12">
                    <a href="<?php echo site_url("pilot/" . $application->user_id . "/profile"); ?>" target="_blank" class="btn vd_btn vd_bg-twitter btn-block"> View Profile </a>
                    <br/>
                    <?php if($application->resume != ''): ?>
                        <a href="<?php echo site_url('upload/member/resume/'.$application->resume); ?>" target="_blank" class="btn vd_btn vd_bg-twitter btn-block"> Download Resume</a>
                    <?php endif; ?>
                    <br/>
                </div>
            </div>
        </div>
        <div class="modal-footer vd_bg-green">
            <a href="<?php echo site_url('applications/shortlist/' . $id . '/' . $application->id . '/confirm'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
         <i class="fa fa-check"></i></span> Shortlist this Applicant </button></a>
        </div>
    </div>
</div>

<div style="text-align: center">
    <div class="left" style="width:800px; text-align: left; margin: auto;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="color-lightgray"><strong><?php echo $job->title; ?></strong></h1>
            </div>
            <div class="col-md-6">
                <div class="color-lightgray"><h5 class="color-lightgray"><?php echo $job->state; ?></h5></div>
                <div class="color-lightgray"><b>Posted
                        On:</b> <?php echo date(RIZ_FORMAT, $job->created); ?></div>
                <div class="color-lightgray">
                    <b>Make-Model:</b> <?php echo $job->mfr . ' - ' . $job->model; ?>
                </div>
            </div>
            <div class="col-md-6">
                <?php if ($job->photo != '') { ?>
                    <div class="left" style="width:160px; float: right;"><img style="max-width: 150px" src="<?php echo RIZ_UPLOAD_AIRCRAFT . $job->photo; ?>"/>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="form-level2" style="padding: 30px 0; text-align: center;">
            <?php if(!is_department()): ?>
                <a href="<?php echo secure_url('/flight-dispatch-board/apply/'.encrypt($job->id)); ?>" class="btn button-main2">Apply</a>
            <?php endif; ?>
            <button onclick="window.print()" class="btn button-main2" style="background:#333">Print</button>
            <a href="http://www.google.com" class="btn button-main2" target="_blank" style="background:#333">Share</a>
        </div>
        <div style="padding: 30px 0;">
            <h5>Job Description</h5>
            <div class="color-lightgray"><?php echo $job->description; ?></div>
            <h5>Job Requirements</h5>
            <div class="color-lightgray"><?php echo $job->requirements; ?></div>
        </div>
    </div>
</div>

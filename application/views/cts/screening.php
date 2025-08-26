<div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header vd_bg-green">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title vd_white">ADDITIONAL SCREENING </h4>
      </div>
      <div class="modal-body">
         <div class="row">
            <div class="col-md-12 col-xs-12">
                <?php if($pipelineAddendumSent != L8_INSERT_ERROR): ?>
<?php /*
               <a href="<?php echo site_url("candidate-tracking/screening/" . $application->id . "/accept/confirm"); ?>" class="btn vd_btn vd_bg-green btn-block">Qualify Applicant</a>
               <br />
               <a href="<?php echo site_url("candidate-tracking/screening/" . $application->id . "/video/confirm"); ?>" class="btn vd_btn vd_bg-yellow btn-block">Request Video Interview</a>
               <br />
               <a href="<?php echo site_url("candidate-tracking/screening/" . $application->id . "/background/confirm"); ?>" class="btn vd_btn vd_bg-blue btn-block">Request Background Checks</a>
               <br />
               <?php if($pipelineAddendumSent != L8_INSERT_ERROR): ?>
*/ ?>               
                  <?php if($pipelineAddendumAnswered == L8_INSERT_ERROR): ?>
                      <button type="button" class="btn vd_btn vd_bg-twitter btn-block" disabled>Sent <?php echo date("m/d/Y h:i:s", $pipelineAddendumSent->created); ?></button>
                  <?php else: ?>
                      <a href="<?php echo site_url('candidate-tracking/addendum/' . encrypt($application->id)."/".$application->user_id); ?>" target="_blank" class="btn vd_btn vd_bg-green btn-block">View Addendum Answers</a>
                  <?php endif; ?>
               <?php else: ?>
                      <h5> <br/> Send Addendum Questions to the Applicant to start Assessment Testing Process: </h5>
                  <a type="button" href="<?php echo site_url("candidate-tracking/screening/" . $application->id . "/addendum_send/confirm"); ?>" class="btn vd_btn vd_bg-twitter btn-block">Send Addendum</a>
               <?php endif;?>

              <?php //echo $application->status; ?>
            </div>
         </div>
         <div class="clearfix">&nbsp;</div>
         <?php if($pipelineAddendumSent != L8_INSERT_ERROR): ?>
           <?php if($pipelineAddendumAnswered != L8_INSERT_ERROR): ?>
         <!-- <div class="row">
            <div class="col-md-12 col-xs-12">
               <h4 class="vd_green">
                  Addendum Answers
               </h4>
            </div>
         </div> -->
       <?php else: ?>
         <div class="row">
            <div class="col-md-12 col-xs-12">
               <h4 class="vd_green">
                  Not Answered yet
               </h4>
            </div>
         </div>
        <?php endif; ?>
      <?php endif; ?>

          <br/><br />   <?php if($application->status == 'f'): ?>
                 <a href="<?php echo site_url("candidate-tracking/screening/" . $application->id . "/accept/confirm"); ?>" class="btn vd_btn vd_bg-yellow btn-block">Qualify Applicant</a>
               <br />
               <a href="<?php echo site_url("candidate-tracking/screening/" . $application->id . "/video/confirm"); ?>" class="btn vd_btn vd_bg-blue btn-block">Request Video Interview</a>
               <br />
               <a href="<?php echo site_url("candidate-tracking/screening/" . $application->id . "/background/confirm"); ?>" class="btn vd_btn vd_bg-green btn-block">Request Background Checks</a>
               <?php endif; ?>

               <br />

      </div>
   </div>
   <div class="modal-footer vd_bg-green">
   </div>
</div>

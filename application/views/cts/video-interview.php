      <div class="modal-body">
        <div class="row" style="padding: 4em; padding-top:0px;"><div class="col-md-12 col-xs-12"><div class="panel widget">
          <?php if ($subscription->trial_left > 0) : ?>

            <h4 class="vd_red center-block">
              <p><br /> This feature not available for Free Trial Version. Please Subscribe and try again.</p>
            </h4>

          <?php else : ?>
            
            <?php if (array_search(L8_ADDON_VIDEO, isset($subscription->addons) && $subscription->addons != null ? $subscription->addons : []) === FALSE) : ?>
              
              
                <h4> Send 5 Video interviewing Questions to Pilots only that you would like to further advance in the interviewing process.
                  They will upload answers in video format no written answers will be accepted. </h4>

                <div class="panel-heading vd_bg-red">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dollar-sign"></i> </span> Video Interviewing + $19.00 / per candidate </h3>
                      </div>
                  <div class="panel-body">
                    <h4> Video Interviewing + $19.00 / per candidate </h4>
                    <p style="font-size:14px;">
                      * One-way virtual interview<br />
                      * One-way virtual showcase <br />
                    </p>
                    <div class="mgbt-xs-10">
            <a href="#" class="deleteOption btn vd_btn vd_bg-red btn-block" object-id1="<?php echo($subscription->id);?>" object-id2="<?php echo(L8_ADDON_VIDEO);?>"><span class="append-icon">
            <i class="fa fa-lock"></i></span>Place Order </button></a>    
                          
                    </div>
                  </div>
               

              <?php else : ?>
                <?php if ($pipelineAnswered == L8_INSERT_ERROR && $pipelineSent == L8_INSERT_ERROR) : ?>
                  <div class="col-md-12 col-xs-12">

                    <div class="panel widget">
                      <div class="panel-heading vd_bg-soft-green">
                        <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-camera"></i> </span> Send Video Interviewing Questions </h3>
                      </div>
                      <div class="panel-body">
                        <form id="job_form" name="form" method="post" enctype="multipart/form-data" action="<?php echo site_url("candidate-tracking/video/$id/$appId/confirm"); ?>">
                          <input type="hidden" name="action" value="postApplication" />
                          <ul class="list-wrapper pd-lr-10">
                            <li>
                              <div>
                                <?php for ($i = 0; $i < 4; $i++) : ?>
                                  <h5><strong class="font-semibold">Choose Question # <?php echo $i + 1; ?></strong></h5>
                                  <?php form_new_select_side($questions, "", "q" . $i, $this->input->post('q' . $i), true, 'text', '', ''); ?>
                                  <br />
                                  <br />
                                <?php endfor; ?>
                              </div>
                            </li>
                            <li>
                              <div>
                                <div class="mgbt-xs-10"><a href="#">
                                    <button type="submit" class="btn vd_btn vd_bg-yellow btn-block"><span class="append-icon">
                                        <i class="fa fa-check"></i></span> Send Now </button></a>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </form>

                      </div>
                    </div>
                  </div>

                <?php elseif ($pipelineAnswered == L8_INSERT_ERROR) : ?>
                  <div class="mgbt-xs-10">
                    <ol>
                      <?php foreach ($appQuestions as $question) : ?>
                        <li><?php echo $question; ?></li>
                      <?php endforeach; ?>
                    </ol>
                    <button class="btn vd_btn vd_bg-blue btn-block" disabled><span class="append-icon">
                        <i class="fa fa-check"></i></span>
                      Sent <?php echo date("m/d/Y h:i:s", $pipelineSent->created); ?>
                    </button>

                  </div>



                <?php else : ?>
                  <div class="mgbt-xs-10"><a href="#">
                      <a href="<?php echo site_url('upload/member/resume/' . $pipelineAnswered->response); ?>" target="_blank" class="btn vd_btn vd_bg-yellow btn-block"><span class="append-icon">
                          <i class="fa fa-download"></i></span>Click here to Download Video Answers </button></a>
                  </div>


                <?php endif; ?>
              <?php endif; ?>
              </div>
<!--
              <?php // if ($application->status == 'v') : ?>
                <a href="<?php //echo site_url("candidate-tracking/screening/" . $application->id . "/accept/confirm"); ?>" class="btn vd_btn vd_bg-yellow btn-block">Qualify Applicant</a>
                     <br />

                <a href="<?php //echo site_url("candidate-tracking/screening/" . $application->id . "/background/confirm"); ?>" class="btn vd_btn vd_bg-blue btn-block">Request Background Checks</a>
                <br />
              <?php //endif; ?>
!-->
            <?php endif; ?>
        </div>
        </div>
      </div>

<script>
$(document).ready(function () {
  $(".deleteOption").click(function() {
  $("#deleteYes").attr("href", "<?php echo site_url("subscription/addon/add");?>" + "/" + $(this).attr("object-id1") + "/" + $(this).attr("object-id2"));
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
            <h4 class="modal-title vd_white">Place Order</h4>
         </div>
         <div class="modal-body">
            <div>
               <div class="col-md-12 col-xs-12">
                   <h5><strong class="font-semibold">  Confirm Purchase!                
                      </strong></h5>
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
<?php
$detail1='<p style="font-size:12px;">
                              *  FAA Airman Certificate Verification<br/>
                              *  FAA Pilot Medical Certification Record (Pilots only)<br/>
                              *  FAA Pilot Accident/Incidents Check (Pilots only)<br/>
                              *  DOT Drug/Alcohol verification (2 year)<br/>
                              *  National Driver Registry<br/><br/>
                              The PRIA and aviation background check forms are located,  <a class="vd_blue" href="https://www.faa.gov/pilots/lic_cert/pria/forms_docs/" target="blank">Click Here</a>,
                                 there are 6 word document forms that correspond to the background checks available on AeroNet.
                                 </a>
                           </p>';
$detail2='<p style="font-size:12px;">
                              *  Pilot Certificate Verification<br/>
                              *  Pilot Medical Certification Record<br/>
                              *  Pilot Employer Record (5 year)<br/>
                              *  Drug and Alcohol (5 year)<br/>
                              *  National Driver Registry<br/><br/>
                              The PRIA and aviation background check forms are located,  <a class="vd_blue" href="https://www.faa.gov/pilots/lic_cert/pria/forms_docs/" target="blank">Click Here</a>,
                                 there are 6 word document forms that correspond to the background checks available on AeroNet.
                                 </a>
                           </p>';
$detail3='<p style="font-size:12px;"><br/>
 <a class="vd_blue" href="/upload/DOCS/Disclosure and Authorisation Form UK.pdf" target="blank">
 View BACKGROUND SCREENING DISCLOSURE & AUTHORIZATION DOC   </a>                                    </b>
                            </p>';
$detail6='<p style="font-size:12px;">
                              *   Education<br/>
                              * Employment<br/>
                              * Employment Gap Review<br/>
                              * Professional References<br/><br/>
                               <a class="vd_blue" href="/upload/DOCS/Disclosure and Authorisation Form UK.pdf" target="blank">   View BACKGROUND SCREENING DISCLOSURE & AUTHORIZATION DOC   </a>                                    </b>

                           </p>';
?>
<div class="modal-body">
   <div class="row" style="padding: 4em;padding-top:0px;">

        <?php if($subscription->trial_left > 0):?>
          <h4 class="vd_red center-block">
              <p><br /> This feature not available for Free Trial Version. Please Subscribe and try again.</p>
            </h4>
          <?php else:?>

        <div class="panel widget">

                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-magic"></i> </span> Choose your Plan and Place Order to Start </h3>
                  </div>
                  <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <?php $i=0; ?>
                       <?php foreach($piplelineBackground as $key => $step): ?>
                        <? $i++; ?>
                      <div class="panel panel-default">
                        <div class="panel-heading vd_bg-green vd_bd-green">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?echo($i);?>"> <?php echo $step["text"];?>  </a> </h4>
                        </div>
                        <?php if($step["subscribed"] <> false): ?>
                        <div id="collapse<?echo($i);?>" class="panel-collapse collapse in">
                        <?else:?>
                        <div id="collapse<?echo($i);?>" class="panel-collapse collapse">
                        <? endif;?>

                    <div class="panel-body">
                    <?php
                    if($i==1):
                    echo($detail1);
                    elseif($i==2):
                    echo($detail2);
                    elseif($i==3 || $i==4 || $i==5):
                    echo($detail3);
                    elseif ($i==6):
                    echo($detail6);
                    endif;
                    ?>

         <?php if($step["subscribed"] == false): ?>
             <h5 class="vd_black">  <?php echo $step["text"]; ?> + $<?php echo addon_prices($step["addon"]); ?> / per candidate </h5>
               <div class="mgbt-xs-10">
            <a href="#" class="deleteOption btn vd_btn vd_bg-red btn-block" object-id1="<?php echo($subscription->id);?>" object-id2="<?php echo($step["addon"]);?>"><span class="append-icon">
            <i class="fa fa-lock"></i></span>Place Order </button></a>



         </div>
       <?php else: ?>

          <ul class="list-wrapper pd-lr-10">
                           <li>
                              <div class="mgbt-xs-10"><a href="">
                                <?php if($piplelineBackground[$key]["sent"] == L8_INSERT_ERROR): ?>
                                 <a href="<?php echo site_url("candidate-tracking/background/" . $application->id . "/" . $key . "/confirm"); ?>" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                                 <i class="fa fa-check"></i></span>
                                 Click here to send require documents to the Applicant
                                </a>
                               <?php else: ?>
                                 <a target="_blank" href="<?php echo site_url('upload/forms/'.select_background_attachment_form($key)); ?>"><?php echo select_background_attachment_form($key); ?></a>
                                 <button class="btn vd_btn vd_bg-blue btn-block" disabled><span class="append-icon">
                                 <i class="fa fa-check"></i></span>
                                 Documents are Sent <?php echo date("m/d/Y h:i:s", $piplelineBackground[$key]["sent"]->created); ?>
                               </button>
                               <?php endif; ?>
                              </div>
                           </li>
                        </ul>
             <br/>
             <?php if($piplelineBackground[$key]["answered"] != L8_INSERT_ERROR): ?>
               <div class="mgbt-xs-10"><a target="_blank" href="<?php echo site_url('upload/member/resume/' . $piplelineBackground[$key]["answered"]->response); ?>">
                  <button type="button" class="btn vd_btn vd_bg-yellow btn-block"><span class="append-icon">
                  <i class="fa fa-download"></i></span>Click here to view and Download the scan documents </button></a>
               </div>
             <?php endif; ?>
           <?php endif; ?>
         </div>
                        </div>
                      </div>
             <?php Endforeach; ?>

                    </div>
                  </div>
                </div>
        </div>
            </div>
          <?php endif;?>
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
                   <h5><strong class="font-semibold"> Confirm Purchase!                   
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
<?php $allAircrafts = select_aircraft_make_model_byUserID($this->session->userdata('user_id'), false); ?>
<div class="vd_content-section clearfix" style="margin: 0;">
   <div class="row">
        <?php if($displayPaymentForm): ?>
           <form method="post" id="paymentForm">
              <input type="hidden" name="action" value="postAddons" />
              <input type="hidden" id="addonsMain" name="addons" value="" />
         <div class="col-md-4 col-xs-12 sidebar">
            <div class="panel widget vd_summary-panel">
               <div class="panel-heading vd_bg-blue">
                  <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dollar-sign"></i> </span> Summary </h3>
               </div>
               <div class="panel-body-list">
                  <div class="content-list menu-action-right" >
                     <div data-rel="scroll">
                        <ul class="list-wrapper pd-lr-15" id="cart">
                           <?php if($plan == L8_PLAN_PREMIUM_CTS || plans($subscription->braintree_plan)["hasCTS"] == true): ?>
                             <?php if($subscription->braintree_plan == L8_PLAN_PREMIUM_CTS): ?>
                           <li>
                              <span class="product-title"><strong>Applicant Tracking System</strong><br/>
                              <em class="vd_soft-grey">$<?php echo plans(L8_PLAN_CTS)["price"]; ?> / month base fee </em>
                              </span>
                              <br/>
                              <div class="menu-action"> <i>Paid</i> </div>
                           </li>
                         <?php else: ?>
                           <li>
                              <span class="product-title"><strong>Applicant Tracking System</strong><br/>
                              <em class="vd_soft-grey">$<?php echo plans(L8_PLAN_CTS)["price"]; ?> / month base fee </em>
                              </span>
                              <br/>
                              <div class="menu-action"> $<?php echo plans(L8_PLAN_CTS)["price"]; ?> </div>
                           </li>
                         <?php endif; ?>
                           <li>
                              <span class="product-title"><strong><?php echo $newAircraftCount; ?> N-numbers</strong><br/>
                              <em class="vd_soft-grey"> $<?php echo L8_PLAN_CTS_EXTRA ; ?> per month per N-number </em>
                              <?php foreach($selectedAircrafts as $count => $aircraft): ?>
                                <?php if(array_search($aircraft, $subscribedAircrafts) !== FALSE): ?>
                              <?php else: ?>
                                <br /><?php echo $allAircrafts[$aircraft]; ?>
                              <?php endif; ?>
                              <?php endforeach; ?>
                              </span>
                              <br/>
                              <div class="menu-action"> $<?php echo number_format(L8_PLAN_CTS_EXTRA * $newAircraftCount,2); ?> </div>
                           </li>
                           <?php endif; ?>
                           <li class="recruiter">
                              <span class="product-title">
                              <strong>Auto Recruiter</strong><br/>
                              </span><br/>
                               <div class="menu-action"> FREE </div>
                           </li>
                           <li class="video" style="display:none">
                              <span class="product-title">
                              <strong> Video Interviewing</strong><br/> $19.99 / per applicant
                              </span>
                           </li>
                           <li class="aviation" style="display:none">
                              <span class="product-title">
                              <strong> Aviation Background Check (Part 91)</strong><br/> $159.00 / per candidate
                              </span>
                           </li>
                           <li class="background" style="display:none">
                              <span class="product-title">
                              <strong> Background Check (Part 135)</strong><br/> $199.99 / per applicant
                              </span>
                           </li>
                           <li class="driving" style="display:none">
                              <span class="product-title">
                              <strong> Driving Records Check + National Driver Registry </strong><br/> $29.99 / per candidate
                              </span>
                           </li>
                           <li class="vehicle" style="display:none">
                              <span class="product-title">
                              <strong> Motor Vehicle Records</strong><br/> $19.99 / per applicant
                              </span>
                           </li>
                           <li class="criminal" style="display:none">
                              <span class="product-title">
                              <strong>Criminal Background Check + County Criminal, Misdemeanor and Felony Records Search</strong><br/> 
                              $34.00 / per candidate
                              </span>
                           </li>
                           <li class="resume" style="display:none">
                              <span class="product-title">
                              <strong> Resume Verifications</strong><br/> $19.99 / per applicant
                              </span>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div style="" class="closing text-right pd-15">
                     <span class="mgr-10">Total Price: </span><span>$<?php echo number_format($amount,2); ?></span>
                     <br/><?php if($amount != 0): ?>You will be charged after 60 Days Trial<?php endif; ?><br/><br/>
                     <?php if($amount != 0): ?>
                     <div id="payment-form"></div>
                     <input type="hidden" name="paymentMethod" id="paymentMethod" value="" />
                     <button type="button" class="btn vd_btn vd_bg-green btn-lg" id="purchase" style="width: 100%">Pay Now</button>
                     <?php else: ?>
                     <button type="submit" class="btn vd_btn vd_bg-green btn-lg" style="width: 100%"> Get Started  </button>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
       </form>
    
         <?php endif; ?>
    
    
      <div class="col-md-8 col-xs-12">
          <div style="text-align:center">
           <?php 
           if($displayPaymentForm < 1){
           if($subscription->braintree_plan <> L8_PLAN_PREMIUM_CTS){ ?><br/>
           <h3 class="vd_blue">A Complete Talent Acquisition Suit for small and Mid Size Flight Departments </h3> <br/>
           <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/hire-ring.png" class="img-responsive center-block" >
           <br/> <h5>Recruiting and Applicant Tracking Software(ATS) built around your aircraft and culture with automated work flows that mirror air carrier internal HR processes.</h5>
            <br/> <a href="<?php echo site_url('hiring-solutions'); ?>" >   
            <button type="button" class="btn vd_btn vd_bg-blue btn-md center-block"> Tell me more</button></a>                    
           <?php } else { ?>
             <br/><br/>
               <h3 class="vd_blue"> Your applicant tracking system is now available. </h3>
               <h4 class="vd_green"> Subscribed Aircraft : <?php $tmp = []; foreach($aircrafts as $aircraft){$tmp[] = $allAircrafts[$aircraft];} echo implode(",", $tmp); ?></h4>
               <h4 class="vd_blue">End Date of Subscription : <?php echo date("m/d/Y", strtotime($subscription->ends_at)); ?></h4>
               
             <?php } ?>
            <?php if($trial_days > 0): ?>
              <br/> <h4 class="vd_red"><?php echo round($trial_days/60/60/24); ?> days left in trial</h4>
              <?php elseif($trial_ended <= 0): ?>
              <br/> <h4 class="vd_red"> <b>Trial Ended </b></h4>
              <?php endif; ?>
                
         <br/><br/>
                  <h4 class="vd_gray text-center">
                     <?php form_new_select_updated($allAircrafts, "<b>Choose Aircraft (Make - Model)</b>", "aircrafts", $aircrafts, true, 'text', 'select an aircraft', '', '', true); ?>
                  </h4>
                  <?php if($subscription->braintree_plan != L8_PLAN_PREMIUM_CTS): ?>
                    <?if($trial_ended || $subscription->braintree_plan == L8_PLAN_BASIC): ?>
                    <button type="button" id="chooseAircraft" class="btn vd_btn vd_bg-green btn-md center-block">Upgrade to ATS</button>
                    <?php else: ?>
                      <button type="button" id="chooseAircraft" class="btn vd_btn vd_bg-green btn-md center-block"> Add Aircraft </button>
                    <?php endif; ?>
                <?php else:?>
                  <button class="btn vd_btn vd_bg-yellow btn-md center-block" id="chooseAircraft "> Update Aircraft  </button>
                  <?php endif; ?>
              
             <?php if($subscription->braintree_plan == L8_PLAN_PREMIUM_CTS): ?>
            
              <!-- <div class="mgbt-xs-10"><a href="<?php //echo site_url('flight-dispatch-board/create'); ?>">
                <button type="button" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon">
                <i class="fa fa-tasks"></i></span> Post Unlimited Jobs </button></a>
               </div>

               <div class="mgbt-xs-10"><a href="<?php //echo site_url('my/departments'); ?>">
                <button type="button" class="btn vd_btn vd_bg-black-60 btn-block"><span class="append-icon">
                <i class="fa fa-cogs"></i></span> Update your Career Page </button></a>
               </div>--><br/><br/><br/>
               <div class="mgbt-xs-10">
                <button type="button" class="deleteOption btn vd_btn vd_bg-red btn-block"><span class="append-icon">
                <i class="fa fa-times"></i></span> Cancel Applicant Tracking System </button>
               </div>
               <?php endif; ?>
           <?php } ?>
         </div>
        
   </div>   
   </div></div>
<script src="https://js.braintreegateway.com/web/dropin/1.9.4/js/dropin.min.js"></script>
<script>
   braintree.dropin.create({
       authorization: '<?php echo $braintreeToken; ?>',
       container: '#payment-form',
       card: {
           cardholderName: true
       },
       paypal: {
           flow: 'checkout',
           amount: <?php echo $amount; ?>,
           commit: true,
           displayName: "<?php echo $plan; ?> Plan Subscription",
           enableShippingAddress: false,

       },
       dataCollector: {
           paypal: true
       }
   }, function (createErr, instance) {
       $("#purchase").show();
       $("#purchase").click(function(){
           $("#purchase").attr("disabled", "disabled");
           instance.requestPaymentMethod(function (err, payload) {
               $("#paymentMethod").val(payload.nonce);
               $("#paymentForm").submit();
               $("#purchase").removeAttr("disabled");
           });
       });
   });

   $(document).ready(function(){
     <?php if($displayPaymentForm): ?>
       $( ".addon" ).on('switchChange.bootstrapSwitch', function(event, state) {
           if(state == true) {
              $("." + event.target.id).show();
               if ($("#addonsMain").val() != "") {
                 $("#addonsMain").val($("#addonsMain").val() + "," + event.target.value);
               } else {
                 $("#addonsMain").val(event.target.value);
               }
           } else {
             $("." + event.target.id).hide();
               var array = $("#addonsMain").val().split(",");
               var index = array.indexOf(event.target.value);
               array.splice(index, 1);
               $("#addonsMain").val(array.join(","));
           }
       });
       <?php elseif($subscription != L8_INSERT_ERROR): ?>
       $( ".addon" ).on('switchChange.bootstrapSwitch', function(event, state) {
           if(state == true) {
              $.post('<?php echo site_url('flight-dispatch-board/subscribe/addons/add'); ?>',{
                'subs': <?php echo $subscription->id; ?>,
                'addon': event.target.value,
                'status': 'y',

              }, function(response){
                console.log(response);
              });
           } else {
             $.post('<?php echo site_url('flight-dispatch-board/subscribe/addons/add'); ?>',{
               'subs': <?php echo $subscription->id; ?>,
               'addon': event.target.value,
               'status': 'n',

             }, function(response){
               console.log(response);
             });
           }
       });
       <?php endif; ?>

       $("#chooseAircraft").click(function() {
           $baseUrl = '<?php echo site_url("flight-dispatch-board/subscribe/addons/". ($plan == L8_PLAN_BASIC ? L8_PLAN_CTS : L8_PLAN_PREMIUM_CTS)); ?>';
           $baseUrl += '?aircrafts=' + $("#aircrafts").val().join(",");
           window.location.href = $baseUrl;
       });
   });


$(document).ready(function () {
  $(".deleteOption").click(function() {
    $("#deleteYes").attr("href", '<?php echo site_url("flight-dispatch-board/cancel");?>');
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
            <h4 class="modal-title vd_white">Cancel Applicant Tracking System Subscription</h4>
         </div>
         <div class="modal-body">
            <div>
               <div class="col-md-12 col-xs-12">
                   <h5><strong class="font-semibold">Do you want to Cancel Applicant Tracking System recurring Payment?</br>
                  Recurring System will not charge monthly subscription fee from next month.    
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
   

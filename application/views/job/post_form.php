    <div class="vd_content-section clearfix" style="margin:0;padding: 5px;">
        <div class="panel widget" style="margin-top:5px;">
            <?php if($subscription->braintree_plan != L8_PLAN_BASIC): ?>    
            <br/><a href="#" >
    <img src="/assets/backend/img/info-postjob.jpeg" type="button" data-toggle="modal" data-target="#DCT" class="img-responsive center-block"> </a>
        
        <br/><?php endif;?>
            <div class="panel-heading vd_bg-blue">
                <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-external-link-alt"></i></span> Job Post  </h3>
            </div>
            <div class="panel-body">
                <?php if(is_logged_in() && $this->session->userdata('user_type') == 'd'): ?>
                    <form id="job_form" name="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="postJob"/>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php form_new_select_updated(["" => "Select Position", "p" => "Pilot", "m" => "Mechanic", "a" => "Flight Attendent", "d" => "Flight Dispatcher"], "Looking For", "target", $this->input->post('target'), true); ?>
                                <br/>
                                <?php //form_new_select_updated(["" => "Select Plan", L8_PLAN_BASIC => "Basic Free / 30 day slot", L8_PLAN_PREMIUM => "Premium $99.99/ 30 day slot"], " Choose Your Subscription Plan", "plan", $this->input->post('plan'), true); ?>
                                <div class="form-level">
                                    <p>Job Title</p>
                                    <input type="text" id="job_title" name="job_title" required="required" value="<?php echo $this->input->post('job_title');?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?php form_new_select_updated(select_aircraft_make_model_byUserID($this->session->userdata('user_id')), "Choose Aircraft (Make - Model)", "aircraft", $this->input->post('aircraft'), true); ?>
                                <br/>
                                <?php form_new_input_updated('','state',$this->input->post('state'),true,'text','airports_autocomplete','Location(Airport)',''); ?>
                                <?php // form_new_select_updated(select_state(), "Location(Airport)", "state", $this->input->post('state'), true); ?>
                                 <br/>
                                <div class="form-level">
                                    <p>Your Aircraft Picture (optional)</p>
                                    <input type="file" name="userfile" id="photo"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 controls">
                                <div class="form-group">
                                    <?php 
                                    echo('check'.$this->input->post('target'));
                                    form_new_textarea_updated('Job Description', 'description', $this->input->post('description'), false, 10, 'width-100 form-control', ''); ?>
                                </div>
                                <br>
                                <div class="form-group">
                                    <?php form_new_textarea_updated('Job Requirements', 'requirements', $this->input->post('requirements'), false, 10, 'width-100 form-control', ''); ?>

                                </div>
                                <br/>
                                <?php if(is_object($subscription)): ?>
                                <div class="form-group">
                                    <button type="submit" class="btn vd_btn vd_bg-blue btn-block"><span class="append-icon"><i class="fa fa-external-link-alt"></i></span> Post Job Now </button>
                                </div>
                                <?php else: ?>
                                  <div class="form-group">
                                    <p>Please subscribe to a plan before you post the Job</p>
                                  </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    
 <div id="DCT" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <img src="/assets/backend/img/info-postjob.jpeg" class="img-responsive center-block">
      </div>
      <div class="modal-body">
          <p>

A premium job post includes a custom-prefilled, detailed and editable job description template.  Additionally, an industry standard aviation addendum will be attached to better understand an applicants background history. 

Job Post applicants will be directly imported into your Applicant Tracking System, filtered based on preselected requirements, and be available for further evaluation within your talent hiring pipeline.  </p> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>   
    
    
<? /*
<script src="https://js.braintreegateway.com/web/dropin/1.9.4/js/dropin.min.js"></script>
<script type="text/javascript">
    <?php if($this->input->get('formType')!=''){ ?>
    showPostForm('<?php echo $this->input->get('formType'); ?>');
    <?php } ?>
    <?php if($plan != "" && $plan != L8_PLAN_BASIC): ?>
    braintree.dropin.create({
        authorization: '<?php echo $braintreeToken; ?>',
        container: '#payment-form',
        card: {
            cardholderName: true
        },
        paypal: {
            flow: 'checkout',
            amount: <?php echo plans($plan)["price"]; ?>,
            commit: true,
            displayName: "<?php echo plans($plan)["name"]; ?> Plan Subscription",
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
        $(".addon").change(function(){
            if($(this).prop("checked") == true) {
                $("." + $(this).attr("id")).show();
            } else {
                $("." + $(this).attr("id")).hide();
            }
        });

        $(".addCTS").click(function() {
            $baseUrl = '<?php echo site_url("flight-dispatch-board/subscribe/addons/". ($plan == L8_PLAN_BASIC ? L8_PLAN_CTS : L8_PLAN_PREMIUM_CTS)); ?>';
            $baseUrl += '?aircrafts=' + $("#aircrafts").val().join(",");
            window.location.href = $baseUrl;
        });

    });
    <?php endif; ?>
    <?php if($subscription->braintree_plan == L8_PLAN_BASIC): ?>
    $(document).ready(function() {
        $("#plan").change(function() {
            if ($(this).val() != "<?php echo L8_PLAN_BASIC; ?>") {
                window.location.href = '<?php echo site_url('flight-dispatch-board/create/' . L8_PLAN_PREMIUM); ?>';
            }
        });
    });
    <?php endif; ?>
</script>
*/?>

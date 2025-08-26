<section id="main-sliderBlack" style="height:165px;">
<div class="center wow fadeInDown"><p class="pt-30"></p><h2>Verify to Signup</h2><br/> </div>      
</section>
<style>
    .alert{
    position:fixed; 
    top: 5px; 
    left: 25%; 
    width:72%;
    z-index:9999; }
</style>

    <?php if($msg != ''): ?>
<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>Error!</strong><p><?php echo $msg; ?></p></div>
<?php endif; ?>
<section id="feature" >
    <div class="container" style="padding:10px; ">         
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <h3>You can Signup on Aeronet.io by verifying your certificate number and phone number. </h3>
                        <div class="single-profile-bottom wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms" >
                            <div class="media">

                                <div class="media-body">
                                    <form method="post" id="registerPilot" action="register_new">                                       
                                    <input type="hidden" name="type" value="Anonymus" />   
                                     <input type="hidden" id="unique_id" name="unique_id" value="UID0000">
                                     <input type="hidden" name="signup_try" value="1" />
                                      <input type="hidden" name="action" value="register_pilot_step_phone" />
                                       <?php form_new_input_updated('','cnumber',$this->input->post('cnumber'),true,'text','','Your Certificate Number  *','<span class="form-icon fa fa-id-card"></span>'); ?>
                                       <label style="font-size:12px"> *Only for verification purposes, certificate number will not appear on profile.  </label>
                                    <p class="pt-10"></p>
                                    <label><img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/fusa.png"></label><label> &nbsp; +1 </label>
                                    <?php form_new_input_updated('','phone',$this->input->post('phone'),false,'text','','Enter your Phone','<span class="form-icon fa fa-phone"></span>'); ?>
                                    <label style="font-size:12px">Example (10 digits): xxxxxxxxxx</label>                    
                                    
                     <p class="pt-30 center-block">          
                      <button id="btn" class="button-round" type="submit">Send Verification Code</button> 
                      </p> <p class="pt-30"></p>  
                                </div>
                            </div><!--/.media -->
                        
                    </div>
                    
                </div>
            </form>
        </div></div>
</section>

<section id="main-sliderBlack" style="height:180px;">
<div class="center wow fadeInDown"><p class="pt-40"></p><h2>Verify Your Phone</h2> </div>      
</section>
<style>.alert{
    position:fixed; 
    top: 5px; 
    left: 25%; 
    width:72%;
    z-index:9999; }
</style>
    <?php if($msg != ''): ?>
<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>Error!</strong><p>
   <?php echo $msg; ?></p></div>
<?php endif; ?>
<section id="feature" >
    <div class="container" style="padding:10px; ">         
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="single-profile-bottom wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms" >
                            <div class="media">

                                <div class="media-body">
                                    <form method="post" id="registerPilot">
                                     <input type="hidden" name="type" value="Anonymus" />   
                                     <input type="hidden" id="unique_id" name="unique_id" value="UID0000">
                                     <input type="hidden" name="signup_try" value="1" />
                                    
                                    <input type="hidden" name="action" value="register_pilot_step_phone_verify" />

                                    <?php form_new_input_updated('','verification_code',$this->input->post('verification_code'),false,'text','','Verification Code','<span class="form-icon fa fa-user-secret"></span>'); ?>

                                    <!--
                                    <?php form_new_input_updated('','email',$this->input->post('email'),true,'text','','Your Email *','<span class="form-icon fa fa-user"></span>'); ?>
                                    <?php form_new_input_updated('','password',$this->input->post('password'),true,'password','','Your Password','<span class="form-icon fa fa-lock"></span>'); ?>
                                    -->
                                    
                        
                        <p class="pt-30 center-block">      
                        <button id="btn" class="button-round" type="submit">Verify My Phone</button>
                       </p><p class="pt-30"></p>  
                                </div>
                            </div><!--/.media -->
                        
                    </div>
                    
                </div>
            </form>
        </div></div>
</section>

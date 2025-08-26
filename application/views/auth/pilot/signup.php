<section id="main-sliderBlack" style="height:180px;">
<div class="center wow fadeInDown"><p class="pt-40"></p><h2>Create your Account</h2> </div>      
</section>
<style>.alert{
    position:fixed; 
    top: 5px; 
    left: 25%; 
    width:72%;
    z-index:9999; }
</style>
<?php if($msg != ''): ?>
<div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>Error!</strong><p><?php echo $msg; ?></p></div>
<?php endif; ?>
<section id="feature">
    <div class="container" style="padding:10px;">
      
            <div class="row">
            <div class="col-md-8 col-xs-12 col-md-offset-2">
                <h5>Enter your Email address and password to create account.</h5>
            <form method="post" id="registerPilot" >
                <input type="hidden" name="type" value="<?php echo $pilot['certificates'][0]['type']; ?>" />
                                    <input type="hidden" name="signup_try" value="<?php echo $signup_try; ?>" />
                                    <input type="hidden" name="action" value="register_pilot_step_3" />
                                    <input type="hidden" name="json" value="" />
                                    <input type="hidden" name="image" value="" />
                                    <input type="hidden" name="profile" value="" />
                                    <?php $count = 1; ?>                              
                                    <?php form_new_input_updated('','email',$this->input->post('email'),true,'text','','Your Email *','<span class="form-icon fa fa-user"></span>'); ?>
                                    <?php form_new_input_updated('','password',$this->input->post('password'),true,'password','','Your Password','<span class="form-icon fa fa-lock"></span>'); ?>
                                    <?php form_new_input_updated('','first_name',$pilot['first_name'],true,'text','','First Name *',''); ?>
                                    <?php form_new_input_updated('','last_name',$pilot['last_name'],true,'text','','Last Name *',''); ?>
                                    <?php form_new_input_updated('','address',$pilot['street1'],true,'text','','Address *',''); ?>
                                    <?php form_new_input_updated('','city',$pilot['city'],true,'text','','City *',''); ?>
                                    <?php form_new_input_updated('','state',$pilot['state'],true,'text','','State *',''); ?>
                                    <?php form_new_input_updated('','zipcode',$pilot['zip'],true,'text','','Zip *',''); ?>
                               
                        <p class="pt-30 center-block">          
                       <button id="btn" class="button-round" type="submit">Create My Account</button>&nbsp;
                       <button id="btn" class="button-round" type="button" onclick="window.location.href('<?php echo site_url('register/pilot'); ?>');">No, this isn't me</button>
                        </p>  
                        <p class="pt-40"></p>
                                </div>
                            </div><!--/.media -->
                        </div>
                       </form>
</section>

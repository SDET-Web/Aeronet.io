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
                <h5>Please Enter your details to create account.</h5> <br/>
                    
            <form method="post" id="registerPilot" >
            <input type="hidden" name="action" value="register_pilot_step_3" />
            <input type="hidden" name="json" value="" />
            <input type="hidden" name="image" value="" />
            <input type="hidden" name="profile" value="" />
            
            <?php echo form_new_select_updated(select_user_new(), "", "user_type", get_input_value('', 'user_type', 'user_type'), true); ?>
                               
            <?php form_new_input_updated('','first_name','',true,'text','','First Name *','<span class="form-icon fa fa-user"></span>'); ?>
            <?php form_new_input_updated('','last_name','',true,'text','','Last Name *','<span class="form-icon fa fa-user"></span>'); ?>
            <?php form_new_input_updated('','email',$this->input->post('email'),true,'text','','Your Email *','<span class="form-icon fa fa-envelope"></span>'); ?>
            <?php form_new_input_updated('','password',$this->input->post('password'),true,'password','','Your Password','<span class="form-icon fa fa-lock"></span>'); ?>

                        <p class="pt-30 center-block">          
                       <button id="btn" class="button-round" type="submit">Create My Account</button>
                        </p>  
                        <p class="pt-40"></p>
                                </div>
                            </div><!--/.media -->
                        </div>
                       </form>
</section>
